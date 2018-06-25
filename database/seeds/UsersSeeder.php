<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->insert([
        'name' => 'Pete Johnson',
        'email' => 'pete@humbleandkind.co.uk',
        'password' => bcrypt('jackjaz1'),
      ]);
      DB::table('users')->insert([
        'name' => 'TPS',
        'email' => 'josh@thepottingsheddesign.com',
        'password' => bcrypt('TPS123'),
      ]);
      DB::table('users')->insert([
        'name' => 'GTA',
        'email' => 'Adam.Martel@gta.gg',
        'password' => bcrypt('GTA123'),
      ]);
      DB::table('users')->insert([
        'name' => 'Jack',
        'email' => 'jack@humbleandkind.co.uk',
        'password' => bcrypt('Jack1234'),
      ]);
    }
}
