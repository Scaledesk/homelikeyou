<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: NItesh
 * Date: 9/26/2015
 * Time: 6:35 PM
 */
class Basics extends MX_Controller
{
    function __construct()
    {
        date_default_timezone_set('Asia/Calcutta');
        parent::__construct();
        require $_SERVER["DOCUMENT_ROOT"].'/homelikeyou/vendor/autoload.php';
        $this->load->Model('Mdl_basics');
    }


    public function index()
    {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            if($this->_basics( $this->input->post())){
                setInformUser('success','Details saved successfully, kindly fill these details');
                redirect('descriptions');
            }else{
                setInformUser('error','Details not saved successfully, try Again');
                redirect('basics');
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
    private function _basics($data){
        $this->Mdl_basics->setData($this->session->userdata('home_id'),$data['basics_bedrooms'],$data['basics_beds'],$data['basics_beds'],$data['basics_bathrooms']);
        return $this->Mdl_basics->basics()?true:false;
    }


}