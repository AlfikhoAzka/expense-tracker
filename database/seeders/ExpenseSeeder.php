<?php

namespace Database\Seeders;

use App\Models\Expense;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('expenses')->insert([
            'nama' => Str::random(10),
            'harga' => str::random(10),
        ]);
    }
}
