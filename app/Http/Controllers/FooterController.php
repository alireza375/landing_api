<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Footer;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    public function index(){
        $footer =Footer::latest()->get();
        return $footer;

    }




    //store
    public function create(Request $request){
        //dd($request->all());
        try{
            $request->validate([
              "logo"=>"required",
                "short_dec"=> "required",
                "image"=> "required",
                "quick_links"=> "required",
                "support"=> "required",
                "contacts"=> "required"                      
               ]) ;      
               //image store                        
                // if($request->hasFile("image")){
                //     $image = $request->file("image");
                //     $filename = 'post_image_'.md5('uniqid'). time() .".". $image->getClientOriginalExtension();
                //     $image->move(public_path("images_footer"), $filename);
                // }

                
                $imageArray = [];
                if($request->hasFile("image")){
                $images = $request->file("image");
                foreach($images as $image){
                $imageName = 'post_image_'.md5(('uniqid')). time() .".". $image->getClientOriginalExtension();
               $image->move(public_path("images_footer"), $imageName);
               $imageArray[] = $imageName;
            //    return $image->move(public_path("images"), $imageName);
                }
           }
                
                
                $logoImage = null;
                if($request->hasFile("logo")){
                    $logo = $request->file("logo");
                    $logoImage= 'post_image_'.md5(('uniqid')). time() .".". $logo->getClientOriginalExtension();
                    $logo->move(public_path("images_footer_logo"),  $logoImage);
                    
                   }

               //post create   
              $data=Footer::create([
                "logo"=>$logoImage,
                "short_dec"=> $request->short_dec,
                "image"=> $imageArray,
                "quick_links"=> $request->quick_links,
                "support"=> $request->support,
                "contacts"=> $request->contacts             
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
                "logo"=> "required",
                "short_dec"=> "required",
                "image"=> "required",
                "quick_links"=> "required",
                "support"=> "required",
                "contacts"=> "required",
                ]);

                          
                // if($request->hasFile("image")){
                //     $image = $request->file("image");
                //     $filename = 'post_image_'.md5('uniqid'). time() .".". $image->getClientOriginalExtension();
                //     $image->move(public_path("images"), $filename);
                // }
                $imageArray = [];
                if($request->hasFile("image")){
                $images = $request->file("image");
                foreach($images as $image){
                $imageName = 'post_image_'.md5(('uniqid')). time() .".". $image->getClientOriginalExtension();
               $image->move(public_path("images_footer"), $imageName);
               $imageArray[] = $imageName;
            //    return $image->move(public_path("images"), $imageName);
                }
           }
        
                $logoImage = null;
                if($request->hasFile("logo")){
                    $logo = $request->file("logo");
                    $logoImage= 'post_image_'.md5(('uniqid')). time() .".". $logo->getClientOriginalExtension();
                    $logo->move(public_path("images_footer_logo"),  $logoImage);
                    
                    
                   }
               
                $footer = Footer::findOrFail($id);
                $footer->update([
                    "logo"=>$request->hasFile('image') ?$logoImage : $footer->image,
                    "short_dec"=> $request->short_dec,
                    "image"=> $request->hasFile('image') ?$imageArray : $footer->image,
                    "quick_links"=> $request->quick_links,
                    "support"=> $request->support,
                    "contacts"=> $request->contacts         
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
        $footer = Footer::findOrFail($id);
        $footer->delete();
        
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
