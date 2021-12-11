<?php
/**
 * @author tmtuan
 * created Date: 12/11/2021
 * project: titops
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_item';
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id', 'product_id', 'price', 'quantity'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    
}
