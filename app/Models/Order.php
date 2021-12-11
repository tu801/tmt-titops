<?php
/**
 * @author tmtuan
 * created Date: 12/11/2021
 * project: titops
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_init', 'code', 'total', 'status'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    /**
     * get images slide data
     * @return mixed
     */
    public function getSlideAttribute() {

        $imgData = ProductImage::select('id', 'user_init', 'product_id', 'name')
                ->where('product_id', $this->id)->get();
        return $this->attributes['slide'] = $imgData;
    }
    
}
