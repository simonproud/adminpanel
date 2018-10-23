<?php

namespace Modules\Telegram\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Telegram;

class TelegramController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request){return '';}

    public function sendlead(Request $request)
    {
        $text = '';
        $req = $request->all();
        foreach ($req as $k=>$r){
            $text .= $k.': '.$r.'
';
        }
        if($text == ''){
            return json_encode(['status' => 'error']);
        }
        $response = Telegram::sendMessage([
            'chat_id' => '-303052571',
            'text' => $text
        ]);

        return json_encode(['status' => 'success']);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('telegram::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('telegram::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('telegram::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
