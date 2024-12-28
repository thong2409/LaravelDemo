<?php

namespace App\Http\Service\Product;

use App\Models\Menu;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class ProductAdminService {
    public function getMenu(){
        return Menu::where('active',1)->get();
    }
    public function getAll(){
        return Product::with('menu')
                ->orderByDesc('id')->paginate(15); // Thêm get() để lấy dữ liệu
    }

    public function insert($request){
        $isValidPrice = $this->isValidPrice($request);
        if($isValidPrice == false){
            return false;
        }
            try{
                $imageNames = []; // Mảng để lưu trữ đường dẫn của nhiều ảnh
                // Kiểm tra xem có nhiều ảnh được upload hay không
                if ($request->hasFile('images')) {
                    foreach ($request->file('images') as $image) {
                        // Đặt tên file ảnh mới
                        $imageName = time() . '_' . uniqid() . '.' . $image->extension();
                        // Di chuyển ảnh tới thư mục
                        $image->move(public_path('storage/products'), $imageName);
                        // Lưu đường dẫn vào mảng
                        $imageNames[] = 'storage/products/' . $imageName;
                    }
                }
                // Chuẩn bị dữ liệu để lưu

                $imageName = time().'.'.$request->image->extension();
                $request->image->move(public_path('storage/products'), $imageName);
                $data = $request->except('_token');
                $data['images'] = json_encode($imageNames);
                $data['image'] = 'storage/products/' . $imageName;
                Product::create($data);
                Session::flash('success','Thêm sản phẩm thành công');     
            } catch(\Exception $e){
                Session::flash('error','Thêm sản phẩm thất bại');
                Log::info($e->getMessage());
                return false;
            };
            return true;               
    }

    protected function isValidPrice($request){
        // Kiểm tra nếu giá giảm phải nhỏ hơn giá gốc
        if($request->input('price_sale') != 0 && $request->input('price_sale') >= $request->input('price')) {
            Session::flash('error', 'Giá giảm phải thấp hơn giá gốc');
            return false;
        }
        
        // Kiểm tra nếu giá gốc bằng 0 nhưng giá giảm khác 0
        if((int) $request->input('price') == 0 && $request->input('price_sale') != 0) {
            Session::flash('error', 'Nhập giá gốc');
            return false;
        }

        return true;
    }
    public function update($request,$product){
        $isValidPrice = $this->isValidPrice($request);
        if($isValidPrice == false) return false;
        try{
             $imageNames = []; // Khởi tạo mảng trống cho images mới

            // Xử lý khi có ảnh mô tả mới được upload
            if ($request->hasFile('images')) {
                if ($product->images) {
                    $oldImages = json_decode($product->images, true); // Giải mã JSON thành mảng
                    foreach ($oldImages as $oldImage) {
                        if (file_exists(public_path($oldImage))) {
                            unlink(public_path($oldImage)); // Xóa ảnh cũ
                        }
                    }
                }
                // Lưu ảnh mới
                foreach ($request->file('images') as $image) {
                    $imageName = time() . '_' . uniqid() . '.' . $image->extension();
                    $image->move(public_path('storage/products'), $imageName);
                    $imageNames[] = 'storage/products/' . $imageName; // Lưu đường dẫn vào mảng
                }
            }
            // Cập nhật trường images
            $product->images = json_encode($imageNames);
            
            
            // Nếu người dùng upload ảnh mới
            if ($request->hasFile('image')) {
                // Xóa ảnh cũ nếu cần (tùy theo logic ứng dụng của bạn)
                if ($product->image && file_exists(public_path('storage/products/' . $product->image))) {
                    unlink(public_path('storage/products/' . $product->image)); // Xóa ảnh cũ
                }

                // Lưu ảnh mới
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('storage/products'), $imageName);
                
                // Cập nhật đường dẫn ảnh trong $request
                $product->image = 'storage/products/' . $imageName;
            }
            $product->fill($request->input());
            $product->save();
            Session::flash('success','Cập nhật sản phẩm thành công'); 
        }catch(\Exception $e){
            Session::flash('error','Cập nhật sản phẩm thất bại');
            Log::info($e->getMessage());
            return false; 
        }
        return true;
    }
    public function delete($request){
        $product = Product::where('id',$request->input('id'))->first();
        if($product){
            $product->delete();
            return true;
        }

        return false;
    }
}