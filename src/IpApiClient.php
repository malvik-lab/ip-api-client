<?php

namespace MalvikLab\IpApiClient;

use CuyZ\Valinor\Mapper\MappingError;
use CuyZ\Valinor\MapperBuilder;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\GuzzleException;
use MalvikLab\IpApiClient\DTO\DataDTO;
use Rakit\Validation\Validator;
use MalvikLab\IpApiClient\Exceptions\ValidationException;

class IpApiClient
{
    public const NAME = 'IP API CLIENT';
    public const VERSION = '1.0.0';

    public function __construct(private null | HttpClient $httpClient = null)
    {
        if ( is_null($httpClient) )
        {
            $this->httpClient = new HttpClient();
        }
    }

    /**
     * @param null $ip
     * @return DataDTO
     * @throws GuzzleException
     * @throws MappingError
     * @throws ValidationException
     */
    public function get($ip = null): DataDTO
    {
        $validator = new Validator();

        $inputs = [
            'ip' => $ip,
        ];

        $rules = [
            'ip' => [
                'required',
                'ip'
            ],
        ];

        $validation = $validator->make($inputs, $rules);
        $validation->validate();

        if ( $validation->fails() )
        {
            throw new ValidationException($validation->errors());
        }

        $response = $this->httpClient->get('http://ip-api.com/json/' . $validation->getValidData()['ip']);

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