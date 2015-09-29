<?php
/**
 * Created by PhpStorm.
 * User: tushar
 * Date: 28/9/15
 * Time: 3:03 PM
 */

class Mdl_calendar extends CI_Model {

    private $id;
    private $home_id;
    private $available;
    private $start_date;
    private $end_date;
    private $check_in;

    /**
     * @return mixed
     */
    public function getCheckIn()
    {
        return $this->check_in;
    }

    /**
     * @param mixed $check_in
     */
    public function setCheckIn($check_in)
    {
        $this->check_in = $check_in;
    }

    /**
     * @return mixed
     */
    public function getCheckOut()
    {
        return $this->check_out;
    }

    /**
     * @param mixed $check_out
     */
    public function setCheckOut($check_out)
    {
        $this->check_out = $check_out;
    }
    private $check_out;
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
    public function getAvailable()
    {
        return $this->available;
    }

    /**
     * @param mixed $available
     */
    public function setAvailable($available)
    {
        $this->available = $available;
    }

    /**
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->start_date;
    }

    /**
     * @param mixed $start_date
     */
    public function setStartDate($start_date)
    {
        $this->start_date = $start_date;
    }

    /**
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->end_date;
    }

    /**
     * @param mixed $end_date
     */
    public function setEndDate($end_date)
    {
        $this->end_date = $end_date;
    }
    function __construct()
    {
    parent::__construct();
    }
    public function setData(){
    switch(func_get_arg(0)){
        case 'insert':{
            $this->setHomeId(1);// currently this is given manually, atfter that it will come dynamically either by session or by some other method
        $this->setAvailable(func_get_arg(1)['availability']);
        $this->setStartDate(func_get_arg(1)['start_date']);
        $this->setEndDate(func_get_arg(1)['end_date']);
        $this->setCheckIn(func_get_arg(1)['check_in']);
        $this->setCheckOut(func_get_arg(1)['check_out']);
        break;
        }
        case 'update':{
            $this->setHomeId(1);// currently this is given manually, atfter that it will come dynamically either by session or by some other method
            $this->setId(1);// currently this is given manually, atfter that it will come dynamically either by session or by some other method
            $this->setAvailable(func_get_arg(1)['availability']);
            $this->setStartDate(func_get_arg(1)['start_date']);
            $this->setEndDate(func_get_arg(1)['end_date']);
            $this->setCheckIn(func_get_arg(1)['check_in']);
            $this->setCheckOut(func_get_arg(1)['check_out']);
            break;
        }
        default: break;
        }
    }
    public function insert(){
    return $this->db->insert('hlu_renter_home_calendar',[
        'hlu_renter_home_calendar_home_id'=>$this->getHomeId(),
        'hlu_renter_home_calendar_available'=>$this->getAvailable(),
        'hlu_renter_home_calendar_start_date'=>$this->getStartDate(),
        'hlu_renter_home_calendar_end_date'=>$this->getEndDate(),
        'hlu_renter_home_calendar_check_in'=>$this->getCheckIn(),
        'hlu_renter_home_calendar_check_out'=>$this->getCheckOut()
    ])?true :false;
    }
    public function update(){
        return $this->db->where('hlu_renter_home_calendar_id',$this->getId())->update('hlu_renter_home_calendar',[
            'hlu_renter_home_calendar_home_id'=>$this->getHomeId(),
            'hlu_renter_home_calendar_available'=>$this->getAvailable(),
            'hlu_renter_home_calendar_start_date'=>$this->getStartDate(),
            'hlu_renter_home_calendar_end_date'=>$this->getEndDate(),
            'hlu_renter_home_calendar_check_in'=>$this->getCheckIn(),
            'hlu_renter_home_calendar_check_out'=>$this->getCheckOut()
        ])?true :false;
    }
    public function getAvailabilityOptions(){
        return ['everytime','sometime','specific'];
    }

    /**
     * returns the object in the array form
     * might we give the id of the record in the data base to return that particular object
     * @return array
     */
    public function toArray(){
    return [
        'id'=>$this->getId(),
        'home_id'=>$this->getHomeId(),
        'available'=>$this->getAvailable(),
        'start_date'=>$this->getStartDate(),
        'end_date'=>$this->getEndDate(),
        'check_in'=>$this->getCheckIn(),
        'check_out'=>$this->getCheckOut()
        ];
    }
}