<?php

namespace App\Http\Controllers;

use App\Helpers\AttachmentHelper;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    use AuthorizesRequests;
    public function store(Request $request){
        $post = new Post;
        
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('post','public');
            $post->image = $path;
        }


        $post->title = $request->name;
        $post->author_id = Auth::id();

        $slug = Str::of($post->title)->slug('-');
        $post->slug = $slug;

        $post->body = $request->body;
        

        $slugCategory = Str::of($request->category)->slug('-');
        $category = Category::firstOrCreate(['name' => $request->category,
                                                'slug' => $slugCategory]);
        $categoryId =  $category->id;
        $post->category_id = $categoryId;
 
        $post->save();
        return redirect()->route('dashboard');
    }

    public function update(Request $request){
        
        $post = Post::find($request->id);
        $this->authorize('access_post', $post);  

        // Cleanup attachment lama yang tidak dipakai
        AttachmentHelper::deleteUnusedAttachments($post->body, $request->body);

        if ($request->hasFile('image')) {
            if($post->image){
                Storage::disk('public')->delete($post->image);
            }
            $path = $request->file('image')->store('post','public');
            $post->image = $path;
        }
        $post->title = $request->name;

        $post->body = $request->body;

        $slug = Str::of($post->title)->slug('-');
        $post->slug = $slug;

        $slugCategory = Str::of($request->category)->slug('-');
        $category = Category::updateOrCreate(['name' => $request->category,
                                                'slug' => $slugCategory]);
        $categoryId =  $category->id;
        $post->category_id = $categoryId;
        $post->save();
        return redirect()->route('dashboard');
    }

    public function delete(Request $request){

        $post = Post::find($request->id);

        // Hapus semua attachment dari body
        AttachmentHelper::deleteAllAttachments($post->body);

        if($post->image){
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return back();

    }

    public function viewUpdate(Post $post){  
        $this->authorize('access_post', $post);  
        return view('create-article', ['title' => 'Edit Article', 'post' => $post, 'header_title' => 'Edit Article']);
    }
}
