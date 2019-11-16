<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Message;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Storage;


$factory->define(Message::class, function (Faker $faker) {
    $imgs = [null, 'item_1.jpg', 'item_2.jpg', 'item_3.jpg'];
    $img  = $imgs[rand(0, 3)];
    return [
        Message::ATTR_TEXT      => $faker->text(1000),
        Message::ATTR_IMG       => null === $img ? "" : url('storage/img/' . $img),
        Message::ATTR_PARENT_ID => null,
    ];
});
