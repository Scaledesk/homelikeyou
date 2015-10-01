<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: Nitesh
 * Date: 9/28/2015
 * Time: 11:30 AM
 */
class Mdl_amenities extends CI_Model
{

    private $amenities_id;
    private $amenities_name;
    private $collection;

    /**
     * @return mixed
     */
    public function getCollection()
    {
        return $this->collection;
    }

    /**
     * @param mixed $collection
     */
    public function setCollection($collection)
    {
        $this->collection = $collection;
    }

    function __construct()
    {
        parent::__construct();
        $this->setCollection($this->db->select('hlu_renter_home_amenities_id,hlu_renter_home_amenities_name')->get('hlu_renter_home_amenities')->result_array());

    }


    /**
     * @return mixed
     */
    public function getAmenitiesId()
    {
        return $this->amenities_id;
    }

    /**
     * @param mixed $amenities_id
     */
    public function setAmenitiesId($amenities_id)
    {
        $this->amenities_id = $amenities_id;
    }

    /**
     * @return mixed
     */
    public function getAmenitiesName()
    {
        return $this->amenities_name;
    }

    /**
     * @param mixed $amenities_name
     */
    public function setAmenitiesName($amenities_name)

    {
        $this->amenities_name = $amenities_name;
    }



    public function setData()
    {
        $this->setAmenitiesName(func_get_arg(0));


    }
    private function _validate()
    {
        $this->setAmenitiesName($this->security->xss_clean($this->getAmenitiesName()));


    }



    public function amenities(){

        $this->_validate();

        $data = [
            'hlu_renter_home_amenities_name' => $this->getAmenitiesName()];
        return $this->db->insert('hlu_renter_home_amenities', $data) ? true : false;
    }



    public function toArray(){
        return $this->getCollection();
    }


    public function toString(){


        $query=$this->db->get("hlu_renter_home_amenities")->result_array();
      // print_r($query[0]);
        $data=implode(',',$query[0]);
        $data= (string)$data;

       // echo $data;
       // die();
        return $data;
    }
}