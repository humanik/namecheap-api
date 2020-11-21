<?php

namespace Humanik\Namecheap\API\Tests;

use Humanik\Namecheap\API\Adapter\Adapter;
use Humanik\Namecheap\API\Client;
use Humanik\Namecheap\API\Endpoints\Domains;
use Humanik\Namecheap\API\Endpoints\DomainsDns;
use Humanik\Namecheap\API\Endpoints\Users;

class ClientTest extends TestCase
{
    public function testGetBalances()
    {
        $mock = $this->createMock(Adapter::class);

        $client = new Client($mock);

        $this->assertInstanceOf(Users::class, $client->users());
        $this->assertInstanceOf(Domains::class, $client->domains());
        $this->assertInstanceOf(DomainsDns::class, $client->domainsDns());
    }
}
