<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Nitesh
 * Date: 17/9/15
 * Time: 3:05 PM
 */

class Mdl_profile extends CI_Model{

    private $profile_id;
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
    public function getProfileId()
    {
        return $this->profile_id;
    }

    /**
     * @param mixed $profile_id
     */
    public function setProfileId($profile_id)
    {
        $this->profile_id = $profile_id;
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
                $this->setProfileId(func_get_arg(1));
                $this->setFirstName(func_get_arg(2));
                $this->setLastName(func_get_arg(3));
                break;
               }
            case'step2':{
                //echo func_get_arg(1);

                $this->setImage(func_get_arg(1));
                 break;
                  }

            case'step3':{
                $this->setAddress(func_get_arg(1));
                $this->setPin(func_get_arg(2));
                $this->setState(func_get_arg(3));
                $this->setCountry(func_get_arg(4));
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
                                if($this->checkProfileExist()){

                                    $data = [
                                        'hlu_profiles_first_name' => $this->getFirstName(),
                                        'hlu_profiles_last_name' => $this->getLastName()
                                    ];
//                                    echo '<pre/>';
//                                    print_r($data);
                                    return $this->db->where(array('hlu_profiles_id'=>$this->getProfileId()))->update('hlu_profiles', $data) ? true : false;
                                }else{
                                    $data = [
                                        'hlu_profiles_id' => $this->getProfileId(),
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
                            $this->getProfileId();
                           return $this->db->where(array('hlu_profiles_id'=>/*$this->getProfileId()*/2))->update('hlu_profiles', $data) ? true : false;
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
                           return $this->db->where(array('hlu_profiles_id'=>/*$this->getProfileId()*/2))->update('hlu_profiles', $data) ? true : false;

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

    private function checkProfileExist()
    {
        return $this->db->where('hlu_profiles_id',$this->getProfileId())->select('hlu_profiles_id')->get('hlu_profiles')->result_array()?true:false;
    }
}