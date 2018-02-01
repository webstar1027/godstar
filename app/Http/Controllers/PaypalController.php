<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paypal;
use Tymon\JWTAuth\Facades\JWTAuth;
//PAYPAL_ID=AeE_zl2PXPj3WbUiruxbAOjhpHJ-z0C8cNWe2_JtK5UWYLdFdYfhN-og9ttDbGhxWPFVR_KyQcYRVLG1
//PAYPAL_SECRET=EL4kcGnJS_tR5xrjfRi4p-uTQ07ZMNfMAcEM81XSak1ITMe8Dp-aDZeuSABTYxKXe2VQgoq2XPy_vkZE

class PaypalController extends Controller
{
//    public function getPaypalInfo(Request $request)
//    {
//        if(JWTAuth::parseToken()->toUser()){
//            $user =  JWTAuth::parseToken()->toUser();
//        }else{
//            return response()->json(['text' => false],500);
//            die();
//        }
//
//
//       $paypalInfo = $request->all();
//       $insertPaypalInfo['user_id'] = $user->id;
//        $insertPaypalInfo['subscriptions_type_id'] = 'annual';//or 'monthly'
//        $insertPaypalInfo['state'] = $paypalInfo['state'];
//       $insertPaypalInfo['cart'] = $paypalInfo['cart'];
//       $insertPaypalInfo['email'] = $paypalInfo['payer']['payer_info']['email'];
//       $insertPaypalInfo['payer_id'] = $paypalInfo['payer']['payer_info']['payer_id'];
//       $insertPaypalInfo['recipient_name'] = $paypalInfo['payer']['payer_info']['shipping_address']['recipient_name'];
//       $insertPaypalInfo['total'] = $paypalInfo['transactions'][0]['amount']['total'];
//
//        $savePaypalInfo = new Paypal();
//        $savePaypalInfo->fill($insertPaypalInfo);
//        $savePaypalInfo->save();
//        return response()->json(['text' => true],200);
//    }
}
