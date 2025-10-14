<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerProfile;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\Profile\CustomerCreateRequest;
use App\Http\Requests\Profile\CustomerUpdateRequest;
use Illuminate\Support\Arr;
use Pest\ArchPresets\Custom;

class CustomerProfileController extends Controller
{
    //User Profile Create API
    public function profileCreate(CustomerCreateRequest $request)
    {
        try{
            $user = auth()->user();

            $data = $request->validated();

            if(CustomerProfile::where('user_id',$user->id)->exists()){
                return $this->error('Customer profile already exists');
            }
            $data['user_id'] = $user->id;
            
            $customer_profile = CustomerProfile::create($data);

            return $this->success($customer_profile,'Customer profile created successfully');

        }
        catch(\Exception $e){
            Log::error('Customer profile create error: ' . $e->getMessage());
            return $this->error($e->getMessage());
        }
    }
    //User Profile Update API
    public function profileUpdate(CustomerUpdateRequest $request)
    {
        try{
            $user = auth()->user();

            $data = $request->validated();
            
            //use for update user name
            $userData = Arr::only($data, ['name']);

            //use for update customer profile
            $profileData = Arr::only($data, [
                'mobile_no',
                'city',
                'state',
                'post_code',
                'address',
                'cus_fax',
                'ship_name',
                'ship_add',
                'ship_city',
                'ship_state',
                'ship_postcode',
                'ship_country',
                'ship_phone',
                'ship_fax',
            ]);

            if(!empty($userData)){
                $user->name = $userData['name'];
                $user->save();
            }

            $customer_profile = CustomerProfile::where('user_id',$user->id)->update($profileData);

            return $this->success($customer_profile,'Customer profile updated successfully');
            
        }
        catch(\Exception $e){
            Log::error('Customer profile update error: ' . $e->getMessage());
            return $this->error($e->getMessage());
        }
    }
}
