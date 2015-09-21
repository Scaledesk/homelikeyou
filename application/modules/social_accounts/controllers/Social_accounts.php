<?php
/**
 * Created by PhpStorm.
 * User: tushar
 * Date: 21/9/15
 * Time: 3:15 PM
 */

class Social_accounts extends MX_Controller{
    function __construct()
    {
        parent::__construct();
    }
    public function index(){
    $this->load->view('index.php');
    }
}