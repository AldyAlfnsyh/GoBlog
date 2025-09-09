<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AttachmentController extends Controller
{
    public function store(Request $request){
        if($request->hasFile('file')){
            $path = $request->file('file')->store('attachments', 'public');
            return response()->json([
                'url' => asset('storage/'. $path)
            ], 200);
        }

        return response()->json(['error' => 'No file upload'], 400);
    }
}
