<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\Delegate;
use App\Contact;
use App\Event;
/**
 *
 */
trait Booking
{
    public function CreateDeligateBooking($contactId, $eventId)
    {
        $contact = (int)$contactId;
        $event = (int)$eventId;
        $credentials = env('ADMINISTRATE_USER','') . ":" . env('ADMINISTRATE_SECRET','');
        $url = env('ADMINISTRATE_URL','') . '/api/v2/event/delegates';
        $data = array("event_id" => $event, "notes" => 'Booking made through the Integration Tier', "contact_id" => $contact);
        $options = array(
            'http' => array(
                'method'  => 'POST',
                'content' => json_encode($data),
                'header'=>
                "Content-Type: application/json\r\n" .
                "Accept: application/json\r\n" .
                "Authorization: Basic " . base64_encode($credentials)
            )
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        return $result;
    }
}
