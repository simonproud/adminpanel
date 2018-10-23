<?php

namespace Modules\CRM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use \App\User;
use \Modules\CRM\Entities\Lead;
use \Modules\CRM\Entities\LeadCstm;

use Illuminate\Support\Facades\Redis;

class LeadsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data['statistic']['leads']['total'] = '5';
        return view('crm::leads.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $data['users'] = [];
        $usersAr = User::all()->toArray();
        $data['cstm_fields'] = LeadCstm::where('active', 'true')->get()->toArray();

        foreach ($usersAr as $key=>$user){
            $data['users'][$key]['label'] = $user['email'];
            $data['users'][$key]['value'] = $user['id'];
        }
        return view('crm::leads.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $req = $request->all();
        if(isset($req['id'])){
            if( $req['id'] == 'null'){
                $lead = new Lead;
            }else{
                $lead = Lead::find($req['id']);
            }
        }else{
            $lead = new Lead;
        }

        $lead->name = $req['name'];
        $lead->description = $req['description'];
        $lead->source = 'none';
        if(isset($req['operator'])){$lead->user_id = $req['operator']['value'];}
        if(isset($req['client'])){$lead->client_id = $req['client'];}

        if($id = $lead->save()){

            if(isset($req['additional'])){
                if(isset($req['additional']['source'])){
                    $lead->source = $req['additional']['source'];
                }
                $additional = [];
                foreach ($req['additional'] as $key=>$input){
                    $additional[] = [
                        'lead_id' => $id,
                        'key' => $key,
                        'value' => $input,
                    ];
                }
                if(  $items =  $lead->leadinfo()->createMany($additional)){
                    return json_encode(['status' => 'success']);
                }
                return json_encode(['status' => 'danger']);
            }
            return json_encode(['status' => 'success']);

        }
        return json_encode(['status' => 'danger']);
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
        $data['users'] = [];
        $usersAr = User::all()->toArray();
        $data['cstm_fields'] = LeadCstm::where('active', 'true')->get()->toArray();

        foreach ($usersAr as $key=>$user){
            $data['users'][$key]['label'] = $user['email'];
            $data['users'][$key]['value'] = $user['id'];
        }
        return view('crm::leads.edit', $data);
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
    public function destroy(Request $request)
    {
        if(Lead::find($request->id)->delete()){
            return ['status' => 'success'];
        }
        return ['status' => 'danger'];
    }

    /**
     * Get list leads
     * @param  Request $request
     * @return Response
     */
    public function ajaxList(Request $request)
    {
        if(isset($request->q)){

            $request = $request->all();
            $request = json_decode($request['q'], true);
            foreach ($request as $item){
                $req[$item[0]] = $item[1];
            }
            $leads = Lead::where('active', true)->with('leadinfo')->orderBy('created_at', 'desc')->paginate($req['perPage'], ['*'],'page', $req['currentPage'])->toArray();

        }else {
            $leads = Lead::where('active', true)->with('leadinfo')->paginate(8)->toArray();

        }


        foreach ($leads['data'] as $key=>$lead){
            foreach ($lead['leadinfo'] as $addi){
                $leads['data'][$key][$addi['key']] = $addi['value'];
            }
            if(count($leads) > 0){
                $leads['data'][$key]['id'] .= ' ';
            }
        }



        $data = [
            'items' => $leads['data'],
            'count' => $leads['total'],
        ];
        return json_encode($data);
    }
}
