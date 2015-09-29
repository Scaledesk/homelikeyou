<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: Nitesh
 * Date: 9/28/2015
 * Time: 12:51 PM
 */
class Mdl_descriptions extends CI_Model
{
    private $description_id;
    private $description_name;
    private $description_summary;

    /**
     * @return mixed
     */
    public function getDescriptionId()
    {
        return $this->description_id;
    }

    /**
     * @param mixed $description_id
     */
    public function setDescriptionId($description_id)
    {
        $this->description_id = $description_id;
    }

    /**
     * @return mixed
     */
    public function getDescriptionName()
    {
        return $this->description_name;
    }

    /**
     * @param mixed $description_name
     */
    public function setDescriptionName($description_name)
    {
        $this->description_name = $description_name;
    }

    /**
     * @return mixed
     */
    public function getDescriptionSummary()
    {
        return $this->description_summary;
    }

    /**
     * @param mixed $description_summary
     */
    public function setDescriptionSummary($description_summary)
    {
        $this->description_summary = $description_summary;
    }



    public function setData()
    {
        $this->setDescriptionId(func_get_arg(0));
        $this->setDescriptionName(func_get_arg(1));
        $this->setDescriptionSummary(func_get_arg(2));


    }
    private function _validate()
    {
        $this->setDescriptionName($this->security->xss_clean($this->getDescriptionName()));
        $this->setDescriptionSummary($this->security->xss_clean($this->getDescriptionSummary()));
        $this->setDescriptionId($this->security->xss_clean($this->getDescriptionId()));


    }



    public function description(){

        $this->_validate();

        $data = [
            'hlu_renter_home_description_id' => $this->getDescriptionId(),
            'hlu_renter_home_description_name' => $this->getDescriptionName(),
            'hlu_renter_home_description_summary' => $this->getDescriptionSummary()];
         return $this->db->insert('hlu_renter_home_description', $data) ? true : false;
    }



    public function toArray(){


        $query=$this->db->get("hlu_renter_home_description")->result_array();

        $data=array(
            'description_id'=>$query[0]['hlu_renter_home_description_id'],
            'description_name'=>$query[0]['hlu_renter_home_description_name'],
            'description_summary'=>$query[0]['hlu_renter_home_description_summary']

        );

        return $data;
    }


    public function toString(){


        $query=$this->db->get("hlu_renter_home_description")->result_array();
        // print_r($query[0]);
        $data=implode(',',$query[0]);
        $data= (string)$data;

        // echo $data;
        // die();
        return $data;
    }
}

