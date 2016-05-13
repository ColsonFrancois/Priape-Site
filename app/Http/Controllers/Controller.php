<?php

namespace App\Http\Controllers;

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
        $user = json_decode($response);
        $user->userToken = $tab['user-token'];
        Session::put('user', $user);
/*       $works = array (
            0 =>
                (array(
                    'created' => 1463047864000,
                    'name' => 'tondre el pelouso',
                    '___class' => 'Work',
                )),
        );
        $user->works = $works;
        $user->email = 'champ@champ.be';
        $user->objectId = 'CD2984EC-F571-54EB-FF0A-D2333BEA4500';
        $test = json_encode($user);

        $url = 'https://api.backendless.com/v1/users/CD2984EC-F571-54EB-FF0A-D2333BEA4500';
        $response = \Httpful\Request::put($url)
            ->sendsJson()
            ->addHeader('application-id', '603EA250-3BD9-5EB1-FF62-53D50AC37900')
            ->addHeader('secret-key', '0E72338A-D313-ED73-FF03-E7DD53D51D00')
            ->addHeader('Content-Type', 'application/json')
            ->addHeader('application-type', 'REST')
            ->addHeader('user-token', $user->userToken)
            ->body($test)
            ->send();
        log:info($response);*/
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

        $param = $request;
        if($param['password_confirmation'] == $param['password'])
        {
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
        }
    }
    public function profil()
    {
        $geopoint = json_encode(Session::get('user')->location);
        $tab[] = json_decode($geopoint, true);
        $param = array("latlng" => $tab[0]['latitude'].",".$tab[0]['longitude']);
        $response = \Geocoder::geocode('json', $param);
        $tableau = json_decode($response, true);
        log:info($tableau);



        return \view('/profil', array(
            'street' => $tableau['results'][0]['address_components'][1]['long_name'],
            'number' => $tableau['results'][0]['address_components'][0]['long_name'],
            'zip' => $tableau['results'][0]['address_components'][6]['long_name'],
        ));
    }

}
