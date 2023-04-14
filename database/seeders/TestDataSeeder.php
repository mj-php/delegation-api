<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $timestamp = Carbon::createFromFormat('Y-m-d H:i:s', '2023-02-18 10:22:11');

        DB::table('workers')->insert([
            'id' => 1,
            'updated_at' => $timestamp,
            'created_at' => $timestamp,
        ]);

        DB::table('workers')->insert([
            'id' => 2,
            'updated_at' => $timestamp,
            'created_at' => $timestamp,
        ]);

        DB::table('countries')->insert([
            'name' => 'Poland',
            'code' => 'PL',
            'stake' => 10,
            'updated_at' => $timestamp,
            'created_at' => $timestamp,
        ]);

        DB::table('countries')->insert([
            'name' => 'Germany',
            'code' => 'DE',
            'stake' => 50,
            'updated_at' => $timestamp,
            'created_at' => $timestamp,
        ]);

        DB::table('countries')->insert([
            'name' => 'Great Britain',
            'code' => 'GB',
            'stake' => 75,
            'updated_at' => $timestamp,
            'created_at' => $timestamp,
        ]);

        $start = Carbon::createFromFormat('Y-m-d H:i:s', '2023-02-18 8:00:00');
        $end = Carbon::createFromFormat('Y-m-d H:i:s', '2023-02-25 12:00:00');

        DB::table('delegations')->insert([
            'country_id' => 1,
            'worker_id' => 1,
            'start' => $start,
            'end' => $end,
            'amount_due' => 450.00,
            'updated_at' => $timestamp,
            'created_at' => $timestamp,
        ]);
    }
}
