<?php

namespace App\Http\Service;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserService {

    public function getAll(){
        return User::orderBy('id')->paginate(5);
    }
    
    public function create($request){
        try{
            return User::create([
                'name' => (string) $request->input('name'),
                'email' => (string) $request->input('email'),
                'address' => (string) $request->input('address'),
                'password' => bcrypt($request->input('password')),
                'is_admin' => (int) $request->input('is_admin'),
            ]);
            Session::flash('success','Thêm nhân viên thành công');
            return true;
        }
        catch(\Exception $e){
            Session::flash('error','Tạo mới nhân viên thất bại');
            return false;
        }
        
    }

    public function update($request,$user){
       try{
            if ($request->filled('password')) {
                $request->merge(['password' => Hash::make($request->password)]);
            }
            $user->fill($request->input());
            $user->save();
            Session::flash('success','Cập nhật nhân viên thành công');
       } 
       catch(\Exception $e){
            Session::flash('error','Cập nhật nhân viên thất bại');
            return false;
       }
    return true;
    }

    public function delete($request){
        $user = User::where('id',$request->input('id'))->first();
        if($user){
            $user->delete();
            return true;
        }
        return false;
    }
}