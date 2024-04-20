<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class categorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name'=>'hammers'],
            ['name'=>'Screwdrivers'],
            ['name'=>'Saws'],
            ['name'=>'Knives'],
            ['name'=>'Drills']
        ];
        DB::table('categories')->insert($data);
    }
}
