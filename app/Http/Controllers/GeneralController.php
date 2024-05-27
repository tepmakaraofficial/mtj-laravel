<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class GeneralController extends Controller
{
    public function contact(Request $request){
        $user = auth()->user();
        $request->validate(['content'=>'required']);
        $buildContent = 'Contact from '.$user->name."\n";
        $buildContent .= 'Email : '.$user->email."\n";
        $buildContent .= 'Content : '.$request->get('content');
        $pushParams = [
            "chat_id" => env('TG_GROUP_CHAT_ID'),
            "allow_sending_without_reply" => true,
            "parse_mode" => "html",
            "text" => $buildContent
        ];
        $responseBody = $this->sendMessage($pushParams);
        return redirect()->back()->with('message', 'Thank you for contact us we have received and get back to you soon.');
    }

    public function sendMessage(array $data)
    {
        try{
            $url = "https://api.telegram.org/bot".env('TG_API_KEY')."/sendMessage";
            $client = new Client(
                [
                    'timeout' => 30,
                    'connect_timeout' => 30
                ]
            );
            $response = $client->request("POST", $url, ['form_params' => $data]);
            return json_decode($response->getBody()->getContents(),true);
        }catch(\Exception $ex){
            throw $ex;
        }
    }
}
