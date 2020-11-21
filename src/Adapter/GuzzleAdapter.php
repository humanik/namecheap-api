<?php

namespace Humanik\Namecheap\API\Adapter;

use GuzzleHttp\Client;
use Humanik\Namecheap\API\Auth\Auth;
use InvalidArgumentException;
use Psr\Http\Message\ResponseInterface;

class GuzzleAdapter implements Adapter
{
    private Auth $auth;
    private Client $client;

    /**
     * {@inheritdoc}
     */
    public function __construct(Auth $auth, string $base_uri = '')
    {
        $base_uri = $base_uri ?: 'https://api.sandbox.namecheap.com/xml.response';

        $this->auth = $auth;
        $this->client = new Client(['base_uri' => $base_uri]);
    }

    /**
     * {@inheritdoc}
     */
    public function get(string $uri, array $data = [], array $headers = []): ResponseInterface
    {
        return $this->request('get', $uri, $data, $headers);
    }

    /**
     * {@inheritdoc}
     */
    public function post(string $uri, array $data = [], array $headers = []): ResponseInterface
    {
        return $this->request('post', $uri, $data, $headers);
    }

    /**
     * {@inheritdoc}
     */
    public function put(string $uri, array $data = [], array $headers = []): ResponseInterface
    {
        return $this->request('put', $uri, $data, $headers);
    }

    /**
     * {@inheritdoc}
     */
    public function patch(string $uri, array $data = [], array $headers = []): ResponseInterface
    {
        return $this->request('patch', $uri, $data, $headers);
    }

    /**
     * {@inheritdoc}
     */
    public function delete(string $uri, array $data = [], array $headers = []): ResponseInterface
    {
        return $this->request('delete', $uri, $data, $headers);
    }

    public function request(string $method, string $uri, array $data = [], array $headers = []): ResponseInterface
    {
        if (!in_array($method, ['get', 'post', 'put', 'patch', 'delete'])) {
            throw new InvalidArgumentException('Request method must be get, post, put, patch, or delete');
        }

        $data = array_merge($data, $this->auth->getParams());

        return $this->client->request($method,
            $uri,
            [
                'headers' => $headers,
                ('get' === $method ? 'query' : 'json') => $data,
            ]
        );
    }
}
