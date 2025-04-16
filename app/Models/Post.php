<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title','author','slug','body'];
    protected $with = ['author','category'];
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function likes():HasMany{
        return $this->hasMany(likes::class);
    }
    public function comment():HasMany{
        return $this->hasMany(Comment::class);
    }
    public function reply():HasMany{
        return $this->hasMany(Reply::class);
    }

    public function report():HasMany{
        return $this->hasMany(Report::class);
    }
    // protected $table = 'posts';
    // protected $primaryKey = 'post_id';

    // public static function all(){
    //     return [
    //         [
    //         'id' => 1,
    //         'slug' => 'judul-artikel-1',
    //         'title' => 'Judul Artikel 1',
    //         'author' => 'Aldy Alfiansyah',
    //         'body' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nihil itaque ut odit dolore fugiat laboriosam quos enim aliquid dolor atque, reiciendis praesentium dolorum tempore maxime commodi repellendus provident! Quibusdam, odit!',
    //     ],
    //     [
    //         'id' => 2,
    //         'slug' => 'judul-artikel-2',
    //         'title' => 'Judul Artikel 2',
    //         'author' => 'Mane',
    //         'body' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nihil itaque ut odit dolore fugiat laboriosam quos enim aliquid dolor atque, reiciendis praesentium dolorum tempore maxime commodi repellendus provident! Quibusdam, odit!',
    //     ]
    //     ];
    // }

    // public static function find($slug): array{
    //     $post = Arr::first(static::all(), function($post) use($slug){
    //         return $post['slug'] == $slug;
    //     });

    //     if(!$post){
    //         abort(404);
    //     }

    //     return $post;
    // }
}
