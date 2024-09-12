<?php

namespace App\Adapters;

use App\Adapters\ServiceAdapter;

class hotelLegsServiceAdapter implements ServiceAdapter {

    const mapRules = [
        'hotel' => 'hotelId',
        'checkInDate' => 'checkIn',
        //'numberOfNights' => 
    ];

    // this logic should be in the request
    public function mapCommonFields(array $mapRules): array {

    }

    public function sendRequest(array $commonRequest): array {
        // Transform common request to service A format

        $mockRequestData = [
            'hotel' => 1,
            'checkInDate' => '2018-10-20',
            'numberOfNights' => 5,
            'guests' => 3,
            'rooms' => 2,
            'currency' => 'EUR'
        ];
        
        // mock
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

    public function formatResponse(array $serviceResponse): array {
        // Transform service A response to common response format

        return [
            'rooms' => [
                'roomId'=> 1,
                'rates'=> [
                    [
                        'mealPlanId'=>1,
                        'isCancellable'=> false,
                        'price'=> 123.48
                    ],
                    [
                        'mealPlanId'=>2,
                        'isCancellable'=> true,
                        'price'=> 150.00
                    ]
                ]
            ],
            [
                'roomId'=> 2,
                'rates'=> [
                    [
                        'mealPlanId'=>1,
                        'isCancellable'=> false,
                        'price'=> 123.48
                    ],
                    [
                        'mealPlanId'=>2,
                        'isCancellable'=> true,
                        'price'=> 150.00
                    ]
                ]
            ]
        ];
    }
}