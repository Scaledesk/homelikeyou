<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: Nitesh
 * Date: 9/25/2015
 * Time: 5:32 PM
 */
class Mdl_renters extends CI_Model
{
    private $home_id;
    private $home_type;
    private $room_type;
    private $home_accomodates;

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



    public function setData()
    {
        switch (func_get_arg(0)) {
            case "step1": {
                $this->setHomeType(func_get_arg(1));
                $this->setRoomType(func_get_arg(2));
                $this->setHomeAccomodates(func_get_arg(3));
                break;
            }
            default :
                break;

        }


    }


    private function _validate()
      {
                    switch(func_get_arg(0)) {
                    case 'step1': {
                        $this->setHomeType($this->security->xss_clean($this->getHomeType()));
                        $this->setRoomType($this->security->xss_clean($this->getRoomType()));
                        $this->setHomeAccomodates($this->security->xss_clean($this->getHomeAccomodates()));
                        break;
                    }
                        default :break;
                   }
      }



    public function insertHome(){
                switch(func_get_arg(0)){
                    case 'step1': {
                        $this->_validate(func_get_arg(0));

                        $data = [
                            'hlu_renter_home_type' => $this->getHomeType(),
                            'hlu_renter_home_room_type' => $this->getRoomType(),
                            'hlu_renter_home_accomodates' => $this->getHomeAccomodates(),
                        ];
                        return $this->db->insert('hlu_renter_home', $data) ? true : false;
                        break;
                    }
                    default :break;
                }
    }
}