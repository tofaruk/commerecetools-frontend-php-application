<?php

namespace App\Services;

use Commercetools\Api\Client\ApiRequestBuilder;
use Commercetools\Api\Client\ClientCredentialsConfig;
use Commercetools\Api\Client\Config;
use Commercetools\Client\ClientCredentials;
use Commercetools\Client\ClientFactory;
use Commercetools\Api\Client\Resource\ResourceByProjectKey;
use GuzzleHttp\ClientInterface;

class CommercetoolsService
{
    /**
     * @return \Commercetools\Api\Client\Resource\ResourceByProjectKey
     * @throws \Commercetools\Exception\InvalidArgumentException
     */
    function createApiClient(): ResourceByProjectKey
    {
        /** @var string $clientId */
        /** @var string $clientSecret */
        $authConfig = new ClientCredentialsConfig(
            new ClientCredentials(CTP_CLIENT_ID, CTP_CLIENT_SECRET),
            [],
            CTP_AUTH_URL.'/oauth/token'
        );

        $client = ClientFactory::of()->createGuzzleClient(
            new Config([], CTP_API_URL),
            $authConfig
        );

        /** @var ClientInterface $client */
        $builder = new ApiRequestBuilder($client);

        // Include the Project key with the returned Client
        return $builder->withProjectKey(CTP_PROJECT_KEY);
    }
}
