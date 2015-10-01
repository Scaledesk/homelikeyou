<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Nitesh
 * Date: 9/28/2015
 * Time: 6:37 PM
 */
class Safety extends MX_Controller
{


    function __construct()
    {
        date_default_timezone_set('Asia/Calcutta');
        parent::__construct();
        require $_SERVER["DOCUMENT_ROOT"].'/homelikeyou/vendor/autoload.php';
        $this->load->Model('Mdl_safety');
    }


    public function index()
    {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            if($this->_safety( $this->input->post())){
                setInformUser('success','Details saved successfully, kindly fill these details');
                redirect('prices');
            }else{
                setInformUser('error','Details not saved successfully, try Again');
                redirect('safety');
            }
        } else {
            $home_id=$this->session->userdata('home_id')?$this->session->userdata('home_id'):'';
            if($home_id==''){
                setInformUser('error','First post these details');
                redirect('renters/rentAHome');
            }
            $this->load->view('index');
        }
    }
    private function _safety($data){
        $this->Mdl_safety->setData($this->session->userdata('home_id'),$data['safety_type'],$data['fire_alarm'],$data['fire_extinguisher'],$data['gas_valve'],$data['safety_card'],$data['emergency_exit']);
        return $this->Mdl_safety->safety($data)?true:false;
    }

    public function getSafety(){
        $this->Mdl_safety->toArray();
        return;
    }
    public  function getString(){
        $this->Mdl_safety->toString();
    }
    private function _updateSafety($id,$data){

        $this->Mdl_safety->setData("update",/*"2"$this->session->userdata['user_data']['user_id'],*/$data['safety_id'],$data['safety_type'],$data['fire_alarm'],$data['fire_extinguisher'],$data['gas_valve'],$data['safety_card'],$data['emergency_exit']);
        return $this->Mdl_safety->updateSafety($id)?true:false;
    }
}