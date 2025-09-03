<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;
use App\Helpers\CartManagement;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Address;
use App\Models\Payment;

#[Title('Checkout - ShopEase')]
class CheckoutPage extends Component
{
    public $fullName, $email, $address1, $address2, $city, $state, $zip, $phone, $remarks;
    public $paymentMethod = 'creditCard';
    public $cardNumber, $expiryDate, $cvv, $cardName;

    public function mount(){
        $cart_items = Auth::check() ? CartManagement::getCartItemsFromDatabase() : CartManagement::getCartItemsFromCookie();

        if (count($cart_items) == 0) {
            return redirect('/products');
        }
    }

    public function placeOrder(){
        $this->validate([
            'fullName' => 'required|string|max:255',
            'address1' => 'required|string|max:255',
            'address2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'zip' => 'required|string|max:20',
            'phone' => 'required|string|max:20',
            'remarks' => 'nullable|string|max:255',
            // 'paymentMethod' => 'required|in:creditCard,paypal',
            // 'cardNumber' => $this->paymentMethod === 'creditCard' ? 'required|string|min:16|max:19' : 'nullable',
            // 'expiryDate' => $this->paymentMethod === 'creditCard' ? 'required|string' : 'nullable',
            // 'cvv' => $this->paymentMethod === 'creditCard' ? 'required|string|min:3|max:4' : 'nullable',
            // 'cardName' => $this->paymentMethod === 'creditCard' ? 'required|string' : 'nullable',
        ]);

        $cart_items = Auth::check() ? CartManagement::getCartItemsFromDatabase() : CartManagement::getCartItemsFromCookie();

        $line_items = [];

        foreach ($cart_items as $key => $item) {
            $line_items[] = [
                'price_data' => [
                    'currency' => 'lkr',
                    'unit_amount' => $item['unit_amount'] * 100,
                    'product_data' => [
                        'name' => $item['name'],
                    ]
                ],
                'quantity' => $item['quantity']
            ];
        }

        $order = new Order;
        $order->user_id = Auth()->user()->id;
        $order->total_amount = CartManagement::calculateGrandTotal($cart_items);
        $order->delivery_fee = 0;
        $order->status = 'pending';
        $order->order_remarks = $this->remarks ?? 'Order placed by ' . Auth()->user()->name;

        $address = new Address();
        $address->full_name = $this->fullName;
        $address->phone = $this->phone;
        $address->street_address = $this->address1 . $this->address2;
        $address->city = $this->city;
        $address->state = $this->state;
        $address->zip_code = $this->zip;

        $redirect_url = '';

        if ($this->paymentMethod == 'cash') {
            $payment = Payment::create([
                'order_id' => $order->id,
                'payment_method' => $this->payment_method,
                'status' => 'pending',
                'transaction_id' => '-',
            ]);
            $order->payemnt_id = $payment->id;
        }

        // if ($this->payment_method == 'stripe') {
        //     Stripe::setApiKey(config('site-specific.STRIPE_SECRET'));
        //     $sessionCheckout = Session::create([
        //         'payment_method_types' => ['card'],
        //         'customer_email' => Auth()->user()->email,
        //         'line_items' => $line_items,
        //         'mode' => 'payment',
        //         'success_url' => route('success').'?session_id={CHECKOUT_SESSION_ID}',
        //         'cancel_url' => route('cancel'),
        //     ]);

        //     $redirect_url = $sessionCheckout->url;
        // } else {
            $redirect_url = route('success');
        // }

        $order->shipping_address = $address->street_address;
        $order->save();
        $address->order_id = $order->id;
        $address->save();

        foreach ($cart_items as $key => $product) {
            $orderItems = new OrderItem;
            $orderItems->order_id = $order->id;
            $orderItems->product_id = $product['product_id'];
            $orderItems->variant_id = $product['variant_id'] ?? null;
            $orderItems->quantity = $product['quantity'];
            $orderItems->price_at_time = $product['unit_amount'];
            $orderItems->save();
        }

        // $order->items()->createMany($cart_items);
        Auth::check() ? CartManagement::clearCartItemsFromDatabase() : CartManagement::clearCartItemsFromCookies();
        // Mail::to(request()->user())->send(new OrderPlaced($order));
        return redirect($redirect_url);
    }

    public function render()
    {
        $cart_items = Auth::check() ? CartManagement::getCartItemsFromDatabase() : CartManagement::getCartItemsFromCookie();
        $grand_total = CartManagement::calculateGrandTotal($cart_items);

        return view('livewire.checkout-page', [
            'cart_items' => $cart_items,
            'grand_total' => $grand_total
        ]);
    }
}
