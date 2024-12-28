<?php

namespace App\Http\Service\Product;

use App\Models\Product;

class ProductService {
    const LIMIT = 16;
    public function get(int $page = null){
        return Product::select('id','name','price','price_sale','image')
                        ->orderByDesc('id')
                        ->when($page !== null, function($query) use ($page) {
                            $query-> offset($page * self::LIMIT);
                        })
                        ->limit(self::LIMIT)
                        ->get();
        
    }
    public function show($id){
        return Product::where('id', $id)
                        ->where('active', 1)
                        ->with('menu')
                        ->firstOrFail();
    }
    public function more($id){
        return Product::select('id','name','price','price_sale','image')
                        ->where('active', 1)
                        ->where('id','!=', $id)
                        ->orderByDesc('id')
                        ->limit(8)
                        ->get();
    }
}