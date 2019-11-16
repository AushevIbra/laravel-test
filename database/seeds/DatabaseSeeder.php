<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $from = database_path('seeds' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR);
        $to   = storage_path('app\public\img' . DIRECTORY_SEPARATOR);

        if (false === file_exists(storage_path('app\public\img'))) {
            mkdir(storage_path('app\public\img'));
        }


        File::copy($from . 'item_1.jpg', $to . 'item_1.jpg');
        File::copy($from . 'item_2.jpg', $to . 'item_2.jpg');
        File::copy($from . 'item_3.jpg', $to . 'item_3.jpg');

        factory(App\User::class, 5)->create()->each(function (\App\User $user) {
            $user->messages()->saveMany(factory(\App\Models\Message::class, 3)->make());
        });

    }
}
