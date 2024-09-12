<?php

namespace App\Adapters;

interface ServiceAdapter {
    public function sendRequest(array $commonRequest): array;
    public function formatResponse(array $serviceResponse): array;
}