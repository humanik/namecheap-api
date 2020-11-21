<?php

namespace Humanik\Namecheap\API\Tests\Auth;

use Humanik\Namecheap\API\Auth\ApiKey;
use Humanik\Namecheap\API\Tests\TestCase;

class ApiKeyTest extends TestCase
{
    public function testGetParams()
    {
        $auth = new ApiKey('key', 'user', 'username', '127.0.0.1');

        $this->assertArraySubset(
            [
                'ApiKey' => 'key',
                'ApiUser' => 'user',
                'UserName' => 'username',
                'ClientIp' => '127.0.0.1',
            ],
            $auth->getParams()
        );
    }
}
