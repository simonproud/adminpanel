<?php
/**
 * Created by PhpStorm.
 * User: home
 * Date: 11.09.18
 * Time: 18:48
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{

    public  $imported = false;

    public static function getTableName()
    {
        return with(new static)->getTable();
    }


}