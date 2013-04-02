<?php

require Yii::app ()->getBasePath () . '/utils/Constants.php';

class ClientController extends Controller
{
    public $layout = "//layout/xml";
    private static $serverIp = "192.168.3.101";

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
        $commonColumns = Column::model()->findAll("enterprise_id = $user->enterprise_id");

        $dummyColumns =	Column::model()->findAll("column_id < 0");
        $orderedColumns = array();
        $theme = Theme::model()->findAll("enterprise_id     = $user->enterprise_id");
        
        $theme = count($theme) ? $theme[0] : Theme::model()->findByPk("0");
        for($i = 1; $i < 10; ++ $i)
        {
            $columnId = $theme [($i > 9 ? "theme_c$i" : "theme_c0$i")];
            $columns = $columnId > 0 ? $commonColumns : $dummyColumns;
            
            foreach ( $columns as $column )
            {
                if ($column->column_id == $columnId)
                {
                    array_push ( $orderedColumns, $column );
                    break;
                }
            }
        }

        $verInfo = Build::model()->getLatestVersion($clientVersion, $user->enterprise_id);
        
        $this->render($viewName, array(
                                      'result'     => LA_RSP_SUCCESS,
                                      'info'       => 'login success',
                                      'newver'     => $verInfo['newver'],
                                      'type'       => $verInfo['type'],
                                      'url'        => $verInfo['url'],
                                      'columns'    => $orderedColumns,
                                      'user'       => $user,
                                      'theme'      => $theme->theme_id,
                                      ));
        return;
    }
    
    public function actionListNotification()
    {
        $viewName = 'listnotification';
        if(!isset($_GET['userid']))
        {
            $this->renderRetCodeAndInfoView($viewName, LA_RSP_FAILED, 'user id missed');
            return; 
        }
        
        $userid =$_GET['userid'];
        $user = User::model()->findByPk($userid);
        
        if($user == null)
        {
            $this->renderRetCodeAndInfoView($viewName, LA_RSP_FAILED, 'user does not exist');
            return;
        }
        

        
        $count = Notification::model()->count("enterprise_id = $user->enterprise_id");
        $pagination = new CPagination($count);
        $pagination->pageSize = LA_PAGE_SIZE;
        //default pageVar = page, set it explicit.
        $pagination->pageVar = 'page';
        $criteria = new CDbCriteria();
        $criteria->condition = "enterprise_id = $user->enterprise_id";
        $pagination->applyLimit($criteria);
        
        $notificationList = Notification::model()->findAll($criteria);

        $this->render($viewName, Array(
                'result'  => LA_RSP_SUCCESS,
                'info'    => 'list notification success',
                'notificationList' => $notificationList,
                'ip'      => ClientController::$serverIp,
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
    
    public function actionListColumn()
    {
        $viewName = 'list_column_articles';
        if(!isset($_GET['columnId']))
        {
            $this->renderRetCodeAndInfoView($viewName, LA_RSP_FAILED, 'column id is not set');
            return;
        }
        
        $columnId = $_GET['columnId'];
        $count = Article::model()->count("column_id = $columnId");
        
        $pagination = new CPagination($count);
        $pagination->pageVar = 'page';
        $criteria = new CDbCriteria();
        $criteria->condition = "column_id = $columnId";
        $pagination->applyLimit($criteria);
        
        
        $articles = Article::model()->findAll($criteria);
        $this->render($viewName, Array(
                'result'  => LA_RSP_SUCCESS,
                'info'    => 'get artile list success',
                'articles' => $articles,
                'ip'       => ClientController::$serverIp,
        ));
    }
    
    public function actionListBanner()
    {
        $viewName = 'list_column_articles';
        if(!isset($_GET['enterpriseId']))
        {
            $this->renderRetCodeAndInfoView($viewName, LA_RSP_FAILED, 'enterprise id missed.');
            return;
        }
        
        $enterpriseId = $_GET['enterpriseId'];
        $articles = Article::model()->findAll("enterprise_id = $enterpriseId and article_isbanner = 1");
        
        $this->render($viewName, Array(
                'result'  => LA_RSP_SUCCESS,
                'info'    => 'get banner list success',
                'articles' => $articles,
                'ip'       => ClientController::$serverIp,
        ));
    }
    
    public function actionCount()
    {
        $url = $_GET['url'];
        
        echo "click count of an article ";
    }

    public function actionListContacts()
    {
        $viewName = "list_contacts";
        if (! isset ( $_GET ['enterpriseId'] ))
        {
            $this->renderRetCodeAndInfoView ( $viewName, LA_RSP_FAILED, 'enterprise id missed.' );
            return;
        }
        //Contacts::exportAndGroupContactsToZip($_GET ['enterpriseId']);
        Contacts::exportAndSortContactsToZip($_GET['enterpriseId']);
        $this->render($viewName,
                array(
                        'result' => "0",
                        'info'   => "list contacts successfull",
                        'contacts' => array()));
    }
    
    public function  actionCheckUpdate()
    {
    	$viewName = 'check_update';
        if(!isset($_GET['eId']))
        {
            $this->renderRetCodeAndInfoView($viewName, LA_RSP_FAILED, 'enterprise id missed.');
            return;
        }
        
        $eId = $_GET['eId'];
        $ver = '0';
        $ver = $_GET['ver'];
        
        $builds = Build::model()->findAll("enterprise_id = $eId order by build_date desc");
        
        if(count($builds) < 1)
        {
        	$this->renderRetCodeAndInfoView($viewName, LA_RSP_NOUPDATE, 'no updates found.');
        	return;
        }
		
        $build = $builds[0];
        
        $clientVerArray = explode("-", $_GET['ver']);
        $clientBuildTime = intval($clientVerArray[1]);
        $latestBuildTime = intval($build->build_date);
        if($clientBuildTime > $latestBuildTime)
        {
        	$this->renderRetCodeAndInfoView($viewName, LA_RSP_NOUPDATE, 'no updates found.');
        	return;
        }
        
        $url = "/server/apk/$eId/{$build->build_version}.apk";
        $this->render($viewName,
        		array(
        				'result' => LA_RSP_SUCCESS,
        				'info'   => "new update found",
        				'type'   => $build->build_type,
        				'url'    => $url,
        				'newver'=> $build->build_version
        				));
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
                        'allow', // actions for all users
                        'actions' => array (
                                'index',
                                'view',
                                "phoneunamelogin",
                                "phoneimeidlogin",
                                "listnotification",
                                "listcolumn",
                                "listchannel",
                                "listbanner",
                                "listcontacts",
                                "checkupdate",
                                "columnpage",
                                "count",
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
