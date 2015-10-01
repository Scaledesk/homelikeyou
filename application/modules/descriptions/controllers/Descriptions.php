<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: Nitesh
 * Date: 9/28/2015
 * Time: 12:50 PM
 */
class Descriptions extends MX_Controller
{
   public function __construct(){

    parent::__construct();
       require $_SERVER["DOCUMENT_ROOT"].'/homelikeyou/vendor/autoload.php';
       $this->load->Model('Mdl_descriptions');

   }

    public function index()
    {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            if($this->_description( $this->input->post())){
                setInformUser('success','Details saved successfully, kindly fill these details');
                redirect('address');
            }else{
                setInformUser('error','Details not saved successfully, try Again');
                redirect('description');
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
    private function _description($data){
        $this->Mdl_descriptions->setData($this->session->userdata('home_id'),$data['description_name'],$data['description_summary']);
        return $this->Mdl_descriptions->description()?true:false;
    }
    public function getdescription(){
        $this->Mdl_descriptions->toArray();
        return;
    }
    public  function getString(){
        $this->Mdl_descriptions->toString();
    }



}