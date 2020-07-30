<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use function Psy\debug;

class FatComparativoController extends Controller
{
    /**
     * @var \Illuminate\Session\SessionManager|\Illuminate\Session\Store
     */
    protected $token;

    public function __construct()
    {
        $this->token = session('token');
    }

    public function index(){
        return view('pages.fat-comp.fat-comp');
    }

    public function getCompFatFiscal(Request $request){
        $token =  session('token');
        $headers = [ 'Authorization' => "Bearer $token" ];
        $ano = $request->input('ano');
        $client = new Client(['base_url' =>  env('API_URL')]);
        $client->setDefaultOption('verify', base_path() . env('SSL'));
        $res = $client->get(
            '/getCompFatFiscal?ano='.$ano,
            Array('headers' => $headers)
        );
        return response($res->getBody());
    }

    public function getCompFatGerencial(Request $request){
        $token =  session('token');
        $headers = [ 'Authorization' => "Bearer $token" ];
        $ano = $request->input('ano');
        $client = new Client(['base_url' =>  env('API_URL')]);
        $client->setDefaultOption('verify', base_path() . env('SSL'));
        $res = $client->get(
            '/getCompFatGerencial?ano='.$ano,
            Array('headers' => $headers)
        );
        return response($res->getBody());
    }

}
