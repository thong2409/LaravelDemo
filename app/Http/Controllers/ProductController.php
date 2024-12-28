<?php

namespace App\Http\Controllers;

use App\Http\Service\Product\ProductService;
use App\Http\Service\Menu\MenuService;
use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Service\CartService;
use App\Models\Product;

class ProductController extends Controller
{
    protected $cartService;
    protected $productService;
    protected $menuService;
    public function __construct(ProductService $productService,MenuService $menuService, CartService $cartService){
        $this->productService = $productService;
        $this->menuService = $menuService;
        $this->cartService = $cartService;
    }
    public function index($id = '', $slug = ''){
        $product = $this->productService->show($id);
        $productsMore = $this->productService->more($id);
        
        return view('client.products.content',[
            'category' =>$this->menuService->getParent(),
            'allMenus'=> Menu::where('active', 1)->get(),
            'product' => $product,
            'products' =>$productsMore,
            'menuChild' =>$this->menuService->getChild()
        ]);
    }
}
