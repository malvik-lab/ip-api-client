<?php

namespace MalvikLab\IpApiClient;

use CuyZ\Valinor\Mapper\MappingError;
use CuyZ\Valinor\MapperBuilder;
use Respect\Validation\Validator as v;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\GuzzleException;
use MalvikLab\IpApiClient\DTO\DataDTO;

class IpApiClient
{
    public const NAME = 'IP API CLIENT';
    public const VERSION = '1.0.1';

    public function __construct(private null | HttpClient $httpClient = null)
    {
        if ( is_null($httpClient) )
        {
            $this->httpClient = new HttpClient();
        }
    }

    /**
     * @param $ip
     * @return DataDTO
     * @throws GuzzleException
     * @throws MappingError
     */
    public function get($ip = null): DataDTO
    {
        v::ip()->assert($ip);

        $url = sprintf('http://ip-api.com/json/%s?fields=status,message,continent,continentCode,country,countryCode,region,regionName,city,district,zip,lat,lon,timezone,offset,currency,isp,org,as,asname,reverse,mobile,proxy,hosting,query',
            $ip
        );

        $response = $this->httpClient->get($url);

        $data = [
            'limit' => [
                'ttl' => array_key_exists(0, $response->getHeader('X-Ttl')) ? (int)$response->getHeader('X-Ttl')[0] : null,
                'rl' => array_key_exists(0, $response->getHeader('X-Rl')) ? (int)$response->getHeader('X-Rl')[0] : null,
            ],
            'ipInfo' => json_decode((string)$response->getBody(), true),
        ];

        return (new MapperBuilder())
            ->mapper()
            ->map(DataDTO::class, $data);
    }
}