<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\News;
use App\Models\NewsCalendar;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public $cat = 'forex';
    public $pairs = [
        // 'BINANCE:BTCUSDT'=>"BTC/USD",
        // 'BINANCE:ETHUSDT'=>"ETH/USD",
        // 'OANDA:XAU_USD'=>"GOLD/USD",
        // 'OANDA:GBP_JPY'=>"GBP/JPY",
        // 'OANDA:EUR_USD'=>"EUR/USD",
    ];
    public function home(){
        $getCat = request()->get('cat');
        if(empty($getCat)){
            $getTradingType = \App\Models\UserSetting::getTradingType();
            if(!empty($getTradingType[0]??null)){
                $getCat = strtolower($getTradingType[0]->value);
            }
        }
        if($getCat == 'stock'){
            $getCat = 'merger';
        }
        $supportCats = ['general','forex', 'crypto', 'merger'];
        in_array($getCat,$supportCats)? $this->cat = $getCat:'';//general, forex, crypto, merger

        $getLastNews = News::select('created_at','news_id')->where('category',$this->cat)->orderBy('id', 'DESC')->first();
        $needFetch = !empty($getLastNews)?false:true;
        $lastId = 0;
        if(!empty($getLastNews)){
            // Your datetime value (replace this with your actual datetime value)
            $yourDatetime = Carbon::parse($getLastNews->created_at);
            // Current time
            $currentTime = Carbon::now();
            // Check if the difference is greater than 2 hours
            if ($yourDatetime->diffInHours($currentTime) > 2) {
                $needFetch = true;
            }
            $lastId = $getLastNews->news_id;
        }

        if($needFetch){
            $this->getNewsApi($lastId);
        }
        $allNews = News::orderBy('id', 'DESC')->where('category',$this->cat)->paginate(15);
        $pairs = $this->pairs;
        $getCalendar = [];//$this->getCalendar();

        return view('news',compact('allNews','pairs','getCalendar'));
    }

    public function view($id){
        $news = News::where('id',$id)->first();
        $view = view('partials.news-view',compact('news'))->render();
        return response($view);
    }

    public function getCalendar(){
        // Get the start and end dates of the current week
        $startDate = Carbon::now()->startOfWeek();
        $endDate = Carbon::now()->endOfWeek();
        $getCat = request()->get('cat');
        $type = NewsCalendar::TYPE_FOREX;
        if($getCat=='forex'){
            $type = NewsCalendar::TYPE_FOREX;
        }elseif($getCat=='crypto'){
            $type = NewsCalendar::TYPE_CRYPTO;
        }
        elseif($getCat=='stock'){
            $type = NewsCalendar::TYPE_STOCK;
        }
        if($type == NewsCalendar::TYPE_FOREX){
            // Query the database to retrieve records created within the current week
            $recordsThisWeek = NewsCalendar::whereBetween('created_at', [$startDate, $endDate])->where('type',$type)->whereNotNull('data')->first();
            if($recordsThisWeek){
                return $recordsThisWeek;
            }
            $data = file_get_contents('https://nfs.faireconomy.media/ff_calendar_thisweek.json');
            $insertGetId = NewsCalendar::insertGetId([
                'type'=>$type,
                'data'=>$data,
                'created_at'=>getCurrentDatetime()
            ]);
            return NewsCalendar::where('id',$insertGetId)->first();
        }
        return null;
    }

    public function getNewsApi($lastId = 0){

        $url = 'https://finnhub.io/api/v1/news?category='.$this->cat.'&minId='.$lastId;
        $client = new \GuzzleHttp\Client([
            "headers"=>[
                "X-Finnhub-Token"=>env("FINNHUB_API_KEY")
            ]
        ]);
        try 
        {
            
            $request = $client->get($url);
            $response = $request->getBody()->getContents();
            $datas = json_decode($response);
            
            $forInsert = [];
            foreach ($datas as $key => $news) {
                $forInsert[]=[
                    "category"=>$news->category,
                    "headline"=>$news->headline,
                    "news_id"=>$news->id,
                    "news_date"=>Carbon::parse($news->datetime)->toDateTimeString(),
                    "image"=>$news->image,
                    "related"=>$news->related,
                    "source"=>$news->source,
                    "summary"=>$news->summary,
                    "url"=>$news->url,
                    'created_at' => getCurrentDatetime(),
                    'updated_at' => getCurrentDatetime()
                ];
            }
            
            $forInsert = array_reverse($forInsert);
            // dd($forInsert);
            News::insert($forInsert);
            return $forInsert;
        } catch (\Throwable $th) {
            // dd($th);
            throw $th;
            
        }
        
    }
}
