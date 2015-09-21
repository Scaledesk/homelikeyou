<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Nitesh
 * Date: 17/9/15
 * Time: 3:05 PM
 */

class Mdl_profiles extends CI_Model{

    private $profiles_id;
    private $first_name;
    private $last_name;
    private $image;
    private $address;
    private $pin;
    private $state;
    private $country;


    public function __construct(){
        parent::__construct();

    }
    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * @param mixed $last_name
     */
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }

    /**
     * @return mixed
     */
    public function getProfilesId()
    {
        return $this->profiles_id;
    }

    /**
     * @param mixed $profiles_id
     */
    public function setProfilesId($profiles_id)
    {
        $this->profiles_id = $profiles_id;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * @param mixed $first_name
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getPin()
    {
        return $this->pin;
    }

    /**
     * @param mixed $pin
     */
    public function setPin($pin)
    {
        $this->pin = $pin;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    public  function setData(){
        switch(func_get_arg(0)){
            case "step1":{
                //echo func_get_arg(3);
                $this->setProfilesId(func_get_arg(1));
                $this->setFirstName(func_get_arg(2));
                $this->setLastName(func_get_arg(3));
                break;
               }
            case'step2':{
                //echo func_get_arg(1);

                $this->setImage(func_get_arg(1));
                $this->setProfilesId(func_get_arg(2));
                 break;
                  }

            case'step3':{
                $this->setAddress(func_get_arg(1));
                $this->setPin(func_get_arg(2));
                $this->setState(func_get_arg(3));
                $this->setCountry(func_get_arg(4));
                $this->setProfilesId(func_get_arg(5));
                break;
               }
            case'get_profiles_data':{
                $this->setProfilesId(func_get_arg(1));

                break;
               }
            default:break;
        }
    }

    /**
     * @return bool
     */
    public function updateProfile(){
        switch(func_get_arg(0)){
            case 'step1': {
                                $this->_validate(func_get_arg(0));
                                if($this->_checkProfileExist()){

                                    $data = [
                                        'hlu_profiles_first_name' => $this->getFirstName(),
                                        'hlu_profiles_last_name' => $this->getLastName()
                                    ];
//                                    echo '<pre/>';
//                                    print_r($data);
                                    return $this->db->where(array('hlu_profiles_id'=>$this->getProfilesId()))->update('hlu_profiles', $data) ? true : false;
                                }else{
                                    $data = [
                                        'hlu_profiles_id' => $this->getProfilesId(),
                                        'hlu_profiles_first_name' => $this->getFirstName(),
                                        'hlu_profiles_last_name' => $this->getLastName()
                                    ];
                                    return $this->db->insert('hlu_profiles', $data) ? true : false;
                                }

                            }
                            break;
            case 'step2':{
                          $this->_validate(func_get_arg(0));
                          $data = [
                                'hlu_profiles_image'=> $this->getImage()
                          ];
                            $this->getProfilesId();
                           return $this->db->where(array('hlu_profiles_id'=>$this->getProfilesId()/*2*/))->update('hlu_profiles', $data) ? true : false;
                         }
                         break;
            case 'step3':{
                           $this->_validate(func_get_arg(0));
                          $data = [
                              'hlu_profiles_address'=>$this->getAddress(),
                              'hlu_profiles_pin'=>$this->getPin(),
                              'hlu_profiles_state'=>$this->getState(),
                              'hlu_profiles_country'=>$this->getCountry()

                          ];
                           return $this->db->where(array('hlu_profiles_id'=>$this->getProfilesId()/*2*/))->update('hlu_profiles', $data) ? true : false;

                   break;
            }
            default : break;
        }
    }


    private function _validate()
    {switch(func_get_arg(0)) {
        case 'step1': {
                        $this->setFirstName($this->security->xss_clean($this->getFirstName()));
                        $this->setLastName($this->security->xss_clean($this->getLastName()));
                        break;
        }
        case'step2':{
                     $this->setImage($this->security->xss_clean($this->getImage())) ;
                     break;
                     }
        case'step3':{
                    $this->setAddress($this->security->xss_clean($this->getAddress()));
                    $this->setPin($this->security->xss_clean($this->getPin()));
                    $this->setState($this->security->xss_clean($this->getState()));
                    $this->setCountry($this->security->xss_clean($this->getCountry()));
                    break;
        }

        default:
            break;
        }
    }

    private function _checkProfileExist()
    {
        return $this->db->where('hlu_profiles_id',$this->getProfilesId())->select('hlu_profiles_id')->get('hlu_profiles')->result_array()?true:false;
    }


    public function toArray(){
       // $query=$this->db->query("select * from hlu_profiles where hlu_profiles_id='$hlu_profiles_id'")->result();
         // echo $this->getProfilesId();
         $this->db->where("hlu_profiles_id", 8);
         $query=$this->db->get("hlu_profiles")->result_array();
        // print_r($query);
        $data=array(
            'profiles_id'=>$query[0]['hlu_profiles_id'],
            'profiles_first_name'=>$query[0]['hlu_profiles_first_name'],
            'profiles_last_name'=>$query[0]['hlu_profiles_last_name'],
            'profiles_image'=>$query[0]['hlu_profiles_image'],
            'profiles_address'=>$query[0]['hlu_profiles_address'],
            'profiles_pin'=>$query[0]['hlu_profiles_pin'],
            'profiles_state'=>$query[0]['hlu_profiles_state'],
            'profiles_country'=>$query[0]['hlu_profiles_country']
        );

      return $data;
    }
}