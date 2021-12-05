<?php
/**
 * @author tmtuan
 * created Date: 12/4/2021
 * project: titops
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'price', 'brand_id', 'description', 'images'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function BrandInfo()
    {
        return $this->belongsTo(ProductBrand::class,'brand_id','id');
    }

}
