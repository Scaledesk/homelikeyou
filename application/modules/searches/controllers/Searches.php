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
           $to_do_with_post=$_POST['todo'];

              if( $to_do_with_post=="hlm834"){

                  $data['a']= $this->_searchHome('home', $this->input->post());
                  echo '<pre/>';
                  print_r($data['a']);
              }
               elseif( $to_do_with_post=="hlm8734"){
                   $data['a']= $this->_searchRoom('room', $this->input->post());
                   echo '<pre/>';
                 print_r($data['a']);
               }



           }
          else{
              $this->load->view('index');
             /* $this->load->view('search_view');*/
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
