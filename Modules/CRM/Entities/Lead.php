<?php

namespace Modules\CRM\Entities;

use App\BaseModel;

class Lead extends BaseModel
{
    public $imported = true;
    protected $fillable = ['name', 'source', 'description'];


    public function leadinfo()
    {
        return $this->hasMany('Modules\CRM\Entities\LeadInfo');
    }

}
