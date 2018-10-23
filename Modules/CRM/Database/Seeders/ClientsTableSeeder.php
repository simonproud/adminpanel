<?php

namespace Modules\CRM\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use DB;
class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        DB::table('clients')->insert([
            'first_name' => 'Client '.str_random(4),
            'second_name' => 'Client '.str_random(4),
            'third_name' => 'Client '.str_random(4),
            'age' => '18',
            'description' => 'TestClient',
        ]);
        // $this->call("OthersTableSeeder");
    }
}
