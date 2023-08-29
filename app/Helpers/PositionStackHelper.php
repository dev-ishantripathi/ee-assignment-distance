<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;

class PositionStackHelper
{

    /**
     * @param string $address
     * @param array  $fields
     *
     * @return array
     * @throws RequestException
     */
    public function forwardGeoLocation(string $address, array $fields = []): array
    {
        $requestUrl = $this->getUrl($this->getForwardBaseUrl(), $address, $fields);
        return Http::get($requestUrl)->throw()->json();
    }

    private function getBaseUrl(): string
    {
        return config('position-stack.base_url');
    }

    private function getForwardEndpoint(): string
    {
        return config('position-stack.forward_endpoint');
    }

    private function getAccessKey(): string
    {
        return config('position-stack.access_key');
    }

    private function getForwardBaseUrl(): string
    {
        return sprintf(
            '%s%s?access_key=%s&output=json',
            $this->getBaseUrl(),
            $this->getForwardEndpoint(),
            $this->getAccessKey(),

        );
    }

    private function getUrlWithQuery(string $baseUrl, string $query): string
    {
        return sprintf(
            "%s&query='%s'",
            $baseUrl,
            $query
        );
    }

    private function getUrlWithQueryAndFields(string $baseUrl, string $query, array $fields): string
    {
        return sprintf(
            "%s&fields=%s",
            $this->getUrlWithQuery($baseUrl, $query),
            implode(',', $fields)
        );
    }

    private function getUrl(string $baseUrl, string $query, array $fields): string
    {
        if(empty($fields)) {
            return $this->getUrlWithQuery($baseUrl, $query);
        }

        return $this->getUrlWithQueryAndFields($baseUrl, $query, $fields);
    }
}
