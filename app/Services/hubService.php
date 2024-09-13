<?php

namespace App\Services;

use GuzzleHttp\Promise;
use GuzzleHttp\Client;

use App\Http\Requests\commonHubRequest; 

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

    public function search(commonHubRequest $request): array
    {
        $responses = [];
        $integratorsRequests = [];

        foreach ($this->serviceAdapters as $adapter) {
            // map the initial fields, convert the commonhubrequest to
            // specific request
            $adapterTypeRequest = $adapter->mapCommonFields($request);

            // send request to one of the multiple apis
            $serviceResponse = $adapter->sendRequest($adapterTypeRequest->all());

            // format the response
            $formattedResponse = $adapter->formatResponse($serviceResponse);

            $responses[] = $formattedResponse;
            $integratorsRequests[get_class($adapter)] = $adapterTypeRequest->all();
        }

        return [
            'HUB_response' => $responses,
            'integrators_requests' => $integratorsRequests,
            'dinamycally_generated' => config('custom.RANDOMIZE_REQUEST_DATA')
        ];
    }
}
