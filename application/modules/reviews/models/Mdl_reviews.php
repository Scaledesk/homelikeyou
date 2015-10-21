<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: Nitesh
 * Date: 10/1/2015
 * Time: 10:55 AM
 */
class Mdl_reviews extends CI_Model
{
    private $rating_id;
    private $post_id;
    private $rating_number;
    private $total_points;
   /* private $created;
    private $modified;
    private $status;*/
    private $home_id;
    private $comment;

    /**
     * @return mixed
     */
    public function getRatingId()
    {
        return $this->rating_id;
    }

    /**
     * @param mixed $rating_id
     */
    public function setRatingId($rating_id)
    {
        $this->rating_id = $rating_id;
    }

    /**
     * @return mixed
     */
    public function getPostId()
    {
        return $this->post_id;
    }

    /**
     * @param mixed $post_id
     */
    public function setPostId($post_id)
    {
        $this->post_id = $post_id;
    }

    /**
     * @return mixed
     */
    public function getRatingNumber()
    {
        return $this->rating_number;
    }

    /**
     * @param mixed $rating_number
     */
    public function setRatingNumber($rating_number)
    {
        $this->rating_number = $rating_number;
    }

    /**
     * @return mixed
     */
    public function getTotalPoints()
    {
        return $this->total_points;
    }

    /**
     * @param mixed $total_points
     */
    public function setTotalPoints($total_points)
    {
        $this->total_points = $total_points;
    }

    /**
     * @return mixed
     */
    public function getHomeId()
    {
        return $this->home_id;
    }

    /**
     * @param mixed $home_id
     */
    public function setHomeId($home_id)
    {
        $this->home_id = $home_id;
    }

    /**
     * @return mixed
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param mixed $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }




    public function setData()
    {
        switch(func_get_arg(0)){
            case "comment":{
                //echto func_get_arg(3);
                $this->setPostId(func_get_arg(1));
                $this->setHomeId(func_get_arg(2));
                $this->setComment(func_get_arg(3));
                break;
            }
            case "approve":{
                $this->setRatingId(func_get_arg(1));
                break;
            }
            default:
                $this->setPostId(func_get_arg(0));
                $this->setHomeId(func_get_arg(1));
                $this->setRatingNumber(func_get_arg(2));

                break;
        }

    }
    private function _validate()
    {
        switch(func_get_arg(0)){
            case "comment":{
                $this->setPostId($this->security->xss_clean($this->getPostId()));
                $this->setHomeId($this->security->xss_clean($this->getHomeId()));

                $this->setComment($this->security->xss_clean($this->getComment()));

                break;
            }


            default:
                $this->setPostId($this->security->xss_clean($this->getPostId()));
                $this->setHomeId($this->security->xss_clean($this->getHomeId()));
                $this->setRatingNumber($this->security->xss_clean($this->getRatingNumber()));

                break;
        }


    }

    public function approve(){
        $data = [
            'status' =>1

        ];
        return $this->db->where(array('rating_id'=>$this->getRatingId()))->update('hlu_post_rating', $data) ? true : false;

    }
    public function getRating(){

        $query=$this->db->get("hlu_reviews_comment")->result_array();

        return $query;

    }
    public function rating(){
        $this->_validate(func_get_arg(0));
        $this->db->order_by("rating_id","desc");
        $rate=$this->db->get("hlu_post_rating")->result_array();

       $total_point= $rate[0]['total_points']+$this->getRatingNumber();

        $data = [
             'post_id' => $this->getPostId(),
             'rating_number' => $this->getRatingNumber(),
             'created' => date("Y-m-d H:i:s"),
             'modified' =>date("Y-m-d H:i:s") ,
             'total_points' =>$total_point ,
             'home_id' => $this->getHomeId()
         ];

        if($this->db->where(array('post_id'=>$this->getPostId(),'home_id'=>$this->getHomeId()))->select('hlu_post_rating', $data)) {
            return $this->db->where(array('post_id'=>$this->getPostId(),'home_id'=>$this->getHomeId()))->update('hlu_post_rating', $data) ? true : false;
        }
        else{


            return $this->db->insert('hlu_post_rating', $data) ? true : false;
        }
       // return $this->db->insert('hlu_post_rating', $data) ? true : false;
    }


    public function comment(){
        $this->_validate(func_get_arg(0));


        $data = [
            'comment' => $this->getComment(),

        ];


        if($this->db->where(array('post_id'=>$this->getPostId(),'home_id'=>$this->getHomeId()))->select('hlu_post_rating', $data)) {
            return $this->db->where(array('post_id'=>$this->getPostId(),'home_id'=>$this->getHomeId()))->update('hlu_post_rating', $data) ? true : false;
        }
        else{


           return $this->db->insert('hlu_post_rating', $data) ? true : false;
            }

    }
}



