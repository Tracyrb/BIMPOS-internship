<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $primaryKey = 'menu_id, admin_id';
    protected $table = 'menus';
    protected $fillable = ['name', 'description', 'admin_id'];

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function admin(){
        return $this->belongsTo(User::class,'admin_id');
    }
}
