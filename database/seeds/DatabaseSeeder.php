<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call(UserTableSeeder::class);
        
            DB::table('users')->insert([
                'nama_lengkap' => str_random(10),
                'username' => 'admin',
                'password' => bcrypt('admin'),
                'status'=> 3,
                'alamat'=> str_random(100)
                ]);
        

        Model::reguard();

    }
}
