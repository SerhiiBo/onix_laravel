<?php

namespace App\Models;

use App\Events\UserCreating;
use App\Listeners\FullNameFromFirstLastNameCreatedUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Event;
use Laravel\Sanctum\HasApiTokens;
use \Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->full_name = "$user->first_name $user->last_name";
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'first_name',
        'last_name',
        'full_name',
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

    public function scopeEmail(Builder $query, $email)
    {
        return $query->where('email', 'ILIKE', "$email%");
    }

    public function scopeBetweenDates(Builder $query, $startDate, $endDate)
    {
        if ($startDate && $endDate) {
            return $query->whereBetween('created_at', [$startDate, $endDate]);
        }
    }

    public function scopeSortByTop(Builder $query)
    {
            return $query->withCount('posts')->orderBy('posts_count', 'DESC');
    }

    public function scopeTrueAuthor(Builder $query, $authors)
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
