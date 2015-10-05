<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Nitesh
 * Date: 10/1/2015
 * Time: 6:56 PM
 */
class Admin extends MX_Controller
{

    function __construct(){

        parent::__construct();

    }

    public function index(){

       if(isAdmin()||hasPermission('permissions.content.CUD')) {
            $this->load->view('index');
            $this->load->view('header/header');
        }
        else {

            echo "Please login first. Or you do not have the permission [access permissions]";

        }
    }


}