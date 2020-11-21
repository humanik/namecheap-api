<?php

namespace Humanik\Namecheap\API\Endpoints;

use Humanik\Namecheap\API\Response;

class Domains extends AbstractEndpoint
{
    public function getList(array $params = []): Response
    {
        return $this->createResponse(
            $this->command('domains.getList', $params),
            function (array $response): array {
                return $response['DomainGetListResult']['Domain'];
            },
        );
    }

    public function create(array $params = []): Response
    {
        return $this->createResponse(
            $this->command('domains.create', $params),
            function (array $response): array {
                return $response['DomainCreateResult'];
            },
        );
    }
}
