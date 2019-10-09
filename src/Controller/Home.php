<?php

namespace App\Controller;


use App\Core\Template;

class Home extends AbstractController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function indexAction()
    {
        return parent::getView(
            __METHOD__,
            [
                'title'=> ' Home',
                'welcome'=> 'Welcome to Home',
            ]
        );
    }
}