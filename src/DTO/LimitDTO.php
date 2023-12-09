<?php

namespace MalvikLab\IpApiClient\DTO;

final readonly class LimitDTO
{
    public function __construct(
        public float $ttl,
        public float $rl
    ) {}
}