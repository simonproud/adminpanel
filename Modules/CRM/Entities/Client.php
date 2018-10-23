<?php

namespace Modules\CRM\Entities;

use Laravel\Scout\Searchable;
use App\BaseModel;

class Client extends BaseModel
{
    use Searchable;

    public $imported = true;
    protected $fillable = ['first_name', 'second_name', 'third_name', 'age', 'description'];

    public function clientinfo()
    {
        return $this->hasMany('Modules\CRM\Entities\ClientInfo');
    }
}
