<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserFormRequest;
use App\Http\Service\UserService;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService){
        $this->userService = $userService;
    }
    public function index(){
        
        return view('admin.user.users',[
        'users'=>$this->userService->getAll()
        ]);
        
    }

    public function create(){
        return view('admin.user.add-user');
    }

    public function store(UserFormRequest $request){
        $this->userService->create($request);
        return redirect()->route('admin.users');
    }

    public function edit(User $user)
    {
         return view('admin.user.edit-user',[
            'user'=> $user,
         ]);
    }

    public function update(Request $request, User $user)
    {
        $this->userService->update($request, $user);
        return redirect()->route('admin.users');
    }

    public function destroy(Request $request)
    {
        $result = $this->userService->delete($request);
        if($result){
            return response()->json([
                'error' =>false,
                'message' =>'Xóa thành công'
            ]);
        }
        return response()->json(['error' => true]);
    }
    public function search(Request $request)
    {
    $searchTerm = $request->input('search'); // Lấy giá trị tìm kiếm từ form
    
    // Thực hiện tìm kiếm trên bảng sliders, ví dụ tìm kiếm theo title hoặc description
    $results = User::where('name', 'like', '%' . $searchTerm . '%')
                        ->orWhere('email', 'like', '%' . $searchTerm . '%')
                        ->orWhere('address', 'like', '%' . $searchTerm . '%')
    ->paginate(2);


    // Trả về view với kết quả tìm kiếm
    return view('admin.user.users', 
    [
            'users' => $results,
        ]
    );
    }
}
