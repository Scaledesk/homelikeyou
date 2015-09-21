<?php
/**
 * Created by PhpStorm.
 * User: tushar
 * Date: 21/9/15
 * Time: 4:16 PM
 */

class Mdl_social_accounts extends CI_Model{

    private $id;
    private $provider;
    private $user_id;
    private $user_email;
    private $user_name;
    private $users_id_fk;

    function __construct()
    {
        $user_data=$this->session->userdata('user_data');
        if(isset($user_data)&&$this->session->userdata('authorize')){
            $this->setUsersIdFk($user_data['user_id']);
        if($social_data=$this->db->where('hlu_users_social_accounts_users_id_fk',$this->getUsersIdFk())->get('hlu_users_social_accounts')->result_array()){
            $this->setId($social_data[0]['hlu_users_social_accounts_id']);
            $this->setProvider($social_data[0]['hlu_users_social_accounts_provider']);
            $this->setUserId($social_data[0]['hlu_users_social_accounts_user_id']);
            $this->setUserEmail($social_data[0]['hlu_users_social_accounts_user_email']);
            $this->setUserName($social_data[0]['hlu_users_social_accounts_user_name']);
            }else{
            $this->setId('');
            $this->setProvider('');
            $this->setUserId('');
            $this->setUserEmail('');
            $this->setUserName('');
            }
        }
        parent::__construct();
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
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * @param mixed $provider
     */
    public function setProvider($provider)
    {
        $this->provider = $provider;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function getUserEmail()
    {
        return $this->user_email;
    }

    /**
     * @param mixed $user_email
     */
    public function setUserEmail($user_email)
    {
        $this->user_email = $user_email;
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->user_name;
    }

    /**
     * @param mixed $user_name
     */
    public function setUserName($user_name)
    {
        $this->user_name = $user_name;
    }

    /**
     * @return mixed
     */
    public function getUsersIdFk()
    {
        return $this->users_id_fk;
    }

    /**
     * @param mixed $users_id_fk
     */
    public function setUsersIdFk($users_id_fk)
    {
        $this->users_id_fk = $users_id_fk;
    }
    public function checkFacebookAccount(){
        return strtolower($this->getProvider())=='facebook'?true:false;
    }
    public function checkGoogleAccount(){
        return strtolower($this->getProvider())=='google'?true:false;
    }
    public function setData(){
    switch(func_get_arg(0)){
        case 'update_facebook':{$this->setProvider(func_get_arg(2));
            $this->setUserName(func_get_arg(1)['name']);
            $this->setUserEmail(func_get_arg(1)['email']);
            $this->setUserId(func_get_arg(1)['id']);
            break;}
        default:break;
        }
    }
    public function update(){
    return $this->db->where('hlu_users_social_accounts_id',$this->getId())->update('hlu_users_social_accounts',[
        'hlu_users_social_accounts_provider'=>$this->getProvider(),
        'hlu_users_social_accounts_user_id'=>$this->getUserId(),
        'hlu_users_social_accounts_user_email'=>$this->getUserEmail(),
        'hlu_users_social_accounts_user_name'=>$this->getUserName(),
        'hlu_users_social_accounts_users_id_fk'=>$this->getUsersIdFk()
    ])?true:false;
        }
    public function insert(){
        return $this->db->insert('hlu_users_social_accounts',[
            'hlu_users_social_accounts_provider'=>$this->getProvider(),
            'hlu_users_social_accounts_user_id'=>$this->getUserId(),
            'hlu_users_social_accounts_user_email'=>$this->getUserEmail(),
            'hlu_users_social_accounts_user_name'=>$this->getUserName(),
            'hlu_users_social_accounts_users_id_fk'=>$this->getUsersIdFk()
        ])?true:false;
    }
}