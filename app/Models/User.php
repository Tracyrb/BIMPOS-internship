<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'email', 'password', 'user_id', 'admin_id'
    ];
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function hasRole()
    {
        dd("here");
        return $this->user_id === $this->admin_id ? 'admin' : 'user';
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'stocks')
            ->withPivot('quantity');
    }

    public function stocks(): BelongsToMany
    {
        return $this->belongsToMany(Stock::class, 'stocks')
            ->withPivot('quantity_in_stock');
    }

    public function menus()
    {
        return $this->hasMany(Menu::class, 'admin_id');
    }

    public function categories()
    {
        return $this->hasMany(Category::class, 'admin_id');
    }   

    public function adminProducts()
    {
        return $this->hasMany(Product::class, 'admin_id');
    }   

    public function adminStocks()
    {
        return $this->hasMany(Stock::class, 'admin_id');
    } 
}
