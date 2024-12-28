<?php
namespace App\Http\Service;

use App\Jobs\SendMail;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CartService{
    public function create($request){
        $quantity = (int)$request->input('quantity');
        $product_id = (int)$request->input('product_id');

        // Kiểm tra số lượng và product_id hợp lệ
        if ($quantity <= 0 || $product_id <= 0) {
            Session::flash('error', 'Số lượng hoặc Sản phẩm không chính xác');
            return false;
        }

        // Lấy giỏ hàng từ session (hoặc khởi tạo mảng nếu chưa có giỏ hàng)
        $carts = Session::get('carts', []);  // Thay đổi: Khởi tạo giỏ hàng rỗng nếu không có
        // Kiểm tra sản phẩm đã tồn tại trong giỏ hàng
        if (Arr::exists($carts, $product_id)) {
            // Cập nhật số lượng sản phẩm hiện có trong giỏ hàng
            $carts[$product_id] += $quantity;
        } else {
            // Thêm sản phẩm mới vào giỏ hàng
            $carts[$product_id] = $quantity;
        }

        // Lưu giỏ hàng cập nhật lại vào session
        Session::put('carts', $carts);
        return true;
    }

    public function getProducts(){
        $carts = Session::get('carts', []);
                
        $productId = array_keys($carts);

         // Sử dụng whereIn thay vì where để kiểm tra nhiều id
        return Product::select('name', 'price', 'id', 'price_sale', 'image')
                        ->where('active', 1)
                        ->whereIn('id', $productId) // whereIn để lấy các sản phẩm theo nhiều id
                        ->get();
    }

    public function update($request){
        Session::put('carts',$request->input('quantity'));

        return true;
    }
    public function remove($id){
        $carts = Session::get('carts');
        unset($carts[$id]);

        Session::put('carts',$carts);
        return true;
    }

    public function addCart($request){
      
        try{
            DB::beginTransaction();
            $carts = Session::get('carts', []);
            $customer_id = $request->input('id');
            $productId = array_keys($carts);
            $products = Product::select('name', 'id','price', 'price_sale','image')
                                ->where('active', 1)
                                ->where('id', $productId)
                                ->get();
            $data = [];
            foreach($products as $product){
                $data[] = [
                    'customer_id' => $customer_id,
                    'product_id' => $product->id,
                    'qty' => $carts[$product->id],
                    'price' => $product->price_sale != 0 ? $product->price_sale : $product->price,
                    'product_name' => $product->name,
                    'product_image' => $product->image,
                ];
            }
            $filteredData = array_map(function($item) {
                return [
                    'customer_id' => $item['customer_id'],
                    'product_id' => $item['product_id'],
                    'qty' => $item['qty'],
                    'price' => $item['price']
                ];
            }, $data);
            Cart::insert($filteredData);
            Session::flash('success','Thanh toán thành công đơn hàng đang được xử lý');

            #Queue
            $email = session('customer.email'); // Lấy email từ session
            SendMail::dispatch($email,$data)->delay(now()->addSeconds(2));

            Session::forget('carts');
            DB::commit();
        }
        catch(\Exception $e){
            DB::rollBack();
            Session::flash('error','Thanh toán thất bại vui lòng thử lại sau!');
            Log::info($e->getMessage());
            return false;
        }
        return true;
    }

    public function getCustomer(){
        return Customer::orderByDesc('id')->paginate(10);
    }

    
}