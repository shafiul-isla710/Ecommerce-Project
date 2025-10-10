<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {

        try{
            $query = Product::query();

            if($request->filled('category_id')){
                $query->where('category_id', $request->category_id);
            }
            if($request->filled('brand_id')){
                $query->where('brand_id', $request->brand_id);
            }
            if($request->filled('remarks')){
                $query->where('remarks', $request->remarks);
            }
            if($request->filled('title')){
                $query->where('title', $request->title);
            }

            $data = $query->get();
            return $this->success($data,'Products Fetched Successfully');
        }
        catch(\Exception $e){
            return $this->error($e->getMessage());
        }
    }

    
}
