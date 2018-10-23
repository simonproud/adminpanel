<?php

namespace Modules\CRM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\CRM\Entities\Client;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('crm::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('crm::clients.create');
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
        return view('crm::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('crm::edit');
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
    public function ajaxList(Request $request)
    {
        if(isset($request->q)){

            $request = $request->all();
            $request = json_decode($request['q'], true);
            foreach ($request as $item){
                $req[$item[0]] = $item[1];
            }
            $clients = Client::where('active', true)->with('clientinfo')->orderBy('id', 'desc')->paginate($req['perPage'], ['*'],'page', $req['currentPage'])->toArray();

        }else {
            $clients = Client::where('active', true)->with('clientinfo')->paginate(8)->toArray();

        }


        foreach ($clients['data'] as $key=>$client){
            foreach ($client['clientinfo'] as $addi){
                $clients['data'][$key][$addi['key']] = $addi['value'];
            }
            if(count($clients) > 0){
                $clients['data'][$key]['id'] .= ' ';
            }
        }

        $data = [
            'items' => $clients['data'],
            'count' => $clients['total'],
        ];
        return ($data);
    }
}
