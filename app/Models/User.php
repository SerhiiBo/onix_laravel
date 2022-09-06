<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use \Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeEmail($query, $email)
    {
        return $query->where('email', 'ILIKE', "$email%");
    }

    public function scopeBetweenDates($query, $startDate, $endDate)
    {
        if ($startDate && $endDate) {
            return $query->whereBetween('created_at', [$startDate, $endDate]);
        }
    }

    public function scopeSortByTop($query, $sortBy)
    {
        if ($sortBy === 'top') {
            return $query->withCount('posts')->orderBy('posts_count', 'DESC');
        }
    }

    public function scopeTrueAuthor($query, $authors)
    {
        if ($authors === 'true') {
            return $query->withCount('posts')->has('posts', '>', 0);
        }
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
