<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Nitesh
 * Date: 9/19/2015
 * Time: 4:07 PM
 */
class Messages  extends MX_Controller
{

    function __construct(){
        parent::__construct();
        $this->load->Model('Mdl_messages');
        $this->load->Model('Users/Mdl_users');
   //	$this->load->helper(array('form','url','language'));
        $this->load->library('upload');
    }
/*$this->Message_model->send_message()*/

    function index()
    {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $to_do_with_post=$_POST['todo'];
            if ($to_do_with_post=="hml324"){
                echo $this->_sendMessages('send',$this->input->post())?"your messages sucessfully":"sorry, some error occured";
              }

        }

        else{
            $data['email']=$this->getEmail();
            /*print_r($data['email']);
            die();*/
            $this->load->view('admin/header/header.php');
            $this->load->view('index.php',$data);
        }
    }


    private function _sendMessages($todo,$data)
    {
        switch ($todo){

            case'send':

                $config['upload_path'] = APPPATH.'modules/messages/upload/';
                $config['allowed_types'] = 'png|jpeg|gif|jpg|pdf';
                $config['max_size'] = '2048000';
                $attached=time().$_FILES['attached']['name'];
                $config['upload_path'];

                $_FILES['attached']['name']=$attached;

                $this->upload->initialize($config);
                $this->upload->do_upload('attached');
                /*print_r($data);die();*/
                $this->Mdl_messages->setData($todo,"2"/*$this->session->userdata['user_data']['user_id']*/,$data['send_to'],$data['subject'],$data['body'],$attached);

                return $this->Mdl_messages->sendTo($todo)?true:false;
                break;
            default: break;
        }

    }


    public  function getEmail(){
        $data=$this->Mdl_messages->getEmail();

        return $data;

    }

}