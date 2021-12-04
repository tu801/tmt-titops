<?php
/**
 * @author tmtuan
 * created Date: 12/4/2021
 * project: titops
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductBrand extends Model
{
    protected $table = 'product_brand';
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
