<?php
error_reporting(0);
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Javed
 * Date: 9/29/2015
 * Time: 3:38 PM
 */
class Photos extends MX_Controller
{

    function __construct()
    {
        date_default_timezone_set('Asia/Calcutta');
        parent::__construct();
        require $_SERVER["DOCUMENT_ROOT"].'/homelikeyou/vendor/autoload.php';
        $this->load->Model('Mdl_photos');
       // $this->load->library('form');
    }
    public function index()
    {

        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {

            if($this->_uploadPhoto())
            {
                setInformUser('success','Photos uploaded successfully, kindly fill these details');
                redirect('safety');
            }
            else{
                setInformUser('error','Some error occurred! Try Again');
                redirect('photos');
            }
        }
        else {

            $home_id=$this->session->userdata('home_id')?$this->session->userdata('home_id'):'';
            if($home_id==''){
                setInformUser('error','First post these details');
                redirect('renters/rentAHome');
            }
            if($_GET['req']==1){

                $data['img']=$this->Mdl_photos->viewRenterHomePhoto();
                $this->load->view('viewRenterHomePhoto',$data);
            }
            elseif($_GET['action']=='Delete'){
                if($this->Mdl_photos->deleteRenterHomePhoto($_GET['id'])){
                    redirect('photos?req=1');
                }
            }
            else {
                $data['title'] = 'Upload Photos';
                $this->load->view('index', $data);
            }

        }
    }

    private function _uploadPhoto()
    {
        $f = 0;

        // retrieve the number of images uploaded;
        $number_of_files = sizeof($_FILES['photos']['tmp_name']);
        // considering that do_upload() accepts single files, we will have to do a small hack so that we can upload multiple files. For this we will have to keep the data of uploaded files in a variable, and redo the $_FILE.
        $files = $_FILES['photos'];
        $errors = array();
        // first make sure that there is no error in uploading the files
        for($i=0;$i<$number_of_files;$i++)
        {
            if($_FILES['photos']['error'][$i] != 0) $errors[$i][] = 'Could not upload file '.$_FILES['photos']['name'][$i];
        }
        if(sizeof($errors)==0)
        {

            $this->load->library('upload');
            // next we pass the upload path for the images
            //$config['upload_path'] = 'upload/'
            $config['upload_path'] = APPPATH.'modules/photos/upload/';
            // also, we make sure we allow only certain type of images
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            for ($i = 0; $i < $number_of_files; $i++) {
                $_FILES['photos']['name'] = $files['name'][$i];
                $_FILES['photos']['type'] = $files['type'][$i];
                $_FILES['photos']['tmp_name'] = $files['tmp_name'][$i];
                $_FILES['photos']['error'] = $files['error'][$i];
                $_FILES['photos']['size'] = $files['size'][$i];
                //now we initialize the upload library
                $this->upload->initialize($config);
                // we retrieve the number of files that were uploaded
                if ($this->upload->do_upload('photos'))
                {
                    $photo_url = base_url().'application/modules/photos/upload/'.$_FILES['photos']['name'];
                    $this->Mdl_photos->setRenterHomeId($this->session->userdata('home_id'));
                    $this->Mdl_photos->setRenterHomePhoto($photo_url);
                    if($this->Mdl_photos->photosInsert())
                    {
                        $f=1;
                    }


                }
                else
                {
                   return false;
                    //$data['upload_errors'][$i] = $this->upload->display_errors();
                   // echo $this->upload->display_errors();
                }
            }
            if($f==1){
                return true;
                //echo "upload successfull";
            }
        }

        else
        {
            return false;
            //print_r($errors);
        }
    }


}