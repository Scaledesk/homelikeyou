<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Nitesh
 * Date: 9/26/2015
 * Time: 4:09 PM
 */
class Mdl_address extends CI_Model
{
    private $address_id;
    private $address_hno;
    private $address_street;
    private $address_city;
    private $address_state;
    private $address_country;
    private $address_zip;

    /**
     * @return mixed
     */
    public function getAddressId()
    {
        return $this->address_id;
    }

    /**
     * @param mixed $address_id
     */
    public function setAddressId($address_id)
    {
        $this->address_id = $address_id;
    }

    /**
     * @return mixed
     */
    public function getAddressHno()
    {
        return $this->address_hno;
    }

    /**
     * @param mixed $address_hno
     */
    public function setAddressHno($address_hno)
    {
        $this->address_hno = $address_hno;
    }

    /**
     * @return mixed
     */
    public function getAddressStreet()
    {
        return $this->address_street;
    }

    /**
     * @param mixed $address_street
     */
    public function setAddressStreet($address_street)
    {
        $this->address_street = $address_street;
    }

    /**
     * @return mixed
     */
    public function getAddressCity()
    {
        return $this->address_city;
    }

    /**
     * @param mixed $address_city
     */
    public function setAddressCity($address_city)
    {
        $this->address_city = $address_city;
    }

    /**
     * @return mixed
     */
    public function getAddressState()
    {
        return $this->address_state;
    }

    /**
     * @param mixed $address_state
     */
    public function setAddressState($address_state)
    {
        $this->address_state = $address_state;
    }

    /**
     * @return mixed
     */
    public function getAddressCountry()
    {
        return $this->address_country;
    }

    /**
     * @param mixed $address_country
     */
    public function setAddressCountry($address_country)
    {
        $this->address_country = $address_country;
    }

    /**
     * @return mixed
     */
    public function getAddressZip()
    {
        return $this->address_zip;
    }

    /**
     * @param mixed $address_zip
     */
    public function setAddressZip($address_zip)
    {
        $this->address_zip = $address_zip;
    }



    public function setData()
    {
        $this->setAddressId(func_get_arg(0));
        $this->setAddressHno(func_get_arg(1));
        $this->setAddressStreet(func_get_arg(2));
        $this->setAddressCity(func_get_arg(3));
        $this->setAddressState(func_get_arg(4));
        $this->setAddressCountry(func_get_arg(5));
        $this->setAddressZip(func_get_arg(6));

    }
    private function _validate()
              {
                  $this->setAddressId($this->security->xss_clean($this->getAddressId()));
                  $this->setAddressHno($this->security->xss_clean($this->getAddressHno()));
                  $this->setAddressStreet($this->security->xss_clean($this->getAddressStreet()));
                  $this->setAddressCity($this->security->xss_clean($this->getAddressCity()));
                  $this->setAddressState($this->security->xss_clean($this->getAddressState()));
                  $this->setAddressCountry($this->security->xss_clean($this->getAddressCountry()));
                  $this->setAddressZip($this->security->xss_clean($this->getAddressZip()));

               }


    public function address(){

                $this->_validate(func_get_arg(0));

                $data = [
                    'hlu_renter_home_address_id' => $this->getAddressId(),
                    'hlu_renter_home_address_hno' => $this->getAddressHno(),
                    'hlu_renter_home_address_street' => $this->getAddressStreet(),
                    'hlu_renter_home_address_city' => $this->getAddressCity(),
                    'hlu_renter_home_address_state' => $this->getAddressState(),
                    'hlu_renter_home_address_country' => $this->getAddressCountry(),
                    'hlu_renter_home_address_zip' => $this->getAddressZip()
                ];
                return $this->db->insert('hlu_renter_home_address', $data) ? true : false;
         }
}
