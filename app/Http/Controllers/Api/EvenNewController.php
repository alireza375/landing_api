<?php

namespace App\Http\Controllers\Api;

use App\Models\EvenNew;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EvenNewController extends Controller
{

    public function EvenIndex(){

        $even = EvenNew::all();
         return $even;
    }
    //
    public function EvenStore(Request $request){

        $request->validate([
            "image"=> "required",
            "date"=> "required",
            "title"=> "required",
            "description"=> "required",
           ]) ;
           //image store
           if($request->hasFile("image")){
            $image = $request->file("image");
            $filename = 'post_image_'.md5('uniqid'). time() .".". $image->getClientOriginalExtension();
            $image->move(public_path("images"), $filename);
           }
           //post create
        $data = EvenNew::create([
            "image" => $request->image,
            "date" => date('Y-m-d', strtotime(str_replace('/', '-', $request->date))),
            "title"=> $request->title,
            "description"=> $request->description,
           ]);
           return response()->json([
            'status' => 'success',
            'message' => 'News or Even Create Successfully', $data
        ]);
    }


    public function EvenUpdate(Request $request, $id){
        $even = EvenNew::findorFail($id);
        $even->update($request->all());
        $response = [
            'success' => true,
            'message' => 'News or Even Update Successfuly'
        ];
        return response()->json($response, 200);
    }



    public function DeleteEven(Request $request){
        $even = EvenNew::findOrFail($request->id);

        if($even){
            $even->delete();
            $response = [
                'success' => true,
                'message' => 'Even Delete Successfuly'
            ];
        }else{
            $response = [
                'success' => false,
                'message' => 'Even Not Found'
            ];
        }
        return response()->json($response, 200);
    }
}
