<?php

namespace App\Http\Controllers;

use App\User;
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

        return \view('/home');
    }
    public function contact()
    {
        $user = Backendless::$UserService->getCurrentUser();
        Log::info($user->name);

    }
    public function register()
    {
        if(Session::has('user'))
        {
            return redirect()->route('home');
        }
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
        $json = '{
        "login":"'.$param['email'].'",
"password":"'.$param['password'].'"
}';
        $uri = 'https://api.backendless.com/v1/users/login';
        $response = \Httpful\Request::post($uri)
            ->sendsJson()
            ->addHeader('application-id', '603EA250-3BD9-5EB1-FF62-53D50AC37900')
            ->addHeader('secret-key', '0E72338A-D313-ED73-FF03-E7DD53D51D00')
            ->addHeader('Content-Type', 'application/json')
            ->addHeader('application-type', 'REST')
            ->body($json)
            ->send();
       $tab = json_decode($response, true);



 /*Get all works do by his job*/
      /*  $whereClause = "job='".Session::get('user')->getJob()."'";
        $url = 'https://api.backendless.com/v1/data/Work?where='.$whereClause;
        $response = \Httpful\Request::get($url)
            ->addHeader('application-id', '603EA250-3BD9-5EB1-FF62-53D50AC37900')
            ->addHeader('secret-key', '0E72338A-D313-ED73-FF03-E7DD53D51D00')
            ->addHeader('application-type', 'REST')
            ->addHeader('Content-Type', 'application/json')
            ->addHeader('user-token', Session::get('user')->getUserToken())
            ->send();
        $workTab = json_decode($response, true);*/
        $whereClause = "objectId='".$tab['objectId']."'";
        $link = 'https://api.backendless.com/v1/data/users?where='.$whereClause;
        $res = \Httpful\Request::get($link)
            ->addHeader('application-id', '603EA250-3BD9-5EB1-FF62-53D50AC37900')
            ->addHeader('secret-key', '0E72338A-D313-ED73-FF03-E7DD53D51D00')
            ->addHeader('application-type', 'REST')
            ->addHeader('Content-Type', 'application/json')
            ->addHeader('user-token', $tab['user-token'])
            ->send();

        $array = json_decode($res, true);
        log:info($array);

        $user = new User();
        $user->jsonDesializable($array['data'][0]);
        $user->setUserToken($tab['user-token']);
        Session::put('user', $user);


        return redirect()->route('home');
        }
    public function logout()
    {
       if(Session::has('user'))
       {
           $url = 'https://api.backendless.com/v1/users/logout';
           $response = \Httpful\Request::put($url)
               ->addHeader('application-id', '603EA250-3BD9-5EB1-FF62-53D50AC37900')
               ->addHeader('secret-key', '0E72338A-D313-ED73-FF03-E7DD53D51D00')
               ->addHeader('application-type', 'REST')
               ->addHeader('user-token', Session::get('user')->userToken)
               ->send();
           log:info($response);
           Session::forget('user');
       }
        return redirect()->route('home');

    }
    public function dashboard()
    {
/*        if(Session::has('user'))
        {


            $works = Session::get('user')->works;

            return \view('/dashboard', array(
           'works' =>  $works));
        }
        else{
        return redirect()->roue('home');
        }*/
        return \view('/dashboard');
    }
    public function registration(Request $request)
    {
        $picture = null;
        $param = $request;
        if($param['password_confirmation'] == $param['password']) {
            if (!is_null($param['image'])) {
                $uri = 'https://api.backendless.com/v1/files/images/'.$param['name'].$param['email'].'.jpg';
                $response = \Httpful\Request::post($uri)
                    ->addHeader('application-id', '603EA250-3BD9-5EB1-FF62-53D50AC37900')
                    ->addHeader('secret-key', '0E72338A-D313-ED73-FF03-E7DD53D51D00')
                    ->addHeader('Content-Type', 'application/json')
                    ->addHeader('application-type', 'REST')
                    ->attach($param['image'])
                    ->send();
                $tableau = json_decode($response, true);
                $picture = $tableau['fileURL'];

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

                $uri = 'https://api.backendless.com/v1/users/register';
                $response = \Httpful\Request::post($uri)
                    ->sendsJson()
                    ->addHeader('application-id', '603EA250-3BD9-5EB1-FF62-53D50AC37900')
                    ->addHeader('secret-key', '0E72338A-D313-ED73-FF03-E7DD53D51D00')
                    ->addHeader('Content-Type', 'application/json')
                    ->addHeader('application-type', 'REST')
                    ->body($json)
                    ->send();
                log:info($response);
                return redirect()->route('home');
        }}

        else{
            echo "
            <script src='assets/js/jquery-2.1.4.min.js'></script>
        <link href='assets/css/toastr.css' rel='stylesheet'/>
        <script src='assets/js/toastr.js'></script>
        <script type='text/javascript'>
                $(document).ready(function(){
                    toastr.options.timeOut = 10000;
                    toastr.error('mauvaise adresse.');
                $('#linkButton').click(function() {
                    toastr.success('Click Button');
                });
            });
        </script>";
        }

/*

            $params = array("address"=>$param['street'].' '.$param['number'].','.$param['zip'].' '.$param['country']);
            $response = \Geocoder::geocode('json', $params);
            $tab = json_decode($response, true);

            if(($tab['status'] != 'ZERO_RESULTS'))
            {   log:info($tab);
           $results = $tab['results'][0];
            $geometry = $results['geometry'];
            $location = $geometry['location'];
            $geopoint = new \App\GeoPoint();
            $geopoint->latitude = $location['lat'];
            $geopoint->longitude = $location['lng'];
            $geopoint->___class = 'GeoPoint';

            $user = new \App\User();
            $user->name = $param['name'];
            $user->password = $param['password'];
            $user->email = $param['email'];
            $user->professional = true;
            $user->description = $param['description'];
                $user->phone = $param['phone'];
            $user->job = $param['job'];
            $user->location = $geopoint;
            $json = json_encode($user);
            $uri = 'https://api.backendless.com/v1/users/register';
            $response = \Httpful\Request::post($uri)
                ->sendsJson()
                ->addHeader('application-id', '603EA250-3BD9-5EB1-FF62-53D50AC37900')
                ->addHeader('secret-key', '0E72338A-D313-ED73-FF03-E7DD53D51D00')
                ->addHeader('Content-Type', 'application/json')
                ->addHeader('application-type', 'REST')
                ->body($json)
                ->send();
                return redirect()->route('home');
        }

       */
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
        $whereClause = "job='".Session::get('user')->getJob()."'";
        $url = 'https://api.backendless.com/v1/data/Work?where='.$whereClause;
        $response = \Httpful\Request::get($url)
            ->addHeader('application-id', '603EA250-3BD9-5EB1-FF62-53D50AC37900')
            ->addHeader('secret-key', '0E72338A-D313-ED73-FF03-E7DD53D51D00')
            ->addHeader('application-type', 'REST')
            ->addHeader('Content-Type', 'application/json')
            ->addHeader('user-token', Session::get('user')->getUserToken())
            ->send();
        $workTab = json_decode($response, true);

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
        $url = 'https://api.backendless.com/v1/data/users/'.Session::get('user')->getObjectId();
        $response = \Httpful\Request::put($url)
            ->sendsJson()
            ->addHeader('application-id', '603EA250-3BD9-5EB1-FF62-53D50AC37900')
            ->addHeader('secret-key', '0E72338A-D313-ED73-FF03-E7DD53D51D00')
            ->addHeader('Content-Type', 'application/json')
            ->addHeader('application-type', 'REST')
            ->addHeader('user-token', Session::get('user')->getUserToken())
            ->body($json)
            ->send();
        $array = json_decode($response, true);
        $token = Session::get('user')->getUserToken();
        Session::get('user')->jsonDesializable($array);
        Session::get('user')->setUserToken($token);
        /*$param = $request;
        $resultworks=array();
        foreach($param['work'] as $works=>$value)
        {
            list($value1,$value2) = explode('|', $value);
            $element =
                    array(
                        'objectId'=>$value1,
                        'job' => Session::get('user')->job,
                        'name' => $value2,
                        '___class' => 'Work',);

            array_push($resultworks, $element);
        }

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

        $test = json_encode(Session::get('user'));
        $url = 'https://api.backendless.com/v1/data/users/'.Session::get('user')->getObjectId();
        $response = \Httpful\Request::put($url)
            ->sendsJson()
            ->addHeader('application-id', '603EA250-3BD9-5EB1-FF62-53D50AC37900')
            ->addHeader('secret-key', '0E72338A-D313-ED73-FF03-E7DD53D51D00')
            ->addHeader('Content-Type', 'application/json')
            ->addHeader('application-type', 'REST')
            ->addHeader('user-token', Session::get('user')->getUserToken())
            ->body($test)
            ->send();
        $tab = json_decode($response, true);
        log:info($response);
        $user = new User();
        $user->jsonDesializable($tab);
        $user->userToken = Session::get('user')->userToken;
        Session::forget('user');
        Session::put('user', $user);*/
        return redirect()->route('home');
    }
    public function calendar()
    {
        return \view('/calendar');
    }

}
