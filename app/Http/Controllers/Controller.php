<?php

namespace App\Http\Controllers;



use App\Api;
use App\User;
use App\Event;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Log;
use Symfony\Component\HttpFoundation\Request;
use backendless\Backendless;
use backendless\model\BackendlessUser;
use Illuminate\Support\Facades\Auth;


include "D:/Logiciel/wamp/www/Priape-site/vendor/backendless/autoload.php";
include "D:/Logiciel/wamp/www/Priape-site/vendor/httpful.phar";
Backendless::initApp('603EA250-3BD9-5EB1-FF62-53D50AC37900', '34C1A9A1-E8C3-AFFF-FF39-5C460D6DB200', 'v1');




class Controller extends BaseController
{

    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    public function showWelcome()
    {

        if(Session::has('user')){
            return redirect()->route('dashboard');
        }
        return \view('/home');
    }
    public function contact()
    {
        $user = Backendless::$UserService->getCurrentUser();
        Log::info($user->name);

    }
    public function register()
    {
/*        if(Session::has('user'))
        {
            return redirect()->route('home');
        }*/
        return \view('/register');
    }

    public function connection()
    {
        if(Session::has('user'))
        {
            return redirect()->route('home');
        }
        return \view('/login');
    }
    public function authentification( Request $request)
    {
        $param = $request;
        $tab =  Api::login($param['email'], $param['password']);
        $array = Api::getUser($tab['objectId'], $tab['user-token']);
        $user = new User();
        $user->jsonDesializable($array['data'][0]);
        $user->setUserToken($tab['user-token']);
        Session::put('user', $user);
        if($user->getProfessional() == false)
        {
            return redirect()->route('logout');
        }
        else{return redirect()->route('dashboard');}
        }
    public function logout()
    {
       if(Session::has('user'))
       {
           Api::logout(Session::get('user')->getUserToken());
           Session::forget('user');
       }
        return redirect()->route('home');

    }
    public function dashboard()
    {
       $array= Api::getWeather(Session::get('user')->getLocation()['latitude'],Session::get('user')->getLocation()['longitude']);
        return \view('/dashboard', array('weather' => $array));
    }
    public function registration(Request $request)
    {
        $picture = null;
        $param = $request;
        if($param['password_confirmation'] == $param['password']) {
            if (!is_null($param['image'])) {
               $picture  = Api::uploadImage(Session::get('user')->getName(),Session::get('user')->getEmail(), Session::get('user')->getToken(), $param['image']);
            } else {
                $picture = null;
            }
            $params = array("address"=>$param['street'].' '.$param['number'].','.$param['zip'].' '.$param['country']);
            $response = \Geocoder::geocode('json', $params);
            $tab = json_decode($response, true);

            if(($tab['status'] != 'ZERO_RESULTS'))
            {
                $results = $tab['results'][0];
                $geometry = $results['geometry'];
                $location = $geometry['location'];
                $geopoint = new \App\GeoPoint();
                $geopoint->latitude = $location['lat'];
                $geopoint->longitude = $location['lng'];
                $geopoint->___class = 'GeoPoint';

                $user = new User();
                $user->setName($param['name']);
                $user->setPassword('1234');
                $user->setEmail($param['email']);
                $user->setProfessional(true);
                $user->setDescription($param['description']);
                $user->setPhone($param['phone']);
                $user->setJob($param['job']);
                $user->setLocation($geopoint);
                $param['location'] = $geopoint;
                if($picture !=null){$user->setPicture($picture);}

                $json = $user->jsonToRegister();
                Api::register($json);
                return redirect()->route('home', array("error" => "null"));
        }}
    }
    public function profil()
    {
        /*Convert geopoint to adress*/
        $geopoint = json_encode(Session::get('user')->getLocation());
        $tab[] = json_decode($geopoint, true);
        $param = array("latlng" => $tab[0]['latitude'].",".$tab[0]['longitude']);
        $response = \Geocoder::geocode('json', $param);
        $tableau = json_decode($response, true);
        log:info($tableau);

        /*Get all works do by his job*/
        $workTab = Api::getWorks(Session::get('user')->getJob(),  Session::get('user')->getUserToken());
        $count = count($workTab['data']);
        if(count(Session::get('user')->getWorks()) > 0){
        foreach(Session::get('user')->getWorks() as $work)
        {
            for($i = 0; $i < $count; $i++){
                if($work['name'] === $workTab['data'][$i]['name'])
                {

                    $workTab['data'][$i]['checked'] = true;

                }

            }
        }
        }

        return \view('/profil', array(
            'street' => $tableau['results'][0]['address_components'][1]['long_name'],
            'number' => $tableau['results'][0]['address_components'][0]['long_name'],
            'zip' => $tableau['results'][0]['address_components'][6]['long_name'],
            'works' => $workTab['data']
        ));
    }
    public function editing(Request $request)
    {

        $param = $request;
        $resultworks= array();
        if(sizeof($param['work'])>0){
        foreach($param['work'] as $works=>$value)
        {

            list($value1,$value2) = explode('|', $value);
            $element =
                array(
                    'objectId'=>$value1,
                    'job' => Session::get('user')->getJob(),
                    'name' => $value2,
                    '___class' => 'Work');

            array_push($resultworks, $element);
        }
        }
        log:info($resultworks);
        Session::get('user')->setworks($resultworks);
        Session::get('user')->setName($param['name']);
        Session::get('user')->setWorks($resultworks);
        Session::get('user')->setPhone($param['phone']);
        Session::get('user')->setDescription($param['description']);
        $params = array("address"=>$param['street'].' '.$param['number'].','.$param['zip'].' '.$param['country']);
        $response = \Geocoder::geocode('json', $params);
        $tab = json_decode($response, true);
        if(($tab['status'] != 'ZERO_RESULTS')) {
            $results = $tab['results'][0];
            $geometry = $results['geometry'];
            $location = $geometry['location'];
            $geopoint = new \App\GeoPoint();
            $geopoint->latitude = $location['lat'];
            $geopoint->longitude = $location['lng'];
            $geopoint->___class = 'GeoPoint';
            Session::get('user')->setLocation($geopoint);
        }
        $json = Session::get('user')->jsonSerialize();
        $array = Api::editUser(Session::get('user')->getUserToken(),$json, Session::get('user')->getObjectId());
        $token = Session::get('user')->getUserToken();
        Session::get('user')->jsonDesializable($array);
        Session::get('user')->setUserToken($token);
        return redirect()->route('home');
    }
    public function calendar()
    {

        $workTab = Api::getWorks(Session::get('user')->getJob(),Session::get('user')->getUserToken());
        log:info($workTab);

        $tab = Api::getEvent(Session::get('user')->getUserToken());
        $event = "";
        foreach($tab['data'] as $value)
        {
            $y = gmdate("y", $value['scheduled']);
            $y = '20'.$y;
            $m = gmdate("m", $value['scheduled']);
            $m = $m-1;
            $d = gmdate("d", $value['scheduled']);
            $h = gmdate("H", $value['scheduled']);
            $i = gmdate("i", $value['scheduled']);
            $tampon = "{
        title: '".$value['title']."',
                    objectId : '".$value['objectId']."',
                    start: new Date(".$y.",".$m.",".$d.",".$h.",".$i.")
                },";
            $event = $event .' '.$tampon;
        }
        return \view('/calendar')->with(array("events" => $event, "works" => $workTab['data']));
    }
    public function adding(Request $request)
    {
        $param = $request;
        $scheduled = $param['date'].' '.$param['time'];
        $timestamp = strtotime($scheduled);
        $event = new Event($param['work'], $timestamp);
        $json = $event->serializeObject();
        Api::add(Session::get('user')->getUserToken(), $json);
       return redirect()->route('calendar');
    }

      public function delete($objectId)
    {
       Api::remove(Session::get('user')->getUserToken(), $objectId);
        return redirect()->route('calendar');
    }

}
