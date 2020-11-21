<?php

namespace Humanik\Namecheap\API\Tests\Endpoints;

use Humanik\Namecheap\API\Adapter\Adapter;
use Humanik\Namecheap\API\Endpoints\DomainsDns;
use Humanik\Namecheap\API\Tests\TestCase;

class DomainsDnsTest extends TestCase
{
    public function testSetCustom()
    {
        $response = $this->getPsr7JsonResponseForFixture('Endpoints/DomainsDns/setCustom.xml');

        $mock = $this->createMock(Adapter::class);
        $mock->method('get')->willReturn($response);

        $mock->expects($this->once())
            ->method('get')
            ->with(
                $this->equalTo(''),
                $this->arrayHasSubset([
                    'SLD' => 'example',
                    'TLD' => 'com',
                    'Nameservers' => 'ns1.example.com,ns2.example.com',
                    'Command' => 'namecheap.domains.dns.setCustom',
                ])
            );

        $endpoint = new DomainsDns($mock);
        $response = $endpoint->setCustom('example.com', ['ns1.example.com', 'ns2.example.com']);

        $this->assertSame(
            [
                'Domain' => 'domain.com',
                'Updated' => 'true',
            ],
            $response->getResult()
        );
    }
}
