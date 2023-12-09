<?php declare(strict_types=1);

namespace Tests\Integration;

use CuyZ\Valinor\Mapper\MappingError;
use GuzzleHttp\Exception\GuzzleException;
use MalvikLab\IpApiClient\DTO\DataDTO;
use MalvikLab\IpApiClient\Exceptions\ValidationException;
use MalvikLab\IpApiClient\IpApiClient;
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
        $dataDTO = $this->client->get('8.8.8.8');
        $this->assertInstanceOf(DataDTO::class, $dataDTO);
    }
}