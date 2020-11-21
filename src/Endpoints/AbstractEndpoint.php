<?php

namespace Humanik\Namecheap\API\Endpoints;

use Humanik\Namecheap\API\Adapter\Adapter;
use Humanik\Namecheap\API\ApiResponse;
use Psr\Http\Message\ResponseInterface;

class AbstractEndpoint
{
    protected Adapter $client;

    public function __construct(Adapter $adapter)
    {
        $this->client = $adapter;
    }

    protected function domainToParams(string $domain): array
    {
        [$SLD, $TLD] = explode('.', $domain);

        return compact('SLD', 'TLD');
    }

    protected function command(string $command, array $params = [], array $headers = []): ResponseInterface
    {
        $params['Command'] = 'namecheap.'.$command;

        return $this->client->get('', $params, $headers);
    }

    protected function createResponse(ResponseInterface $response, callable $parseResult): ApiResponse
    {
        $xml = simplexml_load_string((string)$response->getBody(), 'SimpleXMLElement');
        $json = json_encode($xml);
        $data = json_decode($json, true);
        $data = $this->levelUp($data, '@attributes');
        $result = call_user_func($parseResult, $data['CommandResponse']);

        return new ApiResponse($result, $data);
    }

    protected function levelUp(array $data, string $key): array
    {
        $result = [];
        foreach ($data as $index => $value) {
            if ($index === $key) {
                $result = array_merge($result, $data, $value);
                unset($result[$key]);
            } else {
                if (is_array($value)) {
                    $result[$index] = $this->levelUp($value, $key);
                }
            }
        }

        return $result;
    }
}
