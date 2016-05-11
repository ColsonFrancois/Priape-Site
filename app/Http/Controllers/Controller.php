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
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;

include "D:/Logiciel/wamp/www/Priape-site/vendor/backendless/autoload.php";
Backendless::initApp('603EA250-3BD9-5EB1-FF62-53D50AC37900', '34C1A9A1-E8C3-AFFF-FF39-5C460D6DB200', 'v1');

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;


    public function showWelcome()
    {
        if(Session::has('user'))
        {
           Backendless::$UserService->setCurrentUser(Session::get('user'));
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
        $LogUser = new \App\User();
        $user = Backendless::$UserService->login($param['email'], $param['password']);
        Session::put('user', $user);

            return redirect()->route('home');

/*        $result = array_values($user->works);
        $LogUser->works = $result;*/



/*           $test = Backendless::$UserService->getCurrentUser();
        $test->setName("Bob");
        $test->setProperty('job', null);
        $test->setPropert('works', null);
        Backendless::$UserService->update( $test );*/




        /*      $client = new Client('https://api.backendless.com/v1/');
              $test = $client->post('/users/login');
              $test->setAuth($request->email, $request->password);
              Log::info($test->getUrl());

              $response = $test->send();

              Log::info($response->getBody());*/
/*        $client = new Client();
        $response = $client->post('https://api.backendless.com/v1/users/login', [
            'auth' => [
                'username',
                'password'
            ]
        ])*/;



/*        $client = new Client('https://api.backendless.com/v1/users/login');
        $client->setSslVerification(FALSE);
        $res = $client->post('', [
        'headers' => [
            'application-id' => '603EA250-3BD9-5EB1-FF62-53D50AC37900',
            'secret-key' => '0E72338A-D313-ED73-FF03-E7DD53D51D00',
            'Content-Type', 'application/json',
            'application-type', 'REST'
        ],
         ],[
                'auth' => [
                    $request->email, $request->password,null
                ]
            ]
    );
       $result = $res->getBody();
        Log::info($result);*/

/*        $httpClient = new GuzzleClient('https://api.backendless.com/v1/users/login');
        $httpClient->setSslVerification(FALSE);

        $post_data = array(
            $request->email, $request->password,null
        );
        $option_array = array(
            'application-id' => '603EA250-3BD9-5EB1-FF62-53D50AC37900',
            'secret-key' => '0E72338A-D313-ED73-FF03-E7DD53D51D00',
            'Content-Type', 'application/json',
            'application-type', 'REST'
        );
        $response = $httpClient->post('', $option_array, $post_data)->send();*/





    }

    public function logout()
    {
       if(Session::has('user'))
       {
           Session::forget('user');
       }
        return redirect()->route('home');

    }
    public function dashboard()
    {
        if(Session::has('user'))
        {


            $works = Session::get('user')->works;

            return \view('/dashboard', array(
           'works' =>  $works));
        }
        else{
        return redirect()->roue('home');
        }
    }
    public function registration(Request $request)
    {
        $param = $request;
        if($param['password_confirmation'] == $param['password'])
        {
            $geopoint = new \App\GeoPoint();

            $geopoint->latitude = 50.484444;
            $geopoint->longitude = 4.254995;
            $geopoint->___class = 'GeoPoint';

            $user = new BackendlessUser();
            $user->setEmail($param['email']);
            $user->setPassword($param['password']);
            $user->setName($param['name']);
            $user->setProperty('professional', true);
            $user->setProperty('location', $geopoint);

            $user = Backendless::$UserService->register($user);
        }
        return redirect()->route('home');
    }

}
