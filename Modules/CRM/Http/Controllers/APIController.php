<?php

namespace Modules\CRM\Http\Controllers;

use function foo\func;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\CRM\Entities\Lead;
use Modules\CRM\Entities\Order;
use Modules\CRM\Entities\LeadInfo;
use Modules\CRM\Entities\OrderInfo;
use Modules\CRM\Entities\Client;
use Modules\CRM\Entities\ClientInfo;
use Modules\CRM\Http\Requests\StoreOrder;

class APIController extends Controller
{

    public $filterResult = '';
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

    public function createOrder(StoreOrder $request){
        $req = $request->all();
        $order = new Order;
        $order->name = $req['name'];
        $order->cost = $req['cost'];
        $order->description = $req['description'];
        $order->currency = $req['currency'];
        $order->status_id = $req['status_id'];
        $order->active = $req['active'];
        $order->client_id = $req['client_id'];
        $order->user_id = $req['user']['value'];
        $order->save();

        if( count($req['additional']) > 0){
            $adata = [];
            foreach ($req['additional'] as $k=>$v){
                $add['order_id'] = $order->id;
                $add['key'] = $k;
                $add['value'] = $v;
                $adata[] = $add;
            }

             OrderInfo::insert($adata);

        }

        $return = $order->toArray();
        $return['id'] = (string)$return['id'];
        //$return->id = (string)$order->id;
        return $return;
    }
    public function getOrders(Request $request){
        $request = $request->all();
        $req = [];
        if(isset($request['q'])) {
        $requestAr = json_decode($request['q'], true);
        foreach ($requestAr as $item){
            $req[$item[0]] = $item[1];
        }


            $orders = Order::where('active', true)->with('orderinfo')->orderBy('created_at', 'desc')->paginate($req['perPage'], ['*'], 'page', $req['currentPage'])->toArray();
        }else{
            $orders = Order::where('active', true)->with('orderinfo')->paginate(8)->toArray();

        }

        foreach ($orders['data'] as $kk=>$vv){
            $orders['data'][$kk]['id'] =  (string)$orders['data'][$kk]['id'];
        }
        $data = [
            'items' => $orders['data'],
            'count' => $orders['total'],
        ];

        return json_encode($data);
    }
    public function getClients(Request $request)
    {
        $data = [];
       if(isset($request->q) && $request->q != ''){
          $clients = Client::where('first_name', 'LIKE', '%' .$request->q. '%')
            ->orWhere('second_name', 'LIKE', '%' .$request->q. '%')
            ->orWhere('third_name', 'LIKE', '%' .$request->q. '%')
            ->with('clientinfo')->get()->toArray();

           if(count($clients) > 0){

               foreach ($clients as $key=>$client){
                $clients[$key]['id'] = (string)$clients[$key]['id'];
               }
               $data['items'] = $clients;
           }
       }

        return $data;
    }


    public function array_search($search,$arr)
    {
        $result = array();
        foreach ($arr as  $key=>$val){
            if (strpos($val, $search)!==false){
                $result[] = $key;
            }
        }
        return $result;
    }

}
