<?php

namespace Modules\CRM\Entities;

use App\BaseModel;

class Contact extends BaseModel
{
    public $imported = true;
    protected $fillable = ['contact_type', 'data', 'client_id'];


    public function contactinfo()
    {
        return $this->hasMany('Modules\CRM\Entities\ContactInfo');
    }
}
