<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Helpers\CartManagement;
use App\Models\Order;
use App\Models\Address;

#[Title('Checkout - ShopEase')]
class CheckoutPage extends Component
{
    public $fullName, $email, $address1, $address2, $city, $state, $zip, $phone;
    public $paymentMethod = 'creditCard';
    public $cardNumber, $expiryDate, $cvv, $cardName;

    public function mount(){
        $cart_items = CartManagement::getCartItemsFromCookie();

        if (count($cart_items) == 0) {
            return redirect('/products');
        }
    }

    public function placeOrder(){
        $this->validate([
            'fullName' => 'required|string|max:255',
            'email' => 'required|email',
            'address1' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'zip' => 'required|string|max:20',
            'phone' => 'required|string|max:20',
            'paymentMethod' => 'required|in:creditCard,paypal',
            'cardNumber' => $this->paymentMethod === 'creditCard' ? 'required|string|min:16|max:19' : 'nullable',
            'expiryDate' => $this->paymentMethod === 'creditCard' ? 'required|string' : 'nullable',
            'cvv' => $this->paymentMethod === 'creditCard' ? 'required|string|min:3|max:4' : 'nullable',
            'cardName' => $this->paymentMethod === 'creditCard' ? 'required|string' : 'nullable',
        ]);

        $cart_items = CartManagement::getCartItemsFromCookie();

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
        $order->grand_total = CartManagement::calculateGrandTotal($cart_items);
        $order->payment_method = $this->payment_method;
        $order->payment_status = 'pending';
        $order->status = 'new';
        $order->currency = 'lkr';
        $order->shipping_amount = 0;
        $order->shipping_method = 'none';
        $order->notes = 'Order placed by ' . Auth()->user()->name;

        $address = new Address();
        $address->first_name = $this->first_name;
        $address->last_name = $this->last_name;
        $address->phone = $this->phone;
        $address->street_address = $this->street_address;
        $address->city = $this->city;
        $address->state = $this->state;
        $address->zip_code = $this->zip_code;

        $redirect_url = '';

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

        $order->save();
        $address->order_id = $order->id;
        $address->save();
        $order->items()->createMany($cart_items);
        CartManagement::clearCartItems();
        // Mail::to(request()->user())->send(new OrderPlaced($order));
        return redirect($redirect_url);
    }

    public function render()
    {
        $cart_items = CartManagement::getCartItemsFromCookie();
        $grand_total = CartManagement::calculateGrandTotal($cart_items);

        return view('livewire.checkout-page', [
            'cart_items' => $cart_items,
            'grand_total' => $grand_total
        ]);
    }
}
