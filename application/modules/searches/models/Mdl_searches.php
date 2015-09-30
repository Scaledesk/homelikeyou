<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Nitesh
 * Date: 9/30/2015
 * Time: 12:28 PM
 */
class Mdl_searches extends CI_Model
{
    private  $home_id;
    private  $home_type;
    private  $home_accomodates;
    private  $home_city;
    private  $room_type;

    /**
     * @return mixed
     */
    public function getHomeId()
    {
        return $this->home_id;
    }

    /**
     * @param mixed $home_id
     */
    public function setHomeId($home_id)
    {
        $this->home_id = $home_id;
    }

    /**
     * @return mixed
     */
    public function getHomeType()
    {
        return $this->home_type;
    }

    /**
     * @param mixed $home_type
     */
    public function setHomeType($home_type)
    {
        $this->home_type = $home_type;
    }

    /**
     * @return mixed
     */
    public function getHomeAccomodates()
    {
        return $this->home_accomodates;
    }

    /**
     * @param mixed $home_accomodates
     */
    public function setHomeAccomodates($home_accomodates)
    {
        $this->home_accomodates = $home_accomodates;
    }

    /**
     * @return mixed
     */
    public function getHomeCity()
    {
        return $this->home_city;
    }

    /**
     * @param mixed $home_city
     */
    public function setHomeCity($home_city)
    {
        $this->home_city = $home_city;
    }

    /**
     * @return mixed
     */
    public function getRoomType()
    {
        return $this->room_type;
    }

    /**
     * @param mixed $room_type
     */
    public function setRoomType($room_type)
    {
        $this->room_type = $room_type;
    }



    public function setData()
    {
        switch (func_get_arg(0)) {
            case "home": {
            $this->setHomeType(func_get_arg(1));
            break;
           }
            case "room": {
                $this->setHomeType(func_get_arg(1));
                break;
            }
            default :
                break;

        }
    }


    private function _validate()
    {
        switch(func_get_arg(0)) {
            case 'home': {
                $this->setHomeType($this->security->xss_clean($this->getHomeType()));
                break;
            }
            case 'room': {
                $this->setRoomType($this->security->xss_clean($this->getRoomType()));
                break;
            }
            default :break;
        }
    }


    public function searches(){
        switch(func_get_arg(0)){
            case 'home': {
                $this->_validate(func_get_arg(0));
                 $this->getHomeType();
                 $this->db->like('hlu_renter_home_type', $this->getHomeType());
                // $this->db->like('LOWER(' .'hlu_renter_home_type'. ')', strtolower($this->getHomeType()));
                 $data= $this->db->get('hlu_renter_home')->result();
               // echo "</>";
               /* echo '<pre/>';
                 print_r($data->result());
                 die(); */
                return $data;
                 break;
                }
            case 'room': {
                $this->_validate(func_get_arg(0));
                $this->db->like('hlu_renter_home_room_type', $this->getHomeType());
                $data= $this->db->get('hlu_renter_home')->result();
                //$this->db->like('LOWER(' .'hlu_renter_home_room_type'. ')', strtolower($this->getRoomType()));
              //  $data = ['hlu_renter_home_room_type' => $this->getHomeType()];
               /* echo '<pre/>';
                print_r($data->result());
                die();*/
               // return $this->db->get('hlu_renter_home');
                return $data;
                break;
            }
            default :break;
        }
    }



}


