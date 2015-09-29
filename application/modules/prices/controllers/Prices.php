<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: Nitesh
 * Date: 9/28/2015
 * Time: 4:30 PM
 */
class Prices extends MX_Controller
{


    function __construct()
    {
        date_default_timezone_set('Asia/Calcutta');
        parent::__construct();
        require $_SERVER["DOCUMENT_ROOT"].'/homelikeyou/vendor/autoload.php';
        $this->load->Model('Mdl_prices');
    }


    public function index()
    {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {

            $to_do_with_post=$_POST['todo'];
            if ($to_do_with_post=="hlu87687"){
                echo $this->_updatePrices('update',$this->input->post())?"your  update sucessfully":"sorry, some error occured";
            }
            else {
                echo $this->_prices($this->input->post()) ? "your inserted sucessfully" : "sorry, some error occured";
            }

        }



        else {


            $this->load->view('index');

        }
    }



    private function _prices($data){



        $this->Mdl_prices->setData(/*"2"$this->session->userdata['user_data']['user_id'],*/$data['price_id'],$data['price_night'],$data['price_currency']);
        return $this->Mdl_prices->prices($data)?true:false;
    }

    public function getPrices(){
        $this->Mdl_prices->toArray();

        return;
    }


    public  function getString(){

        $this->Mdl_prices->toString();
    }

    private function _updatePrices($id,$data){

        $this->Mdl_prices->setData("update",/*"2"*//*$this->session->userdata['user_data']['user_id']*/$data['price_id'],$data['price_night'],$data['price_currency']);
        return $this->Mdl_prices->updatePrices($id)?true:false;

    }
}

//hlu_renter_home_price_id`, `hlu_renter_home_price_night`, `hlu_renter_home_price_currency