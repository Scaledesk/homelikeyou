<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Nitesh
 * Date: 10/1/2015
 * Time: 6:56 PM
 */
class Dashboard extends MX_Controller
{

    function __construct(){

        parent::__construct();
        $this->load->Model('Mdl_dashboard');
    }

    public function index(){



    }


}