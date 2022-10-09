<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Firebase extends Model
{
    use HasFactory;

    const FIREBASE_API_KEY = '';
 

    // sending push message to single user by firebase reg id
    public STATIC function send($to, $message) {
        $fields = array(
            'to' => $to,
            'notification'=>['title'=>$message['title'], 'body'=>$message['message']['description']],
            'data' => $message,
        );
        return \App\Firebase::sendPushNotification($fields);
    }

    // Sending message to a topic by topic name
    public STATIC function sendToTopic($to, $message) {
        $fields = array(
            'to' => '/topics/' . $to,
            'notification'=>['title'=>$message['title'], 'body'=>$message['message']['description']],
            'data' => $message,
        );
        return Firebase::sendPushNotification($fields);
    }

    // sending push message to multiple users by firebase registration ids
    public STATIC function sendMultiple($registration_ids, $message) {
        $fields = array(
            'to' => $registration_ids,
            'notification'=>['title'=>$message['title'], 'body'=>$message['message']['description']],
            'data' => $message,
        );

        return Firebase::sendPushNotification($fields);
    }

    // function makes curl request to firebase servers
    private STATIC function sendPushNotification($fields) {

        //require_once __DIR__ . '/config.php';

        // Set POST variables
        $url = 'https://fcm.googleapis.com/fcm/send';

        $headers = array(
            'Authorization: key=' . firebase::FIREBASE_API_KEY,
            'Content-Type: application/json'
        );
        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//json_encode($fields)
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }

        // Close connection
        curl_close($ch);

        return $result;
    }

}
