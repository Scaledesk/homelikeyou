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


            echo $this->_description( $this->input->post()) ? "your inserted sucessfully" : "sorry, some error occured";


        } else {


            $this->load->view('index');

        }
    }



    private function _description($data){



        $this->Mdl_descriptions->setData(/*"2"$this->session->userdata['user_data']['user_id'],*/$data['description_id'],$data['description_name'],$data['description_summary']);
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