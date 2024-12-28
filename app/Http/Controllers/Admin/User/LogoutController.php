<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout(Request $request){
        Auth::guard('customer')->logout();

        // Đăng xuất admin nếu có
        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        }
        $request->session()->invalidate(); // Invalidate phiên đăng nhập
        $request->session()->regenerateToken(); // Tạo lại token để bảo mật
        return redirect()->route('admin.user.login');
    }
}
