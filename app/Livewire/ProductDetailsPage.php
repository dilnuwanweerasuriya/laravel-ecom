<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navigation;
use App\Models\Product;
use App\Models\Review;

#[Title('Product Details - ShopEase')]
class ProductDetailsPage extends Component
{
    #[Url]
    public $sort = 'recent';

    public $slug;
    public $product;
    public $selectedImage;
    public $selectedAttributes = [];
    public $quantity = 1;

    public function mount($slug)
    {
        $this->slug = $slug;

        $this->product = Product::with('images', 'variants.attributes', 'variants.images')
            ->where('slug', $this->slug)
            ->firstOrFail();

        $this->selectedImage = $this->product->images->first()->image_url ?? null;
    }

    public function selectAttribute($name, $value){
        $key = strtolower($name);
        $this->selectedAttributes[$key] = $value;
        $this->updateSelectedImage();
    }

    private function updateSelectedImage(){
        // Find the first variant matching all selected attributes
        $variant = $this->product->variants->first(function ($v) {
            foreach ($this->selectedAttributes as $name => $value) {
                $attr = $v->attributes->first(fn($a) => strtolower($a->attribute_name) === $name);
                if (!$attr || $attr->attribute_value !== $value) {
                    return false;
                }
            }
            return true;
        });

        // If a matching variant has images, use its first image
        if ($variant && $variant->images->isNotEmpty()) {
            $this->selectedImage = $variant->images->first()->image_url;
        }
    }

    public function selectImage($imageUrl){
        $this->selectedImage = $imageUrl;
    }

    public function increaseQty(){
        $this->quantity++;
    }

    public function decreaseQty(){
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    //add product to cart method
    public function addToCart($product_id){
        $requiredAttributes = $this->product->variants->first()?->attributes->pluck('attribute_name')->map(fn($a) => strtolower($a))->unique();
    
        if ($requiredAttributes && count($this->selectedAttributes) < $requiredAttributes->count()) {
            LivewireAlert::title('Please select all attributes!')
                ->warning()
                ->toast()
                ->position('bottom-end')
                ->show();
            return;
        }

        // Find exact matching variant
        $variant = $this->product->variants->first(function ($v) {
            if ($v->attributes->count() !== count($this->selectedAttributes)) {
                return false;
            }
            foreach ($this->selectedAttributes as $name => $value) {
                $attr = $v->attributes->first(fn($a) => strtolower($a->attribute_name) === $name);
                if (!$attr || $attr->attribute_value !== $value) {
                    return false;
                }
            }
            return true;
        });

        if (!$variant) {
            LivewireAlert::title('Please select all attributes!')
                ->warning()
                ->toast()
                ->position('bottom-end')
                ->show();
            return;
        }

        $total_count = CartManagement::addItemToCartWithQty($product_id, $this->quantity, $variant->id);

        $this->dispatch('update-cart-count', total_count: $total_count)->to(Navigation::class);

        LivewireAlert::title('Product added to the cart successfully!')
            ->success()
            ->toast()
            ->position('bottom-end')
            ->show();
    }

    public function render(){

        $reviews = Review::where('product_id', $this->product->id);

        if($this->sort == 'recent'){
            $reviews->orderBy('created_at', 'desc');
        }

        if($this->sort == 'highest_rating'){
            $reviews->orderBy('rating', 'desc');
        }

        if($this->sort == 'lowest_rating'){
            $reviews->orderBy('rating', 'asc');
        }

        $related_product = Product::where('slug', '!=', $this->slug)->where('category_id', $this->product->category_id);

        return view('livewire.product-details-page', [
            'product' => $this->product,
            'reviews' => $reviews->get(),
            'related_products' => $related_product->paginate(4),
        ]);
    }
}
