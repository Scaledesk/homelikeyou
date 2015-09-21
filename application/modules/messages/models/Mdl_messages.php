<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Nitesh
 * Date: 9/19/2015
 * Time: 4:08 PM
 */
class Mdl_messages extends CI_Model
{
    private $profiles_id;
    private $send_to;
    private $subject;
    private $body;
    private $attached;
    /**
     * @return mixed
     */

    public function __construct(){
        parent::__construct();

    }
    public function getProfilesId()
    {
        return $this->profiles_id;
    }

    /**
     * @param mixed $profiles_id
     */
    public function setProfilesId($profiles_id)
    {
        $this->profiles_id = $profiles_id;
    }

    /**
     * @return mixed
     */
    public function getSendTo()
    {
        return $this->send_to;
    }

    /**
     * @param mixed $send_to
     */
    public function setSendTo($send_to)
    {
        $this->send_to = $send_to;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param mixed $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param mixed $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @return mixed
     */
    public function getAttached()
    {
        return $this->attached;
    }

    /**
     * @param mixed $attached
     */
    public function setAttached($attached)
    {
        $this->attached = $attached;
    }
    public  function setData(){
        switch(func_get_arg(0)){
            case "send":{
                //echo func_get_arg(3);
                $this->setSendTo(func_get_arg(1));
                $this->setSubject(func_get_arg(2));
                $this->setBody(func_get_arg(3));
                $this->setAttached(func_get_arg(4));
                break;
            }
            default : break;
        }

    }

}