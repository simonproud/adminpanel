<?php

namespace Modules\CRM\Entities;

use Illuminate\Database\Eloquent\Model;

class ClientInfo extends Model
{
    protected $fillable = ['key', 'value'];
    protected $table = 'clients_info';

    public function client()
    {
        return $this->belongsTo('Modules\CRM\Entities\Client');
    }
}
