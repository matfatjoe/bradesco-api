<?php

namespace Matfatjoe\BradescoBoleto\Auth;

class TokenRequest
{
    private $certPath;
    private $keyPath;
    private $clientId;
    private $clientSecret;

    /**
     * @param string $certPath Path to the .pem certificate file
     * @param string $keyPath Path to the .pem private key file
     * @param string $clientId Client ID for the API
     * @param string $clientSecret Client Secret for the API
     */
    public function __construct(string $certPath, string $keyPath, string $clientId, string $clientSecret)
    {
        if (!file_exists($certPath)) {
            throw new \InvalidArgumentException("Certificate file not found: {$certPath}");
        }

        if (!file_exists($keyPath)) {
            throw new \InvalidArgumentException("Private key file not found: {$keyPath}");
        }

        $this->certPath = $certPath;
        $this->keyPath = $keyPath;
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
    }

    public function getCertPath(): string
    {
        return $this->certPath;
    }

    public function getKeyPath(): string
    {
        return $this->keyPath;
    }

    public function getClientId(): string
    {
        return $this->clientId;
    }

    public function getClientSecret(): string
    {
        return $this->clientSecret;
    }

    public function toArray(): array
    {
        return [
            'grant_type' => 'client_credentials',
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
        ];
    }
}
