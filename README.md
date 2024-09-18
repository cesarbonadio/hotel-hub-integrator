# Hotel hub service

## Overview

This project provides an API in form of HUB that connects to multiple services, maps all the requests to adapt them to each service, and then returns
a common response format.

## Installation

To run this project, you need to have the following installed:
- PHP 8 or higher
- Composer 2.6 or higher
- Redis^7 database setted up and running or docker 23^

### Steps to Install

1. Clone the repository and cd to folder
```console
git clone git@github.com:cesarbonadio/hotel-hub-integrator.git
```
2. Instal dependencies using composer
```console
composer install
```
3. create .env file
```console
cat .env.example > .env
```
or create .env manually and copy the content of .env.example

4. Set your secret laravel key app
```console
php artisan key:generate
```

5. Set up your .env file

For this project, just configure the variable RANDOMIZE_REQUEST_DATA if you want to get random data or not

7. Run server with artisan
```console
php artisan serve
```

## API Endpoint

### POST /api/hub

This endpoint accepts a common request in the from of:

#### Request Body
| Parameter    | Type | Description  |
| ------------- |:-------------:| ------:|
| hotelId | int | the id of the hotel |
| checkIn | date(yyyy-mm-dd) | check in date |
| checkOut |  date(yyyy-mm-dd) | check out date |
| numberOfGuests | int | number of guests |
| numberOfRooms | int | number of rooms |
| currency | string | desired currency |

##### Example:
```json
{
    "hotelId": 1,
    "checkIn": "2018-10-20",
    "checkOut": "2018-10-25",
    "numberOfGuests": 3,
    "numberOfRooms": 2,
    "currency": "EUR"
}
```

#### Response

The response should be in this format

##### Example:
```json
{
    "rooms": [
        {
            "roomId": 1,
            "rates": [
                {
                    "mealPlanId": 1,
                    "isCancellable": false,
                    "price": 123.48
                },
                {
                    "mealPlanId": 1,
                    "isCancellable": true,
                    "price": 150
                }
            ]
        },
        {
            "roomId": 2,
            "rates": [
                {
                    "mealPlanId": 1,
                    "isCancellable": false,
                    "price": 148.25
                },
                {
                    "mealPlanId": 2,
                    "isCancellable": false,
                    "price": 165.38
                }
            ]
        }
    ],
    "integrators_requests": {
        "App\\Adapters\\hotelLegsServiceAdapter": {
            "hotel": 1,
            "checkInDate": "2018-10-20",
            "guests": 3,
            "rooms": 2,
            "currency": "EUR",
            "numberOfNights": 5
        }
    },
    "dinamycally_generated": false
}
```