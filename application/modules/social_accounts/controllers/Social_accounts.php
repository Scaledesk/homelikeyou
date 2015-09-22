<?php
/**
 * Created by PhpStorm.
 * User: tushar
 * Date: 21/9/15
 * Time: 3:15 PM
 */

class Social_accounts extends MX_Controller{
    function __construct()
    {
        require $_SERVER["DOCUMENT_ROOT"].'/homelikeyou/vendor/autoload.php';
        parent::__construct();
        $this->load->Model('Mdl_social_accounts');
    }
    public function index(){
        $data['facebook_login_url']=$this->addFacebookAccount();
    $this->load->view('index.php',$data);
    }
    public function addFacebookAccount(){
//    $fb=Facebook::getFb();
        $fb = new Facebook\Facebook([
            'app_id' => '1659779297592952',
            'app_secret' => '12f070df1d8ba88fded6413b8b7d0b3d',
            'default_graph_version' => 'v2.2',
        ]);
        $helper = $fb->getRedirectLoginHelper();

        $permissions = ['email','publish_actions']; // Optional permissions

        return $helper->getLoginUrl(base_url().'social_accounts/doFacebookLogin', $permissions);
    }

    public function doFacebookLogin(){
//        $fb=Facebook::getFb();
        $fb = new Facebook\Facebook([
            'app_id' => '1659779297592952',
            'app_secret' => '12f070df1d8ba88fded6413b8b7d0b3d',
            'default_graph_version' => 'v2.2',
        ]);
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
        if($accessToken!=null){
            $user_token=$accessToken->getValue();

            $_SESSION['fb_access_token'] = (string) $accessToken;
            if($this->_shareWithFacebook($fb, $user_token)) //may be true or false
            {
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

            if($this->Mdl_social_accounts->getId()!=''){
                $this->Mdl_social_accounts->setData('update_facebook',$user,'facebook');
                if($this->Mdl_social_accounts->update()){
                    setInformUser('success','Link Post succdessfully and your facebook details is saved successfully');
                    redirect('social_accounts');
                }else{
                    setInformUser('error','Some error occurred');
                    redirect('social_accounts');
                }
            }else{
                $this->Mdl_social_accounts->setData('update_facebook',$user,'facebook');
                if($this->Mdl_social_accounts->insert()){
                    setInformUser('success','Link Post succdessfully and your facebook details is saved successfully');
                    redirect('social_accounts');
                }else{
                    setInformUser('error','Some error occurred');
                    redirect('social_accounts');
                }
                }
            }

        }

    }

    /**
     * @param $fb
     * @param $user_token
     * @return mixed
     */
    private function _shareWithFacebook($fb, $user_token)
    {
        $linkData = [
            'link' => 'http://www.google.com',    //share this link with facebook
            'message' => 'Testing my app',
        ];
        try {
            // Returns a `Facebook\FacebookResponse` object
            $response = $fb->post('/me/feed', $linkData, $user_token);
            $graphNode = $response->getGraphNode();
            if($graphNode['id']){return true;}
            else{
                return false;
            }
        } catch (Facebook\Exceptions\FacebookResponseException $e) {
            /*echo 'Graph returned an error: ' . $e->getMessage();
            exit;*/return false;
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            /*echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;*/
            return false;
        }
    }
}