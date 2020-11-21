<?php

namespace Humanik\Namecheap\API\Endpoints;

use Humanik\Namecheap\API\Response;

class DomainsDns extends AbstractEndpoint
{
    public function setCustom(string $domain, array $nameservers): Response
    {
        $params = ['Nameservers' => implode(',', $nameservers)] + $this->domainToParams($domain);

        return $this->createResponse(
            $this->command('domains.dns.setCustom', $params),
            function (array $response): array {
                return $response['DomainDNSSetCustomResult'];
            }
        );
    }
}
