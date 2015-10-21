<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Javed
 * Date: 9/29/2015
 * Time: 3:38 PM
 */
class Mdl_photos  extends CI_Model
{
    private $renter_home_id;
    private $renter_home_photo;

    /**
     * @return mixed
     */
    public function getRenterHomeId()
    {
        return $this->renter_home_id;
    }

    /**
     * @param mixed $renter_home_id
     */
    public function setRenterHomeId($renter_home_id)
    {
        $this->renter_home_id = $renter_home_id;
    }

    /**
     * @return mixed
     */
    public function getRenterHomePhoto()
    {
        return $this->renter_home_photo;
    }

    /**
     * @param mixed $renter_home_photo
     */
    public function setRenterHomePhoto($renter_home_photo)
    {
        $this->renter_home_photo = $renter_home_photo;
    }

    public function photosInsert(){

        $data = [
            'hlu_renter_home_photo_home_id' => $this->getRenterHomeId(),
            'hlu_renter_home_photo_url' => $this->getRenterHomePhoto()
        ];
        return $this->db->insert('hlu_renter_home_photo', $data) ? true : false;
    }

    public function viewRenterHomePhoto()
    {
       return $this->db->get('hlu_renter_home_photo')->result();
    }
    public function deleteRenterHomePhoto($id)
    {
        $this->db->where('hlu_renter_home_photo_id',$id);
        $this->db->delete('hlu_renter_home_photo');
        return true;
    }



   /*
    *

    public function setData()
    {
        switch(func_get_arg(0)){
            case "update":{
                //echo func_get_arg(3);
                $this->setSafetyId(func_get_arg(1));
                $this->setSafetyType(func_get_arg(2));
                $this->setFireAlarm(func_get_arg(3));
                $this->setFireExtinguisher(func_get_arg(4));
                $this->setGasValve(func_get_arg(5));
                $this->setSafetyCard(func_get_arg(6));
                $this->setEmergencyExit(func_get_arg(7));
                break;
            }
            default:
                $this->setSafetyId(func_get_arg(0));
                $this->setSafetyType(func_get_arg(1));
                $this->setFireAlarm(func_get_arg(2));
                $this->setFireExtinguisher(func_get_arg(3));
                $this->setGasValve(func_get_arg(4));
                $this->setSafetyCard(func_get_arg(5));
                $this->setEmergencyExit(func_get_arg(6));

                break;
        }



    }
    private function _validate()
    {
        switch(func_get_arg(0)){
            case "update":{
                $this->setSafetyId($this->security->xss_clean($this->getSafetyId()));
                $this->setSafetyType($this->security->xss_clean($this->getSafetyType()));
                $this->setFireAlarm($this->security->xss_clean($this->getFireAlarm()));
                $this->setFireExtinguisher($this->security->xss_clean($this->getFireExtinguisher()));
                $this->setGasValve($this->security->xss_clean($this->getGasValve()));
                $this->setSafetyCard($this->security->xss_clean($this->getSafetyCard()));
                $this->setEmergencyExit($this->security->xss_clean($this->getEmergencyExit()));
                break;
            }
            default:
                $this->setSafetyId($this->security->xss_clean($this->getSafetyId()));
                $this->setSafetyType($this->security->xss_clean($this->getSafetyType()));
                $this->setFireAlarm($this->security->xss_clean($this->getFireAlarm()));
                $this->setFireExtinguisher($this->security->xss_clean($this->getFireExtinguisher()));
                $this->setGasValve($this->security->xss_clean($this->getGasValve()));
                $this->setSafetyCard($this->security->xss_clean($this->getSafetyCard()));
                $this->setEmergencyExit($this->security->xss_clean($this->getEmergencyExit()));


                break;
        }


    }



    public function updateSafety(){
        $this->_validate(func_get_arg(0));
        $data = [
            'hlu_renter_home_safety_type' => $this->getSafetyType(),
            'hlu_renter_home_safety_card' => $this->getSafetyCard(),
            'hlu_renter_home_safety_fire_alarm' => $this->getFireAlarm(),
            'hlu_renter_home_safety_fire_extinguisher' => $this->getFireExtinguisher(),
            'hlu_renter_home_safety_emergency_exit' => $this->getEmergencyExit(),
            'hlu_renter_home_safety_gas_valve' => $this->getGasValve()
        ];
//                                    echo '<pre/>';
//                                    print_r($data);
        return $this->db->where(array('hlu_renter_home_safety_id'=>$this->getSafetyId()))->update('hlu_renter_home_safety', $data) ? true : false;

    }


    public function safety(){

        //echo func_get_arg(0);
        // die();
        $this->_validate(func_get_arg(0));

        $data = [
            'hlu_renter_home_safety_id' => $this->getSafetyId(),
            'hlu_renter_home_safety_type' => $this->getSafetyType(),
            'hlu_renter_home_safety_card' => $this->getSafetyCard(),
            'hlu_renter_home_safety_fire_alarm' => $this->getFireAlarm(),
            'hlu_renter_home_safety_fire_extinguisher' => $this->getFireExtinguisher(),
            'hlu_renter_home_safety_emergency_exit' => $this->getEmergencyExit(),
            'hlu_renter_home_safety_gas_valve' => $this->getGasValve()
        ];
        return $this->db->insert('hlu_renter_home_safety', $data) ? true : false;
    }



    public function toArray(){


        $query=$this->db->get("hlu_renter_home_safety")->result_array();

        $data=array(
            'safety_id'=>$query[0]['hlu_renter_home_safety_id'],
            'safety_type'=>$query[0]['hlu_renter_home_safety_type'],
            'safety_card'=>$query[0]['hlu_renter_home_safety_card'],
            'fire_alarm'=>$query[0]['hlu_renter_home_safety_fire_alarm'],
            'fire_extinguisher'=>$query[0]['hlu_renter_home_safety_fire_extinguisher'],
            'emergency_exit'=>$query[0]['hlu_renter_home_safety_emergency_exit'],
            'gas_valve'=>$query[0]['hlu_renter_home_safety_gas_valve']

        );

        return $data;
    }


    public function toString(){


        $query=$this->db->get("hlu_renter_home_safety")->result_array();
        // print_r($query[0]);
        $data=implode(',',$query[0]);
        $data= (string)$data;

        // echo $data;
        // die();
        return $data;
    }       */



}