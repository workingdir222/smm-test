<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class regionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function province()
    {
        $curl = \curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://pro.rajaongkir.com/api/province",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "key: 31691a1881ada48b9e2caaf80f0b1659"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
        return "cURL Error #:" . $err;
        } else {
        return $response;
        }
    }

    public function city(Request $request)
    {
        $key = $request->input('key');
        $curl = \curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://pro.rajaongkir.com/api/city?province=". $key,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "key: 31691a1881ada48b9e2caaf80f0b1659"
        ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);

        if ($err) {
        return "cURL Error #:" . $err;
        } else {
        return $response;
        }
    }

    public function subdistrict(Request $request)
    {
        $key = $request->input('key');
        $curl = \curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://pro.rajaongkir.com/api/subdistrict?city=". $key,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "key: 31691a1881ada48b9e2caaf80f0b1659"
        ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);

        if ($err) {
        return "cURL Error #:" . $err;
        } else {
        return $response;
        }
    }

   
}
