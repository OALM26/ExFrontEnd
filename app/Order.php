<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;

class Order extends Model
{
    public function GetOrders()
    {   
        //Token
        $Token = env('TOKEN');
        $header = array('Authorization'=>$Token);

        //Llamado y resuesta del API
        $client = new Client();

        $response = $client->get('https://eshop-deve.herokuapp.com/api/v2/orders', array('headers' => $header));
        $response = json_decode($response->getBody()->getContents());
        $response = $response->orders;

        //Creación de Array para la información de las ordenes
        $Orders=[];
        foreach($response as $res)
        {
           $Orders[]=["id"=>$res->id,
            "OrderNumber"=>$res->number,
            "Status"=>$res->status->financial,
            "Total"=>($res->totals->total-$res->totals->discount),
            "Items"=>$res->items];
        }

        return $Orders;
    }
}
