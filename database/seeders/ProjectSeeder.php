<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;


class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        // $faker->addProvider(new \Xvladqt\Faker\LoremFlickrProvider($faker));
        for ($i = 0; $i < 10; $i++) {
            $project = new Project();
            $project->title =  ucfirst($faker->words(3, true));
            $project->slug = Str::slug($project->title);
            $project->description = $faker->text();
            $project->creation_date = $faker->date();
            $project->img = 'images/' . 'placeholder.webp';
            $project->type_id = 1;


            $project->save();
        }
    }
}







            //$img = $faker->image(storage_path() . '/app/public/images', 640, 480);
            //$imgUrl = $faker->imageUrl(640, 480);
            //dd($imgUrl);
            //$img = $faker->image('storage/app/public/images', 640, 480);
            //dd($img);
            //dd(storage_path());

            /*$fp = fopen('storage/app/public/images/prova.jpg', 'w');
            $url = "http://via.placeholder.com/640x480.png/CCCCCC?text=well+hi+there";
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_FILE, $fp);
            $success_exec = curl_exec($ch);

            $success_getinfo = curl_getinfo($ch, CURLINFO_HTTP_CODE) === 200;

            dd($success_getinfo);

            fclose($fp);
            curl_close($ch); */