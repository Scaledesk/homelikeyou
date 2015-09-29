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

}
//hlu_renter_home_safety_id`, `hlu_renter_home_safety_type`, `hlu_renter_home_safety_card`,
 //`hlu_renter_home_safety_fire_alarm`, `hlu_renter_home_safety_fire_extinguisher`,
 //`hlu_renter_home_safety_emergency_exit`, `hlu_renter_home_safety_gas_valve