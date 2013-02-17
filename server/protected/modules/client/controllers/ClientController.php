<?php

require Yii::app ()->getBasePath () . '/utils/Constants.php';

class ClientController extends Controller
{
    //just a test action for all
    public $layout = "//layout/xml";

    public function renderRetCodeAndInfoView($viewName, $retCode, $why)
    {
        $this->render($viewName, Array('result' => $retCode,
                                       'info'   => $why));
    }
    
    //login with username and password, username is password
    public function actionPhoneUnameLogin()
    {
        //view name
        $viewName = 'phonelogin';
        
        //GET params
        if( !isset($_GET['username']) || !isset($_GET['password']) )
        {
            $this->render($viewName, array('result' => LA_RSP_FAILED,
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
            $this->render($viewName, array('result' => LA_RSP_FAILED,
                    'info'   => 'user does not exist',
            ));
            return;
        }
        
        if($user->password != $password)
        {
            $this->render($viewName, array('result' => LA_RSP_FAILED,
                    'info'   => 'wrong password',
            ));
            return;
        }
        
        $clientVersion  = isset($_GET['ver']) ? $_GET['ver'] : 0;
        $columns = Column::model()->findAll("enterprise_id = $user->enterprise_id");
        $verInfo = Build::model()->getLatestVersion($clientVersion, $user->enterprise_id);
        
        $this->render($viewName, array(
                                      'result'     => LA_RSP_SUCCESS,
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
        //view name
        $viewName = 'phonelogin';
        
        if( !isset($_GET['imeid']) )
        {
            $this->render($viewName, array('result' => LA_RSP_FAILED,
                    'info'   => 'invalid request imeid required.',
            ));
            return;
        }
        
        $imeid = $_GET['imeid'];
        $user = User::getUserByImeid($imeid);
        
        if($user == null)
        {
            $this->render($viewName, array('result' => LA_RSP_FAILED,
                    'info'   => 'user does not exist',
            ));
            return;
        }
        
        $clientVersion  = isset($_GET['ver']) ? $_GET['ver'] : 0;
        $columns = Column::model()->findAll("enterprise_id = $user->enterprise_id");
        $verInfo = Build::model()->getLatestVersion($clientVersion, $user->enterprise_id);
        
        $this->render($viewName, array(
                                      'result'     => LA_RSP_SUCCESS,
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
        $viewName = 'listnotification';
        if(!isset($_GET['username']))
        {
            $this->renderRetCodeAndInfoView($viewName, LA_RSP_FAILED, 'user name missed');
            return; 
        }
        
        $username =$_GET['username'];
        $user = User::getUserByName($username);
        
        if($user == null)
        {
            $this->renderRetCodeAndInfoView($viewName, LA_RSP_FAILED, 'user does not exist');
            return;
        }
        
        
        $criteria = new CDbCriteria();
        $count = Notification::model()->count("enterprise_id = $user->enterprise_id");
        $pagination = new CPagination($count);
        $pagination->pageSize = LA_PAGE_SIZE;
        $pagination->applyLimit($criteria);
        
        $notificationList = Notification::model()->findAll($criteria);

        $this->render($viewName, Array(
                'result'  => LA_RSP_SUCCESS,
                'info'    => 'list notification success',
                'notificationList' => $notificationList,
                ));
    }
    
    public function actionReadNotification()
    {
        $viewName = 'readnotification';
        
        if(!isset($_GET['notificationId']))
        {
            $this->renderRetCodeAndInfoView($viewName, LA_RSP_FAILED, 'notification id missed.');
            return;
        }
        
        $notification = Notification::model()->findByPk($_GET['notificationId']);
        if($notificationId == null)
        {
            $this->renderRetCodeAndInfoView($viewName, LA_RSP_FAILED, 'the notification does not exist');
            return;
        }
        
        if(!isset($_GET['username']))
        {
            $this->renderRetCodeAndInfoView($viewName, LA_RSP_FAILED, 'user id missed.');
            return;
        }
        
        $user = User::getUserByName($_GET['username']);
        if($user == null)
        {
            $this->renderRetCodeAndInfoView($viewName, LA_RSP_FAILED, 'the user does not exist');
            return;
        }
        
        $this->renderRetCodeAndInfoView($viewName, LA_RSP_SUCCESS, 'read notification success');
        
        return;
    }
    
    public function actionListChannelArticles()
    {
        $channelId = $_GET['channelId'];
        
        echo "channel article list";
    }
    
    public function actionListBanner()
    {
        if(!isset($_GET['username']))
        {
            $this->renderRetCodeAndInfoView($viewName, LA_RSP_FAILED, 'user id missed.');
            return;
        }
        
        $user = User::getUserByName($_GET['username']);
        if($user == null)
        {
            $this->renderRetCodeAndInfoView($viewName, LA_RSP_FAILED, 'the user does not exist');
            return;
        }
        
        
        
        
        echo "banner list";
    }
    
    public function actionCount()
    {
        $url = $_GET['url'];
        
        echo "click count of an article ";
    }
    
    public function actionListContacts()
    {
    if(!isset($_GET['username']))
        {
            $this->renderRetCodeAndInfoView($viewName, LA_RSP_FAILED, 'user id missed.');
            return;
        }
        
        $user = User::getUserByName($_GET['username']);
        if($user == null)
        {
            $this->renderRetCodeAndInfoView($viewName, LA_RSP_FAILED, 'the user does not exist');
            return;
        }
        
        echo "all contacts list";
    }
    
    public function  actionCheckUpdate()
    {
        if(!isset($_GET['username']))
        {
            $this->renderRetCodeAndInfoView($viewName, LA_RSP_FAILED, 'user id missed.');
            return;
        }
        
        $user = User::getUserByName($_GET['username']);
        if($user == null)
        {
            $this->renderRetCodeAndInfoView($viewName, LA_RSP_FAILED, 'the user does not exist');
            return;
        }
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
