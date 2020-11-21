<?php

namespace Humanik\Namecheap\API\Tests\Adapter;

use GuzzleHttp\Exception\RequestException;
use Humanik\Namecheap\API\Adapter\GuzzleAdapter;
use Humanik\Namecheap\API\Auth\Auth;
use Humanik\Namecheap\API\Tests\TestCase;

class GuzzleAdapterTest extends TestCase
{
    private GuzzleAdapter $client;

    public function setUp(): void
    {
        $auth = $this->createMock(Auth::class);
        $auth->method('getParams')
            ->willReturn(['username' => 'John']);

        $this->client = new GuzzleAdapter($auth, 'https://httpbin.org/');
    }

    public function testGet()
    {
        $response = $this->client->get('/get', ['city' => 'Moscow']);

        $data = json_decode($response->getBody());
        $this->assertEquals('John', $data->args->username);
        $this->assertEquals('Moscow', $data->args->city);

        $this->assertEquals('application/json', $response->getHeader('Content-Type')[0]);
    }

    public function testPost()
    {
        $response = $this->client->post('https://httpbin.org/post', ['X-Post-Test' => 'Testing a POST request.']);

        $headers = $response->getHeaders();
        $this->assertEquals('application/json', $headers['Content-Type'][0]);

        $body = json_decode($response->getBody());
        $this->assertEquals('Testing a POST request.', $body->json->{'X-Post-Test'});
    }

    public function testPut()
    {
        $response = $this->client->put('https://httpbin.org/put', ['X-Put-Test' => 'Testing a PUT request.']);

        $headers = $response->getHeaders();
        $this->assertEquals('application/json', $headers['Content-Type'][0]);

        $body = json_decode($response->getBody());
        $this->assertEquals('Testing a PUT request.', $body->json->{'X-Put-Test'});
    }

    public function testPatch()
    {
        $response = $this->client->patch(
            'https://httpbin.org/patch',
            ['X-Patch-Test' => 'Testing a PATCH request.']
        );

        $headers = $response->getHeaders();
        $this->assertEquals('application/json', $headers['Content-Type'][0]);

        $body = json_decode($response->getBody());
        $this->assertEquals('Testing a PATCH request.', $body->json->{'X-Patch-Test'});
    }

    public function testDelete()
    {
        $response = $this->client->delete(
            'https://httpbin.org/delete',
            ['X-Delete-Test' => 'Testing a DELETE request.']
        );

        $headers = $response->getHeaders();
        $this->assertEquals('application/json', $headers['Content-Type'][0]);

        $body = json_decode($response->getBody());
        $this->assertEquals('Testing a DELETE request.', $body->json->{'X-Delete-Test'});
    }

    public function testNotFound()
    {
        $this->expectException(RequestException::class);
        $this->client->get('https://httpbin.org/status/404');
    }
}
