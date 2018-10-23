<?php

namespace Modules\CRM\Entities;

use App\BaseModel;

class Order extends BaseModel
{
    public $imported = true;
    protected $fillable = ['name', 'cost', 'currency', 'description'];

    public function orderinfo()
    {
        return $this->hasMany('Modules\CRM\Entities\OrderInfo');
    }
}
