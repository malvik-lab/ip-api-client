<?php

namespace MalvikLab\IpApiClient\DTO;

final readonly class DataDTO
{
    public function __construct(
        /** @var LimitDTO */
        public object $limit,
        /** @var IpInfoDTO */
        public object $ipInfo
    ) {}
}