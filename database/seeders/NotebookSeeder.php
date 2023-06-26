<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotebookSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		DB::table('notebooks')->insert([
			['name' => 'Notes', 'notebook_category_id' => 1],
			['name' => 'Quick Notes', 'notebook_category_id' => 5],
		]);
	}
}
