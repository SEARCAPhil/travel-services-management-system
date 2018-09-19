<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class Profile extends Controller
{
    public function image(Request $request) {
        $input = @json_decode($request->getContent());
        $data = $input->data;
        $id = $input->id;

        if (preg_match('/^data:image\/(\w+);base64,/', $data, $type)) {
            $data = substr($data, strpos($data, ',') + 1);
            $type = strtolower($type[1]); // jpg, png, gif
        
            if (!in_array($type, [ 'jpg', 'jpeg', 'gif', 'png' ])) { echo 'a';
                exit;
            }
        
            $data = base64_decode($data);
        
            if ($data === false) { echo 'a';
                exit;
            }
        } else { 
            exit;
        }
        
        var_dump(file_put_contents("uploads/profile/{$id}.{$type}", $data));
        //move_uploaded_file($_FILES["attachment"]["tmp_name"], 'uploads/automobile/'.$filename)
    }
}
