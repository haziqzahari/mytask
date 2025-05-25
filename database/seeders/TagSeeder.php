<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{

    const TAGS = [
        'Project',
        'Technical',
        'Mobile App'
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect($this::TAGS)->each(function($tags){
            $tag = new Tag();

            $tag->name = $tags;
            $tag->save();
        });
    }
}
