<?php

namespace Modules\CRM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use \App\User;
use \Modules\CRM\Entities\OrderCstm;
use \Modules\CRM\Entities\Order;

use \Modules\CRM\Entities\Lead;


use Illuminate\Support\Facades\Redis;

class OrdersController extends Controller
{
    /**
     * Display a listing of the order.
     * @return Response
     */

    public function index(Request $request)
    {
        return view('crm::orders.index');
    }

    /**
     * Show the form for creating a new order.
     * @return Response
     */
    public function create(Request $request)
    {
        $data['users'] = [];
        $data['lead'] = false;
        $usersAr = User::all()->toArray();
        $data['cstm_fields'] = OrderCstm::where('active', 'true')->get()->toArray();

        if($request->lead){
            $data['lead'] = Lead::where('id', $request->lead)->with('leadinfo')->get()->toArray();
            $data['lead'] = $data['lead'][0];
        }

        foreach ($usersAr as $key=>$user){
            $data['users'][$key]['label'] = $user['email'];
            $data['users'][$key]['value'] = (string)$user['id'];
        }


        return view('crm::orders.create', $data);
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
}
