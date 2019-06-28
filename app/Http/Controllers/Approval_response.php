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

      # check if approver is different from the one who received the email approval
      if(!isset($tr_details[0])) return;
      if($tr_details[0]->approved_by_uid !== $token_details->uid) return self::show_unsuccessfull_card();
      $itinerary = $official_itinerary->index($tr_details[0]->tr);

      # add approval
      $is_approved = self::create_approval ($token_details->uid, $tr_details[0]->tr, $request->comment ? 0: 1, $request->comment??null, '', $_SERVER['HTTP_USER_AGENT']??null);

      if($is_approved) {
        ob_start();
        header('Content-Type: application/json`');
        header ('CARD-ACTION-STATUS: Successfull!!!!');
        header('CARD-UPDATE-IN-BODY: true');
        echo @self::send_refresh_card($token_details->access_token, $tr_details[0], json_decode($itinerary), ($request->comment ? 0: 1));
        \ob_end_flush();
      } else {
        return self::show_unsuccessfull_card();
      }

    }


    private function send_refresh_card ($access_token, $data, $itinerary, $status) {
   
      $itinerary_json = '';

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
          $response    = '
            {
              "type": "AdaptiveCard",
              "$schema": "http://adaptivecards.io/schemas/adaptive-card.json",
              "version": "1.0",
              "padding": "none",
              "originator": "'.env('MAIL_ORIGINATOR').'",
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
                                            "height": "30px"
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
                                                      "url": "'.url('/').'/travel/official/print/travel_request/3015??access_token='.$access_token.'"
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
                                                      "size": "Small",
                                                      "text": "John Kenneth Abella",
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
                                                      "text": "MIS Assistant",
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
                                                      "text": "Information Technology Services Unit",
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
                          },
                          {
                              "type": "ColumnSet",
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

  private function create_approval ($uid, $tr_id, $status, $remarks, $checksum, $user_agent) {
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

}

