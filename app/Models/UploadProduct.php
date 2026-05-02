<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'dicription',
        'picture',
        'category',
    ];


    public function optionalProducts()
    {
        return $this->hasMany(OptionalProduct::class, 'uploadproduct_id', 'id');
    }
}
