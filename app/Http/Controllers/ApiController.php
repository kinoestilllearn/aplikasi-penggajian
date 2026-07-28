<?php

namespace App\Http\Controllers;

class ApiController extends Controller
{
    // public function curl(array $data)
    // {
    //     $curl = curl_init();

    //     dd($curl, $data['url']);

    //     curl_setopt_array($curl, array(
    //         CURLOPT_URL            => $data['url'],
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_ENCODING       => '',
    //         CURLOPT_MAXREDIRS      => 10,
    //         CURLOPT_TIMEOUT        => 0,
    //         CURLOPT_FOLLOWLOCATION => true,
    //         CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
    //         CURLOPT_CUSTOMREQUEST  => 'GET',
    //     ));

    //     $response = curl_exec($curl);

    //     curl_close($curl);

    //     return json_decode($response);
    // }
}
