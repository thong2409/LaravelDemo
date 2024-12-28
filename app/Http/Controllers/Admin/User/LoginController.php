<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginFromRequest;
use App\Http\Service\Menu\MenuService;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    protected $menuService;
    public function __construct(MenuService $menuService){
        $this->menuService = $menuService;
    }
    public function login(){
        $categories = $this->menuService->getParent();
        return view('admin.user.login',[
            'category' =>$categories, // Lấy danh mục cha,
            'allMenus' => Menu::where('active', 1)->get(),
            'menuChild' =>$this->menuService->getChild()
        ]);
    }
    public function store(LoginFromRequest $request){
        
        $this-> validate($request,[
            'email' => 'required',
            'password' => 'required',
        ]);

        // 1. Kiểm tra trong bảng `users` (cho Admin)
        if (Auth::guard('web')->attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ], $request->input('remember'))) {
            // Lấy thông tin khách hàng từ database
            $user = Auth::guard('web')->user();

            // Lưu thông tin vào session
            session([
                'user'=>[
                'id' => $user->id,
                'name' => $user->name,
                ]
            ]);
            return redirect()->route('admin'); // Điều hướng đến trang admin
        }

        // 2. Kiểm tra trong bảng `customers` (cho Customer)
        if (Auth::guard('customer')->attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ], $request->input('remember'))) {

            // Lấy thông tin khách hàng từ database
            $customer = Auth::guard('customer')->user();

            // Lưu thông tin vào session
            session([
                'customer'=>[
                'id' => $customer->id,
                'name' => $customer->full_name,
                'email' => $customer->email,
                'phone' => $customer->phone,
                'address' => $customer->address,
                ]
            ]);
            return redirect()->route('user'); // Điều hướng đến trang user bình thường
        }

        Session::flash('error', 'Đăng nhập thất bại.Tài khoản hoặc mật khẩu không đúng');
        return redirect()->back();
        }
}
