<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\Events\RedisEvent;
use App\Mail\PaymentSucceed;
use Mail;

class RedisController extends Controller
{
    public function index()
    {
        $messages = Message::all();

        return view('chat', compact('messages'));
    }

    public function sendMessage(Request $request)
    {
        $messages = Message::create($request->all());

        event(
            $e = new RedisEvent($messages)
        );

        return redirect()->back();
    }

    public function sendMail(Request $request)
    {
        Mail::to('sonvotu96@gmail.com')->send(new PaymentSucceed(Message::first()));

        return 'sent';
    }

    public function camera(Request $request)
    {
        return view('webcam');
    }

    public function base64_to_jpeg($base64_string, $output_file) {
    // open the output file for writing
        $ifp = fopen( $output_file, 'wb' );

    // split the string on commas
    // $data[ 0 ] == "data:image/png;base64"
    // $data[ 1 ] == <actual base64 string>
        $data = explode( ',', $base64_string );

    // we could add validation here with ensuring count( $data ) > 1
        fwrite( $ifp, base64_decode( $data[ 1 ] ) );

    // clean up the file resource
        fclose( $ifp );

        return $output_file;
    }

    public function image(Request $request)
    {
        $img = $request->data;
        // $img = $_POST['img'];
        $img = str_replace('data:image/jpeg;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $image = 'image-' . time() . '.png';
        file_put_contents($image, $data);
        // return $this->base64_to_jpeg($request->data, 'abc.jpg');
    }
}
