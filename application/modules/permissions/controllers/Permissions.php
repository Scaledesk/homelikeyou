<?php  defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: tushar
 * Date: 15/9/15
 * Time: 12:42 AM
 */

class Permissions extends MX_Controller{

    function __construct(){
        parent::__construct();
        $this->load->Model('Mdl_permissions');
    }
    public function index(){
        if(isAdmin()||hasPermission('permissions.content.CUD')){
//            echo "valid";
            if(strtolower( $_SERVER['REQUEST_METHOD'] ) == 'post'){
                $to_do_with_post=$_POST["todo"];
                /*echo $to_do_with_post;*/
                /*print_r($this->input->post());*/
                if(isset($to_do_with_post)){
                    if($to_do_with_post=='insert_permission'){
                        $this->_insertPermissions($this->input->post());
                    }
                }
            }else{
                $this->load->view('admin/header/header');
                $this->load->view('index.php');
            }
        }
        else{
            echo "Please login first. Or you do not have the permission [access permissions]";
        }
    }

    private function _insertPermissions($data)
    {
        $this->Mdl_permissions->setData('insert_permission',$data['permission_name']);
        if($this->Mdl_permissions->insertPermissions()){
            echo "Permission inserted successfully";
        }else{
            echo "Some error occurred! Try Again";
        };
    }
}