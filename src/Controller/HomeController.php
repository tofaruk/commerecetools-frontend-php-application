<?php

namespace App\Controller;

use App\Core\BaseController;
use App\Core\Request;
use App\Core\View;

class HomeController extends BaseController
{
    public function indexAction(Request $request, $prams = [])
    {
        return View::render();
    }
}
