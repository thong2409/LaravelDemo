<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Service\CartService;
use App\Http\Service\Menu\MenuService;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    protected $cartService;
    protected $menuService;
    public function __construct(CartService $cartService, MenuService $menuService){
        $this->cartService = $cartService;
        $this->menuService = $menuService;
    }
    public function index(Request $request){
        $result = $this->cartService->create($request);
        if($result === false){
            return redirect()->back();
        }
        return redirect('/carts');
        
    }
    public function show(){
        $products = $this->cartService->getProducts();
        return view('client.carts.list',[
            'products' => $products,
            'carts' => Session::get('carts'),
            'category' =>$this->menuService->getParent(),
            'allMenus'=> Menu::where('active', 1)->get(),
            'menuChild' =>$this->menuService->getChild()
        ]);
    }

    public function update(Request $request){
        $this->cartService->update($request);
        return redirect('/carts');
    }
    public function remove($id = 0){
        $this->cartService->remove($id);
        return redirect('/carts');
    }
    public function checkout(){
        $products = $this->cartService->getProducts();
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!Auth::guard('customer')->check()) {
            // Nếu chưa đăng nhập, trả về thông báo
            return redirect()->route('admin.user.login')->with('error', 'Bạn cần đăng nhập để thực hiện thanh toán.');
        }

        // Kiểm tra xem giỏ hàng có sản phẩm hay không
        $carts = session()->get('carts', []); // Lấy giỏ hàng từ session

        if (empty($carts)) {
            // Nếu giỏ hàng rỗng, trả về thông báo
            return redirect()->back()->with('error', 'Giỏ hàng của bạn chưa có sản phẩm nào.');
        }


        return view('client.carts.checkout',[
            'category' =>$this->menuService->getParent(),
            'allMenus'=> Menu::where('active', 1)->get(),
            'menuChild' =>$this->menuService->getChild(),
            'products' => $products,
            'carts' => Session::get('carts'),
        ]);
        
    }

    public function addCart(Request $request){
        $result = $this->cartService->addCart($request);

        return redirect()->route('user')->with('success','Đơn hàng của bạn đang được xử lý hãy kiểm tra Email!');
        
    }
}
