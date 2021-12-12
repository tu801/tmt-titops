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

    /**
     * get images slide data
     * @return mixed
     */
    public function getSlideAttribute() {

        $imgData = ProductImage::select('id', 'user_init', 'product_id', 'name')
                ->where('product_id', $this->id)->get();
        return $this->attributes['slide'] = $imgData;
    }

    public function getImagesAttribute() {
        if ( $this->attributes['images'] == null || empty($this->attributes['images']) ) {
            $imgData = ProductImage::select('id', 'user_init', 'product_id', 'name')
            ->where('product_id', $this->id)->first();
            return $this->attributes['images'] = $imgData->name;
        } else return $this->attributes['images'];
    }
}
