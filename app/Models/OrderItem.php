<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    // Table name (optional if it matches Laravel's conventions)
    protected $table = 'order_items';

    // Primary key (optional if it's 'id')
    protected $primaryKey = 'id';

    // Enable auto-increment for the primary key (default behavior)
    public $incrementing = true;

    // Primary key type
    protected $keyType = 'int';

    // Specify the fillable fields for mass assignment
    protected $fillable = [
        'order_id',
        'product_name',
        'product_price',
        'quantity',
        'product_image', // Optional, depending on your requirements
    ];

    // Define the relationship with the Order model
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id'); // 'order_id' links to 'id' in orders table
    }
}
