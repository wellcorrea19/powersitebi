<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use function Psy\debug;

class FaturamentoController extends Controller
{
    /**
     * @var \Illuminate\Session\SessionManager|\Illuminate\Session\Store
     */

    public function index(){
        return view('pages.fat.faturamento');
    }

    public function getFatFiscal(){
        
        $dados = DB::select('appbi.nfaemp = label',('sum(appbi.total) = value'))
                    ->from('appbi')
                    ->where('appbi.cnpjcli = 24.504.241/0001-36')
                    ->and('appbi.dataemi' >= '01-jan-2000')
                    ->and('appbi.dataemi' <='22-jul-2020')
                    ->and('appbi.tipodoc = RPS' OR 'appbi.tipodoc = CTe' OR 'appbi.tipodoc = NFSe')
                    ->groupby('appbi(nfaemp)');
                    
        return view('fat.faturamento', ['appbi' => $dados]);
    }
}
