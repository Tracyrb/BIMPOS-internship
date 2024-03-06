<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['name', 'price', 'category_id', 'admin_id'];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_product')
            ->withPivot('quantity');
    }

    public function admin(){
        return $this->belongsTo(User::class,'admin_id');
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }

}
