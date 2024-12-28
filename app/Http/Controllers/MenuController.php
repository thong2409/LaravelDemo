<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Service\Menu\MenuService;
use App\Http\Service\Product\ProductService;
use App\Models\Menu;
use App\Models\Product;

class MenuController extends Controller
{
    protected $menuService;
    public function __construct(MenuService $menuService){
        $this->menuService = $menuService;
    }
    public function index(Request $request,$id = null,$lug = null){
        $menu = $id ? $this->menuService->getId($id) : null;
        $menuChild = $this->menuService->getChild(); 
        $products = $this->menuService->getProduct($menu,$request);
        return view('client.shop.shop',
            [
                'category' =>$this->menuService->getParent(),
                'allMenus'=> Menu::where('active', 1)->get(),
                'products' => $products,
                'menu' => $menu,
                'menuChild'=>$menuChild
            ]
        );
    }
    public function filterByPrice(Request $request,$id){
        $menu = $this->menuService->getId($id);
        // Lấy giá bắt đầu và giá kết thúc từ form
        $minPrice = $request->input('giabatdau');
        $maxPrice = $request->input('giaketthuc');

        // Kiểm tra nếu có cả giá bắt đầu và giá kết thúc
        $query = Product::where('menu_id',$menu);
        if ($minPrice) {
            $query->where('price', '>=', $minPrice);
        }

        if ($maxPrice) {
            $query->where('price', '<=', $maxPrice);
        }
         // Lấy danh sách sản phẩm sau khi lọc
        $products = $query->get();
         // Trả về view với danh sách sản phẩm đã lọc
    return view('client.shop.shop', [
        'products' => $products,
    ]);
    }
}
