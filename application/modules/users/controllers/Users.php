<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: tushar
 * Date: 14/9/15
 * Time: 4:38 PM
 */

class Users extends MX_Controller{

    function __construct()
    {
    	date_default_timezone_set('Asia/Calcutta');
        parent::__construct();
        require $_SERVER["DOCUMENT_ROOT"].'/homelikeyou/vendor/autoload.php';
        $this->load->Model('Mdl_users');
    }
    /**
     * this is the index method the landing page for all operations
     */
    public function index(){

        if($this->_logged_in()){
            if($this->_getRole()=='guest'){
                //show their dashboard
            }elseif($this->_getRole()=='host'){
                //show their dashboard
            }
        }else if(strtolower( $_SERVER['REQUEST_METHOD'] ) == 'post'){
                $to_do_with_post=$_POST["todo"];
            if(isset($to_do_with_post)){
                if($to_do_with_post=='login'){
                    $this->_login($this->input->post());
                }elseif($to_do_with_post=='register'){
                    $this->_register($this->input->post());
                }
            }
        }else{
            $roles= array();
            foreach($this->_getRole() as $role){
               $roles[$role['hlu_roles_id']]=$role['hlu_roles_name'];
            }
            $data['roles']=$roles;
            $data['facebook_login_url']=$this->_getFacebookLoginUrl();
            $this->load->view('index.php',$data);
        }
    }

    /**
     * check if user if someone is logged in or not
     * @return bool
     */
    private function _logged_in()
    {
        /*if(someone is logged in)
        RETURN TRUE;*/
    }

    /**
     *return role of currently logged in user
     */
    private function _getRole()
    {
        //return role
        if(false/*logged_in*/){

        }else{
            $this->load->Model('user_roles/Mdl_roles');
            return $this->Mdl_roles->getRolesName();
        }
    }

    /**
     *login the user
     */
    private function _login($data)
    {
        $this->Mdl_users->setData('checkUser',$data['user_name_email'],$data['password']);
        if($this->Mdl_users->checkUser()){
            $this->Mdl_users->setData('setSessionData',$data['user_name_email']);
            $user_data=$this->Mdl_users->getUserData();
            $this->_setSessionData('authorize',$user_data);
            redirect('testapp');
        }else{
            //set flash message that his username and password do not match try again.
            setInformUser('error','your Username and password do not match');
            redirect('users');
        }
    }

    /**
     *register the user
     */
    private function _register($data)
    {
        $this->Mdl_users->setData('register',$data['user_name_email'],$data['password'],$data['user_level']);
        if($this->Mdl_users->register('normal_registration')){
            echo "your account successfully created";
        };
    }

    private function _setSessionData()
    {
        switch(func_get_arg(0)){
            case 'authorize':   $this->session->set_userdata('authorize',true);
                                $this->session->set_userdata('user_data',func_get_arg(1));
                                break;
            default: break;
        }
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect('users?logout=1');
    }

    private function _getFacebookLoginUrl(){
        $fb = $this->_facebookAppConf();

        $helper = $fb->getRedirectLoginHelper();

        $permissions = ['email']; // Optional permissions
        return $helper->getLoginUrl(base_url().'users/doFacebookLogin', $permissions);
    }
    private function _facebookAppConf(){
        $fb = new Facebook\Facebook([
            'app_id' => '1659779297592952',
            'app_secret' => '12f070df1d8ba88fded6413b8b7d0b3d',
            'default_graph_version' => 'v2.2',
        ]);
        return $fb;
    }
    public function doFacebookLogin(){
        $fb = $this->_facebookAppConf();

        $helper = $fb->getRedirectLoginHelper();

        try {
            $accessToken = $helper->getAccessToken();
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        if (! isset($accessToken)) {
            if ($helper->getError()) {
                header('HTTP/1.0 401 Unauthorized');
                echo "Error: " . $helper->getError() . "\n";
                echo "Error Code: " . $helper->getErrorCode() . "\n";
                echo "Error Reason: " . $helper->getErrorReason() . "\n";
                echo "Error Description: " . $helper->getErrorDescription() . "\n";
            } else {
                header('HTTP/1.0 400 Bad Request');
                echo 'Bad request';
            }
            exit;
        }


// The OAuth 2.0 client handler helps us manage access tokens
        $oAuth2Client = $fb->getOAuth2Client();

// Get the access token metadata from /debug_token
        $tokenMetadata = $oAuth2Client->debugToken($accessToken);

// Validation (these will throw FacebookSDKException's when they fail)
        $tokenMetadata->validateAppId("1659779297592952");
// If you know the user ID this access token belongs to, you can validate it here
//$tokenMetadata->validateUserId('123');
        $tokenMetadata->validateExpiration();

        if (! $accessToken->isLongLived()) {
            // Exchanges a short-lived access token for a long-lived one
            try {
                $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
            } catch (Facebook\Exceptions\FacebookSDKException $e) {
                echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
                exit;
            }
        }

        $_SESSION['fb_access_token'] = (string) $accessToken;

        // User is logged in with a long-lived access token.
        // You can redirect them to a members-only page.
        //header('Location: https://example.com/members.php');
        try {
            // Returns a `Facebook\FacebookResponse` object
            $response = $fb->get('/me?fields=id,name,email', $accessToken);
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        $user = $response->getGraphUser();
        $user_token=$accessToken->getValue();
        $this->Mdl_users->setData("facebook_login",$user['email'],$user['id'],$user_token,'facebook');
        if($this->Mdl_users->isSocialRegistered()){
            //set the session and login the user
            $this->Mdl_users->setData('setSessionData',$user['email']);
            $user_data=$this->Mdl_users->getUserData();
            $this->_setSessionData('authorize',$user_data);
            redirect('testapp');
        }else
        if($this->Mdl_users->isNormalRegistered()){
            redirect('users');
        }else{
            $this->Mdl_users->register('social_registration');
            //inform the user that his account is successfully registered, so he/she can login
            redirect('users');
          }
        }

    public function doGoogleLogin(){
        // $curl=curl_init();
        //curl_setopt( $curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        ########## Google Settings.. Client ID, Client Secret from https://cloud.google.com/console #############
        $google_client_id 		= '788432038523-rmf69v29f1simoqpmech5cfds76ucutl.apps.googleusercontent.com';
        $google_client_secret 	= 'vfuBwdccUNVERFEJAzQJt872';
        $google_redirect_url 	= base_url()."users/doGoogleLogin"; //path to your script
        $google_developer_key 	= 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxx';

        ########## MySql details (Replace with yours) #############
        $db_username = "root"; //Database Username
        $db_password = "tushar"; //Database Password
        $hostname = "localhost"; //Mysql Hostname
        $db_name = 'Home'; //Database Name
        ###################################################################
        $gClient = new Google_Client();
        $gClient->setApplicationName('Homeyou');
        $gClient->setClientId($google_client_id);
        $gClient->setClientSecret($google_client_secret);
        $gClient->setRedirectUri($google_redirect_url);
        $gClient->setDeveloperKey($google_developer_key);
        $gClient->setAccessType("offline");

        $google_oauthV2 = new Google_Service_Oauth2($gClient);

        if (isset($_REQUEST['reset']))
        {
            unset($_SESSION['token']);
            $gClient->revokeToken();
            header('Location: ' . filter_var($google_redirect_url, FILTER_SANITIZE_URL)); //redirect user back to page
        }

        if (isset($_GET['code']))
        {
            $gClient->authenticate($_GET['code']);
            $_SESSION['token'] = $gClient->getAccessToken();
            header('Location: ' . filter_var($google_redirect_url, FILTER_SANITIZE_URL));
            return;
        }
        if (isset($_SESSION['token']))
        {
            $gClient->setAccessToken($_SESSION['token']);
        }
        if ($gClient->getAccessToken())
        {
            try{     //For logged in user, get details from google using access token
                $user 				= $google_oauthV2->userinfo->get();
                $user_id 				= $user['id'];
                $user_name 			= filter_var($user['name'], FILTER_SANITIZE_SPECIAL_CHARS);
                $email 				= filter_var($user['email'], FILTER_SANITIZE_EMAIL);
                $profile_url 			= filter_var($user['link'], FILTER_VALIDATE_URL);
                $profile_image_url 	= filter_var($user['picture'], FILTER_VALIDATE_URL);
                $personMarkup 		= "$email<div><img src='$profile_image_url?sz=50'></div>";
                $_SESSION['token'] 	= $gClient->getAccessToken();
            }catch(Exception $e){
                $this->logout();
            }
        }
        else
        {
            //For Guest user, get google login url
            $gClient->setScopes(array(
                'https://www.googleapis.com/auth/plus.login',
                'profile',
                'email',
                'openid',
            ));
            $authUrl = $gClient->createAuthUrl();
        }

        if(isset($authUrl)) //user is not logged in, show login button
        {
            redirect($authUrl);
        }else // user logged in
        {
            $this->Mdl_users->setData("facebook_login",$user['email'],$user['id'],$_SESSION['token'],'google');
            if($this->Mdl_users->isSocialRegistered()){
                //set the session and login the user
                $this->Mdl_users->setData('setSessionData',$user['email']);
                $user_data=$this->Mdl_users->getUserData();
                $this->_setSessionData('authorize',$user_data);
                redirect('testapp');
            }else
                if($this->Mdl_users->isNormalRegistered()){
                    //set flash error message to inform user that he has already registered, through normal registration, try normal login or forgot password
                    //redirect to login
                    redirect('users');
                }else{
                    $this->Mdl_users->register('social_registration');
                    //inform the user that his account is successfully registered, so he/she can login
                    redirect('users');
                }

        }

    }

}

