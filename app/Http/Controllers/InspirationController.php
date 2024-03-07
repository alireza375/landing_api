<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Inspiraton;
use Illuminate\Http\Request;

class InspirationController extends Controller
{
    public function create(Request $request){
        //dd($request->all());
        try{
            $request->validate([
                "head"=> "required",
                "sort_dec"=> "required",
                "heading_tag"=> "required",
                "mvg"=> "required",
               
        
               ]) ;
        
               //image store
        
               //post create
                
              $data= Inspiraton::create([
                "head"=> $request->head,
                "sort_dec"=> $request->sort_dec,
                "heading_tag"=> $request->heading_tag,
                "mvg"=> $request->mvg,
               
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



    public function update(Request $request, $id){
        try{
            $request->validate([
                "head"=> "required",
                "sort_dec"=> "required",
                "heading_tag"=> "required",
                "mvg"=> "required"
               
                ]);
        
               
                $inspiration = Inspiraton::findOrFail($id);
                $inspiration->update([
                    'head' => $request->head,
                    'sort_dec' => $request->sort_dec,
                    'heading_tag' => $request->heading_tag,
                    'mvg' => $request->mvg,
                    
                    
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
            $inspiration = Inspiraton::findOrFail($id);
            $inspiration->delete();
            
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

    public function index(){
        $inspiration =Inspiraton::latest()->get();
        return $inspiration;

    }


//img
//     function fileUploadLocal($file, $path, $old_file = null)
// {
//     try {
//         if (!file_exists(public_path($path))) {
//             mkdir(public_path($path), 0777, true);
//         }
//         $file_name = time() . '_' . randomNumber(16) . '_' . $file->getClientOriginalName();
//         $destinationPath = public_path($path);

//         $file_name = str_replace(' ','_',$file_name);
//         # old file delete
//          if ($old_file) {
//             removeFileLocal($path, $old_file);
//       }
//         # resize image
//         if (filesize($file) / 1024 > 2048) {

//          enable extension=gd2
//        $file->orientate(); //so that the photo does not rotate automatically

//            Image::make($file)->orientate()->save($destinationPath . $file_name, 60);
//           quality = 60 low, 75 medium, 80 original
//        } else {
//             #original image upload
//              $file->move($destinationPath, $file_name);
//          }

//         $file->move($destinationPath, $file_name);

//         return $file_name;
//     } catch (Exception $e) {
//         return null;
//     }
// }

}
