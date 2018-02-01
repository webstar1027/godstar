<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Resume;
use App\Linkedinresume;
use DB;
use Illuminate\Support\Facades\Storage;
use App\Subscription;

class UploadController extends Controller
{
    public function index(Request $request)
    {

        $file = $request->file('file');
        if(JWTAuth::parseToken()->toUser()){
            $user =  JWTAuth::parseToken()->toUser();
        }else{
            return response()->json(['text' => false],500);
            die();
        }

        $resume['user_id'] = $user['id'];
        $resume['name'] = time().$file->getClientOriginalName();
        $uploadDestinationPath = public_path() . '/uploads/';
       // dd($uploadDestinationPath);
        $file->move($uploadDestinationPath, $resume['name']);

        $resModel = new Resume();
        $fileOldName = Resume::select('name')->where('user_id',$resume['user_id'])->first();
        if($fileOldName){
            if(gettype($fileOldName->name) == 'string'){
                unlink('uploads/'.$fileOldName->name);
            }
            Resume::where('user_id',  $resume['user_id'])->delete();
        }

        $resModel->fill($resume);
        $resModel->save();
        return response()->json(['text' => true],200);
    }

    public function linkedinResume()
    {
        if(JWTAuth::parseToken()->toUser()){
            $user =  JWTAuth::parseToken()->toUser();
        }else{
            return response()->json(['text' => false],500);
        }

        if($user['provider'] == 'linkedin'){
           // dd($user);
            $provider_id = $user['provider_id'];
        }else{
            return response()->json(['error' => 'Please Login With Linkedin'],500);
        }
    }

    public function linkedinResumeSave(Request $request)
    {
        $resumeInfo = $request->all();
        $provider_id = $resumeInfo[0]['id'];
        $resumeInfoArray['provider_id'] = $provider_id;
        $resumeInfoArray['resume'] = $resumeInfo[0];

        $resumeInfoModel = new Linkedinresume();

        $authLinkedinResume = Linkedinresume::where('provider_id', $provider_id)->first();
        //dd($resumeInfoArray);
        if($authLinkedinResume){
            //Linkedinresume::where('provider_id', $provider_id)->update($resumeInfoArray);
            Linkedinresume::where('provider_id', $provider_id)->delete();
            Linkedinresume::firstOrCreate($resumeInfoArray);
        }else{
             Linkedinresume::create($resumeInfoArray);
        }
    }

    public function linkedinResumeSaveUser(Request $request)
    {
        $resumeInfo = $request->all();

        $resumeInfoArray['user_id'] = $resumeInfo['id'];
        $resumeInfoArray['name'] = $resumeInfo['resume'];
        $resumeInfoArray['provider'] = 'linkedin';
//        $resumeInfoModel = new Resume();
//        $resumeInfoModel->fill($resumeInfoArray);
//        $resumeInfoModel->firstOrCreate();
        Resume::where('user_id', $resumeInfoArray['user_id'])->delete();
        Resume::firstOrCreate($resumeInfoArray);
        return response()->json(['error' => 'true'],200);
       // $authLinkedinResume = Linkedinresume::where('provider_id', $provider_id)->first();

    }

    public function linkedinResumeGet(Request $request)
    {
        if(JWTAuth::parseToken()->toUser()){
            $user =  JWTAuth::parseToken()->toUser();
        }else{
            return response()->json(['text' => false],500);
        }

        if($user['provider'] == 'linkedin'){
            $provider_id = $user['provider_id'];
            $userLinkedinInfo = Linkedinresume::where('provider_id', $provider_id)->first();
            return response()->json(['text' => $userLinkedinInfo],200);
        }else{
            return response()->json(['error' => 'error']);
        }
    }

    public function selectTemplate(Request $request)
    {
        if(JWTAuth::parseToken()->toUser()){
            $user =  JWTAuth::parseToken()->toUser();
        }else{
            return response()->json(['text' => false],500);
        }

        $user_id = $user['id'];
        $name = $request['name'];
        $template_id = $request['id'];

        DB::table('users')
            ->where('id', $user_id)
            ->update(['template_id' => $name, 'prospect' => '1']);
        return response()->json(['data' => 'template']);
    }
}