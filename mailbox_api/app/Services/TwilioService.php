<?php

namespace App\Services;

use Twilio\Rest\Client;
use Twilio\TwiML\MessagingResponse;

class TwilioService {

    /**
     * Static variable to store Twilio Account SID 
     * @static
     */
    private $TWILIO_ACCOUNT_SID;
    
    /**
     * Static variable to store Twilio Auth Token 
     * @static
     */
    private $TWILIO_AUTH_TOKEN;

     /**
     * string variable to store Twilio Phone Number Whatsapp 
     * @var string 
     */
    private $numberWhatsapp; 
    
     /**
     * String variable to store Twilio Phone Number SMS
     * @var string 
     */
    private $numberSms;
    
    /**
     * Variable to create instance of Twilio\Rest\Client;
     * @var Client 
     */
    private $client;

    public function __construct()
    {
        $this->TWILIO_ACCOUNT_SID     = getenv('TWILIO_ACCOUNT_SID'); 
        $this->TWILIO_AUTH_TOKEN      = getenv('TWILIO_AUTH_TOKEN');
        $this->numberWhatsapp         = getenv('TWILIO_NUMBER_WHATSAPP');
        $this->numberSms              = getenv('TWILIO_NUMBER_WHATSAPP');

        $this->client = new Client($this->TWILIO_ACCOUNT_SID, $this->TWILIO_AUTH_TOKEN);
    }
    
    /*
    * Send message for whatsapp to user using twilio programmable 
    * @param string $message (Body of message) 
    * @param string $phoneNumberUser (Phone number of user)
    */
    public function sendWhatsappMessage($message, $phoneNumberUser) {
        
        $messageTwilio = $this->client->messages->create("whatsapp:" . $phoneNumberUser, [
            'from' => "whatsapp:" . $this->numberWhatsapp,
            'body' => $message
        ]);

        return $messageTwilio;
    }

    /*
    * Send message for SMS to user using twilio programmable 
    * @param string $message (Body of message) 
    * @param string $phoneNumberUser (Phone number of user)
    */
    public function sendSmsMessage($message, $phoneNumberUser) {
        
    
        $messageTwilio = $this->client->messages->create($phoneNumberUser, [
            'from' => $this->numberSms,
            'body' => $message
        ]);

        return $messageTwilio;
    }

    /*
    * Message receive for SMS to user using twilio programmable 
    * @param string $message (Body of message) 
    * @param string $from (Phone number of user)
    */
    public function receiveSmsMessage($from, $message){
        $twiml = new MessagingResponse();

        //TODO: Save to Databasse
        //dd($twiml, $from, $message);

        return $twiml;
    }
    
}