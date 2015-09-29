<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Nitesh
 * Date: 9/29/2015
 * Time: 5:14 PM
 */
class Mobiles extends MX_Controller
{

    function __construct()
    {
        date_default_timezone_set('Asia/Calcutta');
        parent::__construct();
        require $_SERVER["DOCUMENT_ROOT"].'/homelikeyou/vendor/autoload.php';
        $this->load->Model('Mdl_mobiles');
    }


    public function index()
    {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {

            $to_do_with_post=$_POST['todo'];
            if ($to_do_with_post=="hlu87687"){
                echo $this->_updateMobiles('update',$this->input->post())?"your  update sucessfully":"sorry, some error occured";
            }
            elseif($to_do_with_post=="hlu8787"){

                echo $this->_varifyMobiles('status',$this->input->post())?"your  Status sucessfully Update":"sorry, some error occured";
            }
            else {
                echo $this->_mobiles($this->input->post()) ? "your inserted sucessfully" : "sorry, some error occured";
            }

        }



        else {


            $this->load->view('index');

        }
    }


    private function _mobiles($data){



        $this->Mdl_mobiles->setData(/*"2"$this->session->userdata['user_data']['user_id'],*/$data['home_id'],$data['mobile_number']);
        return $this->Mdl_mobiles->mobiles($data)?true:false;
    }

    public function getMobiles(){
        $data=$this->Mdl_mobiles->toArray();
       print_r($data);
        return;
    }


    public  function getString(){

        $data=$this->Mdl_mobiles->toString();
        echo $data;
    }

    private function _updateMobiles($id,$data){

        $this->Mdl_mobiles->setData("update",/*"2"$this->session->userdata['user_data']['user_id'],*/$data['home_id'],$data['mobile_number']);
        return $this->Mdl_mobiles->updateMobiles($id)?true:false;

    }


    public function _varifyMobiles($id){

        $this->Mdl_mobiles->setData("status",/*"2"$this->session->userdata['user_data']['user_id'],*/$id['home_id']);
        return $this->Mdl_mobiles->varifyMobiles($id)?true:false;

    }
}


/*
`hlu_renter_home_mobile_id`,
`hlu_renter_home_mobile_number`,
`hlu_renter_home_mobile_status`,
`hlu_renter_home_mobile_home_id*/