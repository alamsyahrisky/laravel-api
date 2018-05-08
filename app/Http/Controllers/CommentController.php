<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comments;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use App\User;
use JWTAuthException;

class CommentController extends Controller
{
    public function index(Request $request)
	{
		$comments=Comments::all();
		return response()->json($comments,200);
	}
 
    public function show(Comments $Comments)
    {
        return $Comments;
    }
 
    public function store(Request $request)
    {
        $Comments = Comments::create($request->all());
 
        return response()->json($Comments, 201);
    }
 
    public function update(Request $request, Comments $Comments)
    {
        $Comments->update($request->all());
 
        return response()->json($Comments, 200);
    }
 
    public function delete(Comments $Comments)
    {
        $Comments->delete();
 
        return response()->json("success", 200);
    }

    public function getcurl(){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://localhost/laravel-api/public/api/comments",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                // Set Here Your Requesred Headers
                'Content-Type: application/json',
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            print_r(json_decode($response));
        }
    }

    
    public function postcurl(){
        // Make Post Fields Array
        $data1 = [
            'author' => 'curl',
            'text' => 'isi dari curl',
        ];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://localhost/laravel-api/public/api/comments",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data1),
            CURLOPT_HTTPHEADER => array(
                // Set here requred headers
                "accept: */*",
                "accept-language: en-US,en;q=0.8",
                "content-type: application/json",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            print_r(json_decode($response));
        }
    }
}
