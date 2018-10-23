<?php

namespace Modules\CRM\Entities;

use Illuminate\Database\Eloquent\Model;

class OrderInfo extends Model
{
    protected $fillable = ['key', 'value'];
    protected $table = 'orders_info';

    public function order()
    {
        return $this->belongsTo('Modules\CRM\Entities\Order');
    }
}
