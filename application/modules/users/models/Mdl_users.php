<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: tushar
 * Date: 14/9/15
 * Time: 7:05 PM
 */

class Mdl_users extends CI_Model{
    const GUEST_ID =1; //may be needs to do it like it take it from database or to define user level as global constants later. It will be seen in future.
    private $user_id;
    private $user_name;
    private $password;
    private $role_id;
    private $roles_name;
    private $permissions_name;
    private $social_id;
    private $token;
    private $provider;

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }


    public function __construct(){
        parent::__construct();
        $this->role_id=self::GUEST_ID;
        $this->permissions_name=array();
    }

    /**
     * @param mixed $roles_name
     */
    public function setRolesName($roles_name)
    {
        $this->roles_name = $roles_name;
    }

    /**
     * @param mixed $permissions_name
     */
    public function setPermissionsName($permissions_name)
    {
        $this->permissions_name = $permissions_name;
    }

    /**
     *perform set data for class functions.
     */
    public function setData(){
        switch (func_get_arg(0)){
            case "register":    $this->setUserName(func_get_arg(1));
                                $this->setPassword(func_get_arg(2));
                                $this->setRoleId(func_get_arg(3));
                                break;
            case "checkUser":   $this->setUserName(func_get_arg(1));
                                $this->setPassword(func_get_arg(2));
                                break;
            case "setSessionData": { if($data=$this->db->where(array('hlu_users_permissions_username'=>func_get_arg(1)))->get('hlu_users_permissions')->result_array()){
                                        $this->setUserId($data[0]['hlu_users_permissions_user_id']);
                                        $this->setUserName($data[0]['hlu_users_permissions_username']);
                                        $this->setRoleId($data[0]['hlu_users_permissions_user_role_id']);
                                        $this->setRolesName($data[0]['hlu_users_permissions_user_role']);
                                        foreach($data as $row){
                                            array_push($this->permissions_name,$row['hlu_users_permissions_user_permission']);
                                        }
                                        $this->getUserData();
                                        break;
                                    }else{
                                        $data=$this->db->where(array('hlu_users_username'=>func_get_arg(1)))->select('hlu_users_username,hlu_users_id,hlu_users_roles_id')->get('hlu_users')->result_array();
                                        $this->setUserID($data[0]['hlu_users_id']);
                                        $this->setUserName($data[0]['hlu_users_username']);
                                        $this->setRoleId($data[0]['hlu_users_roles_id']);
                                        $role_name=$this->db->where(array('hlu_roles_id'=>$this->role_id))->select('hlu_roles_name')->get('hlu_roles')->result_array();
                                        $this->setRolesName($role_name[0]['hlu_roles_name']);
                                        $this->permissions_name=array();
                                    }
                            }
                                break;
            case "facebook_login":      {
                                        $this->setUserName(func_get_arg(1));
                                        $this->setSocialId(func_get_arg(2));
                                        $this->setToken(func_get_arg(3));
                                        $this->setProvider(func_get_arg(4));
                                        break;
            }
            case "is_Social":      {
                                        $this->setUserId(func_get_arg(1));
                                        $this->setProvider(func_get_arg(2));
                                        break;
            }
            case 'UidEmail' : {
                                        $this->setUserId(func_get_arg(1));
                                        $this->setUserId(func_get_arg(2));
                                        break;
            }
            default:            break;
        }

    }

    /**
     * @param mixed $provider
     */
    public function setProvider($provider)
    {
        $this->provider = $provider;
    }

    /**
     * @param mixed $social_id
     */
    public function setSocialId($social_id)
    {
        $this->social_id = $social_id;
    }

    /**
     * @param mixed $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        if(!$this->user_id){
            $user_id=$this->db->where('hlu_users_username',$this->getUserName())->select(array('hlu_users_id'))->get('hlu_users')->result_array();
            $this->setUserId($user_id[0]['hlu_users_id']);
        }
        return $this->user_id;
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->user_name;
    }

    /**
     * @return mixed
     */
    public function getRoleId()
    {
        return $this->role_id;
    }

    /**
     * @return mixed
     */
    public function getRolesName()
    {
        return $this->roles_name;
    }

    /**
     * @return array
     */
    public function getPermissionsName()
    {
        return $this->permissions_name;
    }
    public function register(){
        switch(func_get_arg(0)){
            case 'normal_registration':$this->_validate('normal_registration');
                $this->setPassword(password_hash($this->password,PASSWORD_DEFAULT));
                $data=[
                    'hlu_users_username'=>$this->user_name,
                    'hlu_users_password'=>$this->password,
                    'hlu_users_roles_id'=>$this->role_id
                ];
                if($this->db->insert('hlu_users',$data)){
                    return true;
                }
                return false;
                break;
            case 'social_registration':$this->_validate('social_registration');
                $data=[
                    'hlu_users_username'=>$this->user_name,
                    'hlu_users_social_id'=>$this->social_id,
                    'hlu_users_provider'=>$this->provider,
                    'hlu_users_roles_id'=>$this->role_id
                ];
                if($this->db->insert('hlu_users',$data)){
                    return true;
                }
                return false;
                break;
            default:break;
        }

    }

    /**
     * this checks user credentials on basis of user provided data
     * @return bool
     */
    public function checkUser(){
        if($data=$this->db->where(array('hlu_users_username'=>$this->user_name))->select('hlu_users_password')->get('hlu_users')->result_array()){
            if((password_verify($this->password,$data[0]['hlu_users_password'])))return true;
            return false;
        }
        return false;
    }

    /**
     * @param mixed $user_name
     */
    public function setUserName($user_name)
    {
        $this->user_name = $user_name;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @param mixed $role_id
     */
    public function setRoleId($role_id)
    {
        $this->role_id = $role_id;
    }

    private function _validate()
    {
        switch(func_get_arg(0)){
            case "normal_registration":$this->setPassword($this->security->xss_clean($this->password));
                $this->setUserName($this->security->xss_clean($this->user_name));
                $this->setRoleId($this->security->xss_clean($this->role_id));
                break;
            case "social_registration":$this->setUserId($this->security->xss_clean($this->user_id));
                $this->setSocialId($this->security->xss_clean($this->social_id));
                $this->setToken($this->security->xss_clean($this->token));
                $this->setProvider($this->security->xss_clean($this->provider));
                break;
            default: break;
        }

    }

    /**
     * return user data
     * @return array
     */
    public function getUserData()
    {
        return ['user_id'=>$this->getUserId(),'user_name'=>$this->getUserName(),
                    'user_role_id'=>$this->getRoleId(),'user_role_name'=>$this->getRolesName(),
                    'user_permissions'=>$this->getPermissionsName()
        ];
    }
    public function isSocialRegistered(){
        return $this->db->where(array('hlu_users_username'=>$this->user_name,'hlu_users_provider'=>$this->provider))->select('hlu_users_id')->get('hlu_users')->result_array()?true:false;
    }
    public function isNormalRegistered(){
        return $this->db->where(array('hlu_users_username'=>$this->user_id))->select('hlu_users_id')->get('hlu_users')->result_array()?true:false;
    }
    public function getUsers(){
        switch(func_get_arg(0)){
            /*returns an array og users Uid and Email*/
            case 'UidEmail':{
                $user1=array();
                $users= $this->db->select('hlu_users_id,hlu_users_username')->get('hlu_users')->result_array();
                foreach($users as $user){
                    $user1[$user['hlu_users_id']]=$user['hlu_users_username'];
                }
                return $user1;
                break;
            }
            default: break;
        }
    }
}