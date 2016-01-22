<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->truncate();
    	factory(App\User::class)->create([
       		'name' => 'Domingo',
       		'email' => 'dilarreta@tecnotropolisla.com',
       		'role' => 'admin',
       		'password' => bcrypt('1234567890')

       	]);
       factory(App\User::class,49)->create();

       /**/
    }
}
