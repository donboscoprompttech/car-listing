<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;
use App\Models\Banner;
use App\Models\FeaturedDealers;
use App\Models\VehicleType;
use App\Models\Ads;
use App\Models\AdsImage;
use App\Models\MotorCustomeValues;
use DB;
use Exception;
use App\Models\Questions;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Input;
use App\Models\AdsInterior;
use App\Models\AdsExterior;
use App\Models\Dynamiccontents;
use App\Models\User;
use App\Models\SocialLink;
use App\Models\Features;

class ServiceController extends Controller
{

    public function index()
    {
        try {
            $testimonial = Testimonial::orderBy('sortorder')->where('status', 1)
                ->get();
            $banner = Banner::where('page', 'First Page')->get();
            $bannerfirst = $banner->first();
            $footerimg = Banner::where('page', 'Footer')->first();
            $question1img = Banner::where('page', 'Faq1')->first();
            $question2img = Banner::where('page', 'Faq2')->first();
            $videoimg = Banner::where('page', 'Video Image')->first();

            $video = Banner::where('page', 'Video')->first();
            $globe = Banner::where('page', 'globe')->first();
            $brands = FeaturedDealers::orderBy('dealer_name')
                ->orderBy('created_at', 'desc')
                ->get();
            $vehicletype = VehicleType::orderBy('name')
                ->get();
            $questions = Questions::get();
            $subcategory = Subcategory::orderBy('sort_order')->where('status', 1)
                ->get();

            $vehicletypecars = Ads::select("ads.*", "ads.canonical_name as mainid", "subcategories.*", "ads_images.*", 'motor_custome_values.*', "model_msts.name as modelname", "make_msts.name as makename")->leftjoin("ads_images", "ads.id", "=", "ads_images.ads_id")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("subcategories", "ads.subcategory_id", "=", "subcategories.id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->where("ads_images.vehicletype", 1)->where("ads.delete_status", 0)->orderBy('ads.sortorder')->limit(8)->get();
            //
            $sqlQuery = "select `motor_custome_values`.make_id, `make_msts`.`name` as `makename` from `motor_custome_values` left join `make_msts` on `motor_custome_values`.`make_id` = `make_msts`.`id` where make_msts.status=1 group by make_id,makename order by sort_order";
            $make = DB::select(DB::raw($sqlQuery));
            $sqlQuery = "select `motor_custome_values`.model_id, `model_msts`.`name` as `modelname` from `motor_custome_values` left join `model_msts` on `motor_custome_values`.`model_id` = `model_msts`.`id` where model_msts.status=1 group by model_id,modelname order by model_msts.sort_order";
            $model = DB::select(DB::raw($sqlQuery));
            //$sqlQuery = "select distinct registration_year from motor_custome_values left join `ads` on `motor_custome_values`.`ads_id` = `ads`.`id`order by registration_year";
            $sqlQuery = "select distinct registration_year from motor_custome_values left join `ads` on `motor_custome_values`.`ads_id` = `ads`.`id` where ads.delete_status=0 order by registration_year ";
            $year = DB::select(DB::raw($sqlQuery));
            $showcarsfirst = Ads::select("ads.*")->skip(0)->take(8)->orderby('id','desc')->where("ads.delete_status", 0)->get();
            $showcarssecond = Ads::select("ads.*")->skip(7)->take(7)->orderby('id','desc')->where("ads.delete_status", 0)->get();
            $contents = Dynamiccontents::first();
            $profile = User::first();
            $sociallinks = SocialLink::get();
            return view('cars.index', compact('testimonial', 'bannerfirst', 'brands', 'vehicletype', 'vehicletypecars', 'questions', 'make', 'model', 'year', 'footerimg', 'question1img', 'question2img', 'videoimg', 'video', 'globe', 'subcategory', 'showcarsfirst', 'showcarssecond', 'contents', 'profile', 'sociallinks'));
        } catch (exception $e) {
            $message = $e->getMessage();
            return view('cars.errorpage', compact('message'));
        }
    }
    public function carsearch()
    {
        try {
            $testimonial = Testimonial::orderBy('sortorder')->where('status', 1)
                ->get();

            $brands = FeaturedDealers::orderBy('dealer_name')
                ->orderBy('created_at', 'desc')
                ->get();
            $questions = Questions::get();
            $footerimg = Banner::where('page', 'Footer')->first();
            $searchresult = Banner::where('page', 'searchresult')->first();
            $showcarsfirst = Ads::select("ads.*")->skip(0)->take(8)->orderby('id','desc')->where("ads.delete_status", 0)->get();
            $showcarssecond = Ads::select("ads.*")->skip(7)->take(7)->orderby('id','desc')->where("ads.delete_status", 0)->get();
            $contents = Dynamiccontents::first();

            return view('cars.search', compact('testimonial', 'brands', 'questions', 'searchresult', 'showcarsfirst', 'showcarssecond'));
        } catch (exception $e) {
            $message = $e->getMessage();
            return view('cars.errorpage', compact('message'));
        }
    }

    function detailsshow($id)
    {
        $iddt = Ads::where('canonical_name', $id)->first();
        $idval = $iddt->id;
        $vehicleimages = Adsimage::where('ads_id', $idval)->get();
        $vehicleinterior = AdsInterior::leftjoin("interiormaster", "ads_interior.interior_id", "=", "interiormaster.id")->where('ads_id', $idval)->get();
        $vehicleexterior = AdsExterior::leftjoin("exteriormaster", "ads_exterior.exterior_id", "=", "exteriormaster.id")->where('ads_id', $idval)->get();
        $vehicletypecars = Ads::select("ads.*", "ads.id as mainid1", "ads.canonical_name as mainid", "vehicletype.*", "vehicletype.name as bodyname", "ads_images.*", 'motor_custome_values.*', "model_msts.name as modelname", "make_msts.name as makename", 'places.name as placename', 'countries.name as countryname', 'phone','phone_hide_flag')->leftjoin("ads_images", "ads.id", "=", "ads_images.ads_id")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("vehicletype", "ads.vehicletype", "=", "vehicletype.id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->leftjoin("seller_information", "seller_information.id", "=", "ads.sellerinformation_id")->where('ads.canonical_name', $id)->first();
$features = Features::join("motor_features","features.id","=","motor_features.value")->select("motor_features.*","features.featuretext as featuresname")->where('ads_id', $idval)->orderBy('sortorder')->get();
        $subcategory = Subcategory::orderBy('sort_order')->where('status', 1)
            ->get();
         $showcarsfirst = Ads::select("ads.*")->skip(0)->take(8)->orderby('id','desc')->where("ads.delete_status", 0)->get();
            $showcarssecond = Ads::select("ads.*")->skip(7)->take(7)->orderby('id','desc')->where("ads.delete_status", 0)->get();
        $contents = Dynamiccontents::first();
        $profile = User::first();
        $sociallinks = SocialLink::get();
        return view('cars.details', compact('vehicletypecars', 'vehicleimages', 'subcategory', 'vehicleinterior', 'vehicleexterior', 'showcarsfirst', 'showcarssecond', 'contents', 'profile', 'sociallinks','features'));
    }


public function searchresult(Request $request)
    {
        try {
            $testimonial = Testimonial::orderBy('sortorder')->where('status', 1)
                ->get();
            $searchresult = Banner::where('page', 'search result')->first();
            $footerimg = Banner::where('page', 'Footer')->first();
            $question1img = Banner::where('page', 'Faq1')->first();
            $question2img = Banner::where('page', 'Faq2')->first();
            $videoimg = Banner::where('page', 'Video Banner')->first();
            $globe = Banner::where('page', 'globe')->first();
            $brands = FeaturedDealers::orderBy('dealer_name')
                ->orderBy('created_at', 'desc')
                ->get();
            $questions = Questions::get();
            $sqlQuery = "select max(price) as price from ads";
            $maxprice =  DB::select(DB::raw($sqlQuery));
            $sqlQuery = "select min(price) as price from ads";
            $minprice =  DB::select(DB::raw($sqlQuery));

            $make = $request->make;
            $model = $request->model;
            $year = $request->year;
            $make1=$make;
            $model1=$model;
            $year1=$year;
            $keywordsearch = $request->keywordsearch;
            $vehicletypecars = array();
            $pageflag = $request->pageflag;
            $subcategory = Subcategory::orderBy('sort_order')->where('status', 1)
                ->get();
                $flag=0;
            if ($pageflag == 1) {
                if (($year != '0') && ($make == '0') && ($model == '0')) {
                    $flag=1;
                    $vehicletypecars = Ads::select("ads.*", "ads.canonical_name as mainid","ads.id as mainid1", "vehicletype.*",  'motor_custome_values.*', "model_msts.name as modelname", 'places.name as placename', 'countries.name as countryname', "make_msts.name as makename")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("vehicletype", "ads.vehicletype", "=", "vehicletype.id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->where("ads.delete_status", 0)->where("motor_custome_values.registration_year", $year)->orderBy('ads.sortorder')->paginate(9);
                } else if (($year == '0') && ($make != '0') && ($model == '0')) {
                    $flag=2;
                    $vehicletypecars = Ads::select("ads.*", "ads.canonical_name as mainid","ads.id as mainid1",  "vehicletype.*", 'motor_custome_values.*', "model_msts.name as modelname", 'places.name as placename', 'countries.name as countryname', "make_msts.name as makename")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("vehicletype", "ads.vehicletype", "=", "vehicletype.id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->where("ads.delete_status", 0)->where("motor_custome_values.make_id", $make)->orderBy('ads.sortorder')->paginate(9);
                } else if (($year == '0') && ($make == '0') && ($model != '0')) {
                    $flag=3;
                    $vehicletypecars = Ads::select("ads.*", "ads.canonical_name as mainid","ads.id as mainid1",  "vehicletype.*",  'motor_custome_values.*', "model_msts.name as modelname", 'places.name as placename', 'countries.name as countryname', "make_msts.name as makename")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("vehicletype", "ads.vehicletype", "=", "vehicletype.id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->where("ads.delete_status", 0)->where("motor_custome_values.model_id", $model)->orderBy('ads.sortorder')->paginate(9);
                } else if (($year != '0') && ($make != '0') && ($model != '0')) {
                    $flag=4;
                    $vehicletypecars = Ads::select("ads.*", "ads.canonical_name as mainid","ads.id as mainid1",  "vehicletype.*",  'motor_custome_values.*', "model_msts.name as modelname", 'places.name as placename', 'countries.name as countryname', "make_msts.name as makename")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("vehicletype", "ads.vehicletype", "=", "vehicletype.id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->where("ads.delete_status", 0)->where("motor_custome_values.model_id", $model)->where("motor_custome_values.registration_year", $year)->where("motor_custome_values.make_id", $make)->orderBy('ads.sortorder')->paginate(9);
                } else if (($year == '0') && ($make != '0') && ($model != '0')) {
                    $flag=5;
                    $vehicletypecars = Ads::select("ads.*", "ads.canonical_name as mainid","ads.id as mainid1",  "vehicletype.*",  'motor_custome_values.*', "model_msts.name as modelname", 'places.name as placename', 'countries.name as countryname', "make_msts.name as makename")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("vehicletype", "ads.vehicletype", "=", "vehicletype.id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->where("ads.delete_status", 0)->where("motor_custome_values.model_id", $model)->where("motor_custome_values.make_id", $make)->orderBy('ads.sortorder')->paginate(9);
                } else if (($year != '0') && ($make != '0') && ($model == '0')) {
                    $flag=6;
                    $vehicletypecars = Ads::select("ads.*", "ads.canonical_name as mainid","ads.id as mainid1",  "vehicletype.*",  'motor_custome_values.*', "model_msts.name as modelname", 'places.name as placename', 'countries.name as countryname', "make_msts.name as makename")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("vehicletype", "ads.vehicletype", "=", "vehicletype.id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->where("ads.delete_status", 0)->where("motor_custome_values.make_id", $make)->where("motor_custome_values.registration_year", $year)->orderBy('ads.sortorder')->paginate(9);
                } else if (($year != '0') && ($make == '0') && ($model != '0')) {
                    $flag=7;
                    $vehicletypecars = Ads::select("ads.*", "ads.canonical_name as mainid","ads.id as mainid1",  "vehicletype.*", 'motor_custome_values.*', "model_msts.name as modelname", 'places.name as placename', 'countries.name as countryname', "make_msts.name as makename")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("vehicletype", "ads.vehicletype", "=", "vehicletype.id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->where("ads.delete_status", 0)->where("motor_custome_values.model_id", $model)->where("motor_custome_values.registration_year", $year)->orderBy('ads.sortorder')->paginate(9);
                } else {
                    $flag=8;
                    $vehicletypecars = Ads::select("ads.*", "ads.canonical_name as mainid", "vehicletype.*", 'motor_custome_values.*',"ads.id as mainid1",  "model_msts.name as modelname", 'places.name as placename', 'countries.name as countryname', "make_msts.name as makename")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("vehicletype", "ads.vehicletype", "=", "vehicletype.id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->where("ads.delete_status", 0)->orderBy('ads.sortorder')->paginate(9);
                }


                $sqlQuery = "select `motor_custome_values`.make_id, `make_msts`.`name` as `makename` from `motor_custome_values` left join `make_msts` on `motor_custome_values`.`make_id` = `make_msts`.`id` group by make_id,makename";
                $make = DB::select(DB::raw($sqlQuery));
                $sqlQuery = "select `motor_custome_values`.model_id, `model_msts`.`name` as `modelname` from `motor_custome_values` left join `model_msts` on `motor_custome_values`.`model_id` = `model_msts`.`id` group by model_id,modelname";
                $model = DB::select(DB::raw($sqlQuery));
                $sqlQuery = "select distinct registration_year from motor_custome_values order by registration_year";
                $year = DB::select(DB::raw($sqlQuery));
            } else {

                $priceflag = $request->priceflag;
                if ($priceflag == 1) {
                    $amount = $request->amount;
                    $amountarr = explode("-", $amount);
                    $minprice1 = $amountarr[0];
                    $maxprice1 = $amountarr[1];
                    $maxpricearr = explode("AED", $maxprice1);
                    $maxpriceval = $maxpricearr[1];
                    $minpricearr = explode("AED", $minprice1);
                    $minpriceval = trim($minpricearr[1]);
                }

                if (($year != '0') && ($make == '0') && ($model == '0') && ($priceflag == 0) && ($keywordsearch == '')) {
                    // "year alone";
                    $flag=9;

                    $vehicletypecars = Ads::select("ads.*", "ads.canonical_name as mainid", "vehicletype.*",  'motor_custome_values.*',"ads.id as mainid1",  "model_msts.name as modelname", 'places.name as placename', 'countries.name as countryname', "make_msts.name as makename")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("vehicletype", "ads.vehicletype", "=", "vehicletype.id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->where("ads.delete_status", 0)->where("ads_images.vehicletype", 1)->where("motor_custome_values.registration_year", $year)->orderBy('ads.sortorder')->paginate(9);
                } else if (($year != '0') && ($make == '0') && ($model == '0') && ($priceflag != 0) && ($keywordsearch == '')) {
                    // "year and price";
                    $flag=10;
                    $vehicletypecars = Ads::select("ads.*", "ads.canonical_name as mainid", "vehicletype.*", 'motor_custome_values.*',"ads.id as mainid1",  'places.name as placename', 'countries.name as countryname', "model_msts.name as modelname", "make_msts.name as makename")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("vehicletype", "ads.vehicletype", "=", "vehicletype.id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->where("ads.delete_status", 0)->where("motor_custome_values.registration_year", $year)->where("ads_images.vehicletype", 1)->where('ads.price', '>=', "$minpriceval")->where('ads.price', '<=', "$maxpriceval")->orderBy('ads.sortorder')->paginate(9);
                } else if (($year == '0') && ($make != '0') && ($model == '0') && ($priceflag == 0) && ($keywordsearch == '')) {
                    // "make alone";
                    $flag=11;
                    $vehicletypecars = Ads::select("ads.*", "ads.canonical_name as mainid","ads.id as mainid1",  "vehicletype.*", 'places.name as placename', 'countries.name as countryname', "ads_images.vehicletype as type1", 'motor_custome_values.*', "model_msts.name as modelname", "make_msts.name as makename")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("vehicletype", "ads.vehicletype", "=", "vehicletype.id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->where("ads.delete_status", 0)->where("motor_custome_values.make_id", $make)->orderBy('ads.sortorder')->paginate(9);
                } else if (($year == '0') && ($make != '0') && ($model == '0') && ($priceflag == 1) && ($keywordsearch == '')) {
                    ///"make and price";
                    $flag=12;
                    $vehicletypecars = Ads::select("ads.*", "ads.canonical_name as mainid", "vehicletype.*",  'places.name as placename',"ads.id as mainid1",  'countries.name as countryname', "ads_images.vehicletype as type1", 'motor_custome_values.*', "model_msts.name as modelname", "make_msts.name as makename")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("vehicletype", "ads.vehicletype", "=", "vehicletype.id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->where("ads.delete_status", 0)->where("motor_custome_values.make_id", $make)->where('ads.price', '>=', "$minpriceval")->where('ads.price', '<=', "$maxpriceval")->orderBy('ads.sortorder')->paginate(9);
                } else if (($year == '0') && ($make == '0') && ($model != '0') && ($priceflag == 0) && ($keywordsearch == '')) {
                    // "model alone";
                    $flag=13;
                    $vehicletypecars = Ads::select("ads.*", "ads.canonical_name as mainid", "vehicletype.*", 'places.name as placename',"ads.id as mainid1",  'countries.name as countryname', "ads_images.vehicletype as type1", 'motor_custome_values.*', "model_msts.name as modelname", "make_msts.name as makename")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("vehicletype", "ads.vehicletype", "=", "vehicletype.id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->where("ads.delete_status", 0)->where("motor_custome_values.model_id", $model)->orderBy('ads.sortorder')->paginate(9);
                } else if (($year == '0') && ($make == '0') && ($model != '0') && ($priceflag == 1) && ($keywordsearch == '')) {
                    //"model and price";
                    $flag=14;
                    $vehicletypecars = Ads::select("ads.*", "ads.canonical_name as mainid","ads.id as mainid1",  "vehicletype.*",  'places.name as placename', 'countries.name as countryname', "ads_images.vehicletype as type1", 'motor_custome_values.*', "model_msts.name as modelname", "make_msts.name as makename")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("vehicletype", "ads.vehicletype", "=", "vehicletype.id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->where("ads.delete_status", 0)->where("motor_custome_values.model_id", $model)->where('ads.price', '>=', "$minpriceval")->where('ads.price', '<=', "$maxpriceval")->orderBy('ads.sortorder')->paginate(9);
                } else if (($year == '0') && ($make == '0') && ($model == '0') && ($priceflag != 0) && ($keywordsearch == '')) {
                    // "price alone";
                    $flag=15;
                    $vehicletypecars = Ads::select("ads.*", "ads.canonical_name as mainid","ads.id as mainid1",  "vehicletype.*",  'places.name as placename', 'countries.name as countryname', "ads_images.vehicletype as type1", 'motor_custome_values.*', "model_msts.name as modelname", "make_msts.name as makename")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("vehicletype", "ads.vehicletype", "=", "vehicletype.id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->where("ads.delete_status", 0)->where('ads.price', '>=', "$minpriceval")->where('ads.price', '<=', "$maxpriceval")->orderBy('ads.sortorder')->paginate(9);
                } else if (($year != '0') && ($make != '0') && ($model != '0') && ($priceflag != 0) && ($keywordsearch == '')) {
                    //"all";
                    $flag=16;
                    $vehicletypecars = Ads::select("ads.*", "ads.canonical_name as mainid","ads.id as mainid1",  "vehicletype.*",  'places.name as placename', 'countries.name as countryname', "ads_images.vehicletype as type1", 'motor_custome_values.*', "model_msts.name as modelname", "make_msts.name as makename")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("vehicletype", "ads.vehicletype", "=", "vehicletype.id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->where("motor_custome_values.model_id", $model)->where("motor_custome_values.registration_year", $year)->where("ads.delete_status", 0)->where("motor_custome_values.make_id", $make)->where('ads.price', '>=', "$minpriceval")->where('ads.price', '<=', "$maxpriceval")->orderBy('ads.sortorder')->paginate(9);
                } else if (($year == '0') && ($make != '0') && ($model != '0') && ($priceflag != 0) && ($keywordsearch == '')) {
                    //"make,model,price";
                    $flag=17;
                    $vehicletypecars = Ads::select("ads.*", "ads.canonical_name as mainid","ads.id as mainid1",  "vehicletype.*",  'places.name as placename', 'countries.name as countryname', "ads_images.vehicletype as type1", 'motor_custome_values.*', "model_msts.name as modelname", "make_msts.name as makename")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("vehicletype", "ads.vehicletype", "=", "vehicletype.id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->where("ads.delete_status", 0)->where("motor_custome_values.model_id", $model)->where("motor_custome_values.make_id", $make)->where('ads.price', '>=', "$minpriceval")->where('ads.price', '<=', "$maxpriceval")->orderBy('ads.sortorder')->paginate(9);
                } else if (($year != '0') && ($make != '0') && ($model == '0') && ($priceflag != 0) && ($keywordsearch == '')) {
                    // "year,make,price";
                    $flag=18;
                    $vehicletypecars = Ads::select("ads.*", "ads.canonical_name as mainid","ads.id as mainid1",  "vehicletype.*",  'places.name as placename', 'countries.name as countryname', 'motor_custome_values.*', "model_msts.name as modelname", "make_msts.name as makename")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("vehicletype", "ads.vehicletype", "=", "vehicletype.id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->where("ads.delete_status", 0)->where("motor_custome_values.make_id", $make)->where("motor_custome_values.registration_year", $year)->where('ads.price', '>=', "$minpriceval")->where('ads.price', '<=', "$maxpriceval")->orderBy('ads.sortorder')->paginate(9);
                } else if (($year != '0') && ($make == '0') && ($model != '0') && ($priceflag != 0) && ($keywordsearch == '')) {
                    //"year,model,price";
                    $flag=19;
                    $vehicletypecars = Ads::select("ads.*", "ads.canonical_name as mainid","ads.id as mainid1",  "vehicletype.*",  'places.name as placename', 'countries.name as countryname',  'motor_custome_values.*', "model_msts.name as modelname", "make_msts.name as makename")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->leftjoin("vehicletype", "ads.vehicletype", "=", "vehicletype.id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->where("ads.delete_status", 0)->where("motor_custome_values.model_id", $model)->where("motor_custome_values.registration_year", $year)->where('ads.price', '>=', "$minpriceval")->where('ads.price', '<=', "$maxpriceval")->orderBy('ads.sortorder')->paginate(9);
                } else if (($year != '0') && ($make != '0') && ($model != '0') && ($priceflag == 0) && ($keywordsearch == '')) {
                    //"year,model,make,price=0";
                    $flag=20;
                    $vehicletypecars = Ads::select("ads.*", "ads.canonical_name as mainid","ads.id as mainid1",  "vehicletype.*",  'places.name as placename', 'countries.name as countryname',  'motor_custome_values.*', "model_msts.name as modelname", "make_msts.name as makename")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("vehicletype", "ads.vehicletype", "=", "vehicletype.id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->where("ads.delete_status", 0)->where("motor_custome_values.model_id", $model)->where("motor_custome_values.registration_year", $year)->where("motor_custome_values.make_id", $make)->orderBy('ads.sortorder')->paginate(9);
                } else if (($year == '0') && ($make != '0') && ($model != '0') && ($priceflag == 0) && ($keywordsearch == '')) {
                    //"model,make,price=0";
                    $flag=21;
                    $vehicletypecars = Ads::select("ads.*", "ads.canonical_name as mainid","ads.id as mainid1",  "vehicletype.*",  'places.name as placename', 'countries.name as countryname',  'motor_custome_values.*', "model_msts.name as modelname", "make_msts.name as makename")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->leftjoin("vehicletype", "ads.vehicletype", "=", "vehicletype.id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->where("ads.delete_status", 0)->where("motor_custome_values.model_id", $model)->where("motor_custome_values.make_id", $make)->orderBy('ads.sortorder')->paginate(9);
                } else if (($year != '0') && ($make != '0') && ($model == '0') && ($priceflag == 0) && ($keywordsearch == '')) {
                    //"year,make,price=0";
                    $flag=22;
                    $vehicletypecars = Ads::select("ads.*", "ads.canonical_name as mainid","ads.id as mainid1",  "vehicletype.*",  'places.name as placename', 'countries.name as countryname',  'motor_custome_values.*', "model_msts.name as modelname", "make_msts.name as makename")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("vehicletype", "ads.vehicletype", "=", "vehicletype.id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->where("ads.delete_status", 0)->where("motor_custome_values.make_id", $make)->where("motor_custome_values.registration_year", $year)->orderBy('ads.sortorder')->paginate(9);
                } else if (($year != '0') && ($make == '0') && ($model != '0') && ($priceflag == 0) && ($keywordsearch == '')) {
                    //"year,model,price=0";
                    $flag=23;
                    $vehicletypecars = Ads::select("ads.*", "ads.canonical_name as mainid","ads.id as mainid1",  "vehicletype.*", 'places.name as placename', 'countries.name as countryname',  'motor_custome_values.*', "model_msts.name as modelname", "make_msts.name as makename")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("vehicletype", "ads.vehicletype", "=", "vehicletype.id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->where("ads.delete_status", 0)->where("motor_custome_values.model_id", $model)->where("motor_custome_values.registration_year", $year)->orderBy('ads.sortorder')->paginate(9);
                }





                 else if (($keywordsearch != '') && ($priceflag == 0)) {

                    $flag=24;
                    //DB::enableQueryLog();
                    $vehicletypecars = Ads::select("ads.*", "ads.canonical_name as mainid", "vehicletype.*",  'places.name as placename',"ads.id as mainid1",  'countries.name as countryname', 'motor_custome_values.*', "model_msts.name as modelname", "make_msts.name as makename")->leftjoin("ads_images as adm", "ads.id", "=", "adm.ads_id")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("vehicletype", "ads.vehicletype", "=", "vehicletype.id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->where("ads.delete_status", 0)->where("motor_custome_values.registration_year", $keywordsearch)->orwhere("ads.title", 'like', "%$keywordsearch%")->orwhere("make_msts.name", 'like', "%$keywordsearch%")->orwhere("model_msts.name", 'like', "%$keywordsearch%")->paginate(9);
                    //$quries = DB::getQueryLog();
                    //print_r($quries);
//dd($quries);
                } else if (($keywordsearch != '') && ($priceflag == 1)) {
                    $flag=25;
                    $vehicletypecars = Ads::select("ads.*", "ads.canonical_name as mainid","ads.id as mainid1",  "vehicletype.*", 'places.name as placename', 'countries.name as countryname',  'motor_custome_values.*', "model_msts.name as modelname", "make_msts.name as makename")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("vehicletype", "ads.vehicletype", "=", "vehicletype.id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->where("ads.delete_status", 0)->where("motor_custome_values.model_id", $model)->where("motor_custome_values.registration_year", $keywordsearch)->orwhere("ads.title", 'like', "%$keywordsearch%")->orwhere("make_msts.name", 'like', "%$keywordsearch%")->orwhere("model_msts.name", 'like', "%$keywordsearch%")->where('ads.price', '>=', "$minpriceval")->where('ads.price', '<=', "$maxpriceval")->orderBy('ads.sortorder')->paginate(9);
                } else if (($keywordsearch == '') && ($priceflag == 1)) {
                    $flag=26;
                    $vehicletypecars = Ads::select("ads.*", "ads.canonical_name as mainid","ads.id as mainid1",  "vehicletype.*",  'places.name as placename', 'countries.name as countryname',  'motor_custome_values.*', "model_msts.name as modelname", "make_msts.name as makename")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("vehicletype", "ads.vehicletype", "=", "vehicletype.id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->where("ads.delete_status", 0)->where('ads.price', '>=', "$minpriceval")->where('ads.price', '<=', "$maxpriceval")->orderBy('ads.sortorder')->paginate(9);
                } else {
                    //echo "hello";
                    $flag=27;
                    $vehicletypecars = Ads::select("ads.*", "ads.canonical_name as mainid","ads.id as mainid1",  "vehicletype.*", 'places.name as placename', 'countries.name as countryname',  'motor_custome_values.*', "model_msts.name as modelname", "make_msts.name as makename")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->leftjoin("vehicletype", "ads.vehicletype", "=", "vehicletype.id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->where("ads.delete_status", 0)->orderBy('ads.sortorder')->paginate(9);
                }}

                //dd($flag);
                $sqlQuery = "select `motor_custome_values`.make_id, `make_msts`.`name` as `makename`,sort_order from `motor_custome_values` left join `make_msts` on `motor_custome_values`.`make_id` = `make_msts`.`id` where make_msts.status=1 group by make_id,makename,sort_order order by make_msts.sort_order";
                $make = DB::select(DB::raw($sqlQuery));
                
                $sqlQuery = "select `motor_custome_values`.model_id, `model_msts`.`name` as `modelname` from `motor_custome_values` left join `model_msts` on `motor_custome_values`.`model_id` = `model_msts`.`id` where model_msts.status=1 group by model_id,modelname order by model_msts.sort_order";
                $model = DB::select(DB::raw($sqlQuery));
                //$sqlQuery = "select distinct registration_year from motor_custome_values order by registration_year";
                $sqlQuery = "select distinct registration_year from motor_custome_values left join `ads` on `motor_custome_values`.`ads_id` = `ads`.`id` where ads.delete_status=0 order by registration_year ";
                $year = DB::select(DB::raw($sqlQuery));
           // }
            $profile = User::first();
            $contents = Dynamiccontents::first();
           $showcarsfirst = Ads::select("ads.*")->skip(0)->take(8)->orderby('id','desc')->where("ads.delete_status", 0)->get();
            $showcarssecond = Ads::select("ads.*")->skip(7)->take(7)->orderby('id','desc')->where("ads.delete_status", 0)->get();
            $sociallinks = SocialLink::get();
            //dd("hello");
            return view('cars.search', compact('testimonial', 'brands', 'questions', 'vehicletypecars', 'searchresult', 'footerimg', 'question1img', 'question2img', 'videoimg', 'make', 'model', 'year', 'maxprice', 'minprice', 'globe', 'subcategory', 'showcarsfirst', 'showcarssecond', 'contents', 'profile', 'sociallinks','make','model','year','make1','model1','year1'));
        } catch (exception $e) {
            $message = $e->getMessage();
            return view('cars.errorpage', compact('message'));
        }
    }














    public function searchresult_old(Request $request)
    {
        try {
            $testimonial = Testimonial::orderBy('sortorder')->where('status', 1)
                ->get();
            $searchresult = Banner::where('page', 'search result')->first();
            $footerimg = Banner::where('page', 'Footer')->first();
            $question1img = Banner::where('page', 'Faq1')->first();
            $question2img = Banner::where('page', 'Faq2')->first();
            $videoimg = Banner::where('page', 'Video Banner')->first();
            $globe = Banner::where('page', 'globe')->first();
            $brands = FeaturedDealers::orderBy('dealer_name')
                ->orderBy('created_at', 'desc')
                ->get();
            $questions = Questions::get();
            $sqlQuery = "select max(price) as price from ads";
            $maxprice =  DB::select(DB::raw($sqlQuery));
            $sqlQuery = "select min(price) as price from ads";
            $minprice =  DB::select(DB::raw($sqlQuery));

            $make = $request->make;
            $model = $request->model;
            $year = $request->year;
            $make1=$make;
            $model1=$model;
            $year1=$year;
            $keywordsearch = $request->keywordsearch;
            $vehicletypecars = array();
            $pageflag = $request->pageflag;
            $subcategory = Subcategory::orderBy('sort_order')->where('status', 1)
                ->get();
            if ($pageflag == 1) {
                if (($year != '0') && ($make == '0') && ($model == '0')) {

                    $vehicletypecars = Ads::select("ads.*", "ads.canonical_name as mainid", "vehicletype.*", "ads_images.*", "ads_images.vehicletype as type1", 'motor_custome_values.*', "model_msts.name as modelname", 'places.name as placename', 'countries.name as countryname', "make_msts.name as makename")->leftjoin("ads_images", "ads.id", "=", "ads_images.ads_id")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("vehicletype", "ads.vehicletype", "=", "vehicletype.id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->where("ads.delete_status", 0)->where("ads_images.vehicletype", 1)->where("motor_custome_values.registration_year", $year)->orderBy('ads.sortorder')->paginate(9);
                } else if (($year == '0') && ($make != '0') && ($model == '0')) {
                    $vehicletypecars = Ads::select("ads.*", "ads.canonical_name as mainid", "vehicletype.*", "ads_images.*", "ads_images.vehicletype as type1", 'motor_custome_values.*', "model_msts.name as modelname", 'places.name as placename', 'countries.name as countryname', "make_msts.name as makename")->leftjoin("ads_images", "ads.id", "=", "ads_images.ads_id")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("vehicletype", "ads.vehicletype", "=", "vehicletype.id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->where("ads.delete_status", 0)->where("ads_images.vehicletype", 1)->where("motor_custome_values.make_id", $make)->orderBy('ads.sortorder')->paginate(9);
                } else if (($year == '0') && ($make == '0') && ($model != '0')) {
                    $vehicletypecars = Ads::select("ads.*", "ads.canonical_name as mainid", "vehicletype.*", "ads_images.*", "ads_images.vehicletype as type1", 'motor_custome_values.*', "model_msts.name as modelname", 'places.name as placename', 'countries.name as countryname', "make_msts.name as makename")->leftjoin("ads_images", "ads.id", "=", "ads_images.ads_id")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("vehicletype", "ads.vehicletype", "=", "vehicletype.id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->where("ads.delete_status", 0)->where("ads_images.vehicletype", 1)->where("motor_custome_values.model_id", $model)->orderBy('ads.sortorder')->paginate(9);
                } else if (($year != '0') && ($make != '0') && ($model != '0')) {
                    $vehicletypecars = Ads::select("ads.*", "ads.canonical_name as mainid", "vehicletype.*", "ads_images.*", "ads_images.vehicletype as type1", 'motor_custome_values.*', "model_msts.name as modelname", 'places.name as placename', 'countries.name as countryname', "make_msts.name as makename")->leftjoin("ads_images", "ads.id", "=", "ads_images.ads_id")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("vehicletype", "ads.vehicletype", "=", "vehicletype.id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->where("ads_images.vehicletype", 1)->where("ads.delete_status", 0)->where("motor_custome_values.model_id", $model)->where("motor_custome_values.registration_year", $year)->where("motor_custome_values.make_id", $make)->orderBy('ads.sortorder')->paginate(9);
                } else if (($year == '0') && ($make != '0') && ($model != '0')) {
                    $vehicletypecars = Ads::select("ads.*", "ads.canonical_name as mainid", "vehicletype.*", "ads_images.*", "ads_images.vehicletype as type1", 'motor_custome_values.*', "model_msts.name as modelname", 'places.name as placename', 'countries.name as countryname', "make_msts.name as makename")->leftjoin("ads_images", "ads.id", "=", "ads_images.ads_id")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("vehicletype", "ads.vehicletype", "=", "vehicletype.id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->where("ads_images.vehicletype", 1)->where("ads.delete_status", 0)->where("motor_custome_values.model_id", $model)->where("motor_custome_values.make_id", $make)->orderBy('ads.sortorder')->paginate(9);
                } else if (($year != '0') && ($make != '0') && ($model == '0')) {
                    $vehicletypecars = Ads::select("ads.*", "ads.canonical_name as mainid", "vehicletype.*", "ads_images.*", "ads_images.vehicletype as type1", 'motor_custome_values.*', "model_msts.name as modelname", 'places.name as placename', 'countries.name as countryname', "make_msts.name as makename")->leftjoin("ads_images", "ads.id", "=", "ads_images.ads_id")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("vehicletype", "ads.vehicletype", "=", "vehicletype.id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->where("ads_images.vehicletype", 1)->where("ads.delete_status", 0)->where("motor_custome_values.make_id", $make)->where("motor_custome_values.registration_year", $year)->orderBy('ads.sortorder')->paginate(9);
                } else if (($year != '0') && ($make == '0') && ($model != '0')) {
                    $vehicletypecars = Ads::select("ads.*", "ads.canonical_name as mainid", "vehicletype.*", "ads_images.*", "ads_images.vehicletype as type1", 'motor_custome_values.*', "model_msts.name as modelname", 'places.name as placename', 'countries.name as countryname', "make_msts.name as makename")->leftjoin("ads_images", "ads.id", "=", "ads_images.ads_id")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("vehicletype", "ads.vehicletype", "=", "vehicletype.id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->where("ads_images.vehicletype", 1)->where("ads.delete_status", 0)->where("motor_custome_values.model_id", $model)->where("motor_custome_values.registration_year", $year)->orderBy('ads.sortorder')->paginate(9);
                } else {
                    $vehicletypecars = Ads::select("ads.*", "ads.canonical_name as mainid", "vehicletype.*", "ads_images.*", "ads_images.vehicletype as type1", 'motor_custome_values.*', "model_msts.name as modelname", 'places.name as placename', 'countries.name as countryname', "make_msts.name as makename")->leftjoin("ads_images", "ads.id", "=", "ads_images.ads_id")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("vehicletype", "ads.vehicletype", "=", "vehicletype.id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->where("ads.delete_status", 0)->where("ads_images.vehicletype", 1)->orderBy('ads.sortorder')->paginate(9);
                }


                $sqlQuery = "select `motor_custome_values`.make_id, `make_msts`.`name` as `makename` from `motor_custome_values` left join `make_msts` on `motor_custome_values`.`make_id` = `make_msts`.`id` group by make_id,makename";
                $make = DB::select(DB::raw($sqlQuery));
                $sqlQuery = "select `motor_custome_values`.model_id, `model_msts`.`name` as `modelname` from `motor_custome_values` left join `model_msts` on `motor_custome_values`.`model_id` = `model_msts`.`id` group by model_id,modelname";
                $model = DB::select(DB::raw($sqlQuery));
                $sqlQuery = "select distinct registration_year from motor_custome_values order by registration_year";
                $year = DB::select(DB::raw($sqlQuery));
            } else {

                $priceflag = $request->priceflag;
                if ($priceflag == 1) {
                    $amount = $request->amount;
                    $amountarr = explode("-", $amount);
                    $minprice1 = $amountarr[0];
                    $maxprice1 = $amountarr[1];
                    $maxpricearr = explode("AED", $maxprice1);
                    $maxpriceval = $maxpricearr[1];
                    $minpricearr = explode("AED", $minprice1);
                    $minpriceval = trim($minpricearr[1]);
                }

                if (($year != '0') && ($make == '0') && ($model == '0') && ($priceflag == 0) && ($keywordsearch == '')) {
                    // "year alone";

                    $vehicletypecars = Ads::select("ads.*", "ads.canonical_name as mainid", "vehicletype.*", "ads_images.*", "ads_images.vehicletype as type1", 'motor_custome_values.*', "model_msts.name as modelname", 'places.name as placename', 'countries.name as countryname', "make_msts.name as makename")->leftjoin("ads_images", "ads.id", "=", "ads_images.ads_id")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("vehicletype", "ads.vehicletype", "=", "vehicletype.id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->where("ads.delete_status", 0)->where("ads_images.vehicletype", 1)->where("motor_custome_values.registration_year", $year)->orderBy('ads.sortorder')->paginate(9);
                } else if (($year != '0') && ($make == '0') && ($model == '0') && ($priceflag != 0) && ($keywordsearch == '')) {
                    // "year and price";

                    $vehicletypecars = Ads::select("ads.*", "ads.canonical_name as mainid", "vehicletype.*", "ads_images.*", "ads_images.vehicletype as type1", 'motor_custome_values.*', 'places.name as placename', 'countries.name as countryname', "model_msts.name as modelname", "make_msts.name as makename")->leftjoin("ads_images", "ads.id", "=", "ads_images.ads_id")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("vehicletype", "ads.vehicletype", "=", "vehicletype.id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->where("ads_images.vehicletype", 1)->where("ads.delete_status", 0)->where("motor_custome_values.registration_year", $year)->where("ads_images.vehicletype", 1)->where('ads.price', '>=', "$minpriceval")->where('ads.price', '<=', "$maxpriceval")->orderBy('ads.sortorder')->paginate(9);
                } else if (($year == '0') && ($make != '0') && ($model == '0') && ($priceflag == 0) && ($keywordsearch == '')) {
                    // "make alone";

                    $vehicletypecars = Ads::select("ads.*", "ads.canonical_name as mainid", "vehicletype.*", "ads_images.*", 'places.name as placename', 'countries.name as countryname', "ads_images.vehicletype as type1", 'motor_custome_values.*', "model_msts.name as modelname", "make_msts.name as makename")->leftjoin("ads_images", "ads.id", "=", "ads_images.ads_id")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("vehicletype", "ads.vehicletype", "=", "vehicletype.id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->where("ads_images.vehicletype", 1)->where("ads.delete_status", 0)->where("motor_custome_values.make_id", $make)->orderBy('ads.sortorder')->paginate(9);
                } else if (($year == '0') && ($make != '0') && ($model == '0') && ($priceflag == 1) && ($keywordsearch == '')) {
                    ///"make and price";

                    $vehicletypecars = Ads::select("ads.*", "ads.canonical_name as mainid", "vehicletype.*", "ads_images.*", 'places.name as placename', 'countries.name as countryname', "ads_images.vehicletype as type1", 'motor_custome_values.*', "model_msts.name as modelname", "make_msts.name as makename")->leftjoin("ads_images", "ads.id", "=", "ads_images.ads_id")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("vehicletype", "ads.vehicletype", "=", "vehicletype.id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->where("ads_images.vehicletype", 1)->where("ads.delete_status", 0)->where("motor_custome_values.make_id", $make)->where('ads.price', '>=', "$minpriceval")->where('ads.price', '<=', "$maxpriceval")->orderBy('ads.sortorder')->paginate(9);
                } else if (($year == '0') && ($make == '0') && ($model != '0') && ($priceflag == 0) && ($keywordsearch == '')) {
                    // "model alone";

                    $vehicletypecars = Ads::select("ads.*", "ads.canonical_name as mainid", "vehicletype.*", "ads_images.*", 'places.name as placename', 'countries.name as countryname', "ads_images.vehicletype as type1", 'motor_custome_values.*', "model_msts.name as modelname", "make_msts.name as makename")->leftjoin("ads_images", "ads.id", "=", "ads_images.ads_id")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("vehicletype", "ads.vehicletype", "=", "vehicletype.id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->where("ads_images.vehicletype", 1)->where("ads.delete_status", 0)->where("motor_custome_values.model_id", $model)->orderBy('ads.sortorder')->paginate(9);
                } else if (($year == '0') && ($make == '0') && ($model != '0') && ($priceflag == 1) && ($keywordsearch == '')) {
                    //"model and price";

                    $vehicletypecars = Ads::select("ads.*", "ads.canonical_name as mainid", "vehicletype.*", "ads_images.*", 'places.name as placename', 'countries.name as countryname', "ads_images.vehicletype as type1", 'motor_custome_values.*', "model_msts.name as modelname", "make_msts.name as makename")->leftjoin("ads_images", "ads.id", "=", "ads_images.ads_id")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("vehicletype", "ads.vehicletype", "=", "vehicletype.id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->where("ads_images.vehicletype", 1)->where("ads.delete_status", 0)->where("motor_custome_values.model_id", $model)->where('ads.price', '>=', "$minpriceval")->where('ads.price', '<=', "$maxpriceval")->orderBy('ads.sortorder')->paginate(9);
                } else if (($year == '0') && ($make == '0') && ($model == '0') && ($priceflag != 0) && ($keywordsearch == '')) {
                    // "price alone";

                    $vehicletypecars = Ads::select("ads.*", "ads.canonical_name as mainid", "vehicletype.*", "ads_images.*", 'places.name as placename', 'countries.name as countryname', "ads_images.vehicletype as type1", 'motor_custome_values.*', "model_msts.name as modelname", "make_msts.name as makename")->leftjoin("ads_images", "ads.id", "=", "ads_images.ads_id")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("vehicletype", "ads.vehicletype", "=", "vehicletype.id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->where("ads_images.vehicletype", 1)->where("ads.delete_status", 0)->where('ads.price', '>=', "$minpriceval")->where('ads.price', '<=', "$maxpriceval")->orderBy('ads.sortorder')->paginate(9);
                } else if (($year != '0') && ($make != '0') && ($model != '0') && ($priceflag != 0) && ($keywordsearch == '')) {
                    //"all";

                    $vehicletypecars = Ads::select("ads.*", "ads.canonical_name as mainid", "vehicletype.*", "ads_images.*", 'places.name as placename', 'countries.name as countryname', "ads_images.vehicletype as type1", 'motor_custome_values.*', "model_msts.name as modelname", "make_msts.name as makename")->leftjoin("ads_images", "ads.id", "=", "ads_images.ads_id")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("vehicletype", "ads.vehicletype", "=", "vehicletype.id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->where("ads_images.vehicletype", 1)->where("motor_custome_values.model_id", $model)->where("motor_custome_values.registration_year", $year)->where("ads.delete_status", 0)->where("motor_custome_values.make_id", $make)->where('ads.price', '>=', "$minpriceval")->where('ads.price', '<=', "$maxpriceval")->orderBy('ads.sortorder')->paginate(9);
                } else if (($year == '0') && ($make != '0') && ($model != '0') && ($priceflag != 0) && ($keywordsearch == '')) {
                    //"make,model,price";

                    $vehicletypecars = Ads::select("ads.*", "ads.canonical_name as mainid", "vehicletype.*", "ads_images.*", 'places.name as placename', 'countries.name as countryname', "ads_images.vehicletype as type1", 'motor_custome_values.*', "model_msts.name as modelname", "make_msts.name as makename")->leftjoin("ads_images", "ads.id", "=", "ads_images.ads_id")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("vehicletype", "ads.vehicletype", "=", "vehicletype.id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->where("ads_images.vehicletype", 1)->where("ads.delete_status", 0)->where("motor_custome_values.model_id", $model)->where("motor_custome_values.make_id", $make)->where('ads.price', '>=', "$minpriceval")->where('ads.price', '<=', "$maxpriceval")->orderBy('ads.sortorder')->paginate(9);
                } else if (($year != '0') && ($make != '0') && ($model == '0') && ($priceflag != 0) && ($keywordsearch == '')) {
                    // "year,make,price";

                    $vehicletypecars = Ads::select("ads.*", "ads.canonical_name as mainid", "vehicletype.*", "ads_images.*", 'places.name as placename', 'countries.name as countryname', "ads_images.vehicletype as type1", 'motor_custome_values.*', "model_msts.name as modelname", "make_msts.name as makename")->leftjoin("ads_images", "ads.id", "=", "ads_images.ads_id")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("vehicletype", "ads.vehicletype", "=", "vehicletype.id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->where("ads_images.vehicletype", 1)->where("ads.delete_status", 0)->where("motor_custome_values.make_id", $make)->where("motor_custome_values.registration_year", $year)->where('ads.price', '>=', "$minpriceval")->where('ads.price', '<=', "$maxpriceval")->orderBy('ads.sortorder')->paginate(9);
                } else if (($year != '0') && ($make == '0') && ($model != '0') && ($priceflag != 0) && ($keywordsearch == '')) {
                    //"year,model,price";

                    $vehicletypecars = Ads::select("ads.*", "ads.canonical_name as mainid", "vehicletype.*", "ads_images.*", 'places.name as placename', 'countries.name as countryname', "ads_images.vehicletype as type1", 'motor_custome_values.*', "model_msts.name as modelname", "make_msts.name as makename")->leftjoin("ads_images", "ads.id", "=", "ads_images.ads_id")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->leftjoin("vehicletype", "ads.vehicletype", "=", "vehicletype.id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->where("ads_images.vehicletype", 1)->where("ads.delete_status", 0)->where("motor_custome_values.model_id", $model)->where("motor_custome_values.registration_year", $year)->where('ads.price', '>=', "$minpriceval")->where('ads.price', '<=', "$maxpriceval")->orderBy('ads.sortorder')->paginate(9);
                } else if (($year != '0') && ($make != '0') && ($model != '0') && ($priceflag == 0) && ($keywordsearch == '')) {
                    //"year,model,make,price=0";

                    $vehicletypecars = Ads::select("ads.*", "ads.canonical_name as mainid", "vehicletype.*", "ads_images.*", 'places.name as placename', 'countries.name as countryname', "ads_images.vehicletype as type1", 'motor_custome_values.*', "model_msts.name as modelname", "make_msts.name as makename")->leftjoin("ads_images", "ads.id", "=", "ads_images.ads_id")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("vehicletype", "ads.vehicletype", "=", "vehicletype.id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->where("ads_images.vehicletype", 1)->where("ads.delete_status", 0)->where("motor_custome_values.model_id", $model)->where("motor_custome_values.registration_year", $year)->where("motor_custome_values.make_id", $make)->orderBy('ads.sortorder')->paginate(9);
                } else if (($year == '0') && ($make != '0') && ($model != '0') && ($priceflag == 0) && ($keywordsearch == '')) {
                    //"model,make,price=0";

                    $vehicletypecars = Ads::select("ads.*", "ads.canonical_name as mainid", "vehicletype.*", "ads_images.*", 'places.name as placename', 'countries.name as countryname', "ads_images.vehicletype as type1", 'motor_custome_values.*', "model_msts.name as modelname", "make_msts.name as makename")->leftjoin("ads_images", "ads.id", "=", "ads_images.ads_id")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->leftjoin("vehicletype", "ads.vehicletype", "=", "vehicletype.id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->where("ads_images.vehicletype", 1)->where("ads.delete_status", 0)->where("motor_custome_values.model_id", $model)->where("motor_custome_values.make_id", $make)->orderBy('ads.sortorder')->paginate(9);
                } else if (($year != '0') && ($make != '0') && ($model == '0') && ($priceflag == 0) && ($keywordsearch == '')) {
                    //"year,make,price=0";

                    $vehicletypecars = Ads::select("ads.*", "ads.canonical_name as mainid", "vehicletype.*", "ads_images.*", 'places.name as placename', 'countries.name as countryname', "ads_images.vehicletype as type1", 'motor_custome_values.*', "model_msts.name as modelname", "make_msts.name as makename")->leftjoin("ads_images", "ads.id", "=", "ads_images.ads_id")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("vehicletype", "ads.vehicletype", "=", "vehicletype.id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->where("ads_images.vehicletype", 1)->where("ads.delete_status", 0)->where("motor_custome_values.make_id", $make)->where("motor_custome_values.registration_year", $year)->orderBy('ads.sortorder')->paginate(9);
                } else if (($year != '0') && ($make == '0') && ($model != '0') && ($priceflag == 0) && ($keywordsearch == '')) {
                    //"year,model,price=0";

                    $vehicletypecars = Ads::select("ads.*", "ads.canonical_name as mainid", "vehicletype.*", "ads_images.*", 'places.name as placename', 'countries.name as countryname', "ads_images.vehicletype as type1", 'motor_custome_values.*', "model_msts.name as modelname", "make_msts.name as makename")->leftjoin("ads_images", "ads.id", "=", "ads_images.ads_id")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("vehicletype", "ads.vehicletype", "=", "vehicletype.id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->where("ads_images.vehicletype", 1)->where("ads.delete_status", 0)->where("motor_custome_values.model_id", $model)->where("motor_custome_values.registration_year", $year)->orderBy('ads.sortorder')->paginate(9);
                }





                 else if (($keywordsearch != '') && ($priceflag == 0)) {


                    $vehicletypecars = Ads::select("ads.*", "ads.canonical_name as mainid", "vehicletype.*", "adm.*", 'places.name as placename', 'countries.name as countryname', 'adm.vehicletype as type1', 'motor_custome_values.*', "model_msts.name as modelname", "make_msts.name as makename")->leftjoin("ads_images as adm", "ads.id", "=", "adm.ads_id")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("vehicletype", "ads.vehicletype", "=", "vehicletype.id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->where("ads.delete_status", 0)->where("motor_custome_values.model_id", $model)->where("motor_custome_values.registration_year", $keywordsearch)->orwhere("ads.title", 'like', "%$keywordsearch%")->orwhere("make_msts.name", 'like', "%$keywordsearch%")->orwhere("model_msts.name", 'like', "%$keywordsearch%")->orderBy('ads.sortorder')->paginate(9);
                } else if (($keywordsearch != '') && ($priceflag == 1)) {
                    $vehicletypecars = Ads::select("ads.*", "ads.canonical_name as mainid", "vehicletype.*", "adm.*", 'places.name as placename', 'countries.name as countryname', 'adm.vehicletype as type1', 'motor_custome_values.*', "model_msts.name as modelname", "make_msts.name as makename")->leftjoin("ads_images as adm", "ads.id", "=", "adm.ads_id")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("vehicletype", "ads.vehicletype", "=", "vehicletype.id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->where("ads.delete_status", 0)->where("motor_custome_values.model_id", $model)->where("motor_custome_values.registration_year", $keywordsearch)->orwhere("ads.title", 'like', "%$keywordsearch%")->orwhere("make_msts.name", 'like', "%$keywordsearch%")->orwhere("model_msts.name", 'like', "%$keywordsearch%")->where('ads.price', '>=', "$minpriceval")->where('ads.price', '<=', "$maxpriceval")->orderBy('ads.sortorder')->paginate(9);
                } else if (($keywordsearch == '') && ($priceflag == 1)) {

                    $vehicletypecars = Ads::select("ads.*", "ads.canonical_name as mainid", "vehicletype.*", "adm.*", 'places.name as placename', 'countries.name as countryname', 'adm.vehicletype as type1', 'motor_custome_values.*', "model_msts.name as modelname", "make_msts.name as makename")->leftjoin("ads_images as adm", "ads.id", "=", "adm.ads_id")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("vehicletype", "ads.vehicletype", "=", "vehicletype.id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->where("ads.delete_status", 0)->where('ads.price', '>=', "$minpriceval")->where('ads.price', '<=', "$maxpriceval")->orderBy('ads.sortorder')->paginate(9);
                } else {
                    //echo "hello";
                    $vehicletypecars = Ads::select("ads.*", "ads.canonical_name as mainid", "vehicletype.*", 'places.name as placename', 'countries.name as countryname', "adm.*", 'adm.vehicletype as type1', 'motor_custome_values.*', "model_msts.name as modelname", "make_msts.name as makename")->leftjoin("ads_images as adm", "ads.id", "=", "adm.ads_id")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->leftjoin("vehicletype", "ads.vehicletype", "=", "vehicletype.id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->where("ads.delete_status", 0)->orderBy('ads.sortorder')->paginate(9);
                }}
                $sqlQuery = "select `motor_custome_values`.make_id, `make_msts`.`name` as `makename`,sort_order from `motor_custome_values` left join `make_msts` on `motor_custome_values`.`make_id` = `make_msts`.`id` where make_msts.status=1 group by make_id,makename,sort_order order by make_msts.sort_order";
                $make = DB::select(DB::raw($sqlQuery));
                
                $sqlQuery = "select `motor_custome_values`.model_id, `model_msts`.`name` as `modelname` from `motor_custome_values` left join `model_msts` on `motor_custome_values`.`model_id` = `model_msts`.`id` where model_msts.status=1 group by model_id,modelname order by model_msts.sort_order";
                $model = DB::select(DB::raw($sqlQuery));
                //$sqlQuery = "select distinct registration_year from motor_custome_values order by registration_year";
                $sqlQuery = "select distinct registration_year from motor_custome_values left join `ads` on `motor_custome_values`.`ads_id` = `ads`.`id` where ads.delete_status=0 order by registration_year ";
                $year = DB::select(DB::raw($sqlQuery));
           // }
            $profile = User::first();
            $contents = Dynamiccontents::first();
           $showcarsfirst = Ads::select("ads.*")->skip(0)->take(8)->orderby('id','desc')->where("ads.delete_status", 0)->get();
            $showcarssecond = Ads::select("ads.*")->skip(7)->take(7)->orderby('id','desc')->where("ads.delete_status", 0)->get();
            $sociallinks = SocialLink::get();
            //dd("hello");
            return view('cars.search', compact('testimonial', 'brands', 'questions', 'vehicletypecars', 'searchresult', 'footerimg', 'question1img', 'question2img', 'videoimg', 'make', 'model', 'year', 'maxprice', 'minprice', 'globe', 'subcategory', 'showcarsfirst', 'showcarssecond', 'contents', 'profile', 'sociallinks','make','model','year','make1','model1','year1'));
        } catch (exception $e) {
            $message = $e->getMessage();
            return view('cars.errorpage', compact('message'));
        }
    }


    public function getModel($makeid = 0)
    {

        // Fetch Models by makeid
        $modelData['data'] = MotorCustomeValues::leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")
            ->select('model_msts.id', 'name')->groupby('model_msts.id', 'name')
            ->where('motor_custome_values.make_id', $makeid)->where("model_msts.status",1)->orderby('model_msts.sort_order')
            ->get();

        return response()->json($modelData);
    }

    public function searchresultfilter(Request $request)
    {
        try {
            $testimonial = Testimonial::orderBy('sortorder')->where('status', 1)
                ->get();
            $searchresult = Banner::where('page', 'search result')->first();
            $footerimg = Banner::where('page', 'Footer')->first();
            $question1img = Banner::where('page', 'Faq1')->first();
            $question2img = Banner::where('page', 'Faq2')->first();
            $videoimg = Banner::where('page', 'Video Banner')->first();
            $brands = FeaturedDealers::orderBy('dealer_name')
                ->orderBy('created_at', 'desc')
                ->get();
            $questions = Questions::get();
            $make = $request->make;
            $model = $request->model;
            $year = $request->year;
            $make1=$make;
            $model1=$model;
            $year1=$year;
            $vehicletypecars = array();
            if (($year != '0') && ($make == '0') && ($model == '0')) {

                $vehicletypecars = Ads::select("ads.*","ads.id as mainid1",  "ads.id as mainid", "vehicletype.*",'motor_custome_values.*', "model_msts.name as modelname", 'places.name as placename', 'countries.name as countryname', "make_msts.name as makename")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("vehicletype", "ads.vehicletype", "=", "vehicletype.id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->where("ads_images.vehicletype", 1)->where("ads.delete_status", 0)->where("motor_custome_values.registration_year", $year)->orderBy('ads.sortorder')->paginate(9);
            } else if (($year == '0') && ($make != '0') && ($model == '0')) {
                $vehicletypecars = Ads::select("ads.*", "ads.id as mainid", "vehicletype.*","ads.id as mainid1", 'motor_custome_values.*', 'places.name as placename', 'countries.name as countryname', "model_msts.name as modelname", "make_msts.name as makename")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("vehicletype", "ads.vehicletype", "=", "vehicletype.id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->where("ads.delete_status", 0)->where("ads_images.vehicletype", 1)->where("motor_custome_values.make_id", $make)->orderBy('ads.sortorder')->paginate(9);
            } else if (($year == '0') && ($make == '0') && ($model != '0')) {
                $vehicletypecars = Ads::select("ads.*", "ads.id as mainid", "vehicletype.*","ads.id as mainid1", 'motor_custome_values.*', 'places.name as placename', 'countries.name as countryname', "model_msts.name as modelname", "make_msts.name as makename")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("vehicletype", "ads.vehicletype", "=", "vehicletype.id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->where("ads.delete_status", 0)->where("ads_images.vehicletype", 1)->where("motor_custome_values.model_id", $model)->orderBy('ads.sortorder')->paginate(9);
            } else if (($year != '0') && ($make != '0') && ($model != '0')) {
                $vehicletypecars = Ads::select("ads.*", "ads.id as mainid", "vehicletype.*","ads.id as mainid1",'motor_custome_values.*', "model_msts.name as modelname", 'places.name as placename', 'countries.name as countryname', "make_msts.name as makename")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("vehicletype", "ads.vehicletype", "=", "vehicletype.id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->where("ads_images.vehicletype", 1)->where("ads.delete_status", 0)->where("motor_custome_values.model_id", $model)->where("motor_custome_values.registration_year", $year)->where("motor_custome_values.make_id", $make)->orderBy('ads.sortorder')->paginate(9);
            } else if (($year == '0') && ($make != '0') && ($model != '0')) {
                $vehicletypecars = Ads::select("ads.*", "ads.id as mainid", "vehicletype.*","ads.id as mainid1", 'motor_custome_values.*', "model_msts.name as modelname", 'places.name as placename', 'countries.name as countryname', "make_msts.name as makename")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("vehicletype", "ads.vehicletype", "=", "vehicletype.id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->where("ads_images.vehicletype", 1)->where("ads.delete_status", 0)->where("motor_custome_values.model_id", $model)->where("motor_custome_values.make_id", $make)->orderBy('ads.sortorder')->paginate(9);
            } else if (($year != '0') && ($make != '0') && ($model == '0')) {
                $vehicletypecars = Ads::select("ads.*", "ads.id as mainid", "vehicletype.*","ads.id as mainid1", 'motor_custome_values.*', "model_msts.name as modelname", 'places.name as placename', 'countries.name as countryname', "make_msts.name as makename")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("vehicletype", "ads.vehicletype", "=", "vehicletype.id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->where("ads_images.vehicletype", 1)->where("ads.delete_status", 0)->where("motor_custome_values.make_id", $make)->where("motor_custome_values.registration_year", $year)->orderBy('ads.sortorder')->paginate(9);
            } else if (($year != '0') && ($make == '0') && ($model != '0')) {
                $vehicletypecars = Ads::select("ads.*", "ads.id as mainid", "vehicletype.*","ads.id as mainid1",'motor_custome_values.*', "model_msts.name as modelname", 'places.name as placename', 'countries.name as countryname', "make_msts.name as makename")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("vehicletype", "ads.vehicletype", "=", "vehicletype.id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->where("ads_images.vehicletype", 1)->where("ads.delete_status", 0)->where("motor_custome_values.model_id", $model)->where("motor_custome_values.registration_year", $year)->orderBy('ads.sortorder')->paginate(9);
            }
            /*$sqlQuery = "select `motor_custome_values`.make_id, `make_msts`.`name` as `makename` from `motor_custome_values` left join `make_msts` on `motor_custome_values`.`make_id` = `make_msts`.`id` group by make_id,makename";
            $make = DB::select(DB::raw($sqlQuery));
            $sqlQuery = "select `motor_custome_values`.model_id, `model_msts`.`name` as `modelname` from `motor_custome_values` left join `model_msts` on `motor_custome_values`.`model_id` = `model_msts`.`id` group by model_id,modelname";
            $model = DB::select(DB::raw($sqlQuery));*/
            $sqlQuery = "select `motor_custome_values`.make_id, `make_msts`.`name` as `makename`,sort_order from `motor_custome_values` left join `make_msts` on `motor_custome_values`.`make_id` = `make_msts`.`id` where make_msts.status=1 group by make_id,makename order by make_msts.sort_order";
                $make = DB::select(DB::raw($sqlQuery));
                $sqlQuery = "select `motor_custome_values`.model_id, `model_msts`.`name` as `modelname` from `motor_custome_values` left join `model_msts` on `motor_custome_values`.`model_id` = `model_msts`.`id` where model_msts.status=1 group by model_id,modelname order by model_msts.sort_order";
                $model = DB::select(DB::raw($sqlQuery));
            $sqlQuery = "select distinct registration_year from motor_custome_values";
            $year = DB::select(DB::raw($sqlQuery));
            return view('cars.search', compact('testimonial', 'brands', 'questions', 'vehicletypecars', 'searchresult', 'footerimg', 'question1img', 'question2img', 'videoimg', 'make', 'model', 'year', 'make1', 'model1', 'year1',));
        } catch (exception $e) {
            $message = $e->getMessage();
            return view('cars.errorpage', compact('message'));
        }
    }

    public function carlisting($cname)
    {
        $subcategory = Subcategory::orderBy('sort_order')->where('status', 1)
            ->get();
        if ($cname == 'All') {
            $vehicletypecars = Ads::select("ads.*", "ads.canonical_name as mainid", "subcategories.*", "ads_images.*", 'motor_custome_values.*', "model_msts.name as modelname", "make_msts.name as makename", 'places.name as placename', 'countries.name as countryname')->leftjoin("ads_images", "ads.id", "=", "ads_images.ads_id")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("subcategories", "ads.subcategory_id", "=", "subcategories.id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->where("ads_images.vehicletype", 1)->paginate(10);

            $vehicletypecarscount = Ads::select("ads.*", "ads.canonical_name as mainid", "subcategories.*", "ads_images.*", 'motor_custome_values.*', "model_msts.name as modelname", "make_msts.name as makename", 'places.name as placename', 'countries.name as countryname')->leftjoin("ads_images", "ads.id", "=", "ads_images.ads_id")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("subcategories", "ads.subcategory_id", "=", "subcategories.id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->where("ads_images.vehicletype", 1)->count();
        } else {
            $vehicletypecars = Ads::select("ads.*", "ads.canonical_name as mainid", "subcategories.*", "ads_images.*", 'motor_custome_values.*', "model_msts.name as modelname", "make_msts.name as makename", 'places.name as placename', 'countries.name as countryname')->leftjoin("ads_images", "ads.id", "=", "ads_images.ads_id")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("subcategories", "ads.subcategory_id", "=", "subcategories.id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->where("ads_images.vehicletype", 1)->where('subcategories.canonical_name', $cname)->paginate(10);
            $vehicletypecarscount = Ads::select("ads.*", "ads.canonical_name as mainid", "subcategories.*", "ads_images.*", 'motor_custome_values.*', "model_msts.name as modelname", "make_msts.name as makename", 'places.name as placename', 'countries.name as countryname')->leftjoin("ads_images", "ads.id", "=", "ads_images.ads_id")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("subcategories", "ads.subcategory_id", "=", "subcategories.id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->where("ads_images.vehicletype", 1)->where('subcategories.canonical_name', $cname)->count();
        }
        $sqlQuery = "select distinct registration_year from motor_custome_values order by registration_year limit 0,4";
        $year = DB::select(DB::raw($sqlQuery));

        $sqlQuery = "select distinct make_id,name from motor_custome_values m join make_msts ma on m.make_id=ma.id order by name limit 0,4";
        $make = DB::select(DB::raw($sqlQuery));

        $sqlQuery = "select distinct model_id,name from motor_custome_values m join model_msts ma on m.model_id=ma.id order by name limit 0,4";
        $model = DB::select(DB::raw($sqlQuery));

        $sqlQuery = "select distinct fuel_type from motor_custome_values order by fuel_type limit 0,4";
        $fueltype = DB::select(DB::raw($sqlQuery));
        $sqlQuery = "select distinct seats from ads order by seats limit 0,4";
        $passengercapacity = DB::select(DB::raw($sqlQuery));
        $sqlQuery = "select max(price) as price from ads";
        $maxprice =  DB::select(DB::raw($sqlQuery));
        $sqlQuery = "select min(price) as price from ads";
        $minprice =  DB::select(DB::raw($sqlQuery));
        return view('cars.listing', compact('minprice', 'maxprice', 'passengercapacity', 'fueltype', 'subcategory', 'vehicletypecars', 'year', 'make', 'model', 'cname', 'vehicletypecarscount'));
    }

    function yearrender()
    {

        $start = $_GET['val'];
        $offsetyear = $start + 4;
        $sqlQuery = "select distinct registration_year from motor_custome_values order by registration_year limit $offsetyear,4";
        $year = DB::select(DB::raw($sqlQuery));
        return view('cars.caryear', compact('year', 'offsetyear'));
    }
    function yearrendercount(){
    
    $start=$_GET['val'];
    $offsetyear=$start+4;
    $page=$_GET['valpage']+1;
$sqlQuery = "select distinct registration_year from motor_custome_values order by registration_year limit $offsetyear,4";
$year = DB::select(DB::raw($sqlQuery));
$sqlQuerycount = "select distinct registration_year from motor_custome_values order by registration_year";
$yearcount = DB::select(DB::raw($sqlQuerycount));
$count=count($yearcount);
$actcount=count($year);
$startcount=$_GET['valcount'];
$nextcount=$startcount+$actcount;
$noofpages=(count($yearcount)/4);
//echo $page;
//echo $noofpages;
if ($page>=$noofpages){
    $show=0;
}else{
    $show=1;
}
return response()->json(['page' => $page, 'show' => $show]);


    //return view('cars.caryear',compact('year','offsetyear'));
}

    function passengercapacityrender()
    {
        $start = $_GET['val'];
        $offsetpassengercapacity = $start + 4;
        $sqlQuery = "select distinct seats from ads order by seats limit $offsetpassengercapacity,4";
        $passengercapacity = DB::select(DB::raw($sqlQuery));
        return view('cars.carpassengercapacity', compact('passengercapacity', 'offsetpassengercapacity'));
    }
function passengercapacityrendercount(){
    $start=$_GET['val'];
    $offsetpassengercapacity=$start+4;
    $page=$_GET['valpage']+1;
$sqlQuery = "select distinct seats from ads order by seats limit $offsetpassengercapacity,4";
$passengercapacity = DB::select(DB::raw($sqlQuery));
$sqlQuerycount = "select distinct seats from ads order by seats";
$passengercapacitycount = DB::select(DB::raw($sqlQuerycount));
$count=count($passengercapacitycount);
$actcount=count($passengercapacity);
$startcount=$_GET['valcount'];
$nextcount=$startcount+$actcount;
$noofpages=(count($passengercapacitycount)/4);
//echo $page;
//echo $noofpages;
if ($page>=$noofpages){
    $show=0;
}else{
    $show=1;
}
return response()->json(['page' => $page, 'show' => $show]);
//if ($actcount>)
//echo $totalcount=count($passengercapacitycount);


}
    function fueltyperender()
    {

        $start = $_GET['val'];
        $offsetfueltype = $start + 4;
        $sqlQuery = "select distinct fuel_type from motor_custome_values order by fuel_type limit $offsetfueltype,4";
        $fueltype = DB::select(DB::raw($sqlQuery));
        return view('cars.carfueltype', compact('fueltype', 'offsetfueltype'));
    }

    function makerender()
    {
        $start = $_GET['val'];
        $offset = $start + 4;
        $sqlQuery = "select distinct make_id,name from motor_custome_values m join make_msts ma on m.make_id=ma.id order by name limit $offset,4";        
        $make = DB::select(DB::raw($sqlQuery));
        return view('cars.carmake', compact('make', 'offset'));
    }
    function makerendercount(){    
    $start=$_GET['val'];
    $offset=$start+4;
    //$offset=$start+1;
$sqlQuery = "select distinct make_id,name from motor_custome_values m join make_msts ma on m.make_id=ma.id order by name limit $offset,4";
//$sqlQuery = "select distinct make_id,name from motor_custome_values m join make_msts ma on m.make_id=ma.id order by name limit $offset,1";
$make = DB::select(DB::raw($sqlQuery));
$page=$_GET['valpage']+1;
$sqlQuerycount = "select distinct make_id,name from motor_custome_values m join make_msts ma on m.make_id=ma.id order by name";
$makecount = DB::select(DB::raw($sqlQuerycount));
$count=count($makecount);
$actcount=count($make);
$startcount=$_GET['valcount'];
$nextcount=$startcount+$actcount;
$noofpages=(count($makecount)/4);
//echo $page;
//echo $noofpages;
if ($page>=$noofpages){
    $show=0;
}else{
    $show=1;
}
return response()->json(['page' => $page, 'show' => $show]);
    //return view('cars.carmake',compact('make','offset'));
}
    function modelrender()
    {

        $start = $_GET['val'];
       /* $offsetmodel = $start + 4;
        $sqlQuery = "select distinct model_id,name from motor_custome_values m join model_msts ma on m.model_id=ma.id order by name limit $offsetmodel,4";*/
         $offsetmodel=$start+1;
$sqlQuery = "select distinct model_id,name from motor_custome_values m join model_msts ma on m.model_id=ma.id order by name limit $offsetmodel,4";
        $model = DB::select(DB::raw($sqlQuery));

        return view('cars.carmodel', compact('model', 'offsetmodel'));
    }

function modelrendercount(){
    
    $start=$_GET['val'];
    $offsetmodel=$start+4;
$sqlQuery = "select distinct model_id,name from motor_custome_values m join model_msts ma on m.model_id=ma.id order by name limit $offsetmodel,4";
$model = DB::select(DB::raw($sqlQuery));
$page=$_GET['valpage']+1;
$sqlQuerycount = "select distinct model_id,name from motor_custome_values m join model_msts ma on m.model_id=ma.id order by name";
$modelcount = DB::select(DB::raw($sqlQuerycount));
$count=count($modelcount);
$actcount=count($model);
$startcount=$_GET['valcount'];
$nextcount=$startcount+$actcount;
$noofpages=(count($modelcount)/4);
//echo $page;
//echo $noofpages;
if ($page>=$noofpages){
    $show=0;
}else{
    $show=1;
}
return response()->json(['page' => $page, 'show' => $show]);

    //return view('cars.carmodel',compact('model','offsetmodel'));


}


    function checkuniquetitle()
    {
        $val = $_GET['val'];
        $sqlQuery = "select count(*) as count from ads where title='$val'";
        $exists = DB::select(DB::raw($sqlQuery));
        //dd($exists);
        if ($exists[0]->count == 1) {
            $found = 1;
        } else {
            $found = 0;
        }
        echo $found;
    }

    function checkuniquetitleedit()
    {
        $val = $_GET['val'];
        $id = $_GET['id'];
        $sqlQuery = "select count(*) as count from ads where title='$val' and id!=$id";
        $exists = DB::select(DB::raw($sqlQuery));
        //dd($exists);
        if ($exists[0]->count == 1) {
            $found = 1;
        } else {
            $found = 0;
        }
        echo $found;
    }


    function getVehicles()
    {

        $val = $_GET['val'];
        $vehicletypecars = Ads::select("ads.*", "ads.canonical_name as mainid", "vehicletype.*", "ads_images.*", "ads_images.vehicletype as type1", 'motor_custome_values.*', "model_msts.name as modelname", 'places.name as placename', 'countries.name as countryname', "make_msts.name as makename")->leftjoin("ads_images", "ads.id", "=", "ads_images.ads_id")->leftjoin("motor_custome_values", "ads.id", "=", "motor_custome_values.ads_id")->leftjoin("vehicletype", "ads.vehicletype", "=", "vehicletype.id")->leftjoin("model_msts", "motor_custome_values.model_id", "=", "model_msts.id")->leftjoin("make_msts", "motor_custome_values.make_id", "=", "make_msts.id")->leftjoin("places", "places.id", "=", "ads.place")->leftjoin("countries", "countries.id", "=", "ads.country_id")->where("ads_images.vehicletype", 1)->where("ads.delete_status", 0)->where("soldreserved", $val)->get();
        $sqlQuery = "select `motor_custome_values`.make_id, `make_msts`.`name` as `makename` from `motor_custome_values` left join `make_msts` on `motor_custome_values`.`make_id` = `make_msts`.`id` group by make_id,makename";
        $make = DB::select(DB::raw($sqlQuery));
        $sqlQuery = "select `motor_custome_values`.model_id, `model_msts`.`name` as `modelname` from `motor_custome_values` left join `model_msts` on `motor_custome_values`.`model_id` = `model_msts`.`id` group by model_id,modelname";
        $model = DB::select(DB::raw($sqlQuery));
        $sqlQuery = "select distinct registration_year from motor_custome_values order by registration_year";
        $year = DB::select(DB::raw($sqlQuery));

        $sociallinks = SocialLink::get();
        $profile = User::first();
        $contents = Dynamiccontents::first();
         $showcarsfirst = Ads::select("ads.*")->skip(0)->take(8)->orderby('id','desc')->where("ads.delete_status", 0)->get();
            $showcarssecond = Ads::select("ads.*")->skip(7)->take(7)->orderby('id','desc')->where("ads.delete_status", 0)->get();
        return view('cars.getVehicles', compact('vehicletypecars'));
    }
}
