<?php

namespace App\Services;

use Faker\Factory as FakerFactory;

class CommentFaker
{
    // TODO delete
    protected $faker = null;

    public function __construct()
    {
        $this->faker = FakerFactory::create();
    }

    public function getComment($total = 1, $lastPostId=1)
    {
        $data = [];
        for ($i = 0; $i < $total; $i++) {
            $post = [];
            $post['post_id'] = rand(1,$lastPostId);
            $post['content'] = $this->faker->text;
            $post['created'] =  $this->faker->dateTimeThisMonth->format("Y-m-d H:i:s");
            $data[] = $post;
        }
        return $data;
    }
}
