<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 * Created by PhpStorm.
 * User: Nitesh
 * Date: 9/30/2015
 * Time: 12:27 PM
 */
class Searches extends MX_Controller
{

    function  __construct(){
        parent::__construct();
        $this->load->Model('Mdl_searches');
    }


    public function index (){

       if(strtolower($_SERVER['REQUEST_METHOD'])=='post')
           {
              if($_POST['home_type']){

                  $data= $this->_searchHome('home', $this->input->post());

              }
               elseif($_POST['room_type']){
                   $data= $this->_searchRoom('room', $this->input->post());

               }



           }
          else{
              $this->load->view('index');
          }
    }



    private function _searchHome($todo,$data){
                       $this->Mdl_searches->setData($todo,$data['home_type']);
                       $data= $this->Mdl_searches->searches($todo);
                       return $data;
    }

    private function _searchRoom($todo,$data){

                        $this->Mdl_searches->setData($todo,$data['room_type']);
                        $data= $this->Mdl_searches->searches($todo);
                        return $data;
    }

}
