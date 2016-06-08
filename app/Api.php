<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Api extends Model
{
    public static function login($email, $pass)
    {
        $json = '{
        "login":"' . $email . '",
"password":"' . $pass . '"
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
        return json_decode($response, true);
    }


    public static function getUser($objectId, $token)
    {
        $whereClause = "objectId='" . $objectId . "'";
        $link = 'https://api.backendless.com/v1/data/users?where=' . $whereClause;
        $response = \Httpful\Request::get($link)
            ->addHeader('application-id', '603EA250-3BD9-5EB1-FF62-53D50AC37900')
            ->addHeader('secret-key', '0E72338A-D313-ED73-FF03-E7DD53D51D00')
            ->addHeader('application-type', 'REST')
            ->addHeader('Content-Type', 'application/json')
            ->addHeader('user-token', $token)
            ->send();
        log:info($response);

        return json_decode($response, true);
    }

    public static function logout($token)
    {

            $url = 'https://api.backendless.com/v1/users/logout';
            $response = \Httpful\Request::put($url)
                ->addHeader('application-id', '603EA250-3BD9-5EB1-FF62-53D50AC37900')
                ->addHeader('secret-key', '0E72338A-D313-ED73-FF03-E7DD53D51D00')
                ->addHeader('application-type', 'REST')
                ->addHeader('user-token', $token)
                ->send();


    }

    public static function getWeather($lat, $lng)
    {
        $uri = 'http://api.openweathermap.org/data/2.5/forecast/daily?lat=' . $lat . '&lon=' . $lng . '&cnt=7&mode=json&appid=95f9f04721ddf57f75017fc3cf07ff78';
        $response = \Httpful\Request::get($uri)
            ->send();
        $tab = json_decode($response, true);
        $array = array();
        $i = 0;
        foreach ($tab["list"] as $value) {

            $tamp['city'] = $tab['city']['name'];
            $tamp["day"] = date("w", $value['dt']);
            $tamp["temp"] = round($value["temp"]["day"] - 273.15);
            $tamp["icon"] = $value["weather"][0]["icon"];
            array_push($array, $tamp);
            $i++;

        }

        return $array;
    }
    public static function uploadImage($name,$email,$token, $image)
    {
        $uri = 'https://api.backendless.com/v1/files/images/'.$name.$email.'.jpg';
        $response = \Httpful\Request::post($uri)
            ->addHeader('application-id', '603EA250-3BD9-5EB1-FF62-53D50AC37900')
            ->addHeader('secret-key', '0E72338A-D313-ED73-FF03-E7DD53D51D00')
            ->addHeader('Content-Type', 'application/json')
            ->addHeader('application-type', 'REST')
            ->addHeader('user-token', $token)
            ->attach($image)
            ->send();
        $tableau = json_decode($response, true);
        $picture = $tableau['fileURL'];

        return $picture;
    }

    public static  function register($user){
        $uri = 'https://api.backendless.com/v1/users/register';
        $response = \Httpful\Request::post($uri)
            ->sendsJson()
            ->addHeader('application-id', '603EA250-3BD9-5EB1-FF62-53D50AC37900')
            ->addHeader('secret-key', '0E72338A-D313-ED73-FF03-E7DD53D51D00')
            ->addHeader('Content-Type', 'application/json')
            ->addHeader('application-type', 'REST')
            ->body($user)
            ->send();
        log:info($response);
    }

    public static function add($token, $object)
    {
        $url = 'https://api.backendless.com/v1/data/Event';
        $response = \Httpful\Request::post($url)
            ->sendsJson()
            ->addHeader('application-id', '603EA250-3BD9-5EB1-FF62-53D50AC37900')
            ->addHeader('secret-key', '0E72338A-D313-ED73-FF03-E7DD53D51D00')
            ->addHeader('Content-Type', 'application/json')
            ->addHeader('application-type', 'REST')
            ->addHeader('user-token', $token)
            ->body($object)
            ->send();
    }

    public static function remove($token, $objectId)
    {
        $url = 'https://api.backendless.com/v1/data/Event/'.$objectId;
        $response = \Httpful\Request::delete($url)
            ->addHeader('application-id', '603EA250-3BD9-5EB1-FF62-53D50AC37900')
            ->addHeader('secret-key', '0E72338A-D313-ED73-FF03-E7DD53D51D00')
            ->addHeader('application-type', 'REST')
            ->addHeader('user-token', $token)
            ->send();
    }
    public static function getEvent($token)
    {
        $url = 'https://api.backendless.com/v1/data/Event';

        $response = \Httpful\Request::get($url)
            ->addHeader('application-id', '603EA250-3BD9-5EB1-FF62-53D50AC37900')
            ->addHeader('secret-key', '0E72338A-D313-ED73-FF03-E7DD53D51D00')
            ->addHeader('Content-Type', 'application/json')
            ->addHeader('application-type', 'REST')
            ->addHeader('user-token', $token)
            ->send();

        $tab = json_decode($response, true);
        return $tab;
    }

    public static function editUser($token, $object, $objectId)
    {

        $url = 'https://api.backendless.com/v1/users/'.$objectId;
        $response = \Httpful\Request::put($url)
            ->sendsJson()
            ->addHeader('application-id', '603EA250-3BD9-5EB1-FF62-53D50AC37900')
            ->addHeader('secret-key', '0E72338A-D313-ED73-FF03-E7DD53D51D00')
            ->addHeader('Content-Type', 'application/json')
            ->addHeader('application-type', 'REST')
            ->addHeader('user-token', $token)
            ->body($object)
            ->send();
        $resp = json_decode($response, true);
        log:info('la reponse  '.$response);
        return $resp;
    }
    public static function getWorks($job, $token)
    {
        $whereClause = "job='".$job."'";
        $url = 'https://api.backendless.com/v1/data/Work?where='.$whereClause;
        $response = \Httpful\Request::get($url)
            ->addHeader('application-id', '603EA250-3BD9-5EB1-FF62-53D50AC37900')
            ->addHeader('secret-key', '0E72338A-D313-ED73-FF03-E7DD53D51D00')
            ->addHeader('application-type', 'REST')
            ->addHeader('Content-Type', 'application/json')
            ->addHeader('user-token',$token)
            ->send();
        $workTab = json_decode($response, true);
        return $workTab;
    }
    public static function getComment($token, $professional)
    {
        $whereClause ="professional='".$professional."'";
        $url = 'https://api.backendless.com/v1/data/Comment?where='.$whereClause;
        $response = \Httpful\Request::get($url)
            ->addHeader('application-id', '603EA250-3BD9-5EB1-FF62-53D50AC37900')
            ->addHeader('secret-key', '0E72338A-D313-ED73-FF03-E7DD53D51D00')
            ->addHeader('application-type', 'REST')
            ->addHeader('Content-Type', 'application/json')
            ->addHeader('user-token',$token)
            ->send();
        $commentTab = json_decode($response, true);
       return $commentTab['data'];
    }


}


