<?php
/**
 * Created by PhpStorm.
 * User: tushar
 * Date: 20/9/15
 * Time: 6:26 PM
 */

class Hlu_email_settings extends MX_Controller{

    function __construct()
    {
        parent::__construct();
        $this->load->Model('Mdl_hlu_email_settings');
    }
    public function index(){
        if(isAdmin()||hasPermission('Hlu_email_settings.Content.U')){
        if(strtolower( $_SERVER['REQUEST_METHOD'] ) == 'post'){
            $todo_with_post=$this->input->post('todo');
            if($todo_with_post=='udeast003'){
                $this->Mdl_hlu_email_settings->setData('update',$this->input->post());
                if($this->Mdl_hlu_email_settings->update()){
                    setInformUser('success','Email settings updated successfully.');
                    redirect('hlu_email_settings','refresh');
                }else{
                    setInformUser('error','Some error occured');
                    redirect('hlu_email_settings','refresh');
                }

            }

        }else{
            $data['email_settings']=$this->Mdl_hlu_email_settings->toArray();
            $this->load->view('admin/header/header');
            $this->load->view('index',$data);
        }
        }else{
            setInformUser('error','You don\'t have the permission [\'access email settings \'].');
            redirect('users');
        }
    }
}