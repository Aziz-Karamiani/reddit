<?php

namespace Database\Seeders;

use App\Models\Topic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Topic::create(["name" => "Programming"]);
        Topic::create(["name" => "UI/UX"]);
        Topic::create(["name" => "Design"]);
        Topic::create(["name" => "DevOps"]);
        Topic::create(["name" => "SEO"]);
    }
}
