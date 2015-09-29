<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: Nitesh
 * Date: 9/28/2015
 * Time: 4:31 PM
 */
class Mdl_prices  extends CI_Model
{
   private $price_id;
   private $price_night;
    private $price_currency;

    /**
     * @return mixed
     */
    public function getPriceId()
    {
        return $this->price_id;
    }

    /**
     * @param mixed $price_id
     */
    public function setPriceId($price_id)
    {
        $this->price_id = $price_id;
    }

    /**
     * @return mixed
     */
    public function getPriceNight()
    {
        return $this->price_night;
    }

    /**
     * @param mixed $price_night
     */
    public function setPriceNight($price_night)
    {
        $this->price_night = $price_night;
    }

    /**
     * @return mixed
     */
    public function getPriceCurrency()
    {
        return $this->price_currency;
    }

    /**
     * @param mixed $price_currency
     */
    public function setPriceCurrency($price_currency)
    {
        $this->price_currency = $price_currency;
    }

    public function setData()
    {
        switch(func_get_arg(0)){
            case "update":{
                //echo func_get_arg(3);
                $this->setPriceId(func_get_arg(1));
                $this->setPriceNight(func_get_arg(2));
                $this->setPriceCurrency(func_get_arg(3));
                break;
            }
            default:
                $this->setPriceId(func_get_arg(0));
                $this->setPriceNight(func_get_arg(1));
                $this->setPriceCurrency(func_get_arg(2));


                break;
        }



    }
    private function _validate()
    {
        switch(func_get_arg(0)){
            case "update":{
                $this->setPriceId($this->security->xss_clean($this->getPriceId()));
                $this->setPriceNight($this->security->xss_clean($this->getPriceNight()));
                $this->setPriceCurrency($this->security->xss_clean($this->getPriceCurrency()));
                break;
            }
            default:
                $this->setPriceId($this->security->xss_clean($this->getPriceId()));
                $this->setPriceNight($this->security->xss_clean($this->getPriceNight()));
                $this->setPriceCurrency($this->security->xss_clean($this->getPriceCurrency()));


                break;
        }


    }
    public function updatePrices(){
        $this->_validate(func_get_arg(0));
        $data = [
            'hlu_renter_home_price_id' => $this->getPriceId(),
            'hlu_renter_home_price_night' => $this->getPriceNight(),
            'hlu_renter_home_price_currency' => $this->getPriceCurrency()
        ];
//                                    echo '<pre/>';
//                                    print_r($data);
        return $this->db->where(array('hlu_renter_home_price_id'=>$this->getPriceId()))->update('hlu_renter_home_price', $data) ? true : false;

    }


    public function prices(){

        //echo func_get_arg(0);
       // die();
        $this->_validate(func_get_arg(0));

        $data = [
            'hlu_renter_home_price_id' => $this->getPriceId(),
            'hlu_renter_home_price_night' => $this->getPriceNight(),
            'hlu_renter_home_price_currency' => $this->getPriceCurrency()];
        return $this->db->insert('hlu_renter_home_price', $data) ? true : false;
    }



    public function toArray(){


        $query=$this->db->get("hlu_renter_home_price")->result_array();

        $data=array(
            'price_id'=>$query[0]['hlu_renter_home_price_id'],
            'price_night'=>$query[0]['hlu_renter_home_price_night'],
            'price_currency'=>$query[0]['hlu_renter_home_price_currency']

        );

        return $data;
    }


    public function toString(){


        $query=$this->db->get("hlu_renter_home_price")->result_array();
        // print_r($query[0]);
        $data=implode(',',$query[0]);
        $data= (string)$data;

        // echo $data;
        // die();
        return $data;
    }

}
//hlu_renter_home_price_id`, `hlu_renter_home_price_night`, `hlu_renter_home_price_currency