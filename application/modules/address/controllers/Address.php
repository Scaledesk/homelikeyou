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


            echo $this->_address( $this->input->post()) ? "your inserted sucessfully" : "sorry, some error occured";


        } else {


            $this->load->view('index');

        }
    }



    private function _address($data){



                $this->Mdl_address->setData(/*"2"$this->session->userdata['user_data']['user_id'],*/$data['address_id'],$data['address_hno'],$data['address_street'],$data['address_city'],$data['address_state'],$data['address_country'],$data['address_zip']);
                return $this->Mdl_address->address()?true:false;





    }
}