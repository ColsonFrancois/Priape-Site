<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    private $title;
    private $scheduled;

    /**
     * Event constructor.
     * @param $title
     * @param $scheduled
     */
    public function __construct($title, $scheduled)
    {
        $this->title = $title;
        $this->scheduled = $scheduled;
    }

    public function serializeObject()
    {
        $data = array("title"=> $this->title, "scheduled" => $this->scheduled);
        $json = json_encode($data, true);
        return $json;
    }


    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getScheduled()
    {
        return $this->scheduled;
    }

    /**
     * @param mixed $scheduled
     */
    public function setScheduled($scheduled)
    {
        $this->scheduled = $scheduled;
    }


}
