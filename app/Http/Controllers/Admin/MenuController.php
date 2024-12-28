<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\CreateFormRequest;
use App\Http\Service\Menu\MenuService;
use App\Models\Menu;
use Illuminate\Http\JsonResponse;

class MenuController extends Controller
{
    protected $menuService;
    public function __construct(MenuService $menuService){
        $this->menuService = $menuService;
    }
    public function index(){
        $test = $this->menuService->getAll();
        return view('admin.category.categories',[
            'title' => 'Danh sách danh mục',
            'menus' => $this->menuService->getAll(),
        ]);
    }
    public function add_category(){
        return view('admin.category.category-add',[
            'title' => 'Thêm danh mục',
            'menus' => $this->menuService->getParent()
        ]);
    }
    public function store(CreateFormRequest $request){
        $result = $this->menuService->create($request);

        return redirect()->route('admin.categories');
    }
    public function update(Menu $menu, CreateFormRequest $request){
        $this->menuService->update($request,$menu);
        return redirect()->route('admin.categories');
    }
    public function edit(Menu $menu){
        
         return view('admin.category.category-edit',[
            'title' => 'Edit Category:' .$menu->name,
            'menu' => $menu,
            'menus' => $this->menuService->getParent()
        ]);
    }
    public function destroy(Request $request): JsonResponse{

        $result = $this->menuService->destroy($request);
        
        if($result){
            return response()->json([
                'error' =>false,
                'message' => 'Delete Category successfully'
            ]);
        }

            return response()->json([
                'error' =>true,
            ]);
    }
    public function getSubCategories(Request $request)
    {
        $subCategories = Menu::where('parent_id', $request->parent_id)->get();
        return response()->json($subCategories);
    }
    public function search(Request $request)
    {
        $searchTerm = $request->input('search'); // Lấy giá trị tìm kiếm từ form
        
        // Thực hiện tìm kiếm trên bảng sliders, ví dụ tìm kiếm theo title hoặc description
        $results = Menu::where('name', 'like', '%' . $searchTerm . '%')
                            ->orWhere('parent_id', 'like', '%' . $searchTerm . '%')
                            ->paginate(2);


        // Trả về view với kết quả tìm kiếm
        return view('admin.category.categories', 
        [
                'menus' => $results,
            ]
        );
    }
}
