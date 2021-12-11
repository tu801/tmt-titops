<?php
/**
 * @author tmtuan
 * created Date: 12/11/2021
 * project: titops
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'product_images';
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'user_init', 'product_id'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

}
