<?php
namespace App;

use Spatie\Permission\Models\Role as RoleSp;


class Role extends RoleSp {
    public static function findByName( $name, $guardName = null)
    {
        $guardName = $guardName ?? Guard::getDefaultName(static::class);

        if($name){}
        $role = static::where('name', $name)->where('guard_name', $guardName)->first();

        if (! $role) {
            throw RoleDoesNotExist::named($name);
        }

        return $role;
    }
}