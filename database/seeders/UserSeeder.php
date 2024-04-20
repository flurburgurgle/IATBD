<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name'=>'admin',
            'email'=>'admin@admin.admin',
            'password'=>bcrypt('2002872'),
            'isAdmin'=>1,],
            ['name'=>'banVictim',
            'email'=>'banVictim@banVictim.banVictim',
            'password'=>bcrypt('2002872'),
            'isAdmin'=>0,]
        ];
        DB::table('users')->insert($data);
    }
}
