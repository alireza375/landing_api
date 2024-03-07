<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Card;
use Illuminate\Http\Request;
use Intervention\Image\Image;
//use Intervention\Image\Facades\Image;
class CardController extends Controller
{
    public function index(){
        $card =Card::latest()->get();
        return $card;

    }

    public function create(Request $request){
        //dd($request->all());
        try{
            $request->validate([
                "missonName"=> "required",
                "sort_dec"=> "required",
                "image"=> "required",
                
               
        
               ]) ;
        
               //image store
                        
                // if($request->hasFile("image")){
                //     $images = $request->file("image");
                //     foreach($images as $image){
                //     $filename = 'post_image_'.md5(uniqid()). time() .".". $image->getClientOriginalExtension();
                //     $image->move(public_path("images"), $filename);
                // }
                // }\

                $imageArray = [];
                if($request->hasFile("image")){
                $images = $request->file("image");
                foreach($images as $image){
                $imageName = 'post_image_'.md5(('uniqid')). time() .".". $image->getClientOriginalExtension();
               $image->move(public_path("images"), $imageName);
               $imageArray[] = $imageName;
            //    return $image->move(public_path("images"), $imageName);
                }
           }
    
               //post create
                
               $data=Card::create([
                "missonName"=> $request->missonName,
                "sort_dec"=> $request->sort_dec,
                "image"=>  $imageArray
              
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
                "missonName"=> "required",
                "sort_dec"=> "required",
                "image"=> "required"
               
               
                ]);

                          
                $imageArray = [];
                if($request->hasFile("image")){
                $images = $request->file("image");
                foreach($images as $image){
                $imageName = 'post_image_'.md5(('uniqid')). time() .".". $image->getClientOriginalExtension();
               $image->move(public_path("images"), $imageName);
               $imageArray[] = $imageName;
            //    return $image->move(public_path("images"), $imageName);
                }
           }
               
                $card = Card::findOrFail($id);
                $card->update([
                    'missonName' => $request->missonName,
                    'sort_dec' => $request->sort_dec,
                    'image' => $request->hasFile('image') ?  $imageArray : $card->image,
                   
                    
                    
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
            $card = Card::findOrFail($id);
            $card->delete();
            
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

//     public function uploadImages(Request $request)
// {
   
//     $request->validate([
//         'images' => 'required|array',
//         'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
//     ]);

    
//     foreach ($request->file('images') as $image) {
       
//         $filename = uniqid() . '_' . time() . '.' . $image->getClientOriginalExtension();

        
//         $imagePath = public_path('uploads/');
//         $image->storeAs('uploads', $filename, 'public');

        
//         Image::make($image->path())->resize(300, 200)->save($imagePath . 'thumbnails/' . $filename);

       
//     }

// }
}


