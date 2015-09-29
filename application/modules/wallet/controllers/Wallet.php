<?php
/**
 * Created by PhpStorm.
 * User: tushar
 * Date: 18/9/15
 * Time: 12:13 PM
 */

class Wallet extends MX_Controller{
    public function __construct(){
    parent::__construct();
        $this->load->Model('Mdl_wallet');
    }
    public function index(){
        if(isAdmin()||hasPermission('Wallet.Content.CRUD')){
            if(strtolower( $_SERVER['REQUEST_METHOD'] ) == 'post'){
                if($todo='Wltad007'){
                    $this->_doWalletTransaction(strtolower($this->input->post('transaction_type')),$this->input->post())?setInformUser('success','Transaction done successfully'):setInformUser('error','Some Error Occurred or Insufficient Balance in case of Debit');
                    redirect('wallet');
                }else{
                    //nothing set flash message invalid request
                }
            }else{
                $this->load->library('Wallet_transaction_type');
                $users=$this->_getUsers();
                $data['users']=$users;
                $data['transaction_type']=Wallet_transaction_type::toArray();
                $this->load->view('index',$data);
            }
        }else{
            echo "Pleased log in or you do nto have permission to access. [access wallet]";
        }
    }
    private function _getUsers(){
        $this->load->Model('users/Mdl_users');
        $users=$this->Mdl_users->getUsers('UidEmail');
        /*echo '<pre/>';
        print_r($users);*/
        return $users;
    }

    private function _doWalletTransaction($todo, $data)
    {
        switch(func_get_arg(0)){
            case strtolower(Wallet_transaction_type::CREDIT):{
                $this->Mdl_wallet->setData(strtolower(Wallet_transaction_type::CREDIT),$data);
                return $this->Mdl_wallet->doWalletTransaction(strtolower(Wallet_transaction_type::CREDIT))?true:false;
                break;
            }
            case strtolower(Wallet_transaction_type::DEBIT):{
                $this->Mdl_wallet->setData(strtolower(Wallet_transaction_type::DEBIT),$data);
                return $this->Mdl_wallet->doWalletTransaction(strtolower(Wallet_transaction_type::DEBIT))?true:false;
                break;
            }
        }
    }
}
