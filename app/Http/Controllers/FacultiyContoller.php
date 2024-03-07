<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Faculty;
use Illuminate\Http\Request;

class FacultiyContoller extends Controller
{
    public function index(){
        $faculty =Faculty::latest()->get();
        return $faculty;

    }

    //create

    public function create(Request $request){
        //dd($request->all());
        try{
            $request->validate([
                "head"=> "required",
                "image"=> "required",
                "title"=> "required",
                "Faculty_Name"=> "required",
                
               
        
               ]) ;
        
               //image store
                        
                // if($request->hasFile("image")){
                //     $image = $request->file("image");
                //     $filename = 'post_image_'.md5('uniqid'). time() .".". $image->getClientOriginalExtension();
                //     $image->move(public_path("images_Faculty"), $filename);
                // }
                    

                $imageArray = null;
                if($request->hasFile("image")){
                    $image = $request->file("image");
                    $imageArray = 'post_image_'.md5(('uniqid')). time() .".". $image->getClientOriginalExtension();
                    $image->move(public_path("images_Faculty"),  $imageArray);
                   }
            //    return $image->move(public_path("images"), $imageName);
                
           
               //post create
                
              $data= Faculty::create([
                "head"=> $request->head,
                "image"=>$imageArray,
                "title"=> $request->title,
                "Faculty_Name"=> $request->Faculty_Name
              
               ]);
               return response()->json([
                "status"=>"Successfull",
                "Message"=>"Create Successfull",$data
               ]);

              
            }

            catch(Exception $e){
                return response()->json([
                    "status"=>"Faild",
                    "message"=>$e->getMessage()
                ],200);

        }


        

    }

    //update

    public function update(Request $request, $id){
        try{
            $request->validate([
                "head"=> "required",
                "image"=> "required",
                "title"=> "required",
                "Faculty_Name"=> "required"
               
               
                ]);

                          
                $imageArray = null;
                if($request->hasFile("image")){
                    $image = $request->file("image");
                    $imageArray = 'post_image_'.md5(('uniqid')). time() .".". $image->getClientOriginalExtension();
                    $image->move(public_path("images_Faculty"),  $imageArray);
                   }
        
               
                $faculty = Faculty::findOrFail($id);
                $faculty->update([
                    'head' => $request->head,
                    'image' => $request->hasFile('image') ?$imageArray : $faculty->image,
                    'title' => $request->title,
                    'Faculty_Name' => $request->Faculty_Name,

                   
                   
                    
                    
                ]);
                return response()->json([
                    "status"=>"Successfull",
                    "Message"=>"update Successfull"
                   ]);
                

        }
        catch(Exception $e){
            return response()->json([
                "status"=>"Faild",
                "message"=>$e->getMessage()
            ],200);

    }

}


    //delete

    public function destroy($id){
        try{
            $faculty = Faculty::findOrFail($id);
            $faculty->delete();
            
            return response()->json([
                "status"=>"Successfull",
                "Message"=>"deleted Successfull"
               ]);

        }

        catch(Exception $e){
            return response()->json([
                "status"=>"Faild",
                "message"=>$e->getMessage()
            ],200);

    }
       
    }
}
