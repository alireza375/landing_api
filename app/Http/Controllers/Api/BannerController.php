<?php

namespace App\Http\Controllers\Api;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class BannerController extends Controller
{
    function index(){
        $banners = Banner::all();
        return $banners;
    }

    //Store Banner
    public function BannerStore(Request $request){
        $request->validate([
            // 'navber' => 'required',
            'logo' => 'required',
            'head_tag' => 'required',
            'sort_paragraph' => 'required',
            'image' => 'required',
        ]);

        $imageArray = [];
        if($request->hasFile("image")){
            $images = $request->file("image");
            foreach($images as $image){
                $imageName = 'post_image_'.md5(('uniqid')). time() .".". $image->getClientOriginalExtension();
               $image->move(public_path("images"), $imageName);
               $imageArray[] = $imageName;
                }
           }

        $logoName = null;
        if($request->hasFile("logo")){
            $logo = $request->file("logo");
            $logoName = 'post_image_'.md5(('uniqid')). time() .".". $logo->getClientOriginalExtension();
            $logo->move(public_path("logos"), $logoName);
           }

        $data = Banner::create([
                "navber" => $request->navber,
                "logo" => $logoName,
                "head_tag"=> $request->head_tag,
                "sort_paragraph"=> $request->sort_paragraph,
                "image" => $imageArray,
            ]);
           return response()->json([
            'status' => 'success',
            'message' => 'Banner Create Successfully',
            'data' => $data,
        ]);
    }



    // public function BannerUpdate(Request $request){
    //     // return "Data Update";
    //     $banner = Banner::findorFail($request->id);

    //     $oldImages = $banner->images ?? [];

    //     // Remove old images from the public/images folder
    //     foreach ($oldImages as $oldImage) {
    //         $oldImagePath = public_path("images/{$oldImage}");
    //         if (File::exists($oldImagePath)) {
    //             File::delete($oldImagePath);
    //         }
    //     }


    //     $banner->update($request->all());
    //     // dd($banner);
    //     $response = [
    //         'success' => true,
    //         'message' => 'Banner Update Successfuly', $banner

    //     ];
    //     return response()->json($response, 200);
    // }

    public function BannerUpdate(Request $request, $id){

        $banner = Banner::findOrFail($id);

        $request->validate([
            // 'navber' => 'required',
            'logo' => 'required',
            'head_tag' => 'required',
            'sort_paragraph' => 'required',
            'image.*' => 'required',
        ]);

        // Get the old image names
        $oldImages = $banner->image ?? [];

        // Ensure $oldImages is always an array
        $oldImages = is_array($oldImages) ? $oldImages : [$oldImages];

        // Remove old images from the public/images folder
        foreach ($oldImages as $oldImage) {
            // Ensure $oldImage is a string
            if (is_string($oldImage)) {
                $oldImagePath = public_path("images/{$oldImage}");
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }
        }

        $imageArray = [];
        if ($request->hasFile("image")) {
            $images = $request->file("image");
            foreach ($images as $image) {
                $imageName = 'post_image_' . md5(uniqid()) . time() . "." . $image->getClientOriginalExtension();
                $image->move(public_path("images"), $imageName);
                $imageArray[] = $imageName;
            }
        }

        $logoName = null;
        if ($request->hasFile("logo")) {
            $logo = $request->file("logo");
            $logoName = 'post_image_' . md5(uniqid()) . time() . "." . $logo->getClientOriginalExtension();
            $logo->move(public_path("logos"), $logoName);
        }

        // Update the banner's fields with the new data
        $banner->update([
            "navber" => $request->navber,
            "logo" => $logoName,
            "head_tag" => $request->head_tag,
            "sort_paragraph" => $request->sort_paragraph,
            "image" => $imageArray,
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Banner Update Successfully',$banner

        ]);
        // Redirect or return a response


    }


    // Banner Delete
    public function BannerDestroy(Request $request){
        // return "Banner Delete Successfully";
        $banner = Banner::findOrFail($request->id);
        if($banner){
            $banner->delete();
            $response = [
                'success' => true,
                'message' => 'Banner Delete Successfuly'
            ];
        }else{
            $response = [
                'success' => true,
                'message' => 'Banner Delete Successfuly'
            ];
        }
        return response()->json($response, 200);
    }

}
