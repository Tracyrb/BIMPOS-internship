<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = 'stocks';
    protected $fillable = ['user_id', 'product_id', 'quantity', 'admin_id'];
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function admin(){
        return $this->belongsTo(User::class,'admin_id');
    }
    public function product() {
        return $this->belongsTo(Product::class);
    }
}
