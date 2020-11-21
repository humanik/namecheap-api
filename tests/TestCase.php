<?php

namespace Humanik\Namecheap\API\Tests;

use DMS\PHPUnitExtensions\ArraySubset\ArraySubsetAsserts;
use DMS\PHPUnitExtensions\ArraySubset\Constraint\ArraySubset;
use GuzzleHttp\Psr7;

/**
 * Class TestCase.
 *
 * @SuppressWarnings(PHPMD.NumberOfChildren)
 */
abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    use ArraySubsetAsserts;

    /**
     * Returns a PSR7 Stream for a given fixture.
     *
     * @param string $fixture  the fixture to create the stream for
     *
     * @return Psr7\Stream
     */
    protected function getPsr7StreamForFixture(string $fixture): Psr7\Stream
    {
        $path = sprintf('%s/Fixtures/%s', __DIR__, $fixture);

        $this->assertFileExists($path);

        $stream = Psr7\Utils::streamFor(file_get_contents($path));

        $this->assertInstanceOf(Psr7\Stream::class, $stream);

        return $stream;
    }

    /**
     * Returns a PSR7 ApiResponse (JSON) for a given fixture.
     *
     * @param string  $fixture  the fixture to create the response for
     * @param int $statusCode  a HTTP Status Code for the response
     *
     * @return Psr7\Response
     */
    protected function getPsr7JsonResponseForFixture(string $fixture, int $statusCode = 200): Psr7\Response
    {
        $stream = $this->getPsr7StreamForFixture($fixture);

        return new Psr7\Response($statusCode, ['Content-Type' => 'application/xml'], $stream);
    }

    public function arrayHasSubset(array $subset)
    {
        return new ArraySubset($subset);
    }
}
