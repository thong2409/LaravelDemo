<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterFromRequest;
use App\Http\Service\Menu\MenuService;
use App\Models\Customer;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    protected $menuService;
    public function __construct(MenuService $menuService){
        $this->menuService = $menuService;
    }
    public function register(){
        $categories = $this->menuService->getParent();
        return view('admin.user.register',[
            'category' =>$categories, // Lấy danh mục cha,
            'allMenus' => Menu::where('active', 1)->get(),
            'menuChild' =>$this->menuService->getChild()
        ]);
    }
    public function store(RegisterFromRequest $request ){
        // Tạo tài khoản mới
        $customer = Customer::create([
            'full_name' => $request->input('full_name'),
            'email' => $request->input('email'),
            'phone' => $request->input('email'),
            'password' => Hash::make($request->input('password')), // Mã hóa mật khẩu
            'address' => $request->input('address')
        ]);

        
        return redirect()->route('admin.user.login');
    }
}
