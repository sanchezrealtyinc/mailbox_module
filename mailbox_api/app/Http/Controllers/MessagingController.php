<?php

namespace App\Http\Controllers;
use App\Services\TwilioService;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MessagingController extends Controller
{
    
    /**
     * @var twilioService
     */
    protected $twilioService; 

    /**
     * MessagingController Constructor
     * @param TwilioService $twilioService
     */
    public function __construct(TwilioService $twilioService)
    {
        $this->twilioService = $twilioService;
    }
    
    public function sendWhatsappMessage(Request $request){
        
        $message = $request->input('message');
        $phoneNumberUser = $request->input('phoneNumber');

        $messageTwilio = $this->twilioService->sendWhatsappMessage($message, $phoneNumberUser);

        $response = [
            "messageTwilioId" => $messageTwilio->sid,
            "content" => "Message to Whatsapp send successfully"
        ];

        return response($response, Response::HTTP_OK);
        
    }

    public function sendSmsMessage(Request $request){
        
        $message = $request->input('message');
        $phoneNumberUser = $request->input('phoneNumber');

        $messageTwilio = $this->twilioService->sendSmsMessage($message, $phoneNumberUser);

        $response = [
            "messageTwilioId" => $messageTwilio->sid,
            "content" => "Message to SMS send successfully"
        ];

        return response($response, Response::HTTP_OK);
    }

}
