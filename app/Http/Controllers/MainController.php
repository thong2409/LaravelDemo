<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Service\Menu\MenuService;
use App\Http\Service\Product\ProductService;
use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Service\CartService;
use App\Models\Product;

class MainController extends Controller
{
    protected $menuService;
    protected $productService;
    protected $cartService;
    public function __construct(MenuService $menuService, ProductService $productService, CartService $cartService){
        $this->menuService = $menuService;
        $this->productService = $productService;
        $this->cartService = $cartService;
    }
    public function index_admin(){
        return view('admin.main');
    }
    public function index_client(){
        $categories = $this->menuService->getParent();
        $allMenus = Menu::where('active', 1)->get();
        return view('client.main',[
            'category' =>$categories, // Lấy danh mục cha,
            'allMenus' => $allMenus,
            'products' =>$this->productService->get(),
            'menuChild' =>$this->menuService->getChild()
        ]);
    }
    public function loadProduct(Request $request){
        $page = $request->input('page',0);
        $result = $this->productService->get($page);
        if(count($result) != 0){
            $html = view('client.products.list',[
                'products' => $result
            ])->render();
            return response()->json([
                'html' => $html
            ]);
        }
        return response()->json([
                'html' => ' '
            ]);
    }

    public function search(Request $request){
        $categories = $this->menuService->getParent();
        $allMenus = Menu::where('active', 1)->get();
        $keyword = $request->input('search');
        $results = Product::where('name', 'like', '%' . $keyword . '%')
                        ->orWhere('menu_id', 'like', '%' . $keyword . '%')
                        ->orWhere('price', 'like', '%' . $keyword . '%')
                        ->paginate(4);

    return view('client.shop.shop', 
    [
            'category' =>$categories, // Lấy danh mục cha,
            'allMenus' => $allMenus,
            'menuChild' =>$this->menuService->getChild(),
            'products' => $results,
        ]
    );
    }

}
