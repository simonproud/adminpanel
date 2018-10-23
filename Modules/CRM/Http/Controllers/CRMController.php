<?php

namespace Modules\CRM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use \Modules\CRM\Entities\Lead;

use Illuminate\Support\Facades\Redis;

class CRMController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('crm::index');
    }

    public  function getStatistic(){
        $data = [];
        $data['leads']['total'] = $this->getTotalLeads();


        return $data;
    }



    public function  getContacts(Request $request){
        return view('crm::contacts.index');
    }
    public function  getClients(Request $request){
        return view('crm::clients.index');
    }


    public  function getTotalLeads(){
        $total = Redis::get('crm:statistic:leads:total');
        if($total == null){
            $total = Lead::all()->count();
            Redis::set('crm:statistic:leads:total', $total);
        }
        return $total;
    }

}
