<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: Nitesh
 * Date: 9/28/2015
 * Time: 11:29 AM
 */
class Amenities extends MX_Controller
{



    function __construct()
    {
        date_default_timezone_set('Asia/Calcutta');
        parent::__construct();
        require $_SERVER["DOCUMENT_ROOT"].'/homelikeyou/vendor/autoload.php';
        $this->load->Model('Mdl_amenities');
    }


    public function index()
    {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {


            echo $this->_amenities( $this->input->post()) ? "your inserted sucessfully" : "sorry, some error occured";


        } else {


            $this->load->view('index');

        }
    }



    private function _amenities($data){



        $this->Mdl_amenities->setData(/*"2"$this->session->userdata['user_data']['user_id'],*/$data['amenities_name']);
        return $this->Mdl_amenities->amenities()?true:false;
        }

   public function getAmenities(){
        $this->Mdl_amenities->toArray();

       return;
   }


    public  function getString(){

        $this->Mdl_amenities->toString();
    }
}