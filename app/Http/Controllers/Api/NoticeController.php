<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Notice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NoticeController extends Controller
{
    //
    public function NoticeIndex(){
        $notices = Notice::get();
         return $notices;
    }

    public function NoticeStore(Request $request)
    {
        $request->validate([
            "head" => "required",
            "date" => "required|date_format:d/m/Y",
            "title" => "required",
        ]);

        $data = Notice::create([
            "head" => $request->head,
            "date" => Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d'),
            "title" => $request->title,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Notice created successfully',
            'data' => $data
        ]);
    }
    public function NoticeUpdate(Request $request){
        $notice = Notice::findorFail($request->id);
        $notice->update($request->all());
        $response = [
            'success' => true,
            'message' => 'Notice Update Successfuly'
        ];
        return response()->json($response, 200);
    }

    public function NoticeDelete(Request $request){
        $notice = Notice::findOrFail($request->id);

        if($notice){
            $notice->delete();
            $response = [
                'success' => true,
                'message' => 'Notice Delete Successfuly'
            ];
        }else{
            $response = [
                'success' => false,
                'message' => 'Notice Not Found'
            ];
        }
        return response()->json($response, 200);
    }

}
