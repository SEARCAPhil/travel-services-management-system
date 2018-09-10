<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Authentication;
use App\Http\Controllers\Accounts;
use App\Http\Controllers\Sessions;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;

#start session

@session_start(); 

class Authentication extends Controller

{
  static $redirectTo = '/trs/public/';

  /**

    * Display a listing of the resource.

    *

    * @return \Illuminate\Http\Response

    */

  public function index(Request $request)
  {
      
    $login = self::login($request);

    if(!isset($login['id'])) return false;

    self::session($login);
    
    return json_encode(array('id' => $login['id'], 
                'token' => $login['token'],
                'role' => $login['role']));


    /*return view('authentication',array('message'=>'
      <div class="alert alert-danger auth-error" style="border-radius: 5px !important;">
          <small>Oops! Invalid Username or Password!  
              <p class="text-important">Is this your account? 
                  <small><a href="'.url("/").'">not my account.</a></small>
              </p>
          </small>
      </div><br/>'));*/
  }


  public function login(Request $request)
  {
    $Ses = new Sessions(DB::connection()->getPdo());
    $Acc = new Accounts(DB::connection()->getPdo());
    //browsers , curl, etc...
    $agent = isset($_SERVER['HTTP_USER_AGENT'])?$_SERVER['HTTP_USER_AGENT']:null;
    // token, salt
    $token = ($Ses->generate_token(date('y-m-d h:i:s'),'bms-2/26/2018'));
    $result = [];

    $input = @json_decode($request->getContent())->data;
    $credential = $Acc->loginO365($input->mail,$input->id);

    // set OPENID
    if(is_null($credential->openID) || empty($credential->openID)) $Acc->setOpenID($credential->uid, $input->id);

    // register
    if(!isset($credential->uid)) {
      // create($company_id, $username, $password, $uid)
      // This is for creating Office365 account
      /*------------------------------------------------------
      // username = @email
      -------------------------------------------------------*/
      $accountId = (int) @$Acc->create(isset($input->mail) ? $input->mail : null, null, $input->id);

      // if account successfully created, save profile to DB
      if($accountId > 0) {

        // create_profile($id, $profile_name, $last_name, $first_name, $middle_name, $email, $department, $department_alias, $position)
        $profileId = (int) @$Acc->create_profile($accountId, $input->displayName, $input->surname, $input->givenName, $input->givenName, $input->mail, $input->department, $input->department, $input->jobTitle);
        $sessionId = $Ses->set($token,$accountId,$agent);
        
        if($sessionId) {
          $result['token'] = $token;
          $result['role'] = @$credential->role;
          $result['id'] = $accountId;
          $result['profile_id'] = $profileId;
          $result['fields'] = $input;
        }

        return $result;

      }
    } else {
      // proceed to login
      // no need to register again
      $sessionId = $Ses->set($token,$credential->uid,$agent);
      if($sessionId) {
        $result['token'] = $token;
        $result['role'] = $credential->role;
        $result['fields'] = $input;
        $result['id'] = $credential->uid;
        $result['profile_id'] = $credential->profile_id;
      }	

      return $result;
    }

    // $res=json_encode(array('id'=>(integer)$row->id,'priv'=>$row->priv,'dept'=>$row->dept_id,'dept_name'=>$row->dept_name,'dept_alias'=>$row->dept_alias,'profile_image'=>$row->profile_image,'profile_name'=>$row->profile_name,'last_name'=>$row->last_name,'first_name'=>$row->first_name,'position'=>$row->position,'date_modified'=>$row->date_modified,'token'=>$hash));
    }


    public function isAdmin(){
      return ($_SESSION['priv'] ==='admin');
    }



    public function logout(){

        $_SESSION=null;

        unset($_SESSION);

        session_destroy();



        #logout script

        echo 'loging out . . .';

        $script='<script>localStorage.clear();setTimeout(function(){window.location="/trs/public/authentication";},600)</script>';

        echo $script;

    }


    private function session($data) {
       #set session manually

       $_SESSION['id'] = $data['id'];
       $_SESSION['token'] = $data['token'];
       $_SESSION['profile_id'] = $data['profile_id'];
       $_SESSION['uid'] = $data['profile_id'];
       $_SESSION['dept'] = $data['fields']->department;
       $_SESSION['priv'] = $data['role'];
       $_SESSION['position'] = $data['fields']->jobTitle;
       $_SESSION['unit'] = $data['fields']->department;
       $_SESSION['name'] = $data['fields']->displayName;

       // echo "authenticating . . .";

      //  $script='<script>localStorage.setItem("priv","'.$_SESSION['priv'].'");setTimeout(function(){window.location="'.self::$redirectTo.'";},600)</script>';

       // echo $script;
    }

}

