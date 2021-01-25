<?php

declare(strict_types=1);

interface LRUCacheContract
{
    public function __construct(int $capacity);

    public function get(int $key);

    public function put(int $key, $data): void;
}