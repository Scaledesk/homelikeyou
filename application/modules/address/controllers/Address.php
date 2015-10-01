<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Nitesh
 * Date: 9/26/2015
 * Time: 4:08 PM
 */
class Address extends MX_Controller
{
    function __construct()
    {
        date_default_timezone_set('Asia/Calcutta');
        parent::__construct();
        require $_SERVER["DOCUMENT_ROOT"].'/homelikeyou/vendor/autoload.php';
        $this->load->Model('Mdl_address');
    }
    public function index()
    {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            if($this->_address( $this->input->post())){
                setInformUser('success','Details saved successfully, kindly fill these details');
                redirect('have_amenities');
            }else{
                setInformUser('error','Details not saved successfully, try Again');
                redirect('address');
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
    private function _address($data){
                $this->Mdl_address->setData($this->session->userdata('home_id'),$data['address_hno'],$data['address_street'],$data['address_city'],$data['address_state'],$data['address_country'],$data['address_zip'],$data['latitude'],$data['longitude']);
                return $this->Mdl_address->address()?true:false;
    }
}