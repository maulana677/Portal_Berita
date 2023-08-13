<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bahasa = new Language();
        $bahasa->name = 'English';
        $bahasa->lang = 'en';
        $bahasa->slug = 'en';
        $bahasa->default = 1;
        $bahasa->status = 1;
        $bahasa->save();
    }
}
