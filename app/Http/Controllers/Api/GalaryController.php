<?php

namespace App\Http\Controllers\Api;

use App\Models\Galary;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GalaryController extends Controller
{
    //
    public function GalaryIndex()
    {
        $galaries = Galary::all();
        return $galaries;
    }
    public function GalaryStore(Request $request)
    {
        $request->validate([
            'head' => 'required',
            'video' => 'required|file|mimes:mp4,avi,flv,mov,wmv',
        ]);
        if ($request->hasFile('video')) {
            $video = $request->file('video');
            $videoPath = $video->storeAs('videos', $video->getClientOriginalName(), 'public');


        $data = Galary::create([
            "head" => $request->head,
            "video" => $videoPath,

        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Galary Store successfully',
            'data' => $data,
        ]);
        }
    }


    public function GalaryUpdate(Request $request, $id)
    {
        $galary = Galary::findOrFail($id);
        $galary->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Galary Update successfully'
        ]);
    }

    public function GalaryDelete(Request $request)
    {
        $galary = Galary::findOrFail($request->id);

        if($galary){
            $galary->delete();
            $response = [
                'success' => true,
                'message' => 'Galary Delete Successfuly'
            ];
        }else{
            $response = [
                'success' => false,
                'message' => 'Galary Not Found'
            ];
        }
        return response()->json($response, 200);
    }
}
