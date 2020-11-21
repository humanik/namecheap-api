<?php

namespace Humanik\Namecheap\API\Endpoints;

use Humanik\Namecheap\API\Response;

class Users extends AbstractEndpoint
{
    public function getBalances(): Response
    {
        return $this->createResponse(
            $this->command('users.getBalances'),
            function (array $response): array {
                return $response['UserGetBalancesResult'];
            },
        );
    }

    public function getPricing(string $productType = 'DOMAIN', array $params = []): Response
    {
        return $this->createResponse(
            $this->command('users.getPricing', $params + ['ProductType' => $productType]),
            function (array $response): array {
                return $response['UserGetPricingResult']['ProductType'];
            },
        );
    }
}
