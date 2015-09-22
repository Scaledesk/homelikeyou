<?php
/**
 * Created by PhpStorm.
 * User: tushar
 * Date: 21/9/15
 * Time: 5:25 PM
 */

class Facebook {
     const APP_ID='1659779297592952';
     const APP_SECRET='12f070df1d8ba88fded6413b8b7d0b3d';
     const DEFAULT_GRAPH_VERSION='v2.2';
    static private $fb;
    function __construct()
    {
        date_default_timezone_set('Asia/Calcutta');
        require $_SERVER["DOCUMENT_ROOT"].'/homelikeyou/vendor/autoload.php';
        Facebook::$fb = new Facebook\Facebook([
            'app_id' => self::APP_ID,
            'app_secret' => self::APP_SECRET,
            'default_graph_version' => self::DEFAULT_GRAPH_VERSION
        ]);

    }

    /**
     * @return mixed
     */
    public static function getFb()
    {
        return self::$fb;
    }

    /**
     * @param mixed $fb
     */
    public static function setFb($fb)
    {
        self::$fb = $fb;
    }


}