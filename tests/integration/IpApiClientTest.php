<?php declare(strict_types=1);

namespace Tests\integration;

use CuyZ\Valinor\Mapper\MappingError;
use GuzzleHttp\Exception\GuzzleException;
use MalvikLab\IpApiClient\IpApiClient;
use Respect\Validation\Exceptions\ValidationException;
use PHPUnit\Framework\TestCase;

final class IpApiClientTest extends TestCase
{
    private IpApiClient $client;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        $this->client = new IpApiClient();
    }

    /**
     * @throws GuzzleException
     * @throws MappingError
     */
    public function testNullIp(): void
    {
        $this->expectException(ValidationException::class);

        $this->client->get();
    }

    /**
     * @throws GuzzleException
     * @throws MappingError
     */
    public function testInvalidIp(): void
    {
        $this->expectException(ValidationException::class);

        $this->client->get('x');
    }

    /**
     * @throws GuzzleException
     * @throws MappingError
     * @throws ValidationException
     */
    public function testValidIp(): void
    {
        $ip = '8.8.8.8';
        $dataDTO = $this->client->get($ip);
        $this->assertSame($ip, $dataDTO->ipInfo->query);
    }
}