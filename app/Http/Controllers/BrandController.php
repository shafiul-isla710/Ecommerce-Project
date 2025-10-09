<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function getBrands()
    {
        try{
            $brands = Brand::all();
            return $this->success($brands,'Brands Fetched Successfully');
        }
        catch(\Exception $e){
            return $this->error($e->getMessage());
        }
    }

}
