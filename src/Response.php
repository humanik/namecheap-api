<?php

namespace Humanik\Namecheap\API;

class Response
{
    protected array $result;
    protected array $data;

    public function __construct(array $result, array $data)
    {
        $this->data = $data;
        $this->result = $result;
    }

    public function getResult(): array
    {
        return $this->result;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getErrors(): array
    {
        return $this->data['Errors'] ?? [];
    }

    public function hasErrors(): bool
    {
        return 0 !== count($this->getErrors());
    }
}
