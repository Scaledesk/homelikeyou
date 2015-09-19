<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Nitesh
 * Date: 9/19/2015
 * Time: 4:07 PM
 */
class Massages  extends MX_Controller
{

    function __construct(){
        parent::__construct();
        $this->load->Model('Mdl_massages');
   //	$this->load->helper(array('form','url','language'));
        $this->load->library('upload');
    }
/*$this->Message_model->send_message()*/

    function index()
    {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $to_do_with_post=$_POST['todo'];
            if ($to_do_with_post=="hml324"){
                echo $this->_sendMassages('send',$this->input->post())?"your massages sucessfully":"sorry, some error occured";
              }

        }

        else{
            $this->load->view('index.php');
        }
    }


    private function _sendMassages($todo,$data)
    {
        switch ($todo){

            case'send':

                $config['upload_path'] = APPPATH.'modules/massages/upload/';

                $config['max_size'] = '2048000';
                $image=time().$_FILES['image']['name'];
                $config['upload_path'];

                $_FILES['image']['name'] = $image;

                $this->upload->initialize($config);
                $this->upload->do_upload('image');
                $this->Mdl_massages->setData($todo,/*"2"*/$this->session->userdata['user_data']['user_id'],$data['send_to'],$data['subject'],$data['body'],$image);
                return $this->Mdl_massages->sendTo($todo)?true:false;
                break;



            default: break;
        }

    }

}