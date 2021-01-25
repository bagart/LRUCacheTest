<?php

declare(strict_types=1);

class LRUCacheIndexed implements LRUCacheContract
{
    private int $capacity;
    private int $idx = 0;
    private array $dataByKey = [];
    private array $idxByKey = [];

    public function __construct(int $capacity)
    {
        if ($capacity <= 0) {
            throw new RuntimeException('capacity value must be great then 0');
        }
        $this->capacity = $capacity;
    }

    private function warm(int $key)
    {
        unset($this->idxByKey[$key]);
        $this->idxByKey[$key] = ++$this->idx;
    }

    public function get(int $key)
    {
        if (!isset($this->dataByKey[$key])) {
            return -1;
        }
        $this->warm($key);

        return $this->dataByKey[$key];
    }

    public function put(int $key, $data): void
    {
        $isExist = isset($this->dataByKey[$key]);
        $this->warm($key);
        $this->dataByKey[$key] = $data;
        if (!$isExist) {
            $this->free(count($this->dataByKey) - $this->capacity);
        }
    }

    public function free(int $count): void
    {
        while ($count-- > 0) {
            unset($this->dataByKey[key($this->idxByKey)]);
            unset($this->idxByKey[key($this->idxByKey)]);
        }
    }

    public function debug(): array
    {
        return [
            'current_count' => count($this->dataByKey),
            'check' => count($this->dataByKey) === count($this->idxByKey) && $this->capacity >= count($this->dataByKey),
        ];
    }
}
