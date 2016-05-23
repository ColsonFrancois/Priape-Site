<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    private $objectId;
    private $name;
    private $email;
    private $job;
    private $password;
    private $description;
    private $location;
    private $picture;
    private $professional;
    private $userToken;
    private $works;
    private $phone;
    private $__meta;

    /**
     * User constructor.
     */
    public function __construct()
    {

    }
    public  function jsonDesializable($tab)
    {
        if(array_key_exists('objectId', $tab))
        {
            $this->objectId = $tab['objectId'];
        }
        $this->name = $tab['name'];
        $this->email = $tab['email'];
        $this->job = $tab['job'];
        $this->location = $tab['location'];
        if(array_key_exists('picture', $tab))
        {
            $this->picture = $tab['picture'];
        }
        $this->professional = $tab['professional'];
        $this->phone = $tab['phone'];
        $this->description = $tab['description'];
        if(array_key_exists('__meta', $tab))
        {
            $this->__meta = $tab['__meta'];
        }
        if(sizeof($tab['works']) < 0)
        {
            $this->works = null;
        }
        if(array_key_exists('password', $tab))
        {
            $this->password = $tab['password'];
        }
        else{
            $this->works = $tab['works'];
        }
    }

    public function jsonSerialize()
    {
        $data = array("objectId" => $this->objectId, "name"=>$this->name, "email" => $this->email,"job" => $this->job,"location" => $this->location,"picture" => $this->picture,"professional" => $this->professional,
            "phone" => $this->phone, "works"=>$this->works, "description" => $this->description, "__meta"=> $this->__meta, "password" => $this->password);
        $json =  json_encode($data, true);
        return $json;
    }
    public function jsonToRegister()
    {
        $data = array( "name"=>$this->name, "email" => $this->email,"job" => $this->job,"location" => $this->location,"picture" => $this->picture,"professional" => $this->professional,
            "phone" => $this->phone, "works"=>$this->works, "description" => $this->description, "__meta"=> $this->__meta, "password" => $this->password);
        $json =  json_encode($data, true);
        return $json;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getMeta()
    {
        return $this->__meta;
    }

    /**
     * @param mixed $_meta
     */
    public function setMeta($_meta)
    {
        $this->__meta = $_meta;
    }


    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getWorks()
    {
        return $this->works;
    }

    /**
     * @param mixed $works
     */
    public function setWorks($works)
    {
        $this->works = $works;

    }


    /**
     * @return string
     */
    public function getPrimaryKey()
    {
        return $this->primaryKey;
    }

    /**
     * @param string $primaryKey
     */
    public function setPrimaryKey($primaryKey)
    {
        $this->primaryKey = $primaryKey;
    }

    /**
     * @return mixed
     */
    public function getObjectId()
    {
        return $this->objectId;
    }

    /**
     * @param mixed $objectId
     */
    public function setObjectId($objectId)
    {
        $this->objectId = $objectId;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getJob()
    {
        return $this->job;
    }

    /**
     * @param mixed $job
     */
    public function setJob($job)
    {
        $this->job = $job;
    }

    /**
     * @return mixed
     */
    public function getProfessional()
    {
        return $this->professional;
    }

    /**
     * @param mixed $professional
     */
    public function setProfessional($professional)
    {
        $this->professional = $professional;
    }

    /**
     * @return mixed
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @param mixed $picture
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
    }

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getUserToken()
    {
        return $this->userToken;
    }

    /**
     * @param mixed $userToken
     */
    public function setUserToken($userToken)
    {
        $this->userToken = $userToken;
    }



    // 'objectId', 'name', 'email', 'password', 'works', 'job', 'location', 'picture', 'professional', 'userToken','phone'

}
