<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Models\InvoiceProduct;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function createCheckout()
    {
        try{
            DB::beginTransaction();

            $user = auth()->user();

            $invoiceNo = 'INV'.rand(10000,99999).'-'.time();
            $customer = $user->customerProfile;
            $carts = Cart::where('user_id', $user->id)->get();
            
            $cus_details = "cus_name:$user->name,cus_email:$user->email,cus_mobile_no:$customer->mobile_no,cus_city:$customer->city,cus_state:$customer->state,cus_post_code:$customer->post_code,cus_address:$customer->address,cus_fax:$customer->cus_fax";

            $ship_details = "ship_name:$customer->ship_name,ship_city:$customer->ship_city,ship_state:$customer->ship_state,ship_post_code:$customer->ship_postcode,ship_address:$customer->ship_add,ship_fax:$customer->ship_fax,ship_country:$customer->ship_country,ship_phone:$customer->ship_phone";
            

            if($carts->isEmpty()){
                return $this->error('Cart is empty');
            }

            $total = 0; 
            foreach($carts as $cart){
                $total += $cart->product->price * $cart->quantity;
            }

            $vat = ($total*3)/100;
            $payable = $total + $vat;

            //create invoice
            $invoice = Invoice::create([
                'user_id' => $user->id,
                'invoice_no' => $invoiceNo,
                'total' => $total,
                'vat' => $vat,
                'payable' => $payable,
                'cust_details' => $cus_details,
                'ship_details' => $ship_details,
            ]);

            //create invoice products
            foreach($carts as $cart){
                InvoiceProduct::create([
                    'invoice_id'=>$invoice->id,
                    'product_id'=>$cart->product_id,
                    'quantity'=>$cart->quantity,
                    'unit_price'=>$cart->product->price,
                    'total_price'=>$cart->product->price * $cart->quantity
                ]);
            }

            DB::commit(); 

            Cart::where('user_id', $user->id)->delete();

            return $this->success($invoice,'Checkout Successfully');

        }
        catch(\Exception $e){
            DB::rollBack();
            Log::error('Checkout error: ' . $e->getMessage());
            return $this->error($e->getMessage());
        }
    }
}