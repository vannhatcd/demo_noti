<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Pusher\Pusher;

class SendMessageController extends Controller
{
    public function index()
    {
        return view('send_message');
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);
        
        $data['title'] = $request->title;
        $data['content'] = $request->content;

        $options = array(
            'cluster' => 'ap1',
            'encrypted' => true
        );

        $pusher = new Pusher(
            'c5e381680046da4eaa76',
            '29a5e106abd78ebec620',
            '1365253',
            $options
        );

        $pusher->trigger('Notify', 'send-message', $data);

        return redirect()->route('send');
    }
}
