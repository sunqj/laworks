<?php

class ClientController extends Controller
{
    //just a test action for all
    public $layout = "//layout/xml";

    //login with username and password, username is password
    public function actionPhoneUnameLogin()
    {
        //GET params
        if( !isset($_GET['username']) || !isset($_GET['password']) )
        {
            $this->render('phonelogin', array('result' => 1,
                    'info'   => 'invalid request, username and password required.',
            ));
            return;
        }
        $username = $_GET['username'];
        $password = $_GET['password'];
        //Page parms
        $user = User::getUserByName($username);
        if($user == null)
        {
            $this->render('phonelogin', array('result' => 1,
                    'info'   => 'user does not exist',
            ));
            return;
        }
        
        if($user->password != $password)
        {
            $this->render('phonelogin', array('result' => 1,
                    'info'   => 'wrong password',
            ));
            return;
        }
        
        $clientVersion  = isset($_GET['ver']) ? $_GET['ver'] : 0;
        $columns = Column::model()->findAll("enterprise_id = $user->enterprise_id");
        $verInfo = Build::model()->getLatestVersion($clientVersion, $user->enterprise_id);
        
        $this->render('phonelogin', array(
                                      'result'     => 0,
                                      'info'       => 'login success',
                                      'newver'     => $verInfo['newver'],
                                      'type'       => $verInfo['type'],
                                      'url'        => $verInfo['url'],
                                      'columns'    => $columns,
                                      'user'       => $user,
                                      ));
        return;
    }
    
    public function actionPhoneImeidLogin()
    {
        if( !isset($_GET['imeid']) )
        {
            $this->render('phonelogin', array('result' => 1,
                    'info'   => 'invalid request imeid required.',
            ));
            return;
        }
        
        $imeid = $_GET['imeid'];
        $user = User::getUserByImeid($imeid);
        
        if($user == null)
        {
            $this->render('phonelogin', array('result' => 1,
                    'info'   => 'user does not exist',
            ));
            return;
        }
        
        $clientVersion  = isset($_GET['ver']) ? $_GET['ver'] : 0;
        $columns = Column::model()->findAll("enterprise_id = $user->enterprise_id");
        $verInfo = Build::model()->getLatestVersion($clientVersion, $user->enterprise_id);
        
        $this->render('phonelogin', array(
                                      'result'     => 0,
                                      'info'       => 'login success',
                                      'newver'     => $verInfo['newver'],
                                      'type'       => $verInfo['type'],
                                      'url'        => $verInfo['url'],
                                      'columns'    => $columns,
                                      'user'       => $user,
                                      ));
        return;
    }
    
    public function actionListNotification()
    {
        $username =$_GET['username'];
        $page = $_GET['page'];
        
        echo "notification list";
    }
    
    public function actionListChannel()
    {
        $channelId = $_GET['channelId'];
        
        echo "channel article list";
    }
    
    public function actionListBanner()
    {
        $username = $_GET['username'];
        
        echo "banner list";
    }
    
    public function actionCount()
    {
        $url = $_GET['url'];
        
        echo "click count of an article ";
    }
    
    public function actionListContacts()
    {
        $username = $_GET['username'];
        
        echo "all contacts list";
    }
    
    public function  actionCheckUpdate()
    {
         $username = $_GET['username'];
         $ver      = $_GET['ver'];
         
         echo "whether there is a new version available or not.";
    }
    
    
    public function actionColumnPage()
    {
        $columnId = $_GET['columnId'];
        $page     = $_GET['page'];
        
        echo "next page content";
    }
    
    /**
     *
     * @return array action filters
     */
    public function filters()
    {
        return array (
                'accessControl', // perform access control for CRUD operations
                'postOnly + delete'  // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     *
     * @return array access control rules
     */
    public function accessRules()
    {
        return array (
                array (
                        'allow', // allow all users to perform 'index' and
                        // 'view' actions
                        'actions' => array (
                                'index',
                                'view',
                                'test',
                                "phoneunamelogin",
                                "phoneimeidlogin",
                                "listnotification",
                                "listchannel",
                                "listbanner",
                                "count",
                                "listcontacts",
                                "checkupdate",
                                "columnpage",
                        ),
                        'users' => array (
                                '*'
                        )
                ),
                array (
                        'allow', // allow authenticated user to perform
                        // 'create' and 'update' actions
                        'actions' => array (
                                'create',
                                'update'
                        ),
                        'users' => array (
                                '@'
                        )
                ),
                array (
                        'allow', // allow admin user to perform 'admin'
                        // and 'delete' actions
                        'actions' => array (
                                'admin',
                                'delete'
                        ),
                        'users' => array (
                                'admin'
                        )
                ),
                array (
                        'deny', // deny all users
                        'users' => array (
                                '*'
                        )
                )
        );
    }
}
