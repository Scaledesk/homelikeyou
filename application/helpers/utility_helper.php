<?php
/**
 * Created by PhpStorm.
 * User: tushar
 * Date: 11/9/15
 * Time: 5:51 PM
 */
function asset_url(){
    return base_url().'assets/';
}
function checkSession(){
    $ci=CI::get_instance();
    if($ci->session->userdata('authorize')){
        return true;
    }
    return false;
}
function hasPermission($provided_permission){
    $ci=CI::get_instance();
    $permission=$ci->session->userdata('user_data');
    $permission=$permission['user_permissions'];
    if(checkSession()&&isset($permission)){return in_array($provided_permission,$permission)? true:false;}
    return false;
}
function isAdmin(){
    $ci=CI::get_instance();
    $role=$ci->session->userdata('user_data');
    $role=$role['user_role_name'];
    if(checkSession()){
    if(strtolower($role)=='admin'){
        return true;
        }
    }
    return false;
}
function isSocial($provided_email,$provided_provider){
    $ci=CI::get_instance();
    $ci->load->Model('users/Mdl_users');
    $ci->Mdl_users->setData('is_social',$provided_email,$provided_provider);
    return $ci->Mdl_users->isSocialRegistered()? true:false;
}
function setInformUser(){
    $ci=CI::get_instance();
    $flash_data=$ci->session->flashdata('message');
    unset($flash_data);
    switch(func_get_arg(0)){
        case 'success' : {
            $ci->session->set_flashdata('message',"<div style='color:green;border:1px solid;border-color: #009900;'>".func_get_arg(1)."</div>");
            break;
        }
        case 'error': {
            $ci->session->set_flashdata('message',"<div style='color:red;border:1px solid;border-color: tomato;'>".func_get_arg(1)."</div>");
            break;
        }
        default:{
            break;
        }
    }
}
function getInformUser(){
    $ci=CI::get_instance();
    if($ci->session->flashdata('message')){
        echo $ci->session->flashdata('message');
    }
}
function isAccountActive(){
    $ci=ci::get_instance();
    $ci->load->Model('users/Mdl_users');
    return $ci->Mdl_users->isActive()?true:false;
}