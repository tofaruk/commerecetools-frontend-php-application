<?php

namespace App\Core;

use App\Core\Request;

abstract class BaseController
{
    private $model = null;

    /**
     * @param array $params
     * @param \App\Core\Request $request
     * @return mixed
     */
    abstract public function indexAction(Request $request, $params = []);
}
