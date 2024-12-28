<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Service\Product\ProductAdminService;
use App\Http\Service\Menu\MenuService;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;
    protected $menuService;

    public function __construct(ProductAdminService $productAdminService,MenuService $menuService){
        $this->productService = $productAdminService;
        $this->menuService = $menuService;
    }
    public function index()
    {
       return view('admin.product.products',[
        'products' => $this->productService->getAll(),
       ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        return view('admin.product.products-add',[
            'menus' => $this->menuService->getParent(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        
        $this->productService->insert($request);
        return redirect()->back();
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
         return view('admin.product.products-edit',[
            'menus' => $this->menuService->getAll(),
            'product'=> $product,
         ]);
    }
    public function view(Product $product)
    {
         return view('admin.product.products-view',[
            'menus' => $this->menuService->getAll(),
            'product'=> $product,
         ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $this->productService->update($request, $product);
        
        return redirect()->route('admin.products')->with('success','Sản phẩm đã được cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $result = $this->productService->delete($request);
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
    $results = Product::where('name', 'like', '%' . $searchTerm . '%')
                        ->orWhere('menu_id', 'like', '%' . $searchTerm . '%')
                        ->orWhere('price', 'like', '%' . $searchTerm . '%')
    ->paginate(2);


    // Trả về view với kết quả tìm kiếm
    return view('admin.product.products', 
    [
            'products' => $results,
        ]
    );
    }
}
