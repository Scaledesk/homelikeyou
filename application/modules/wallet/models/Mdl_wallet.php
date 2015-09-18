<?php
/**
 * Created by PhpStorm.
 * User: tushar
 * Date: 18/9/15
 * Time: 2:47 PM
 */

class Mdl_wallet extends CI_Model{

    private $wallet_id;
    private $wallet_amount;
    private $transaction_id;
    private $transaction_description;
    private $transaction_type;
    private $transaction_amount;
    private $transaction_date;

    function __construct()
    {
        parent::__construct();
    }

    /**
     * @return mixed
     */
    public function getWalletId()
    {
        return $this->wallet_id;
    }

    /**
     * @param mixed $wallet_id
     */
    public function setWalletId($wallet_id)
    {
        $this->wallet_id = $wallet_id;
    }

    /**
     * @return mixed
     */
    public function getWalletAmount()
    {
        return $this->wallet_amount;
    }

    /**
     * @param mixed $wallet_amount
     */
    public function setWalletAmount($wallet_amount)
    {
        $this->wallet_amount = $wallet_amount;
    }

    /**
     * @return mixed
     */
    public function getTransactionId()
    {
        return $this->transaction_id;
    }

    /**
     * @param mixed $transaction_id
     */
    public function setTransactionId($transaction_id)
    {
        $this->transaction_id = $transaction_id;
    }

    /**
     * @return mixed
     */
    public function getTransactionDescription()
    {
        return $this->transaction_description;
    }

    /**
     * @param mixed $transaction_description
     */
    public function setTransactionDescription($transaction_description)
    {
        $this->transaction_description = $transaction_description;
    }

    /**
     * @return mixed
     */
    public function getTransactionType()
    {
        return $this->transaction_type;
    }

    /**
     * @param mixed $transaction_type
     */
    public function setTransactionType($transaction_type)
    {
        $this->transaction_type = $transaction_type;
    }

    /**
     * @return mixed
     */
    public function getTransactionAmount()
    {
        return $this->transaction_amount;
    }

    /**
     * @param mixed $transaction_amount
     */
    public function setTransactionAmount($transaction_amount)
    {
        $this->transaction_amount = $transaction_amount;
    }

    /**
     * @return mixed
     */
    public function getTransactionDate()
    {
        return $this->transaction_date;
    }

    /**
     * @param mixed $transaction_date
     */
    public function setTransactionDate($transaction_date)
    {
        $this->transaction_date = $transaction_date;
    }

    public function setData(){
        switch(func_get_arg(0)){
            case strtolower(Wallet_transaction_type::CREDIT) : {
                $this->setWalletId(func_get_arg(1)['users_email']);
                $this->setTransactionAmount(func_get_arg(1)['transaction_amount']);
                $this->setTransactionType(func_get_arg(1)['transaction_type']);
                $this->setTransactionDescription(func_get_arg(1)['transaction_description']);
                break;
            }
            case strtolower(Wallet_transaction_type::DEBIT):{
                $this->setWalletId(func_get_arg(1)['users_email']);
                $this->setTransactionAmount(func_get_arg(1)['transaction_amount']);
                $this->setTransactionType(func_get_arg(1)['transaction_type']);
                $this->setTransactionDescription(func_get_arg(1)['transaction_description']);
                break;
            }
            default:break;
        }
    }

    public function doWalletTransaction(){
        $this->_validate();
        if($wallet_amount=$this->db->where('hlu_users_wallet_id',$this->getWalletId())->select(array('hlu_users_wallet_amount'))->get('hlu_users_wallet')->result_array()){
            $this->setWalletAmount($wallet_amount[0]['hlu_users_wallet_amount']);
            switch(func_get_arg(0)){
                case strtolower(Wallet_transaction_type::CREDIT):{
                    $this->setWalletAmount($this->getWalletAmount()+$this->getTransactionAmount());
                    $this->db->trans_start();
                    $this->db->where('hlu_users_wallet_id',$this->getWalletId())->update('hlu_users_wallet',['hlu_users_wallet_amount'=>$this->getWalletAmount()]);
                    $this->db->insert('hlu_wallet_transactions', [
                        'hlu_wallet_transactions_wallet_id' => $this->getWalletId(),
                        'hlu_wallet_transactions_description' => $this->getTransactionDescription(),
                        'hlu_wallet_transactions_transaction_type' => $this->getTransactionType(),
                        'hlu_wallet_transactions_transaction_amount' => $this->getTransactionAmount()
                    ]);
                    $this->db->trans_complete();
                    return $this->db->trans_status()?true:false;
                     }
                    break;

                case strtolower(Wallet_transaction_type::DEBIT):{
                    break;
                }
            }
        }else{

        }
        return $this->db->insert?true:false;
    }

    private function _validate()
    {
        $this->setWalletId($this->security->xss_clean($this->getWalletId()));
        $this->setTransactionAmount($this->security->xss_clean($this->getTransactionAmount()));
        $this->setTransactionType($this->security->xss_clean($this->getTransactionType()));
        $this->setTransactionDescription($this->security->xss_clean($this->getTransactionDescription()));
    }
}