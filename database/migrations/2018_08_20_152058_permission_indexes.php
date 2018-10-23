<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PermissionIndexes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableNames = config('permission.table_names');
        $columnNames = config('permission.column_names');
		Schema::table($tableNames['model_has_permissions'], function (Blueprint $table) use ($tableNames, $columnNames) {
           
			$table->index('permission_id');
          
        });
		
		
		 Schema::table($tableNames['model_has_roles'], function (Blueprint $table) use ($tableNames, $columnNames) {
          	
	
				 
			$table->index('role_id');
          
          
           
        });
		
		Schema::table($tableNames['role_has_permissions'], function (Blueprint $table) use ($tableNames) {
             
	
            $table->index('role_id');
            $table->index('permission_id');
            app('cache')->forget('spatie.permission.cache');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
