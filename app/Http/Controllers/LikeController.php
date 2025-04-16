<?php

namespace App\Http\Controllers;

use App\Models\likes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{


    public function toggleLikeDislike(Request $request, $postId)
{

    
    $userId = Auth::id();
    $type = $request->input('type'); // 'like' atau 'dislike'
    

    $existingLike = likes::where('user_id', $userId)
                        ->where('post_id', $postId)
                        ->first();
                        // dd($postId, $existingLike);;                             
    if ($existingLike && $existingLike->type == $type) {
            // Jika sudah like/dislike, klik lagi akan menghapusnya (unlike/undislike)
            $existingLike->delete();
    } elseif($existingLike) {
            // Jika user mengubah dari like ke dislike atau sebaliknya
            $existingLike->update(['type' => $type]);
    } elseif(!$existingLike) {
        // Jika user belum pernah like/dislike, maka tambahkan baru
        
        likes::create([
            'user_id' => $userId,
            'post_id' => $postId,
            'type' => $type
        ]);
    }

    return back();
}

}
