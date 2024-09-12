<?php

namespace App\Services;

use GuzzleHttp\Promise;
use GuzzleHttp\Client;

/**
 * Class hubService
 *
 * This service provides methods to implement the multiple requests
 */
class hubService
{
    public function __construct() {
        $this->serviceAdapters = app('serviceAdapters');
        $this->client = new Client(); // Guzzle client
    }

    public function search(): array
    {
        $responses = [];

        foreach ($this->serviceAdapters as $adapter) {
            $serviceResponse = $adapter->sendRequest([]);
            $formattedResponse = $adapter->formatResponse([]);
            $responses[] = $formattedResponse;
        }

        return $responses;

        //return $this->combineResponses($responses);

        // // Example usage:
        // foreach ($this->serviceAdapters as $adapter) {
        //     print_r($adapter->sendRequest([]));
        // }
        // return [];
    }
}
