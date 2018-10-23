<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PermissionIndexesOther extends Migration
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
           
			$table->foreign('permission_id')
                ->references('id')
                ->on($tableNames['permissions'])
                ->onDelete('cascade');

          
        });
		
		
		 Schema::table($tableNames['model_has_roles'], function (Blueprint $table) use ($tableNames, $columnNames) {
          	
	
				 $table->foreign('role_id')
                ->references('id')
                ->on($tableNames['roles'])
                ->onDelete('cascade');
          
           
        });
		
		Schema::table($tableNames['role_has_permissions'], function (Blueprint $table) use ($tableNames) {
             
			$table->foreign('permission_id')
                ->references('id')
                ->on($tableNames['permissions'])
                ->onDelete('cascade');

            $table->foreign('role_id')
                ->references('id')
                ->on($tableNames['roles'])
                ->onDelete('cascade');
            
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
