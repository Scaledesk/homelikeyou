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

                $this->setProfilesId(func_get_arg(1));
                $this->setSendTo(func_get_arg(2));
                 $this->setSubject(func_get_arg(3));
                 $this->setBody(func_get_arg(4));
                $this->setAttached(func_get_arg(5));

                break;
            }
            default : break;
        }

    }

    public function sendTo(){


        switch(func_get_arg(0)) {
            case 'send': {
                $this->_validate(func_get_arg(0));

               // $send_to = $this->input->post('recipients');
               // echo "</pre";
             //  echo $send_to= $this->getSendTo();
              // $send_to= implode(" ",$this->getSendTo());
                //echo $send_to;
                //die();
                $status = 0;
                $time = date('Y-m-d H:i:s', time());
                $this->db->trans_start();
               /* echo '<pre/>';
                print_r($this->getSendTo());
                die;*/
                foreach($this->getSendTo() as $send ) {


                    $data = array(
                        'hlu_messages_title' => $this->getSubject(),
                        'hlu_messages_body' => $this->getBody(),
                        'hlu_messages_send_to' => $send,
                        'hlu_messages_send_by' => $this->getProfilesId(),
                        'hlu_messages_attached' => $this->getAttached(),
                        'hlu_messages_time' => $time,
                        'hlu_messages_status' => $status,

                    );

                    $this->db->insert('hlu_messages', $data);

                }
                    $this->db->trans_complete();
                       return $this->db->trans_status()?true:false;
                break;
            }
            default :
                break;
        }
    }



    private function _validate()
    {switch(func_get_arg(0)) {
        case 'send': {
            $this->setSendTo($this->security->xss_clean($this->getSendTo()));
            $this->setSubject($this->security->xss_clean($this->getSubject()));
            $this->setBody($this->security->xss_clean($this->getBody()));
            $this->setAttached($this->security->xss_clean($this->getAttached()));
            break;
        }


        default:
            break;
    }
    }


     public function getEmail(){

       $data= $this->db->get('hlu_users')->result();

        return $data;
    }

}