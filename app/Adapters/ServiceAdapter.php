<?php

namespace App\Adapters;

use App\Http\Requests\commonHubRequest;
use Illuminate\Foundation\Http\FormRequest;

interface ServiceAdapter {
    public function mapCommonFields(commonHubRequest $commonHubRequest): FormRequest;
    public function sendRequest(array $adapterTypeRequest): array;
    public function formatResponse(array $serviceResponse): array;
}