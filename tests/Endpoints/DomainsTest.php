<?php

namespace Humanik\Namecheap\API\Tests\Endpoints;

use Humanik\Namecheap\API\Adapter\GuzzleAdapter;
use Humanik\Namecheap\API\Endpoints\Domains;
use Humanik\Namecheap\API\Tests\TestCase;

class DomainsTest extends TestCase
{
    public function testGetList()
    {
        $response = $this->getPsr7JsonResponseForFixture('Endpoints/Domains/getList.xml');

        $mock = $this->createMock(GuzzleAdapter::class);
        $mock->method('get')->willReturn($response);

        $mock->expects($this->once())
            ->method('get')
            ->with(
                $this->equalTo(''),
            );

        $endpoint = new Domains($mock);
        $endpoint->getList();
    }

    public function testCreate()
    {
        $response = $this->getPsr7JsonResponseForFixture('Endpoints/Domains/create.xml');

        $mock = $this->createMock(GuzzleAdapter::class);
        $mock->method('get')->willReturn($response);

        $mock->expects($this->once())
            ->method('get')
            ->with(
                $this->equalTo(''),
            );

        $endpoint = new Domains($mock);
        $endpoint->create();
    }
}
