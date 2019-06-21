<?php

namespace App\Http\Controllers;

use App\Library\ParseXml;
use App\Models\Account;
use App\Models\Distribution;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class HomeController extends Controller {
    /**
     * @var Distribution
     */
    private $distribution;
    /**
     * @var Account
     */
    private $account;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Distribution $distribution, Account $account){
        $this->middleware('auth');
        $this->distribution = $distribution;
        $this->account = $account;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $user = auth()->user();
        $account = $user->account;
        $distribution = $user->account->distribution;
        $sum = $account->summ;
        $client = new Client();
        $response = $client->get('http://www.cbr.ru/scripts/XML_daily.asp');
        if($response->getStatusCode() === 200){
            $parseXml = new ParseXml($response->getBody()->getContents());
            $usd = $this->distribution->sum($sum, $distribution->usd, $parseXml->usd);
            $euro = $this->distribution->sum($sum, $distribution->euro, $parseXml->euro);
            $rub = $this->distribution->sum($sum, $distribution->rub);
            return view('home', compact('user', 'usd', 'euro', 'rub'));
        }

        return 'API для получения курса валют не отвечает';

    }
}
