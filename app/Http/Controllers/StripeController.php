<?php

namespace App\Http\Controllers;

use App\Domain;
use GuzzleHttp\Client;
use function GuzzleHttp\Promise\all;
use Illuminate\Http\Request;
use App\User;
//use Tymon\JWTAuth\Facades\JWTAuth;
use Stripe\Stripe;
use Stripe\Token;
use XmlParser;
use Parser;
use DB;

class StripeController extends Controller
{

    public function getTokenStripe(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $token  = $request->token;
        if(\JWTAuth::parseToken()->toUser()){

            $user =  \JWTAuth::parseToken()->toUser();
        }else{
            return response()->json(['text' => false],500);
            die();
        }
        $customer = \Stripe\Customer::create(array(
            "email" => $user->email,
            "source" => $token,
        ));

        $charge = \Stripe\Charge::create(array(
            "amount" => 2999,
            "currency" => "usd",
            "customer" => $customer->id
        ));

        DB::table('users')
            ->where('id', $user->id)
            ->update(['prospect' => '1']);

        return response()->json(['text' => true],200);
    }

    public function getPlanStripe(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        $plan = $request->plan;
        if(\JWTAuth::parseToken()->toUser()){

            $user =  \JWTAuth::parseToken()->toUser();
        }else{
            return response()->json(['text' => false],500);
            die();
        }
        $token = $request->token;
        $user->newSubscription('main', $plan)->create($token);
        return response()->json(['text' => true]);
    }

    public function domainName(Request $request)
    {
        $domainName = $request->name;
        $client = new Client(['base_uri' => "https://api.namecheap.com/xml.response"]); //73.241.244.223
        $response = $client->request('GET', '?ApiUser=apparc&ApiKey=9973f370110f46d987ae2fcb57295f2a&UserName=apparc&Command=namecheap.domains.check&ClientIp=73.241.244.223&DomainList='.$domainName);



        $res = $response->getBody()->getContents();
        $arInfoParse = \Parser::xml($res);

        if(isset($arInfoParse['Errors']['Error']) && isset($arInfoParse['Errors']['Error']['#text'])){
            $responseInfo['error'] = $arInfoParse['Errors']['Error']['#text'];
            return response()->json(['error' => $responseInfo ],200);
        }
        $responseInfo['validate'] = $arInfoParse['CommandResponse']['DomainCheckResult']['@Available'];
        $responseInfo['domainName'] = $arInfoParse['CommandResponse']['DomainCheckResult']['@Domain'];

        return response()->json(['text' => $responseInfo],200);

    }

    public function domainPay(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        if(\JWTAuth::parseToken()->toUser()){

            $user =  \JWTAuth::parseToken()->toUser();
        }else{
            return response()->json(['text' => false],500);
            die();
        }
        $name = $request->name;
        $token = $request->token;
        $user->newSubscription('main', '1999')->create($token);

        $domainInfo['name'] = $name;
        $domainInfo['user_id'] = $user->id;
        $resuultat = Domain::select()->where('user_id',$user->id)->first();

        $domain = new Domain();
        if($resuultat){
            Domain::where('user_id', $user->id)
                ->update(['name' => $domainInfo['name']]);

            return response()->json(['text' => true]);
        }else{
            $domain->fill($domainInfo);
            $domain->save();
            return response()->json(['text' => true]);
        }
    }

}
