<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\DB;


class Authentication extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       $login=self::login($request);
       $redirectTo='/laravel/public/';

       if($login&&$login!=null){
            $res=json_decode($login);

            //if exists [unmodified] get existing id
            $from_own_db=self::profile_exists($res->id,$res->date_modified);

            if($from_own_db>0){

                #set session manually
                $_SESSION['id']=$from_own_db;
                $_SESSION['token']=$res->token;
                $_SESSION['uid']=$res->id;
                $_SESSION['dept']=$res->dept;
                $_SESSION['priv']=$res->priv;
                $_SESSION['position']=$res->position;
                $_SESSION['unit']=$res->dept_name;
                $_SESSION['name']=$res->profile_name;
                $_SESSION['image']=$res->profile_image;
                 echo "authenticating . . .";
                 $script='<script>setTimeout(function(){window.location="'.$redirectTo.'";},600)</script>';
                 echo $script;

            }else{
                #save to own database
                $to_own_db=self::register($res->id,$res->profile_name,$res->last_name,$res->first_name,$res->profile_image,$res->dept_name,$res->dept_alias,$res->position,$res->date_modified);

                if($to_own_db>0){

                    $_SESSION['id']=$to_own_db;
                    $_SESSION['token']=$res->token;
                    $_SESSION['uid']=$res->id;
                    $_SESSION['dept']=$res->dept;
                    $_SESSION['priv']=$res->priv;
                    $_SESSION['position']=$res->position;
                    $_SESSION['unit']=$res->dept_name;
                    $_SESSION['name']=$res->profile_name;
                    $_SESSION['image']=$res->profile_image;   

                    echo "authenticating . . .";
                    $script='<script>setTimeout(function(){window.location="'.$redirectTo.'";},600)</script>';
                    echo $script;

                }
            }
       }else{
        return view('authentication',array('message'=>'<div class="alert alert-danger text-center">Oops! Invalid Username or Password!</div>'));
       }


       
    }


    public function login(Request $request)
    {
        $this->username=htmlentities(htmlspecialchars($request->input('username')));
        $password=htmlentities(htmlspecialchars($request->input('password')));

        $this->password=sha1($password);

         try{
                $this->pdoObject=DB::connection()->getPdo();
                $this->pdoObject->beginTransaction();
                $login_sql="SELECT login_db.accounts.id,login_db.mpts_sys_privilege.priv,login_db.account_profile.profile_image,login_db.account_profile.profile_name,login_db.account_profile.profile_name,login_db.account_profile.position,login_db.account_profile.first_name,login_db.account_profile.last_name,login_db.account_profile.date_modified,login_db.department.dept_name,login_db.department.dept_id,login_db.department.dept_alias FROM login_db.accounts left join login_db.account_profile on login_db.account_profile.uid=login_db.accounts.id left JOIN login_db.department on login_db.department.dept_id=login_db.account_profile.dept_id left join login_db.mpts_sys_privilege on login_db.mpts_sys_privilege.uid=login_db.account_profile.id where login_db.accounts.account_username=:user and login_db.accounts.account_password=:pass";
                $login_statement=$this->pdoObject->prepare($login_sql);
                $login_statement->bindParam(':user',$this->username);
                $login_statement->bindParam(':pass',$this->password);
                $login_statement->execute();
                $res="";

                #password hash
                if($row=$login_statement->fetch(\PDO::FETCH_OBJ)){
                    $token=md5('--boundery--'.(integer)$row->id);
                    $hash = password_hash($token, PASSWORD_BCRYPT);
                    $res=json_encode(array('id'=>(integer)$row->id,'priv'=>$row->priv,'dept'=>$row->dept_id,'dept_name'=>$row->dept_name,'dept_alias'=>$row->dept_alias,'profile_image'=>$row->profile_image,'profile_name'=>$row->profile_name,'last_name'=>$row->last_name,'first_name'=>$row->first_name,'position'=>$row->position,'date_modified'=>$row->date_modified,'token'=>$hash));

                }else{
                    $res=false;

                }
                
                $this->pdoObject->commit();
                return $res;

        }catch(Exception $e){echo $e->getMessage();$this->pdoObject->rollback();}
       
    }


    /**check if exists and modified**/
    function profile_exists($user_id,$date_modified){
        try{
                $this->user_id=htmlentities(htmlspecialchars($user_id));
                $this->date=htmlentities(htmlspecialchars($date_modified));
                $this->pdoObject->beginTransaction();
                $sql="SELECT * FROM motorpool.account_profile where uid=:id and date_modified=:date_modified ORDER BY id DESC LIMIT 1";
                $statement=$this->pdoObject->prepare($sql);
                $statement->bindParam(':id',$this->user_id);
                $statement->bindParam(':date_modified',$this->date);
                $statement->execute();
                $result=0;
                while($row=$statement->fetch(\PDO::FETCH_OBJ)){
                    $result=$row->id;
                }
                $this->pdoObject->commit();
                return $result;

        }catch(Exception $e){echo $e->getMessage();$this->pdoObject->rollback();}


    }


    function register($uid,$full_name,$last_name,$first_name,$image,$department,$alias,$position,$date_modified){
            try{
                $this->pdoObject=DB::connection()->getPdo();
                $this->pdoObject->beginTransaction();
                $this->uid=htmlentities(htmlspecialchars($uid));
                $this->full_name=@htmlentities(htmlspecialchars($full_name));
                $this->last_name=@htmlentities(htmlspecialchars($last_name));
                $this->first_name=@htmlentities(htmlspecialchars($first_name));
                $this->image=@htmlentities(htmlspecialchars($image));
                $this->department=@htmlentities(htmlspecialchars($department));
                $this->alias=@htmlentities(htmlspecialchars($alias));
                $this->position=@htmlentities(htmlspecialchars($position));
                $this->date_modified=@htmlentities(htmlspecialchars($date_modified));
                
                
                $sql="INSERT INTO account_profile(profile_name,last_name,first_name,profile_image,department,department_alias,position,date_modified,uid)values(:profile_name,:last_name,:first_name,:profile_image,:department,:department_alias,:position,:date_modified,:uid)";
                $statement=$this->pdoObject->prepare($sql);
                $statement->bindParam(':profile_name',$this->full_name);
                $statement->bindParam(':last_name',$this->last_name);
                $statement->bindParam(':first_name',$this->first_name);
                $statement->bindParam(':profile_image',$this->image);
                $statement->bindParam(':department',$this->department);
                $statement->bindParam(':department_alias',$this->alias);
                $statement->bindParam(':position',$this->position);
                $statement->bindParam(':date_modified',$this->date_modified);
                $statement->bindParam(':uid',$this->uid);
                $statement->execute();

                $lastId=$this->pdoObject->lastInsertId();
                $this->pdoObject->commit();

                return $lastId;
                
            }catch(Exception $e){echo $e->getMessage();$this->pdoObject->rollback();}

    }



}
