<?php

namespace App\Http\Controllers;

use App\Models\ProductWishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WishListController extends Controller
{
    public function wishlist(){
        try{
            $user = auth()->user();
            $wishlists = ProductWishList::where('user_id',$user->id)->with('product')->get();
            return $this->success($wishlists);
        }
        catch(\Exception $e){
            Log::error('wish list error: ' . $e->getMessage());
            return $this->error($e->getMessage());
        }
    }
    public function addWishList(Request $request)
    {
        try{
            $user = auth()->user();
            
            $wishList = ProductWishList::where('user_id',$user->id)->where('product_id',$request->product_id)->exists();
            // dd($request->product_id);

            if($wishList){
                return $this->error('Product already added to wish list');
            }else{
                ProductWishList::create([
                    'user_id'=>$user->id,
                    'product_id'=>$request->product_id,
                ]);
                return $this->success([],'Product added to wish list successfully');
            }
        }
        catch(\Exception $e){
            Log::error('wish list error: ' . $e->getMessage());
            return $this->error($e->getMessage());
        }
    }

    //todo Should I pass product_if like input field?
    public function removeWishList(Request $request, ProductWishList $list)
    {
        try{
            $user = auth()->user();
            
            if($user){
                $list->delete();
                return $this->success([],'Product removed from wish list successfully');
            }
        }
        catch(\Exception $e){
            Log::error('Remove wish list error: ' . $e->getMessage());
            return $this->error($e->getMessage());
        }
    }
    // public function clearWishList(Request $request)
    // {
    //     try{
    //         $user = auth()->user();

    //         if($user && $user->wishList()->exists()){
    //             $user->wishList()->delete();
    //             return $this->success([],'Wish list cleared successfully');
    //         }
    //         else{
    //             return $this->error('Wish list is empty');
    //         }
    //     }
    //     catch(\Exception $e){
    //         Log::error('Remove wish list error: ' . $e->getMessage());
    //         return $this->error($e->getMessage());
    //     }
    // }

}
