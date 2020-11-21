<?php

namespace Humanik\Namecheap\API\Adapter;

use Humanik\Namecheap\API\Auth\Auth;
use Psr\Http\Message\ResponseInterface;

/**
 * Interface Adapter.
 */
interface Adapter
{
    /**
     * Adapter constructor.
     *
     * @param Auth   $auth
     * @param string $base_uri
     */
    public function __construct(Auth $auth, string $base_uri);

    /**
     * Sends a GET request.
     * Per Robustness Principle - not including the ability to send a body with a GET request (though possible in the
     * RFCs, it is never useful).
     *
     * @param string $uri
     * @param array  $data
     * @param array  $headers
     *
     * @return ResponseInterface
     */
    public function get(string $uri, array $data = [], array $headers = []): ResponseInterface;

    /**
     * @param string $uri
     * @param array  $data
     * @param array  $headers
     *
     * @return ResponseInterface
     */
    public function post(string $uri, array $data = [], array $headers = []): ResponseInterface;

    /**
     * @param string $uri
     * @param array  $data
     * @param array  $headers
     *
     * @return ResponseInterface
     */
    public function put(string $uri, array $data = [], array $headers = []): ResponseInterface;

    /**
     * @param string $uri
     * @param array  $data
     * @param array  $headers
     *
     * @return ResponseInterface
     */
    public function patch(string $uri, array $data = [], array $headers = []): ResponseInterface;

    /**
     * @param string $uri
     * @param array  $data
     * @param array  $headers
     *
     * @return ResponseInterface
     */
    public function delete(string $uri, array $data = [], array $headers = []): ResponseInterface;
}
