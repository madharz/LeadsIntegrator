<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class ApiClient
{
    private Client $client;
    private string $apiUrl;
    private string $token;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiUrl = $_ENV['API_URL'] ?? '';
        $this->token = $_ENV['API_TOKEN'] ?? '';
    }

    public function post(string $endpoint, array $payload): array
    {
        try {
            $url = rtrim($this->apiUrl, '/') . '/' . ltrim($endpoint, '/');

            $response = $this->client->post($url, [
                'headers' => [
                    'token' => $this->token,
                    'Content-Type' => 'application/json'
                ],
                'json' => $payload
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            return ['status' => false, 'error' => $e->getMessage()];
        }
    }
}