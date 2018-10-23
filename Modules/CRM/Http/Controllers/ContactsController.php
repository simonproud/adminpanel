<?php

namespace Modules\CRM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\CRM\Entities\Contact;

class ContactsController extends Controller
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
        return view('crm::contacts.create');
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
                $contact = new Contact;
            }else{
                $contact = Contact::find($req['id']);
            }
        }else{
            $contact = new Contact;
        }

        $contact->client_id = $req['client'];
        $contact->contact_type = $req['type'];
        $contact->data = $req['data'];

        $contact->save();

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

    public function ajaxList(Request $request){
        if(isset($request->q)){

            $request = $request->all();
            $request = json_decode($request['q'], true);
            foreach ($request as $item){
                $req[$item[0]] = $item[1];
            }
            $contacts = Contact::where('active', true)->with('contactinfo')->orderBy('id', 'desc')->paginate($req['perPage'], ['*'],'page', $req['currentPage'])->toArray();

        }else {
            $contacts = Contact::where('active', true)->with('contactinfo')->paginate(8)->toArray();

        }


        foreach ($contacts['data'] as $key=>$client){
            foreach ($client['contactinfo'] as $addi){
                $contacts['data'][$key][$addi['key']] = $addi['value'];
            }
            if(count($contacts) > 0){
                $contacts['data'][$key]['id'] .= ' ';
                $contacts['data'][$key]['client_id'] .= ' ';
            }
        }

        $data = [
            'items' => $contacts['data'],
            'count' => $contacts['total'],
        ];
        return ($data);
    }
}
