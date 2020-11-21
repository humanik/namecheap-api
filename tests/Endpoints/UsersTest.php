<?php

namespace Humanik\Namecheap\API\Tests\Endpoints;

use Humanik\Namecheap\API\Adapter\Adapter;
use Humanik\Namecheap\API\Endpoints\Users;
use Humanik\Namecheap\API\Tests\TestCase;

class UsersTest extends TestCase
{
    public function testGetBalances()
    {
        $response = $this->getPsr7JsonResponseForFixture('Endpoints/Users/getBalances.xml');

        $mock = $this->createMock(Adapter::class);
        $mock->method('get')->willReturn($response);

        $mock->expects($this->once())
            ->method('get')
            ->with(
                $this->equalTo(''),
                $this->arrayHasSubset([
                    'Command' => 'namecheap.users.getBalances',
                ]),
            );

        $endpoint = new Users($mock);
        $response = $endpoint->getBalances();

        $this->assertArraySubset(
            [
                'Currency' => 'USD',
                'AvailableBalance' => '4932.96',
                'AccountBalance' => '4932.96',
                'EarnedAmount' => '381.70',
                'WithdrawableAmount' => '1243.36',
                'FundsRequiredForAutoRenew' => '0.00',
            ],
            $response->getResult()
        );
    }

    public function testGetPricing()
    {
        $response = $this->getPsr7JsonResponseForFixture('Endpoints/Users/getPricing.xml');

        $mock = $this->createMock(Adapter::class);
        $mock->method('get')->willReturn($response);

        $mock->expects($this->once())
            ->method('get')
            ->with(
                $this->equalTo(''),
                $this->arrayHasSubset([
                    'Command' => 'namecheap.users.getPricing',
                    'ProductType' => 'DOMAIN',
                ]),
            );

        $endpoint = new Users($mock);
        $endpoint->getPricing();
    }
}
