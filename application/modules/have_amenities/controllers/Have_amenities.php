<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: Nitesh
 * Date: 9/28/2015
 * Time: 2:46 PM
 */
class Have_amenities extends MX_Controller
{
    function __construct()
    {
        date_default_timezone_set('Asia/Calcutta');
        parent::__construct();
        require $_SERVER["DOCUMENT_ROOT"].'/homelikeyou/vendor/autoload.php';
        $this->load->Model('Mdl_have_amenities');
    }


    public function index()
    {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {

            $to_do_with_post=$_POST['todo'];
            if ($to_do_with_post=="hlu87687"){
                echo $this->_updateAmenities('update',$this->input->post())?"your  update sucessfully":"sorry, some error occured";
            }
            else {
                echo $this->_haveAmenities($this->input->post()) ? "your inserted sucessfully" : "sorry, some error occured";
            }

         }



        else {


            $this->load->view('index');

        }
    }



    private function _haveAmenities($data){



        $this->Mdl_have_amenities->setData(/*"2"$this->session->userdata['user_data']['user_id'],*/$data['home_id'],$data['amenities_id']);
        return $this->Mdl_have_amenities->amenities($data)?true:false;
    }

    public function getAmenities(){
        $this->Mdl_have_amenities->toArray();

        return;
    }


    public  function getString(){

        $this->Mdl_have_amenities->toString();
    }

    private function _updateAmenities($id,$data){

        $this->Mdl_have_amenities->setData("update",/*"2"*//*$this->session->userdata['user_data']['user_id']*/$data['have_amenities_id'],$data['home_id'],$data['amenities_id']);
        return $this->Mdl_have_amenities->updateAmenities($id)?true:false;

    }


}
