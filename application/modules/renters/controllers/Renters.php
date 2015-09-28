<?php defined('BASEPATH') or exit('No direct script access allowed');


/**
 * Created by PhpStorm.
 * User: NItesh
 * Date: 9/25/2015
 * Time: 5:31 PM
 */
class Renters extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->Model('Mdl_renters');
    }
    public function index()
    {
        if (checkSession()&&(isHost()||hasPermission('RenterHome.Content.C'))){
            if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
                $to_do_with_post = $_POST['todo'];
                if ($to_do_with_post == "hlm87654") {
                    echo $this->_insertHome('step1', $this->input->post()) ? "your inserted sucessfully" : "sorry, some error occured";
                }
            } else {
                $this->load->view('index');
            }
        }else{
            setInformUser('error','please login as Host to sunbmit add');
            redirect('users');
        }
    }
    private function _insertHome($todo,$data){
        switch ($todo){
            case'step1':$this->Mdl_renters->setData($todo,$data['home_type'],$data['room_type'],$data['home_accomodates'],$data['home_city']);
                        return $this->Mdl_renters->insertHome($todo)?true:false;
                        break;
            default:    break;
        }
    }
}