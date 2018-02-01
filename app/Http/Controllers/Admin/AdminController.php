<?php

namespace App\Http\Controllers\Admin;

use App\Domain;
use App\Subscription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use DB;
use App\Linkedinresume;
use App\Resume;

use phpDocumentor\Reflection\Types\Null_;
use Input;
use Excel;

class AdminController extends Controller
{

    public function index()
    {
        if(Auth::user()){
            if(Auth::user()->provider == 'admin'){
                $admin = Auth::user();
                $users =  User::with(['domain','plan'])
                    ->where([
                        ['id', '!=',  Auth::id()],
                        ['archive','=', null],
                        ['prospect','=', '1'],
                    ])
                    ->orderBy('created_at', 'desc')->get();

                foreach ($users as $user){
                    $user['upload'] = 'Upload later';
                    $user_id = $user->id;
                    $res = Resume::select('*')->where('user_id',$user_id)->get();
                    $res->toArray();
                    if(!empty($res->all())){


                        if($res[0]->provider == null){
                            $user['upload'] = 'Resume';
                        }
                        if($res[0]->provider == 'linkedin'){
                            $user['upload'] = 'Linkedin';
                        }

                    }
                    $linkedin = Linkedinresume::select('*')->where('provider_id',$user_id)->get();
                    $linkedin->toArray();
                   // dd($linkedin->all());
                    if(!empty($linkedin->all())){
                        $user['upload'] = 'Linkedin';
                    }
                }

                //echo "<pre>",dd($users);

                return view('admin.main',compact('users'),compact('admin'));
            }else{
                Auth::logout();
                return redirect('/administrate/');
            }
        }else{
            return view('admin.login');
        }

        return view('admin.login');
    }

    public function login()
    {
        if(Auth::user()){
            return redirect('administrate/admin');
        }else{
            return view('admin.login');
        }
    }

    public function signin(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('administrate/admin');
        }else{
            return redirect()->back();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        User::find($id)->delete();

        $resumeId = Resume::select('id')->where('user_id',$id)->first();
        Resume::find($resumeId->id)->delete();

        return response()->json(['data' => 'deleted']);
    }

    public function downloadresume(Request $request)
    {
        $name1 = $request->name;
        $result =  Resume::find($name1);
        $pathToFile = 'uploads/'.$result->name;
        $newName = 'img-'. $result->name;
        $headers = array(
            'Content-Type: application/msword',
        );

        return response()->download($pathToFile,$newName,$headers);
    }

    public function user(Request $request,$id)
    {
        $admin = Auth::user();
        $id = (int)$id;
        $resumeId = 0;
        $user = User::with(['domain','plan'])->where('id',$id)->first();

        if($user->provider == 'linkedin'){
            $providerId = $user->provider_id;
            $userRezume = Linkedinresume::select('*')->where('provider_id',$providerId)->first();
            if($userRezume){
                $userRezume = $userRezume->toArray();
                $userRezume['name'] = $userRezume['resume'];
                $userRezume['user_id'] = 'Linkedin';
            }else{
                $userRezume = null;
            }
        }else{
            $userRezume = Resume::select('*')->where('user_id',$id)->first();
            if($userRezume != null){
                $userRezume = $userRezume->toArray();
            }
        }

        if(gettype($userRezume['name']) == 'string'){
            //$userRezume = file_get_contents('uploads/'.$userRezume['name']);
            $name = 'uploads/'.$userRezume['name'];
            //$userRezume = $this->parsDocx($name); // Parseer +
            $resumeId = $userRezume['id'];
            $userRezume = $userRezume['name'];
        }

        if($userRezume == null){
            $userRezume = 'Not Resume';
        }

        $subBillingInfo = Subscription::where('user_id',$id)->get();
            for ($i=0;$i<count($subBillingInfo);$i++){
                $ssId = $subBillingInfo[$i]->stripe_plan;
                $rr =  substr($ssId, -2);
                $strLength = strlen($ssId) - 2;
                $rrSt =  substr($ssId, 0,$strLength);
                $numC = $rrSt.'.'.$rr;
                $subBillingInfo[$i]->stripe_plan = $numC;
            }
        $domainName = Domain::where('user_id',$id)->get();

        if(isset($domainName[0])){
            $domainName=$domainName[0];
        }else{
            $domainName->name = 'null';
        }

        return view('admin.user',compact('userRezume'),compact('admin'))
            ->with(['resumeId'=>$resumeId,'subBillingInfo'=>$subBillingInfo,'domainName'=>$domainName,'user'=>$user]);

    }

    public function parsDocx($userDoc)
    {
            $fileHandle = fopen($userDoc, "r");
            $line = @fread($fileHandle, filesize($userDoc));
            $lines = explode(chr(0x0D),$line);
            $outtext = "";
            foreach($lines as $thisline)
            {
                $pos = strpos($thisline, chr(0x00));
                if (($pos !== FALSE)||(strlen($thisline)==0))
                {
                } else {
                    $outtext .= $thisline." ";
                }
            }
            $outtext = preg_replace("/[^a-zA-Z0-9\s\,\.\-\n\r\t@\/\_\(\)]/","",$outtext);
            return $outtext;
    }

    public function archive(Request $request)
    {
        $admin = Auth::user();
        $archiveUsers = User::with(['domain','plan'])
        ->where([
            ['id', '!=',  Auth::id()],
            ['archive','=', '1'],
        ])->orderBy('created_at', 'desc')->get();

        return view('admin.archive',compact('archiveUsers'),compact('admin'));
    }

    public function prospects(Request $request)
    {
        $admin = Auth::user();
        $pasiveUsers = User::with(['domain','plan'])
            ->where([
                ['id', '!=',  Auth::id()],
                ['prospect','=', Null],
            ])
            ->orderBy('created_at', 'desc')->get();

        foreach ($pasiveUsers as $user){
            $user['upload'] = 'Upload later';
            $user_id = $user->id;
            $res = Resume::select('*')->where('user_id',$user_id)->get();
            $res->toArray();
            if(!empty($res->all())){


                if($res[0]->provider == null){
                    $user['upload'] = 'Resume';
                }
                if($res[0]->provider == 'linkedin'){
                    $user['upload'] = 'Linkedin';
                }

            }
            $linkedin = Linkedinresume::select('*')->where('provider_id',$user_id)->get();
            $linkedin->toArray();
            if(!empty($linkedin->all())){
                $user['upload'] = 'Linkedin';
            }
        }


        return view('admin.prospects',compact('pasiveUsers'),compact('admin'));
    }

    public function actionArchive(Request $request)
    {
        $id = $request->id;
        DB::table('users')
            ->where('id', $id)
            ->update([
                'archive' => '1',
                'status'=>'Archive',
                'prospect'=> '1'
            ]);
        return response()->json(['data' => 'archived']);
    }

    public function actionStatus(Request $request)
    {
        $sid = $request->id;
        $id = $request->user_id;

        if($sid == 1){
            $ttext = 'In Progress';
        }else if($sid == 2){
            $ttext = 'Active';

        }else if($sid == 3){
            $ttext = 'Archive';

            DB::table('users')
                ->where('id', $id)
                ->update(['archive' => '1','status'=>'Archive','prospect'=> '1']);
            return response()->json(['data' => 'archived']);

        }else{
            $ttext = 'New';
        }


        DB::table('users')
            ->where('id', $id)
            ->update(['status' => $ttext,'archive' => null]);
        return response()->json(['data' => 'archived']);
    }

    public function actionProspectDelete(Request $request)
    {

        $id = $request->id;
        User::find($id)->delete();
        return response()->json(['data' => 'deleted']);

//        $id = $request->id;
//        DB::table('users')
//            ->where('id', $id)
//            ->update(['prospect' => '1']);
//        return response()->json(['data' => 'prospect']);
    }

    public function excel()
    {

        $data = User::get()->toArray();
        return Excel::create('users', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download('xlsx');

    }

}
