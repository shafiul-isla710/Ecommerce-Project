<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCategories()
    {
        try{
            $categories = Category::all();
            return $this->success($categories,'Brands Fetched Successfully');
        }
        catch(\Exception $e){
            return $this->error($e->getMessage());
        }
    }
}
