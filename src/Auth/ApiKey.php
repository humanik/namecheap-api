<?php

namespace Humanik\Namecheap\API\Auth;

class ApiKey implements Auth
{
    private string $apiKey;
    private string $apiUser;
    private string $username;
    private string $clientIp;

    public function __construct(string $apiKey, string $apiUser, string $username, string $clientIp)
    {
        $this->apiKey = $apiKey;
        $this->apiUser = $apiUser;
        $this->username = $username;
        $this->clientIp = $clientIp;
    }

    public function getParams(): array
    {
        return [
            'ApiUser' => $this->apiUser,
            'ApiKey' => $this->apiKey,
            'UserName' => $this->username,
            'ClientIp' => $this->clientIp,
        ];
    }
}
