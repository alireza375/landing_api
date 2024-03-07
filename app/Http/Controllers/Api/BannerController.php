<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    //Store Banner
    public function BannerStore(Request $request){
        // return "Banner Create Successfully";
        $request->validate([
            // 'navber' => 'required',
            'logo' => 'required',
            'head_tag' => 'required',
            'sort_paragraph' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = null;
        if($request->hasFile("image")){
            $image = $request->file("image");
            $imageName = 'post_image_'.md5(('uniqid')). time() .".". $image->getClientOriginalExtension();
            $image->move(public_path("images"), $imageName);
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
                "image" => $imageName,
            ]);
           return response()->json([
            'status' => 'success',
            'message' => 'Banner Create Successfully',
            'data' => $data,
        ]);
    }


    // Update Banner
    public function BannerUpdate(Request $request){
        $banner = Banner::findorFail($request->id);
        $banner->update($request->all());
        // dd($banner);
        $response = [
            'success' => true,
            'message' => 'Banner Update Successfuly'

        ];
        return response()->json($response, 200);
    }


    // Banner Delete
    public function DeleteBanner(Request $request){
        $banner = Banner::findOrFail($request->id);

        if($banner){
            $banner->delete();
            $response = [
                'success' => true,
                'message' => 'Banner Delete Successfuly'
            ];
        }else{
            $response = [
                'success' => false,
                'message' => 'Banner Not Found'
            ];
        }
        return response()->json($response, 200);
    }

}
