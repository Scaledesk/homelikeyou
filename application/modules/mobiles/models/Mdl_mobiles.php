<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Nitesh
 * Date: 9/29/2015
 * Time: 5:14 PM
 */
class Mdl_mobiles extends CI_Model
{
    private $mobile_id;
    private $mobile_number;
    private $mobile_status;
    private $mobile_home_id;

    /**
     * @return mixed
     */
    public function getMobileId()
    {
        return $this->mobile_id;
    }

    /**
     * @param mixed $mobile_id
     */
    public function setMobileId($mobile_id)
    {
        $this->mobile_id = $mobile_id;
    }

    /**
     * @return mixed
     */
    public function getMobileNumber()
    {
        return $this->mobile_number;
    }

    /**
     * @param mixed $mobile_number
     */
    public function setMobileNumber($mobile_number)
    {
        $this->mobile_number = $mobile_number;
    }

    /**
     * @return mixed
     */
    public function getMobileStatus()
    {
        return $this->mobile_status;
    }

    /**
     * @param mixed $mobile_status
     */
    public function setMobileStatus($mobile_status)
    {
        $this->mobile_status = $mobile_status;
    }

    /**
     * @return mixed
     */
    public function getMobileHomeId()
    {
        return $this->mobile_home_id;
    }

    /**
     * @param mixed $mobile_home_id
     */
    public function setMobileHomeId($mobile_home_id)
    {
        $this->mobile_home_id = $mobile_home_id;
    }



    public function setData()
    {
        switch(func_get_arg(0)){
            case "update":{
                //echo func_get_arg(3);
                $this->setMobileHomeId(func_get_arg(1));
                $this->setMobileNumber(func_get_arg(2));
                break;
            }
            case "status":{
                $this->setMobileHomeId(func_get_arg(1));
            }
            default:
                $this->setMobileHomeId(func_get_arg(0));
                $this->setMobileNumber(func_get_arg(1));
                break;
        }



    }
    private function _validate()
    {
        switch(func_get_arg(0)){
            case "update":{
                $this->setMobileHomeId($this->security->xss_clean($this->getMobileHomeId()));
                $this->setMobileNumber($this->security->xss_clean($this->getMobileNumber()));

                break;
            }

            case "status":{
                $this->setMobileHomeId($this->security->xss_clean($this->getMobileHomeId()));
                break;
            }
            default:
                $this->setMobileHomeId($this->security->xss_clean($this->getMobileHomeId()));
                $this->setMobileNumber($this->security->xss_clean($this->getMobileNumber()));


                break;
        }


    }
    public function updateMobiles(){
        $this->_validate(func_get_arg(0));
        $data = [
            'hlu_renter_home_mobile_number' => 1

        ];
//                                    echo '<pre/>';
//                                    print_r($data);
        return $this->db->where(array('hlu_renter_home_mobile_home_id'=>$this->getMobileHomeId()))->update('hlu_renter_home_mobile', $data) ? true : false;

    }



    public function varifyMobiles(){

        $this->_validate(func_get_arg(0));
        $data = [
            'hlu_renter_home_mobile_status' => $this->getMobileStatus()

        ];
        return $this->db->where(array('hlu_renter_home_mobile_home_id'=>$this->getMobileHomeId()))->update('hlu_renter_home_mobile', $data) ? true : false;
    }


    public function mobiles(){

        //echo func_get_arg(0);
        // die();
        $this->_validate(func_get_arg(0));

        $data = [
            'hlu_renter_home_mobile_number' => $this->getMobileNumber(),
            'hlu_renter_home_mobile_home_id' => $this->getMobileHomeId()

        ];
        return $this->db->insert('hlu_renter_home_mobile', $data) ? true : false;
    }



    public function toArray(){


        $query=$this->db->get("hlu_renter_home_mobile")->result_array();

            $data = array(
                'mobile_id' => $query[0]['hlu_renter_home_mobile_id'],
                'mobile_number' => $query[0]['hlu_renter_home_mobile_number'],
                'mobile_status' => $query[0]['hlu_renter_home_mobile_status'],
                'home_id' => $query[0]['hlu_renter_home_mobile_home_id']

            );

        return $data;
    }


    public function toString(){


        $query=$this->db->get("hlu_renter_home_mobile")->result_array();
        // print_r($query[0]);
        $data=implode(',',$query[0]);
        $data= (string)$data;

       // echo $data;
       // die();
        return $data;
    }

}
/*
`hlu_renter_home_mobile_id`,
`hlu_renter_home_mobile_number`,
`hlu_renter_home_mobile_status`,
`hlu_renter_home_mobile_home_id*/