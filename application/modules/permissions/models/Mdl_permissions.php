<?php  defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: tushar
 * Date: 15/9/15
 * Time: 1:14 AM
 */

class Mdl_permissions extends CI_Model{
    private $permissions_name;
    function __construct(){
        parent::__construct();
        $this->permissions_name = $this->db->select('hlu_permissions_id,hlu_permissions_name')->get('hlu_permissions')->result_array();
    }
    public function setData(){
        switch (func_get_arg(0)){
            case "insert_permission":   $this->setPermissionsName(func_get_arg(1));
                                        break;
            default:                    break;
        }
    }

    /**
     * @param mixed $permissions_name
     */
    public function setPermissionsName($permissions_name)
    {
        $this->permissions_name = $permissions_name;
    }
    public function insertPermissions(){
        $this->_validate();
        $data=[
            'hlu_permissions_name'=>$this->permissions_name
        ];
        if($this->db->insert('hlu_permissions',$data)){
            return true;
        }
        return false;
    }

    /**
     * @return mixed
     */
    public function getPermissionsName()
    {
        return $this->permissions_name;
    }

    private function _validate()
    {
        $this->setPermissionsName($this->security->xss_clean($this->permissions_name));
    }

}