<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

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
        'image',
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
        'password' => 'hashed',
    ];

    public function getUsers(string $search = ''){
            // $users = User::where('name', 'LIKE', "%{$request->search}%")->toSQL();
            // dd($users);
            // $users = User::where('name', 'LIKE', "%{$request->search}%")->get();

            $users = $this->where(function ($query) use ($search){
                $query->where('name', 'LIKE', "%{$search}%");
                $query->orWhere('email',"{$search}");
            })
            ->with(['comments'])
            ->paginate(1);
            
            return $users;
    }

    public function comments(){
        return $this->hasMany(Comment::class, 'user_id', 'id');
    }
}
