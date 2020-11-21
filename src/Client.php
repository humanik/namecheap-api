<?php

namespace Humanik\Namecheap\API;

use Humanik\Namecheap\API\Adapter\Adapter;

class Client
{
    protected Adapter $adapter;

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
    }

    public function users(): Endpoints\Users
    {
        return new Endpoints\Users($this->adapter);
    }

    public function domains(): Endpoints\Domains
    {
        return new Endpoints\Domains($this->adapter);
    }

    public function domainsDns(): Endpoints\DomainsDns
    {
        return new Endpoints\DomainsDns($this->adapter);
    }
}
