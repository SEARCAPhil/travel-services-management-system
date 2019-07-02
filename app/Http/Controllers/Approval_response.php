<?php



namespace App\Http\Controllers;



use App\Http\Controllers\Authentication;



use Illuminate\Http\Request;



use App\Http\Requests;



use Illuminate\Support\Facades\DB;


use App\Http\Controllers\Official;
use App\Http\Controllers\Official_staff;

use App\Http\Controllers\Official_scholars;

use App\Http\Controllers\Official_custom;
use App\Http\Controllers\Official_itenerary;

use App\Http\Controllers\Directory;


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



@session_start();


class Approval_response extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */



    public function index(Request $request)

    { 
      if(!isset($request->access_token) || is_null($request->access_token)) { \var_dump($request->body);
        return self::show_unsuccessfull_card($request->body);
      }

      # check if token exists
      $token_details = self::check_valid_email_token ($request->access_token);
      if(!isset($token_details->id)) return self::show_unsuccessfull_card();
      # check if token is expired
      if($token_details->valid_until < date('Y-m-d H:i:s')) return self::show_expired_card();

      $official = new Official();
      $tr_details = json_decode($official->show($request->id));
      $official_itinerary = new Official_itenerary ();
      $official_staff=new Official_staff();
      $official_scholars=new Official_scholars();
      $official_custom=new Official_custom();

      # check if approver is different from the one who received the email approval
      if(!isset($tr_details[0])) return;
      if($tr_details[0]->approved_by_uid !== $token_details->uid) return self::show_unsuccessfull_card();
      $itinerary = $official_itinerary->index($tr_details[0]->tr);
      $staff=json_decode($official_staff->index($tr_details[0]->tr));
      $scholars=json_decode($official_scholars->index($tr_details[0]->tr));
      $custom=json_decode($official_custom->index($tr_details[0]->tr));

      # add approval
      $checksum = self::create_checksum ($token_details->uid, $tr_details[0]->tr, $request->comment ? 0: 1, $request->comment??null, $_SERVER['HTTP_USER_AGENT']??null);
      $is_approved = self::create_approval ($token_details->uid, $tr_details[0]->tr, $request->comment ? 0: 1, $request->comment??null, $_SERVER['HTTP_USER_AGENT']??null, $checksum);

      if($is_approved) {
        ob_start();
        header('Content-Type: application/json`');
        header ('CARD-ACTION-STATUS: Successfull!!!!');
        header('CARD-UPDATE-IN-BODY: true');
        echo @self::send_refresh_card($token_details->access_token, $tr_details[0], json_decode($itinerary), ($request->comment ? 0: 1), $staff, $scholars, $custom, $checksum);
        \ob_end_flush();
        # send email to approver
        # check email
        $account = new Accounts(DB::connection()->getPdo());
        $email = $account->view_username($tr_details[0]->uid); 
        if(isset($email[0]->username)) {
            self::send_email_to_requester($email[0]->username, self::send_refresh_card($token_details->access_token, $tr_details[0], json_decode($itinerary), ($request->comment ? 0: 1), $staff, $scholars, $custom, $checksum));
        }
      } else {
        return self::show_unsuccessfull_card();
      }

    }

    private function send_refresh_card ($access_token, $data, $itinerary, $status, $staff, $scholars, $custom, $checksum) {
   
 #\var_dump($itinerary); exit;
 $itinerary_json = '';
 $passenger_json = '';
 
 $staff_total_count=count($staff);
 $scholars_total_count=count($scholars);
 $custom_total_count=count($custom);
 $passenger_count=0;

 for($a=0;$a<$staff_total_count;$a++){
   $passenger_count++;
   $passenger_json.='{
     "type": "Container",
     "style": null,
     "backgroundImage": null,
     "items": [
         {
             "type": "ColumnSet",
             "style": null,
             "columns": [
                 {
                     "type": "Column",
                     "style": null,
                     "backgroundImage": null,
                     "items": [
                         {
                             "type": "TextBlock",
                             "size": "Small",
                             "text": "'.@$staff[$a]->name.'",
                             "wrap": true
                         }
                     ],
                     "bleed": false,
                     "width": "stretch"
                 },
                 {
                     "type": "Column",
                     "style": null,
                     "backgroundImage": null,
                     "items": [
                         {
                             "type": "TextBlock",
                             "size": "Small",
                             "text": "'.@$staff[$a]->designation.'",
                             "wrap": true
                         }
                     ],
                     "bleed": false,
                     "width": "stretch"
                 },
                 {
                     "type": "Column",
                     "style": null,
                     "backgroundImage": null,
                     "items": [
                         {
                             "type": "TextBlock",
                             "size": "Small",
                             "text": "'.@$staff[$a]->office.'",
                             "wrap": true
                         }
                     ],
                     "bleed": false,
                     "width": "stretch"
                 }
             ],
             "bleed": false
         }
     ],
     "bleed": false
 },';

 }

 for($a=0;$a<$scholars_total_count;$a++){
   $passenger_count++;
   $passenger_json.='{
     "type": "Container",
     "style": null,
     "backgroundImage": null,
     "items": [
         {
             "type": "ColumnSet",
             "style": null,
             "columns": [
                 {
                     "type": "Column",
                     "style": null,
                     "backgroundImage": null,
                     "items": [
                         {
                             "type": "TextBlock",
                             "size": "Small",
                             "text": "'.@$scholars[$a]->full_name.'",
                             "wrap": true
                         }
                     ],
                     "bleed": false,
                     "width": "stretch"
                 },
                 {
                     "type": "Column",
                     "style": null,
                     "backgroundImage": null,
                     "items": [
                         {
                             "type": "TextBlock",
                             "size": "Small",
                             "text": "'.@$scholars[$a]->nationality.'",
                             "wrap": true
                         }
                     ],
                     "bleed": false,
                     "width": "stretch"
                 },
                 {
                     "type": "Column",
                     "style": null,
                     "backgroundImage": null,
                     "items": [
                         {
                             "type": "TextBlock",
                             "size": "Small",
                             "text": " Scholar",
                             "wrap": true
                         }
                     ],
                     "bleed": false,
                     "width": "stretch"
                 }
             ],
             "bleed": false
         }
     ],
     "bleed": false
 },';
 }

 for($a=0;$a<$custom_total_count;$a++){
   $passenger_count++;
   $passenger_json.='{
     "type": "Container",
     "style": null,
     "backgroundImage": null,
     "items": [
         {
             "type": "ColumnSet",
             "style": null,
             "columns": [
                 {
                     "type": "Column",
                     "style": null,
                     "backgroundImage": null,
                     "items": [
                         {
                             "type": "TextBlock",
                             "size": "Small",
                             "text": "'.@$custom[$a]->full_name.'",
                             "wrap": true
                         }
                     ],
                     "bleed": false,
                     "width": "stretch"
                 },
                 {
                     "type": "Column",
                     "style": null,
                     "backgroundImage": null,
                     "items": [
                         {
                             "type": "TextBlock",
                             "size": "Small",
                             "text": "'.@$custom[$a]->designation.'",
                             "wrap": true
                         }
                     ],
                     "bleed": false,
                     "width": "stretch"
                 },
                 {
                     "type": "Column",
                     "style": null,
                     "backgroundImage": null,
                     "items": [
                         {
                             "type": "TextBlock",
                             "size": "Small",
                             "text": " ",
                             "wrap": true
                         }
                     ],
                     "bleed": false,
                     "width": "stretch"
                 }
             ],
             "bleed": false
         }
     ],
     "bleed": false
 },';
 }

 foreach($itinerary as $key => $value) {
   $isEmptyDeptTime = $value->departure_time == '00:00:00' ? true : false; 
   $deptTime = new \DateTime($value->departure_time);
   $itenerary_departure_date_formatted = (@new \DateTime($value->departure_date))->format('F d, Y');

   $itinerary_json.='
   {
     "type": "ColumnSet",
     "padding": {
         "left": "padding",
         "right": "padding"
     },
     "columns": [{
           "type": "Column",
           "items": [
               {
                   "type": "TextBlock",
                   "horizontalAlignment": "Left",
                   "text": "'.$itenerary_departure_date_formatted.'",
                   "wrap": true,
                   "size": "Small"
               }
           ],
           "width": "150px",
           "style": null,
           "backgroundImage": null,
           "bleed": false,
           "separator": true
       },
       {
           "type": "Column",
           "horizontalAlignment": "Left",
           "spacing": "Medium",
           "items": [
               {
                   "type": "TextBlock",
                   "size": "Small",
                   "text": "'.($isEmptyDeptTime ? '' : $deptTime->format('h:i A')).'"
               }
           ],
           "width": "80px",
           "style": null,
           "backgroundImage": null,
           "bleed": false
       },
       {
           "type": "Column",
           "items": [
               {
                   "type": "TextBlock",
                   "size": "Small",
                   "text": "'.$value->location.'",
                   "wrap": true
               }
           ],
           "width": 50,
           "style": null,
           "backgroundImage": null,
           "bleed": false
       },
       {
           "type": "Column",
           "spacing": "Small",
           "verticalContentAlignment": "Center",
           "id": "chevronUp1",
           "isVisible": false,
           "items": [
               {
                   "type": "Image",
                   "width": "20px",
                   "url": "https://messagecarddemo.blob.core.windows.net/messagecard/up.png",
                   "altText": "expanded",
                   "selectAction": {
                       "type": "Action.ToggleVisibility",
                       "title": "expand",
                       "targetElements": [
                           "cardContent1",
                           "chevronUp1",
                           "chevronDown1"
                       ]
                   }
               }
           ],
           "width": "auto",
           "style": null,
           "backgroundImage": null,
           "bleed": false
       },
       {
           "type": "Column",
           "style": null,
           "backgroundImage": null,
           "items": [
               {
                   "type": "TextBlock",
                   "size": "Small",
                   "text": "'.$value->destination.'",
                   "wrap": true
               }
           ],
           "bleed": false,
           "width": 50
       }],
       "style": null,
       "bleed": false
     },';
 }

        $response = '{
            "type": "AdaptiveCard",
            "$schema": "http://adaptivecards.io/schemas/adaptive-card.json",
            "version": "1.0",
            "padding": "none",
            "originator": "'.env('MAIL_ORIGINATOR').'",
            "expectedActors": ["itsu@searca.org"],
            "body": [
                {
                    "type": "Container",
                    "style": "emphasis",
                    "items": [
                        {
                            "type": "ColumnSet",
                            "columns": [
                                {
                                    "type": "Column",
                                    "width": "stretch",
                                    "items": [
                                        {
                                            "type": "TextBlock",
                                            "text": "**TRS APPROVAL**",
                                            "size": "Large",
                                            "weight": "Bolder"
                                        }
                                    ],
                                    "style": null,
                                    "backgroundImage": null,
                                    "bleed": false
                                },
                                {
                                    "type": "Column",
                                    "items": [
                                        {
                                            "type": "Image",
                                            "horizontalAlignment": "Right",
                                            "verticalContentAlignment": "center",
                                            "url": "'.($status ? "https://filedepot.blob.core.windows.net/build/approved.png" : "https://filedepot.blob.core.windows.net/build/declined.png").'",
                                            "height": "30px",
                                            "altText": "STATUS"
                                        }
                                    ],
                                    "style": null,
                                    "backgroundImage": null,
                                    "bleed": false,
                                    "width": "auto"
                                }
                            ],
                            "style": null,
                            "bleed": false
                        }
                    ],
                    "backgroundImage": null,
                    "bleed": false
                },
                {
                    "type": "Container",
                    "padding": {
                        "right": "padding",
                        "left": "padding"
                    },
                    "items": [
                        {
                            "type": "ColumnSet",
                            "columns": [
                                {
                                    "type": "Column",
                                    "items": [
                                        {
                                            "type": "TextBlock",
                                            "size": "ExtraLarge",
                                            "text": "TR#'.@$data->tr.'",
                                            "wrap": true
                                        }
                                    ],
                                    "width": "stretch",
                                    "style": null,
                                    "backgroundImage": null,
                                    "bleed": false
                                },
                                {
                                    "type": "Column",
                                    "items": [
                                        {
                                            "type": "ActionSet",
                                            "actions": [
                                                {
                                                    "type": "Action.OpenUrl",
                                                    "title": "View Original Request (PDF)",
                                                    "url": "'.url('/').'/travel/official/print/travel_request/3015?access_token='.$access_token.'"
                                                }
                                            ]
                                        }
                                    ],
                                    "style": null,
                                    "backgroundImage": null,
                                    "bleed": false,
                                    "width": "auto"
                                }
                            ],
                            "style": null,
                            "bleed": false
                        },
                        {
                            "type": "FactSet",
                            "spacing": "ExtraLarge",
                            "facts": [
                                {
                                    "title": "Requestor",
                                    "value": "**'.@$data->profile_name.'**   ('.@$data->profile_email.') "
                                },
                                {
                                    "title": "Department",
                                    "value": "'.$data->department.'"
                                },
                                {
                                    "title": "Position",
                                    "value": "'.$data->position.'"
                                },
                                {
                                    "title": "Purpose",
                                    "value": "'.strip_tags(nl2br($data->purpose)).'"
                                }
                            ],
                            "separator": true,
                            "height": "stretch"
                        }
                    ],
                    "style": null,
                    "backgroundImage": null,
                    "bleed": false
                },
                {
                    "type": "Container",
                    "style": "emphasis",
                    "spacing": "Medium",
                    "items": [
                        {
                            "type": "ColumnSet",
                            "columns": [
                                {
                                    "type": "Column",
                                    "style": null,
                                    "backgroundImage": null,
                                    "items": [
                                        {
                                            "type": "TextBlock",
                                            "text": "**Date**"
                                        }
                                    ],
                                    "bleed": false,
                                    "width": "150px"
                                },
                                {
                                    "type": "Column",
                                    "style": null,
                                    "backgroundImage": null,
                                    "items": [
                                        {
                                            "type": "TextBlock",
                                            "text": "**Time**"
                                        }
                                    ],
                                    "bleed": false,
                                    "width": "80px"
                                },
                                {
                                    "type": "Column",
                                    "style": null,
                                    "backgroundImage": null,
                                    "items": [
                                        {
                                            "type": "TextBlock",
                                            "horizontalAlignment": "Left",
                                            "text": "**Origin**"
                                        }
                                    ],
                                    "bleed": false,
                                    "width": 50
                                },
                                {
                                    "type": "Column",
                                    "style": null,
                                    "backgroundImage": null,
                                    "items": [
                                        {
                                            "type": "TextBlock",
                                            "text": "**Destination**"
                                        }
                                    ],
                                    "bleed": false,
                                    "width": 50
                                }
                            ],
                            "style": null,
                            "bleed": false
                        }
                    ],
                    "backgroundImage": null,
                    "bleed": false
                },
                '.$itinerary_json.'
                {
                    "type": "Container",
                    "id": "cardContent1",
                    "isVisible": false,
                    "padding": {
                        "left": "padding",
                        "right": "padding"
                    },
                    "style": null,
                    "backgroundImage": null,
                    "bleed": false
                },
                {
                    "type": "Container",
                    "id": "cardContent2",
                    "isVisible": false,
                    "padding": {
                        "left": "padding",
                        "right": "padding"
                    },
                    "style": null,
                    "backgroundImage": null,
                    "bleed": false
                },
                {
                    "type": "Container",
                    "id": "cardContent3",
                    "isVisible": false,
                    "padding": {
                        "left": "padding",
                        "right": "padding"
                    },
                    "items": [
                        {
                            "type": "Container",
                            "items": [
                                {
                                    "type": "Input.Text",
                                    "id": "comment3",
                                    "placeholder": "Add your comment here.",
                                    "value": "",
                                    "validation": null
                                }
                            ],
                            "style": null,
                            "backgroundImage": null,
                            "bleed": false
                        },
                        {
                            "type": "Container",
                            "items": [
                                {
                                    "type": "ColumnSet",
                                    "columns": [
                                        {
                                            "type": "Column",
                                            "items": [
                                                {
                                                    "type": "ActionSet",
                                                    "actions": [
                                                        {
                                                            "type": "Action.Http",
                                                            "title": "Send",
                                                            "method": "POST",
                                                            "body": "{{comment3.value}}",
                                                            "url": "https://messagecardplaygroundfn.azurewebsites.net/api/HttpPost?code=zJaYHdG4dZdPK0GTymwYzpaCtcPAPec8fTvc2flJRvahwigYWg3p0A==&message=The comment was added successfully"
                                                        }
                                                    ]
                                                }
                                            ],
                                            "width": "auto",
                                            "style": null,
                                            "backgroundImage": null,
                                            "bleed": false
                                        }
                                    ],
                                    "style": null,
                                    "bleed": false
                                }
                            ],
                            "style": null,
                            "backgroundImage": null,
                            "bleed": false
                        }
                    ],
                    "style": null,
                    "backgroundImage": null,
                    "bleed": false
                },
                {
                    "type": "Container",
                    "id": "cardContent4",
                    "padding": {
                        "left": "padding",
                        "right": "padding",
                        "top": "padding",
                        "bottom": "large"
                    },
                    "isVisible": false,
                    "items": [
                        {
                            "type": "Container",
                            "items": [
                                {
                                    "type": "TextBlock",
                                    "text": "* Testing 1. by nvnkumar on Tue, Feb 14th, 2017 at 6:00 AM.",
                                    "wrap": true,
                                    "isSubtle": true
                                },
                                {
                                    "type": "TextBlock",
                                    "text": "* Testing 2. by nvnkumar on Tue, Feb 14th, 2017 at 6:00 AM.",
                                    "wrap": true,
                                    "isSubtle": true
                                },
                                {
                                    "type": "TextBlock",
                                    "text": "* Testing 2. by nadhu on Tue, Feb 14th, 2017 at 6:00 AM.",
                                    "wrap": true,
                                    "isSubtle": true
                                }
                            ],
                            "style": null,
                            "backgroundImage": null,
                            "bleed": false
                        }
                    ],
                    "style": null,
                    "backgroundImage": null,
                    "bleed": false
                },
                {
                    "type": "Container",
                    "padding": {
                        "right": "medium",
                        "left": "medium",
                        "bottom": "medium"
                    },
                    "items": [
                        {
                            "type": "Container",
                            "style": null,
                            "backgroundImage": null,
                            "items": [
                                {
                                    "type": "TextBlock",
                                    "text": "**Passenger(s)**"
                                }
                            ],
                            "bleed": false
                        },
                        {
                            "type": "Container",
                            "padding": {
                                "right": "padding",
                                "left": "padding"
                            },
                            "items": [
                                {
                                    "type": "Container",
                                    "style": null,
                                    "backgroundImage": null,
                                    "items": [
                                        {
                                            "type": "ColumnSet",
                                            "style": null,
                                            "columns": [
                                                {
                                                    "type": "Column",
                                                    "style": null,
                                                    "backgroundImage": null,
                                                    "items": [
                                                        {
                                                            "type": "TextBlock",
                                                            "horizontalAlignment": "Left",
                                                            "text": "**Name**"
                                                        }
                                                    ],
                                                    "bleed": false,
                                                    "width": 50
                                                },
                                                {
                                                    "type": "Column",
                                                    "style": null,
                                                    "backgroundImage": null,
                                                    "items": [
                                                        {
                                                            "type": "TextBlock",
                                                            "text": "**Designation**"
                                                        }
                                                    ],
                                                    "bleed": false,
                                                    "width": 50
                                                },
                                                {
                                                    "type": "Column",
                                                    "style": null,
                                                    "backgroundImage": null,
                                                    "items": [
                                                        {
                                                            "type": "TextBlock",
                                                            "text": "**Office / Unit**"
                                                        }
                                                    ],
                                                    "bleed": false,
                                                    "width": 50
                                                }
                                            ],
                                            "bleed": false
                                        }
                                    ],
                                    "bleed": false
                                }
                            ],
                            "style": "emphasis",
                            "backgroundImage": null,
                            "bleed": false,
                            "height": "stretch",
                            "horizontalAlignment": "Left",
                            "spacing": "Medium"
                        },
                        '.$passenger_json.'
                        {
                            "type": "Container",
                            "style": "emphasis",
                            "padding": {
                                "right": "none",
                                "left": "padding",
                                "top": "padding",
                                "bottom": "padding"
                            },
                            "items": [
                                {
                                    "type": "ColumnSet",
                                    "style": null,
                                    "columns": [
                                        {
                                            "type": "Column",
                                            "style": null,
                                            "backgroundImage": null,
                                            "items": [
                                                {
                                                    "type": "TextBlock",
                                                    "size": "Small",
                                                    "weight": "Lighter",
                                                    "text": "**signature : '.$checksum.'**",
                                                    "wrap": true
                                                }
                                            ],
                                            "bleed": false,
                                            "width": "stretch"
                                        }
                                    ],
                                    "bleed": false
                                }
                            ],
                            "backgroundImage": null,
                            "bleed": false
                        }
                        
                    ],
                    "style": null,
                    "backgroundImage": null,
                    "bleed": false
                }
            ],
            "style": null,
            "backgroundImage": null,
            "bleed": false,
            "actions": null
        }';

          return $response;
    }

    private function check_valid_email_token ($token) {
      
      try{

        $this->pdoObject=DB::connection()->getPdo();
        $this->pdoObject->beginTransaction();
        $sql="SELECT * FROM email_token where access_token=:access_token LIMIT 1";

        $statement=$this->pdoObject->prepare($sql);
        $statement->bindParam(':access_token',$token);
        $statement->execute();
        $res=Array();

        while($row=$statement->fetch(\PDO::FETCH_OBJ)){
          $res=$row;
        }

        $this->pdoObject->commit();



        return $res;



    }catch(Exception $e){echo $e->getMessage();$this->pdoObject->rollback();}
  }

  private function show_unsuccessfull_card ($token='') {
    ob_start();
    header ("CARD-ACTION-STATUS: Something went wrong. Please try again later.{$token}");
    \ob_end_flush();
    return;
  }

  private function show_expired_card () {
    ob_start();
    header ('CARD-ACTION-STATUS: This link is already expired. User must resend another request');
    \ob_end_flush();
    return;
  }

  private function create_checksum ($uid, $tr_id, $status, $remarks, $user_agent) {
    $payload = [$uid, $tr_id, $status, $remarks, $user_agent];
    $check = implode('', $payload);
    return md5(sha1($check));
  }

  private function create_approval ($uid, $tr_id, $status, $remarks, $user_agent, $checksum) {
    $this->pdoObject=DB::connection()->getPdo();
    $this->pdoObject->beginTransaction();
    $user_agent = is_null($user_agent) ? '' : $user_agent;
    
    $sql="INSERT INTO approval(uid, tr_id, status, remarks, checksum, user_agent) values (:uid, :tr_id, :status, :remarks, :checksum, :user_agent)";

    $statement=$this->pdoObject->prepare($sql);
    $statement->bindParam(':uid',$uid);
    $statement->bindParam(':tr_id', $tr_id);
    $statement->bindParam(':status', $status);
    $statement->bindParam(':remarks', $remarks);
    $statement->bindParam(':checksum', $checksum);
    $statement->bindParam(':user_agent', $user_agent);
    $statement->execute();

    $lastId=$this->pdoObject->lastInsertId();
    $this->pdoObject->commit();

    return $lastId;
  }

  private function send_email_to_requester($email, $card) {
          // Instantiation and passing `true` enables exceptions
          $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
      
          try {
              //Server settings
              $mail->SMTPDebug = 0;                                       // Enable verbose debug output
              $mail->isSMTP();                                            // Set mailer to use SMTP
              $mail->Host       = env('MAIL_HOST');  // Specify main and backup SMTP servers
              $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
              $mail->Username   = env('MAIL_USERNAME');                     // SMTP username
              $mail->Password   = env('MAIL_PASSWORD');                              // SMTP password
              $mail->SMTPSecure = env('MAIL_ENCRYPTION');                                 // Enable TLS encryption, `ssl` also accepted
              $mail->Port       = env('MAIL_PORT');;                                    // TCP port to connect to
    
              //Recipients
              $mail->setFrom(env('MAIL_USERNAME'), 'Mailer');
              $mail->addAddress($email, $email);     // Add a recipient
              #$mail->addAddress('ellen@example.com');               // Name is optional
              #$mail->addReplyTo('info@example.com', 'Information');
              #$mail->addCC('edrj@searca.org');
              #$mail->addAddress('itsu@searca.org', 'Joe User'); 
              #$mail->addBCC('bcc@example.com');
    
              // Content
              $mail->isHTML(true);                                  // Set email format to HTML
              $mail->Subject = 'TRS Approval Request';
              $mail->Body    = '<html>
              <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                <script type="application/adaptivecard+json">'.$card;
            
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                return $mail->send();
                
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

            
  }

}

