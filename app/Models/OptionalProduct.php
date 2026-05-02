<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionalProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'uploadproduct_id',
        'optional_picture1',
        'optional_picture2',
        'optional_picture3',
        'optional_picture4',
    ];

    /**
     * Relationship with UploadProduct model
     */
    public function uploadProduct()
    {
        return $this->belongsTo(UploadProduct::class, 'uploadproduct_id', 'id');
    }
}
