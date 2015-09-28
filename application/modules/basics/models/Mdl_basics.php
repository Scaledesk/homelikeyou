<?php

/**
 * Created by PhpStorm.
 * User: webo
 * Date: 9/26/2015
 * Time: 6:50 PM
 */
class Mdl_basics extends CI_Model
{
     private $basics_id;
    private $basics_bedrooms;
    private $basics_beds;
    private $basics_bathrooms;

    /**
     * @return mixed
     */
    public function getBasicsId()
    {
        return $this->basics_id;
    }

    /**
     * @param mixed $basics_id
     */
    public function setBasicsId($basics_id)
    {
        $this->basics_id = $basics_id;
    }

    /**
     * @return mixed
     */
    public function getBasicsBedrooms()
    {
        return $this->basics_bedrooms;
    }

    /**
     * @param mixed $basics_bedrooms
     */
    public function setBasicsBedrooms($basics_bedrooms)
    {
        $this->basics_bedrooms = $basics_bedrooms;
    }

    /**
     * @return mixed
     */
    public function getBasicsBeds()
    {
        return $this->basics_beds;
    }

    /**
     * @param mixed $basics_beds
     */
    public function setBasicsBeds($basics_beds)
    {
        $this->basics_beds = $basics_beds;
    }

    /**
     * @return mixed
     */
    public function getBasicsBathrooms()
    {
        return $this->basics_bathrooms;
    }

    /**
     * @param mixed $basics_bathrooms
     */
    public function setBasicsBathrooms($basics_bathrooms)
    {
        $this->basics_bathrooms = $basics_bathrooms;
    }


    public function setData()
    {
        $this->setBasicsId(func_get_arg(0));
        $this->setBasicsBeds(func_get_arg(1));
        $this->setBasicsBedrooms(func_get_arg(2));
        $this->setBasicsBathrooms(func_get_arg(3));


    }
    private function _validate()
    {
        $this->setBasicsBeds($this->security->xss_clean($this->getBasicsBeds()));
        $this->setBasicsBedrooms($this->security->xss_clean($this->getBasicsBedrooms()));
        $this->setBasicsBathrooms($this->security->xss_clean($this->getBasicsBathrooms()));

    }




    public function basics(){

        $this->_validate();

        $data = [
            'hlu_renter_home_basics_id' => $this->getBasicsId(),
            'hlu_renter_home_basics_bedrooms' => $this->getBasicsBeds(),
            'hlu_renter_home_basics_beds' => $this->getBasicsBedrooms(),
            'hlu_renter_home_basics_bathrooms' => $this->getBasicsBathrooms()

        ];
        return $this->db->insert('hlu_renter_home_basics', $data) ? true : false;
    }
}