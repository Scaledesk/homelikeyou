<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: tushar
 * Date: 14/9/15
 * Time: 11:25 PM
 */

class Testapp extends MX_Controller{

    public function index(){
        if($this->_isloggedin()){
            echo 'you are logged  in. Check this is your session data';
            echo '<pre/>';
            print_r($this->session->userdata());
        }else{
            echo 'you are not logged in. Check the session data';
            echo '<pre/>';
            print_r($this->session->userdata());
        }
    }
    private function _isloggedin(){
        if($this->session->userdata('authorize')){
            return true;
        }
        return false;
    }
    public function sendEmail(){
        /*echo fsockopen('ssl://smtp.gmail.com', 465, $n, $s) ? 'connected' : $s;
       die;*/
        $this->email->from('tamyworld@gmail.com', 'Tushar');
        $this->email->to('tusharagarwal7863@gmail.com');

        $this->email->subject('Email Test after using database');
        $this->email->message('Testing the email class after using database.');

        if($this->email->send()){
            echo 'email send successfully';
        }else{
           echo 'some error occurred';
            echo $this->email->print_debugger();
        }
    }
}