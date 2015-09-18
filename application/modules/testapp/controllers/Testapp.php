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
}