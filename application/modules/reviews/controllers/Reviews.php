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
                if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
                  //  $ration=$_POST['comment'];


                if (isset($_POST['comment'])){
                    echo $this->_insertComment('comment',$this->input->post())?"your  comment sucessfully":"sorry, some error occured";

                }
                else {
                    echo $this->_insert($this->input->post()) ? " sucessfully" : "sorry, some error occured";
                }

                                }
                    else {
                    $data['rating']=$this->getRating($this->input->post());
                    $this->load->view('index',$data);
}
            }


    private function _insertComment($id,$data)
    {
        $this->Mdl_reviews->setData('comment',2, 3,/*"2"$this->session->userdata['user_data']['user_id'],*//*"2"$this->session->userdata['user_data']['home_id'],*/
            $data['comment']);
          return $this->Mdl_reviews->comment($id) ? true : false;
    }


            private function _insert($data){
                $this->Mdl_reviews->setData(2,3,/*"2"$this->session->userdata['user_data']['user_id'],*//*"2"$this->session->userdata['user_data']['home_id'],*/$data['rating']);
                return $this->Mdl_reviews->rating($data)?true:false;

                //Check the rating row with same post ID
               // $prevRatingQuery = "SELECT * FROM post_rating WHERE post_id = ".$postID;
               // $prevRatingResult = $db->query($prevRatingQuery);
               // if($prevRatingResult->num_rows > 0):
                   // $prevRatingRow = $prevRatingResult->fetch_assoc();
                   // $ratingNum = $prevRatingRow['rating_number'] + $ratingNum;
                   // $ratingPoints = $prevRatingRow['total_points'] + $ratingPoints;
                    //Update rating data into the database
                   // $query = "UPDATE post_rating SET rating_number = '".$ratingNum."', total_points = '".$ratingPoints."', modified = '".date("Y-m-d H:i:s")."' WHERE post_id = ".$postID;
                  //  $update = $db->query($query);
              //  else:
                    //Insert rating data into the database
                 //   $query = "INSERT INTO post_rating (post_id,rating_number,total_points,created,modified) VALUES(".$postID.",'".$ratingNum."','".$ratingPoints."','".date("Y-m-d H:i:s")."','".date("Y-m-d H:i:s")."')";
                  //  $insert = $db->query($query);
               // endif;

                //Fetch rating deatails from database
               // $query2 = "SELECT rating_number, FORMAT((total_points / rating_number),1) as average_rating FROM post_rating WHERE post_id = ".$postID." AND status = 1";
              //  $result = $db->query($query2);
               // $ratingRow = $result->fetch_assoc();

               // if($ratingRow){
                  //  $ratingRow['status'] = 'ok';
                //}else{
                //    $ratingRow['status'] = 'err';
               // }

                //Return json formatted rating data
                //echo json_encode($ratingRow);


               }

            public function getRating(){
                $data=$this->Mdl_reviews->getRating();
                return $data;
            }
}