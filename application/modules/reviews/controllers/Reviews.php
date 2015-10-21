<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Nitesh
 * Date: 10/1/2015
 * Time: 10:55 AM
 */
class Reviews extends MX_Controller
{
    function  __construct(){
        parent::__construct();
        $this->load->Model('Mdl_reviews');
    }


            public function index()
            {
                if (isAdmin() || hasPermission('permissions.content.CUD')) {
                   $data['comment']=$this->getRating();

                    $this->load->view('admin/header/header');
                    $this->load->view('comment',$data);

                }
                else{
                    if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
                        //  $ration=$_POST['comment'];


                        if (isset($_POST['comment'])) {
                            echo $this->_insertComment('comment', $this->input->post()) ? "your  comment sucessfully" : "sorry, some error occured";

                        } else {
                            echo $this->_insert($this->input->post()) ? " sucessfully" : "sorry, some error occured";
                        }

                    } else {
                        $data['rating'] = $this->getRating($this->input->post());
                        $this->load->view('admin/header/header');
                        $this->load->view('index', $data);
                    }



                }
            }

    private function _insertComment($id,$data)
    {
        $this->Mdl_reviews->setData('comment',$this->session->userdata['user_data']['user_id'],3,/*"2"$this->session->userdata['user_data']['home_id'],*/
            $data['comment']);
          return $this->Mdl_reviews->comment($id) ? true : false;
    }


            private function _insert($data){
                $this->Mdl_reviews->setData(2,3,/*"2"$this->session->userdata['user_data']['user_id'],*//*"2"$this->session->userdata['user_data']['home_id'],*/$data['rating']);
                return $this->Mdl_reviews->rating($data)?true:false;



               }

            public function getRating(){
                $data=$this->Mdl_reviews->getRating();
                return $data;
            }

            public function approve($id){

                $this->Mdl_reviews->setData('approve',$id);
                if( $this->Mdl_reviews->approve()){
                    redirect('reviews');
                }
            }

}