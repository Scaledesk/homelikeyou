<?php
/**
 * Created by PhpStorm.
 * User: tushar
 * Date: 28/9/15
 * Time: 3:01 PM
 */

class Hlu_calendar extends MX_Controller{

    function __construct()
    {
        parent::__construct();
        $this->load->Model('Mdl_calendar');
    }
    public function index(){
        if($this->_checkSession()){
            // may to be implemented
            if(strtolower( $_SERVER['REQUEST_METHOD'] ) == 'post'){
                $todo_with_post=$this->input->post('todo');
            if($todo_with_post=='update'){
                if($this->_update($this->input->post())){// currently this is done this way later it will be changed
                    setInformUser('success','CALENDAR updated successfully');
                    echo 'done';
                }else{
                    setInformUser('error','some error Occurred! Try Again');
                    echo 'not done';
                }
            }else{
                if($this->_insert($this->input->post())){
                    setInformUser('success','CALENDAR saved successfully');
                    echo 'done';
                }else{
                    setInformUser('error','some error Occurred! Try Again');
                    echo 'not done';
                }
            }
            }else{
                $data['availability']=$this->Mdl_calendar->getAvailabilityOptions();
                $this->load->view('index',$data);
            }

        }else{
            setInformUser('error','Kindly login as host to continue');
            redirect('users');
        }
    }

    private function _checkSession(){
        return (checkSession()&&(isHost()||hasPermission('Calendar.Content.CU')))?true:false;
    }
    private function _insert($data){
        $this->Mdl_calendar->setData('insert',$data);
        return $this->Mdl_calendar->insert();
    }
    private function _update($data){
        $this->Mdl_calendar->setData('update',$data);
        return $this->Mdl_calendar->update();
    }
    public function getCalendarArray($home_id){
        // this way we get calendars array for the availability of apartment or home or etc
        $calendars=$this->Mdl_calendar->getCalendarArray($home_id);
        echo '<pre/>';
        print_r($calendars);
        die;
    }
}