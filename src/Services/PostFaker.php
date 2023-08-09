<?php

namespace App\Services;

use Faker\Factory as FakerFactory;

class PostFaker
{
    // TODO delete
    protected $faker = null;

    public function __construct()
    {
        $this->faker = FakerFactory::create();
    }

    public function getPost($total = 1)
    {
        $data = [];
        for ($i = 0; $i < $total; $i++) {
            $post = [];
            $post['title'] = $this->faker->realText(50);
            $post['content'] = $this->faker->text;
            $post['created'] =  $this->faker->dateTimeThisDecade->format("Y-m-d H:i:s");
            $data[] = $post;
        }
        return $data;
    }
}
