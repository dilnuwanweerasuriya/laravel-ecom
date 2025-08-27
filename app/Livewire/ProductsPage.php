<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\withPagination;
use Livewire\Attributes\Url;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navigation;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;

#[Title('Products - ShopEase')]
class ProductsPage extends Component
{
    use withPagination;

    #[Url]
    public $selected_categories = [];

    #[Url]
    public $selected_brands = [];

    #[Url]
    public $price_start = 0;

    #[Url]
    public $price_end = 300000;

    #[Url]
    public $sort = 'latest';

    //add product to cart method
    public function addToCart($product_id){
        $total_count = CartManagement::addItemToCart($product_id);

        $this->dispatch('update-cart-count', total_count: $total_count)->to(Navigation::class);

        LivewireAlert::title('Product added to the cart successfully!')
            ->success()
            ->toast()
            ->position('bottom-end')
            ->show();
    }

    public function render()
    {
        $products = Product::with(['images','variants.images', 'reviews']);

        if(!empty($this->selected_categories)){
            $products->whereIn('category_id', $this->selected_categories);
        }

        if(!empty($this->selected_brands)){
            $products->whereIn('brand_id', $this->selected_brands);
        }

        if ($this->price_start || $this->price_end) {
            $products->where(function ($query) {
                $query->where(function ($q) {
                    $q->where('has_variants', 0)
                    ->whereBetween('price', [$this->price_start, $this->price_end]);
                })->orWhere(function ($q) {
                    $q->where('has_variants', 1)
                    ->whereHas('variants', function ($variantQuery) {
                        $variantQuery->whereBetween('price', [$this->price_start, $this->price_end]);
                    });
                });
            });
        }

        if($this->sort == 'featured'){
            $products->where('is_featured', 1);
        }

        if($this->sort == 'latest'){
            $products->latest();
        }

        if($this->sort == 'price'){
            $products->where(function ($query) {
                $query->where(function ($q) {
                    $q->where('has_variants', 0)
                    ->orderBy('price');
                })->orWhere(function ($q) {
                    $q->where('has_variants', 1)
                    ->whereHas('variants', function ($variantQuery) {
                        $variantQuery->orderBy('price');
                    });
                });
            });
        }

        return view('livewire.products-page', [
            'products' => $products->paginate(12),
            'brands' => Brand::where('is_active', 1)->get(['id', 'name', 'slug']),
            'categories' => Category::where('is_active', 1)->get(['id', 'name', 'slug']),
        ]);
    }
}
