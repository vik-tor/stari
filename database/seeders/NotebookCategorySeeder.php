<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotebookCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('notebook_categories')->insert([
            ['name' => 'Personal journal', 'icon' => 'journal', 'settings' => '{"color": "blue", "sort":"created_at"}'],
            ['name' => 'Code journal', 'icon' => 'journal-code', 'settings' => '{"color": "orange", "sort":"updated_at"}'],
            ['name' => 'Medical journal', 'icon' => 'journal-medical', 'settings' => '{"color": "magenta", "sort":"created_at"}'],
            ['name' => 'Notes', 'icon' => 'journal-text', 'settings' => '{"color": "green", "sort":"updated_at"}'],
            ['name' => 'Quick notes', 'icon' => 'stickies', 'settings' => '{"color": "green", "sort":"updated_at"}'],
            ['name' => 'Recipes', 'icon' => 'journal-richtext', 'settings' => '{"color": "yellow", "sort":"updated_at"}'],
            ['name' => 'Snippets', 'icon' => 'journal-album', 'settings' => '{"color": "red", "sort":"updated_at"}'],
            ['name' => 'List', 'icon' => 'journal-check', 'settings' => '{"color": "red", "sort":"updated_at"}'],
        ]);
    }
}
