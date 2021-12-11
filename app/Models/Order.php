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
    public function getItemsAttribute() {
        $items = OrderItem::select(['product_id', 'order_item.price', 'quantity', 'name'])
                ->join('product', 'product.id', '=', 'order_item.product_id')
                ->where('order_id', $this->id)->get();

        foreach ($items as $item) {
            $img = ProductImage::where('product_id', $item->product_id)->first();
            $item->image = $img->name;
        }
        return $this->attributes['items'] = $items;
    }

}
