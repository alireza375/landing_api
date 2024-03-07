<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(){
        $course =Course::latest()->get();
        return $course;

    }

    //create

    public function create(Request $request){
        //dd($request->all());
        try{
            $request->validate([
                "head"=> "required",
                "title"=> "required",
                "shor_dec"=> "required"
                
               
        
               ]) ;
        
               //image store
        
               //post create
                
               Course::create([
                "head"=> $request->head,
                "title"=> $request->title,
                "shor_dec"=> $request->shor_dec
               
               
               ]);
               return response()->json([
                "status"=>"Successfull",
                "Message"=>"Create Successfull"
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
                "title"=> "required",
                "shor_dec"=> "required",
             
               
                ]);
        
               
                $course = Course::findOrFail($id);
                $course->update([
                    'head' => $request->head,
                    'title' => $request->title,
                    'shor_dec' => $request->shor_dec
                    
                    
                    
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
            $course = Course::findOrFail($id);
            $course->delete();
            
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
