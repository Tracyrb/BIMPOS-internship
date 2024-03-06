<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['category_name', 'description', 'menu_id', 'admin_id'];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }

    public function admin(){
        return $this->belongsTo(User::class,'admin_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
