<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Nitesh
 * Date: 9/28/2015
 * Time: 2:46 PM
 */
class Mdl_have_amenities extends CI_Model
{
    private $amenities_id;
    private $amenities_home_id;
    private $amenities_amenities_id;

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
    public function getAmenitiesHomeId()
    {
        return $this->amenities_home_id;
    }

    /**
     * @param mixed $amenities_home_id
     */
    public function setAmenitiesHomeId($amenities_home_id)
    {
        $this->amenities_home_id = $amenities_home_id;
    }

    /**
     * @return mixed
     */
    public function getAmenitiesAmenitiesId()
    {
        return $this->amenities_amenities_id;
    }

    /**
     * @param mixed $amenities_amenities_id
     */
    public function setAmenitiesAmenitiesId($amenities_amenities_id)
    {
        $this->amenities_amenities_id = $amenities_amenities_id;
    }
    public function setData()
    {
        switch(func_get_arg(0)){
            case "update":{
                //echo func_get_arg(3);
                $this->setAmenitiesId(func_get_arg(1));
                $this->setAmenitiesHomeId(func_get_arg(2));
                $this->setAmenitiesAmenitiesId(func_get_arg(3));
                break;
            }
            default:
                $this->setAmenitiesHomeId(func_get_arg(0));
                $this->setAmenitiesAmenitiesId(func_get_arg(1));
                break;
        }



    }
    private function _validate()
    {
        switch(func_get_arg(0)){
            case "update":{
                 $this->setAmenitiesHomeId($this->security->xss_clean($this->getAmenitiesHomeId()));
                 $this->setAmenitiesAmenitiesId($this->security->xss_clean($this->getAmenitiesAmenitiesId()));
                break;
            }
            default:
                $this->setAmenitiesHomeId($this->security->xss_clean($this->getAmenitiesHomeId()));
                $this->setAmenitiesAmenitiesId($this->security->xss_clean($this->getAmenitiesAmenitiesId()));

                break;
        }


    }
public function updateAmenities(){
    $this->_validate(func_get_arg(0));
    $data = [
        'hlu_renter_home_have_amenities_home_id' => $this->getAmenitiesHomeId(),
        'hlu_renter_home_have_amenities_amenities_id' => $this->getAmenitiesAmenitiesId()
    ];
//                                    echo '<pre/>';
//                                    print_r($data);
    return $this->db->where(array('hlu_renter_home_have_amenities_id'=>$this->getAmenitiesId()))->update('hlu_renter_home_have_amenities', $data) ? true : false;

}
    public function amenities(){

        $this->_validate(func_get_arg(0));

        $data = [
            'hlu_renter_home_have_amenities_home_id' => $this->getAmenitiesHomeId(),
            'hlu_renter_home_have_amenities_amenities_id' => $this->getAmenitiesAmenitiesId()];
        return $this->db->insert('hlu_renter_home_have_amenities', $data) ? true : false;
    }
    public function toArray(){
        $query=$this->db->get("hlu_renter_home_have_amenities")->result_array();

        $data=array(
            'have_amenities_id'=>$query[0]['hlu_renter_home_have_amenities_id'],
            'amenities_home_id'=>$query[0]['hlu_renter_home_have_amenities_home_id'],
            'amenities_id'=>$query[0]['hlu_renter_home_have_amenities_amenities_id']

        );

        return $data;
    }
    public function toString(){
        $query=$this->db->get("hlu_renter_home_have_amenities")->result_array();
        // print_r($query[0]);
        $data=implode(',',$query[0]);
        $data= (string)$data;

        // echo $data;
        // die();
        return $data;
    }
}