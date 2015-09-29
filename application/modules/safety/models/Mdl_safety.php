<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Nitesh
 * Date: 9/28/2015
 * Time: 6:38 PM
 */
class Mdl_safety  extends CI_Model
{
    private $safety_id;
    private $safety_type;
    private $safety_card;
    private $fire_alarm;
    private $fire_extinguisher;
    private $emergency_exit;
    private $gas_valve;

    /**
     * @return mixed
     */
    public function getSafetyId()
    {
        return $this->safety_id;
    }

    /**
     * @param mixed $safety_id
     */
    public function setSafetyId($safety_id)
    {
        $this->safety_id = $safety_id;
    }

    /**
     * @return mixed
     */
    public function getSafetyType()
    {
        return $this->safety_type;
    }

    /**
     * @param mixed $safety_type
     */
    public function setSafetyType($safety_type)
    {
        $this->safety_type = $safety_type;
    }

    /**
     * @return mixed
     */
    public function getSafetyCard()
    {
        return $this->safety_card;
    }

    /**
     * @param mixed $safety_card
     */
    public function setSafetyCard($safety_card)
    {
        $this->safety_card = $safety_card;
    }

    /**
     * @return mixed
     */
    public function getFireAlarm()
    {
        return $this->fire_alarm;
    }

    /**
     * @param mixed $fire_alarm
     */
    public function setFireAlarm($fire_alarm)
    {
        $this->fire_alarm = $fire_alarm;
    }

    /**
     * @return mixed
     */
    public function getFireExtinguisher()
    {
        return $this->fire_extinguisher;
    }

    /**
     * @param mixed $fire_extinguisher
     */
    public function setFireExtinguisher($fire_extinguisher)
    {
        $this->fire_extinguisher = $fire_extinguisher;
    }

    /**
     * @return mixed
     */
    public function getEmergencyExit()
    {
        return $this->emergency_exit;
    }

    /**
     * @param mixed $emergency_exit
     */
    public function setEmergencyExit($emergency_exit)
    {
        $this->emergency_exit = $emergency_exit;
    }

    /**
     * @return mixed
     */
    public function getGasValve()
    {
        return $this->gas_valve;
    }

    /**
     * @param mixed $gas_valve
     */
    public function setGasValve($gas_valve)
    {
        $this->gas_valve = $gas_valve;
    }


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
    }



}
//hlu_renter_home_safety_id`, `hlu_renter_home_safety_type`, `hlu_renter_home_safety_card`,
 //`hlu_renter_home_safety_fire_alarm`, `hlu_renter_home_safety_fire_extinguisher`,
 //`hlu_renter_home_safety_emergency_exit`, `hlu_renter_home_safety_gas_valve