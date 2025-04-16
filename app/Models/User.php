<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use function Pest\Laravel\post;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    protected $fillable = [
        'name',
        'email',
        'password',
        'user_name',
        'slug'
    ];

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->is_admin === true;
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean'
        ];
    }

    public function posts():HasMany{
        return $this->hasMany(Post::class,'author_id');
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
}
