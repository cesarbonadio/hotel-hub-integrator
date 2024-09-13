<?php

namespace App\Adapters;

use App\Adapters\ServiceAdapter;

use App\Http\Requests\commonHubRequest;
use App\Http\Requests\hotelLegsRequest;
use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Support\Carbon;
use Faker\Factory as Faker;

class hotelLegsServiceAdapter implements ServiceAdapter {

    // map the rules that are directly asociated, the rest,
    // will be calculated in mapCommonFields
    const mapRules = [
        'hotelId' => 'hotel',
        'checkIn' => 'checkInDate',
        'numberOfGuests' => 'guests',
        'numberOfRooms' => 'rooms',
        'currency' => 'currency'
    ];

    private static function calculateNights($startDate, $endDate)
    {
        // Parse the dates using Carbon helper
        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);
        
        // Calculate the difference in days (nights)
        $nights = $start->diffInDays($end);
        
        return $nights;
    }

    // this logic should be in the request
    public function mapCommonFields(commonHubRequest $request): FormRequest
    {
        $requestProperties = $request->all();
        $newRequest = [];

        // automatically map the properties that can be directly mapped
        foreach ($requestProperties as $property => $value) {
            if (array_key_exists($property, self::mapRules)) {
                $newRequest[self::mapRules[$property]] = $value;
            }
        }

        // manually calculate the rest properties that are not mapped directly
        $newRequest['numberOfNights'] = self::calculateNights(
            $request->checkIn,
            $request->checkOut
        );
        // and so on...

        return new hotelLegsRequest($newRequest);
    }

    public function sendRequest(array $adapterTypeRequest): array 
    {
        // Transform common request to service A format
        // simulate the api call ...
        // print_r($adapterTypeRequest);

        if(config('custom.RANDOMIZE_REQUEST_DATA')) {
            $count = 4;

            // Create a new Faker instance
            $faker = Faker::create();

            // Possible room and meal options
            $rooms = [1, 2, 3, 4];
            $meals = [1, 2, 3, 4];

            // Generate fake data
            return collect(range(1, $count))->map(function () use ($faker, $rooms, $meals) {
                return [
                    'room' => $faker->randomElement($rooms),
                    'meal' => $faker->randomElement($meals),
                    'canCancel' => $faker->boolean,
                    'price' => $faker->randomFloat(2, 100, 200)
                ];
            })->toArray();
        }
        
        // mock static if randomize is false
        return [
            [
                'room' => 1,
                'meal' => 1,
                'canCancel' => false,
                'price' => 123.48
            ],
            [
                'room' => 1,
                'meal' => 1,
                'canCancel' => true,
                'price' => 150.00
            ],
            [
                'room' => 2,
                'meal' => 1,
                'canCancel' => false,
                'price' => 148.25
            ],
            [
                'room' => 2,
                'meal' => 2,
                'canCancel' => false,
                'price' => 165.38
            ],
        ];
    }

    public function formatResponse(array $serviceResponse): array
    {
        // Use Laravel's collect() helper to work with collections
        return collect($serviceResponse)
        ->groupBy('room')
        ->map(function ($roomRates, $roomId) {
            return [
                'roomId' => (int) $roomId,
                'rates' => $roomRates->map(function ($rate) {
                    return [
                        'mealPlanId' => $rate['meal'],
                        'isCancellable' => $rate['canCancel'],
                        'price' => $rate['price']
                    ];
                })->values()->toArray()
            ];
        })
        ->values() 
        ->toArray();
    }
}