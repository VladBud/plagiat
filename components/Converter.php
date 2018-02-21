<?php

namespace components;


class Converter
{
    public function converter()
    {
        $endpoint = 'https://api2.online-convert.com/jobs';
        $apikey = 'b3b84078f055c7744f025329a76d7e4f';
        $debug = TRUE;

        $json_resquest = '{
        "input": [{
            "type": "remote",
            "source": "https://static.online-convert.com/example-file/raster%20image/jpg/example_small.jpg"
         }],
        "conversion": [{
            "target": "png"
         }]
    }';

        // No need to change parameters below this line.

        $ch = \curl_init($endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_resquest);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'X-Oc-Api-Key: '.$apikey,
            'Content-Type: application/json',
            'cache-control: no-cache'
        ));
        if ($debug) {
            curl_setopt($ch, CURLOPT_HEADER, TRUE);
            curl_setopt($ch, CURLINFO_HEADER_OUT, TRUE);
        }

        $response = curl_exec($ch);
        dump($response);
        $info = curl_getinfo($ch);
        $error =  curl_error($ch);
        curl_close($ch);
        if ($debug) {
            var_dump($info);
        }
        echo $response."\n";
        if (!empty($error)) {
            echo $error;
        }
    }

}