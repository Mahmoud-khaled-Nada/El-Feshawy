<?php

namespace App\Http\Traits;


trait FireBaseTrait
{
    public  $url = 'https://fcm.googleapis.com/fcm/send';
    public  $serverKey = '';



    public function send($fcm_token, $notification)
    {
        $this->serverKey = env('FIREBASE_KEY');
        $data = [
            "registration_ids" => $fcm_token,
            "notification" => [
                "title" => $notification->title,
                "body" => $notification->body,
            ],
            'data' => $notification,
        ];
        $encodedData = json_encode($data);

        $headers = [
            'Authorization:key=' . $this->serverKey,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        // Close connection
        curl_close($ch);
        // FCM response

    }
}
