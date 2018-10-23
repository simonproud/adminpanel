<?php

namespace Modules\CRM\Entities;

use Illuminate\Database\Eloquent\Model;

class ContactInfo extends Model
{
    protected $fillable = ['key', 'value'];
    protected $table = 'contacts_info';

    public function lead()
    {
        return $this->belongsTo('Modules\CRM\Entities\Contact');
    }
}
