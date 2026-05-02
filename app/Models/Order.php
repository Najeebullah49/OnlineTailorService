<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Table name (optional if it matches Laravel's conventions)
    protected $table = 'orders';

    // Primary key (optional if it's 'id')
    protected $primaryKey = 'id';

    // Enable auto-increment for the primary key (default behavior)
    public $incrementing = true;

    // Primary key type
    protected $keyType = 'int';

    // Specify the fillable fields for mass assignment
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'address',
        'city',
        'country',
        'payment_method',
        'total_price',  // Add total_price to fillable
        'status',        // Add status to fillable
        'productsize', 
    ];

    // Set default values for total_price and status before creating
    protected static function booted()
    {
        static::creating(function ($order) {
            // Set default values if they are not provided
            $order->total_price = $order->total_price ?? 0;  // Set total_price to 0 if not provided
            $order->status = $order->status ?? 'pending';    // Set status to 'pending' if not provided
        });
    }

    // Relationship with OrderItem
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id'); // 'order_id' is the foreign key in order_items table
    }
    

    // In Order Model
public function user()
{
    return $this->belongsTo(User::class, 'user_id', 'id');  // user_id is the foreign key, id is the primary key in users table
}

}
