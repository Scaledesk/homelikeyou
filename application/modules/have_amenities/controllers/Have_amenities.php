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
            if($this->_haveAmenities( $this->input->post())){
                setInformUser('success','Details saved successfully, kindly fill these details');
                redirect('photos');
            }else{
                setInformUser('error','Details not saved successfully, try Again');
                redirect('have_amenities');
            }
        } else {
            $home_id=$this->session->userdata('home_id')?$this->session->userdata('home_id'):'';
            if($home_id==''){
                setInformUser('error','First post these details');
                redirect('renters/rentAHome');
            }
            $amenities=$this->getAmenities();
            $amenities1=array();
            foreach($amenities as $amenity){
                $amenities1[$amenity['hlu_renter_home_amenities_id']]=$amenity['hlu_renter_home_amenities_name'];
            }
            $data['amenities']=$amenities1;
            $this->load->view('index',$data);
        }
    }
    private function _haveAmenities($data){
        $this->Mdl_have_amenities->setData($this->session->userdata('home_id'),$data['amenities_id']);
        return $this->Mdl_have_amenities->amenities($data)?true:false;
    }
    public function getHaveAmenities(){
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
    public function getAmenities(){
        $this->load->Model('amenities/Mdl_amenities');
        return $this->Mdl_amenities->toArray();
    }
}
