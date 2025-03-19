<?php

namespace App\Models;

class Lead
{
    public static function buildPayload(array $data): array
    {
        return array_merge($data, [
            'box_id' => $_ENV['BOX_ID'] ?? '',
            'offer_id' => $_ENV['OFFER_ID'] ?? '',
            'countryCode' => $_ENV['COUNTRY_CODE'] ?? '',
            'language' => $_ENV['LANGUAGE'] ?? '',
            'password' => $_ENV['PASSWORD'] ?? '',
            'ip' => $_SERVER['REMOTE_ADDR'] ?? '',
            'landingUrl' => $_ENV['LANDING_URL'] ?? (isset($_SERVER['HTTP_HOST']) ? 'http://' . $_SERVER['HTTP_HOST'] : ''),
        ]);
    }

    public static function parseLeadsResponse(array $responseData): array
    {
        if (isset($responseData['data']) && is_string($responseData['data'])) {
            return json_decode($responseData['data'], true);
        } elseif (isset($responseData['data']) && is_array($responseData['data'])) {
            return $responseData['data'];
        }

        return [];
    }
}