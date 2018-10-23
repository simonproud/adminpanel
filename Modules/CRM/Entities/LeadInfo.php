<?php

namespace Modules\CRM\Entities;

use Illuminate\Database\Eloquent\Model;

class LeadInfo extends Model
{
    protected $fillable = ['key', 'value'];
    protected $table = 'leads_info';

    public function lead()
    {
        return $this->belongsTo('Modules\CRM\Entities\Lead');
    }
}
