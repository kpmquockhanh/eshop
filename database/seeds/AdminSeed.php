<?php

use Illuminate\Database\Seeder;

class AdminSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Admin::query()->create([
            'name' => 'Khánh',
            'email' => 'kpmquockhanh@gmail.com',
            'password' => bcrypt('quockhanh1'),
            'location' => "Ha Noi",
            'status' => 1,
            'type' => 3,
        ]);
    }
}
