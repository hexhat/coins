<?php

declare(strict_types=1);

namespace Hexhat\Coins;

class Connect
{
    public function dialUp(\stdClass $config): \stdClass
    {
        $parameters = ['id' => $config->idlist, 'convert' => $config->currency];
        $request = $config->url . '?' . http_build_query($parameters);
        $headers = ['Accepts: application/json', 'X-CMC_PRO_API_KEY: ' . $config->token];

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $request,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_RETURNTRANSFER => 1
        ]);
        $response = json_decode(curl_exec($curl));
        curl_close($curl);

        return $response;
    }
}
