<?php

namespace App\Controller;

use App\Core\Request;
use App\Core\View;
use App\Services\CommercetoolsService;
use Commercetools\Api\Models\Product\ProductProjectionCollection;
class CatalogController
{
    public function indexAction(Request $request, $prams = []): string
    {
        // query reference : https://docs.commercetools.com/api/general-concepts#pagedqueryresult
        //TODO make a api call
        // Make a get call to the Project
        $apiRoot = (new CommercetoolsService())->createApiClient();
        $manProducts = $apiRoot->productProjections()->get()
            ->withWhere("categories(id=\"3ff9e378-c5c6-4f52-9286-4805254655fe\")")
            ->execute();


        return View::render(['products' => $manProducts->getResults()]);
    }

    public function productAction(Request $request, $prams = []): string
    {
        $slug = isset($prams['slug']) ? $prams['slug'] : null;

        $apiRoot = (new CommercetoolsService())->createApiClient();
        $product = $apiRoot->products()->withId($slug)->get()->execute();
        return View::render(['product' => $product->getMasterData()->getCurrent()]);
    }
}
