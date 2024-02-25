<?php

namespace App\Services\Frontend;

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Http;
use Psr\Http\Message\RequestInterface;

class ProcessApiService
{

    private mixed $client;
    protected string $url;

    public function __construct()
    {
        $this->url = env('API_URL', '');
        //add middleware to attach token to request
        $this->client = Http::withMiddleware(
            Middleware::mapRequest(
                function (RequestInterface $request) {
                    $token = session()->get('token');
                    $request = $request
                        ->withHeader('Accept', 'application/json')
                        ->withHeader('Content-Type', 'application/json');
                    //attach token to request if it exists
                    if ($token) {
                        $request = $request
                            ->withHeader('Authorization', 'Bearer ' . $token);
                    }
                    return $request;
                },
            )
        );
    }

    private function _toObject($array)
    {
        $objectStr = json_encode($array);
        $object = json_decode($objectStr);
        return $object;
    }

    public function login($params = [])
    {
        $url = $this->url . '/auth/login';
        dd($url);
        $response = $this->client->post($url, $params);
        //throw exception if response is not successful
        $response->throw();
        //get data from response
        $response->throw()->json()['message'];

        $data = $response->json();
        return $data;
    }

}
