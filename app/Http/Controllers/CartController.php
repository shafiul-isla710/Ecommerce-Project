<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductDetails;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\CartResource;
use App\Http\Requests\Cart\AddCartListRequest;
use App\Http\Requests\Cart\RemoveCartListRequest;

class CartController extends Controller
{
    // get cart list API
    public function cartList()
    {
        try{
            $cartList = Cart::all();
            return $this->success(CartResource::collection($cartList),'Cart List Fetched Successfully');
        }
        catch(\Exception $e){
            Log::error('Cart list error: ' . $e->getMessage());
            return $this->error($e->getMessage());
        }
    }

    // Add to Cart list API
    public function addCartList(AddCartListRequest $request)
    {
        try{
            $user = auth()->user();
            $product = Product::find($request->product_id);
            $productDetails = ProductDetails::where('product_id',$request->product_id)->get();

            $existingCart = Cart::where('user_id',$user->id)->where('product_id',$request->product_id)->exists();
            if($existingCart){
                return $this->error('Product already added to cart');
            }
            
            $availableColor = $productDetails->pluck('color')->flatten()->unique()->toArray();
            $availableSize = $productDetails->pluck('size')->flatten()->unique()->toArray();

            
            if(!empty($availableColor)){
                if(!$request->color){
                    return $this->error('Please select a color');
                }
                if(in_array($request->color,$availableColor) == false){
                    return $this->error('Color not available');
                }
            }

            if(!empty($availableSize)){
                if(!$request->color){
                    return $this->error('Please select a size');
                }

                if(in_array($request->size,$availableSize) == false){
                    return $this->error('Size not available');
                }
            }

            $price = $product->price;

            if($product->discount && $product->discount > 0){
                $price = $product->discount_price;
            }
            
            $cart = Cart::create([
                'user_id'=>$user->id,
                'product_id'=>$request->product_id,
                'quantity'=>$request->quantity,
                'color'=>$request->color,
                'size'=>$request->size,
                'price'=>$price,
            ]);

            return $this->success($cart,'Cart Added Successfully');
        }
        catch(\Exception $e){
            Log::error('add cart list error: ' . $e->getMessage());
            return $this->error($e->getMessage());
        }
    }

    public function removeToCartLit(RemoveCartListRequest $request)
    {

        try{
            $user = auth()->user();
            $cart = Cart::whereId($request->cart_id)->where('user_id',$user->id)->first();
            if($cart){
                $cart->delete();
                return $this->success([],'Cart Removed Successfully');
            }
            else{
                return $this->error('Cart not found');
            }
        }
        catch(\Exception $e){
            Log::error('remove cart list error: ' . $e->getMessage());
            return $this->error($e->getMessage());
        }
    }
    public function clearCartList()
    {

        try{
            $user = auth()->user();
            $user->cartList()->delete();
            return $this->success([],'Cart List Cleared Successfully');
        }
        catch(\Exception $e){
            Log::error('Clear cart list error: ' . $e->getMessage());
            return $this->error($e->getMessage());
        }
    }
}
