<?php

use Illuminate\Database\Seeder;

class BaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      /*  $users = [[
            'id' => '381727964380659713',
            'email' => 'simon.proud@ro.ru',
            'password' => bcrypt('13qeadzc'),
        ]];

        DB::table('users')->insert($users);*/


        $userFields = [
            [
                'code' => 'FIRST_NAME',
                'require' => 1,
                'type' => 'text',
                'permission' => 'NONE',
                'description' => 'description.user_fields.FIRST_NAME',
                'active' => 1,
                'f_order' => 10,
            ],[
                'code' => 'SECOND_NAME',
                'require' => 1,
                'type' => 'text',
                'permission' => 'NONE',
                'description' => 'description.user_fields.SECOND_NAME',
                'active' => 1,
                'f_order' => 20,
            ],[
                'code' => 'THIRD_NAME',
                'require' => 1,
                'type' => 'text',
                'permission' => 'NONE',
                'description' => 'description.user_fields.THIRD_NAME',
                'active' => 1,
                'f_order' => 30,
            ],[
                'code' => 'PERSONAL_PHONE',
                'require' => 1,
                'type' => 'tel',
                'permission' => 'NONE',
                'description' => 'description.user_fields.PERSONAL_PHONE',
                'active' => 1,
                'f_order' => 40,
            ],[
                'code' => 'CONTACT_PHONE',
                'require' => 0,
                'type' => 'tel',
                'permission' => 'NONE',
                'description' => 'description.user_fields.CONTACT_PHONE',
                'active' => 1,
                'f_order' => 50,
            ],[
                'code' => 'SKYPE',
                'require' => 0,
                'type' => 'text',
                'permission' => 'NONE',
                'description' => 'description.user_fields.SKYPE',
                'active' => 1,
                'f_order' => 60,
            ],[
                'code' => 'EMAIL',
                'require' => 1,
                'type' => 'email',
                'permission' => 'NONE',
                'description' => 'description.user_fields.EMAIL',
                'active' => 1,
                'f_order' => 70,
            ],[
                'code' => 'AVATAR',
                'require' => 0,
                'type' => 'file',
                'permission' => 'NONE',
                'description' => 'description.user_fields.AVATAR',
                'active' => 1,
                'f_order' => 80,
            ],[
                'code' => 'SNILS',
                'require' => 0,
                'type' => 'file',
                'permission' => 'NONE',
                'description' => 'description.user_fields.SNILS',
                'active' => 1,
                'f_order' => 90,
            ],[
                'code' => 'INN',
                'require' => 0,
                'type' => 'file',
                'permission' => 'NONE',
                'description' => 'description.user_fields.INN',
                'active' => 1,
                'f_order' => 100,
            ],[
                'code' => 'PASPORT',
                'require' => 0,
                'type' => 'file',
                'permission' => 'NONE',
                'description' => 'description.user_fields.PASPORT',
                'active' => 1,
                'f_order' => 110,
            ],[
                'code' => 'REGLAMENT',
                'require' => 0,
                'type' => 'file',
                'permission' => 'NONE',
                'description' => 'description.user_fields.REGLAMENT',
                'active' => 1,
                'f_order' => 120,
            ],[
                'code' => 'DOGOVOR',
                'require' => 0,
                'type' => 'file',
                'permission' => 'NONE',
                'description' => 'description.user_fields.DOGOVOR',
                'active' => 1,
                'f_order' => 130,
            ],[
                'code' => 'VIDEOREPORT',
                'require' => 0,
                'type' => 'file',
                'permission' => 'NONE',
                'description' => 'description.user_fields.VIDEOREPORT',
                'active' => 1,
                'f_order' => 140,
            ],[
                'code' => 'VK',
                'require' => 0,
                'type' => 'text',
                'permission' => 'NONE',
                'description' => 'description.user_fields.VK',
                'active' => 1,
                'f_order' => 150,
            ],[
                'code' => 'INSTAGRAM',
                'require' => 0,
                'type' => 'text',
                'permission' => 'NONE',
                'description' => 'description.user_fields.INSTAGRAM',
                'active' => 1,
                'f_order' => 160,
            ],[
                'code' => 'CONFIDY',
                'require' => 0,
                'type' => 'file',
                'permission' => 'NONE',
                'description' => 'description.user_fields.CONFIDY',
                'active' => 1,
                'f_order' => 170,
            ],[
                'code' => 'WORKING_POSITION',
                'require' => 1,
                'type' => 'text',
                'permission' => 'NONE',
                'description' => 'description.user_fields.WORKING_POSITION',
                'active' => 1,
                'f_order' => 170,
            ]
        ];
        DB::table('user_fields')->insert($userFields);
    }
}
