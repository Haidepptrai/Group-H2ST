<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $primaryKey = 'proid';
    public $timestamps = false;
    public function category()
    {
        return $this->belongsTo(Category::class, 'catid', 'catid');
    }
    public function feedbacks()
    {
        return $this->hasMany(Productfeedback::class);
    }

}
