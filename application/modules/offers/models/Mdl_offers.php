<?php
/**
 * Created by PhpStorm.
 * User: tushar
 * Date: 24/9/15
 * Time: 12:48 PM
 */

class Mdl_offers extends CI_Model{

    const TABLE = 'hlu_offers';
    private $id;
    private $sign_up;
    private $fb_share;
    private $phone_verification;
    private $fb_friends_invite;
    private $id_verification;

    function __construct()
    {
        if(checkSession()){
            $user_offers_status=$this->db->where('hlu_offers_id',$this->session->userdata('user_data')['user_id'])->get('hlu_offers')->result_array();
            $this->setId($user_offers_status[0]['hlu_offers_id']);
            $this->setSignup($user_offers_status[0]['hlu_offers_sign_up']);
            $this->setFbShare($user_offers_status[0]['hlu_offers_fb_share']);
            $this->setPhoneVerification($user_offers_status[0]['hlu_offers_phone_verification']);
            $this->setFbFriendsInvite($user_offers_status[0]['hlu_offers_fb_friends_invite']);
            $this->setIdVerification($user_offers_status[0]['hlu_offers_id_verification']);
        }else{
            $this->setId(0);
            $this->setSignup('0');
            $this->setFbShare('0');
            $this->setPhoneVerification('0');
            $this->setFbFriendsInvite('0');
            $this->setIdVerification('0');
        }
        parent::__construct();
    }

    /**
     * @return mixed
     */
    public function getFbShare()
    {
        return $this->fb_share;
    }

    /**
     * @param mixed $fb_share
     */
    public function setFbShare($fb_share)
    {
        $this->fb_share = $fb_share;
    }

    /**
     * @return mixed
     */
    public function getPhoneVerification()
    {
        return $this->phone_verification;
    }

    /**
     * @param mixed $phone_verification
     */
    public function setPhoneVerification($phone_verification)
    {
        $this->phone_verification = $phone_verification;
    }

    /**
     * @return mixed
     */
    public function getFbFriendsInvite()
    {
        return $this->fb_friends_invite;
    }

    /**
     * @param mixed $fb_friends_invite
     */
    public function setFbFriendsInvite($fb_friends_invite)
    {
        $this->fb_friends_invite = $fb_friends_invite;
    }

    /**
     * @return mixed
     */
    public function getIdVerification()
    {
        return $this->id_verification;
    }
    /**
     * @param mixed $id_verification
     */
    public function setIdVerification($id_verification)
    {
        $this->id_verification = $id_verification;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getSignup()
    {
        return $this->sign_up;
    }

    /**
     * @param mixed $sign_up
     */
    public function setSignup($sign_up)
    {
        $this->sign_up = $sign_up;
    }
    public function setData(){
        //
        switch(func_get_arg(0)){
            case 'create_offer':{
                $this->setId(func_get_arg(1)['id']);
                $this->setSignup(func_get_arg(1)['sign_up']);
                break;
            }
            case 'update_offer_fb_share':{
                $this->_refreshOfferStatus();
                $this->setId(func_get_arg(1)['id']);
                $this->setFbShare(func_get_arg(1)['fb_share']);
                break;
            }
            default:break;
        }
    }
    public function insert(){
        return $this->db->insert(self::TABLE,[
            'hlu_offers_id'=>$this->getId(),
            'hlu_offers_sign_up'=>$this->getSignup(),
            'hlu_offers_fb_share'=>$this->getFbShare(),
            'hlu_offers_phone_verification'=>$this->getPhoneVerification(),
            'hlu_offers_fb_friends_invite'=>$this->getFbFriendsInvite(),
            'hlu_offers_id_verification'=>$this->getIdVerification()
        ])?true:false;
    }
    public function update(){
    return $this->db->where('hlu_offers_id',$this->getId())->update(self::TABLE,[
        'hlu_offers_sign_up'=>$this->getSignup(),
        'hlu_offers_fb_share'=>$this->getFbShare(),
        'hlu_offers_phone_verification'=>$this->getPhoneVerification(),
        'hlu_offers_fb_friends_invite'=>$this->getFbFriendsInvite(),
        'hlu_offers_id_verification'=>$this->getIdVerification()
    ])?true:false;
    }
    private function _refreshOfferStatus(){
        $user_offers_status=$this->db->where('hlu_offers_id',$this->getId())->get('hlu_offers')->result_array();
        $this->setId($user_offers_status[0]['hlu_offers_id']);
        $this->setSignup($user_offers_status[0]['hlu_offers_sign_up']);
        $this->setFbShare($user_offers_status[0]['hlu_offers_fb_share']);
        $this->setPhoneVerification($user_offers_status[0]['hlu_offers_phone_verification']);
        $this->setFbFriendsInvite($user_offers_status[0]['hlu_offers_fb_friends_invite']);
        $this->setIdVerification($user_offers_status[0]['hlu_offers_id_verification']);
    }
    public function checkOfferStatus(){
        $this->_refreshOfferStatus();
        switch(func_get_arg(0)){
            case 'fb_share':{
                return $this->getFbShare()=='1'?true:false;
                break;
            }

        }
    }
}