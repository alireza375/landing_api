<?php

namespace App\Http\Controllers\Api;

use Dotenv\Validator;
use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BannerController extends Controller
{
    //
    public function BannerPage(Request $request){

        $validator = Validator::make($request->all(),[
            'navber' => 'required',
            'logo' => 'required',
            'heading_tag' => 'required',
            'sort_description' => 'required',
            'image' => 'required',
        ]);
        if($validator->fails()){
            $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
            return response()->json($response, 400);
        }
        $input = $request->all();
        $user = Banner::create($input);

        $response = [
            'success' => true,
            'message' => 'Data Upload Successfuly'
        ];
        return response()->json($response, 200);
    }

}
