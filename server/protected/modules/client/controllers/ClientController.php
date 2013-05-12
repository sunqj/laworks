<?php

require Yii::app ()->getBasePath () . '/utils/Constants.php';
require Yii::app ()->getBasePath () . '/utils/CommonUtils.php';

class ClientController extends Controller
{
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
        if(!isset($_GET['uId']))
        {
            $this->renderRetCodeAndInfoView($viewName, LA_RSP_FAILED, 'user id missed');
            return; 
        }

        $userId = $_GET['uId'];
        $user = User::model()->findByPk($userId);

        $eId = $user->enterpriseTable->enterprise_id;
        $departments = UserDepartment::model()->findAll("user_id = $userId");

        $conditionStr = "";

        $dIdArray = Array(0);

        foreach($departments as $department)
        {
            array_push($dIdArray, $department->department_id);
        }
        $inStr = "(" . implode(", ", $dIdArray) . ")";
        $conditionStr = "enterprise_id = $eId and (department_id in $inStr )";

        $readNotifications = NotificationUser::model()->findAll("user_id = $userId");
        if(count($readNotifications))
        {
            $nIdArray = Array();
            foreach($readNotifications as $notification)
            {
                array_push($nIdArray, $notification->notification_id);
            }
            $inStr = "(" . implode(", ", $nIdArray) . ")";
            $conditionStr .= "and notification_id not in $inStr";
        }

        $count = Notification::model()->count($conditionStr);
        $pagination = new CPagination($count);
        $pagination->pageSize = LA_PAGE_SIZE;
        //default pageVar = page, set it explicit.
        $pagination->pageVar = 'page';
        $criteria = new CDbCriteria();
        $criteria->condition = $conditionStr;          
        $pagination->applyLimit($criteria);

        $notificationList = Notification::model()->findAll($criteria);

        $this->render($viewName, Array(
            'result'  => LA_RSP_SUCCESS,
            'info'    => 'list notification success',
            'notificationList' => $notificationList,
            'ip'      => getLocalAddr(),
        ));
    }

    public function actionReadNotification()
    {
        $viewName = 'readnotification';

        if(!isset($_GET['nid']))
        {
            $this->renderRetCodeAndInfoView($viewName, LA_RSP_FAILED, 'notification id missed.');
            return;
        }

        $notificationId = $_GET['nid'];
        $notification = Notification::model()->findByPk($notificationId);
        if($notificationId == null)
        {
            $this->renderRetCodeAndInfoView($viewName, LA_RSP_FAILED, 'the notification does not exist');
            return;
        }

        if(!isset($_GET['userId']))
        {
            $this->renderRetCodeAndInfoView($viewName, LA_RSP_FAILED, 'user id missed.');
            return;
        }

        $userId = $_GET['userId'];
        $user = User::model()->findByPk($userId);

        if($user == null)
        {
            $this->renderRetCodeAndInfoView($viewName, LA_RSP_FAILED, 'the user does not exist');
            return;
        }

        $readFlags = NotificationUser::model()->find("user_id = $userId and notification_id = $notificationId");

        if(!count($readFlags))
        {
            $flag = new NotificationUser();
            $flag->user_id = $userId;
            $flag->notification_id = $notificationId;
            $flag->save();
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
            'ip'       => getLocalAddr()
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
            'ip'       => getLocalAddr()
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

        $url = "/apk/$eId/{$build->build_version}.apk";
        $this->render($viewName,
            array(
                'result' => LA_RSP_SUCCESS,
                'info'   => "new update found",
                'type'   => $build->build_type,
                'url'    => $url,
                'newver'=> $build->build_version
            ));
    }

    /*
     * discuss group related functions
     */

    /*
     * create a discuss group
     */
    public function actionCreateTopic()
    {

        if(!isset($_GET['uid']))
        {
            $this->renderRetCodeAndInfoView ( $viewName, LA_RSP_FAILED, 'user id missed.' );
            return;
        }

        if(!isset($_GET['content']))
        {
            $this->renderRetCodeAndInfoView ( $viewName, LA_RSP_FAILED, 'content missed.' );
            return;
        }

        $userid = $_GET['uid'];
        $user = User::model()->findByPk($userid);
        if(!$user)
        {
            $this->renderRetCodeAndInfoView ( $viewName, LA_RSP_FAILED, 'invalid user' );
            return;
        }
        $topic = new Topic;
        $now = time();
        $topic->user_id = $user->user_id;
        $topic->enterprise_id = $user->enterprise_id;
        $topic->topic_created_gmt = $now;
        $topic->topic_updated_gmt = $now;
        $topic->topic_content = $_GET['content'];
        $topic->save();

        $viewName = 'create_topic';

        $this->renderRetCodeAndInfoView($viewName, LA_RSP_SUCCESS, 'create topic successful');
    }

    /*
     * list all discuss groups
     */
    public function actionListTopic()
    {
        $viewName = 'list_topic';

        if (! isset ( $_GET ['eid'] ))
        {
            $this->renderRetCodeAndInfoView ( $viewName, LA_RSP_FAILED, 'enterprise id missed.' );
            return;
        }

        $eid = $_GET['eid'];
        $enterprise = Enterprise::model()->findByPk($eid);
        if(!$enterprise)
        {
            $this->renderRetCodeAndInfoView ( $viewName, LA_RSP_FAILED, 'enterprise does not exist.' );
            return;
        }

        
        $conditionStr = "enterprise_id = $eid";
        $count = Topic::model()->count($conditionStr);
        $pagination = new CPagination($count);
        $pagination->pageSize = LA_PAGE_SIZE;
        //default pageVar = page, set it explicit.
        $pagination->pageVar = 'page';
        $criteria = new CDbCriteria();
        $criteria->condition = $conditionStr;
        $pagination->applyLimit($criteria);
        
        $topics = Topic::model()->findAll($criteria);
        $this->render($viewName,
            array(
                'result' => LA_RSP_SUCCESS,
                'info'   => "list topics successful",
                'topics' => $topics,
            ));
    } 

    /*
     * list all comments for a discuss group
     */
    public function actionListReply()
    {
        $viewName = 'list_reply';
        if(!isset($_GET['tid']))
        {
            $this->renderRetCodeAndInfoView ( $viewName, LA_RSP_FAILED, 'topic id missed.' );
            return;
        }

        $tid = $_GET['tid'];
        $topic = Topic::model()->findByPk($tid);
        if(!$topic)
        {
            $this->renderRetCodeAndInfoView ( $viewName, LA_RSP_FAILED, 'topic does not exist.' );
            return;
        }

        $conditionStr = "topic_id = $tid";
        $count = Reply::model()->count($conditionStr);
        $pagination = new CPagination($count);
        $pagination->pageSize = LA_PAGE_SIZE;
        //default pageVar = page, set it explicit.
        $pagination->pageVar = 'page';
        $criteria = new CDbCriteria();
        $criteria->condition = $conditionStr;
        $pagination->applyLimit($criteria);
        
        $replies = Reply::model()->findAll($criteria);

        $this->render($viewName,
            array(
                'result' => LA_RSP_SUCCESS,
                'info'   => "list replies successful",
                'replies' => $replies,
            ));
    }

    /*
     * vote related functions
     */
    public function actionListVote()
    {
        $viewName = 'list_vote';
        if (! isset ( $_GET ['eid'] ))
        {
            $this->renderRetCodeAndInfoView ( $viewName, LA_RSP_FAILED, 'enterprise id missed.' );
            return;
        }

        $eid = $_GET ['eid'];
        $conditionStr = "enterprise_id = $eid";
        
        $count = Vote::model()->count($conditionStr);
        $pagination = new CPagination($count);
        $pagination->pageSize = LA_PAGE_SIZE;
        //default pageVar = page, set it explicit.
        $pagination->pageVar = 'page';
        $criteria = new CDbCriteria();
        $criteria->condition = $conditionStr;
        $pagination->applyLimit($criteria);
        
        $votes = Vote::model()->findAll($criteria);

        $this->render($viewName,
            array(
                'result' => LA_RSP_SUCCESS,
                'info'   => "list replies successful",
                'votes' => $votes,
            ));
    }

    public function actionListOption()
    {
        $viewName = 'list_option';
        if (! isset ( $_GET ['vid'] ))
        {
            $this->renderRetCodeAndInfoView ( $viewName, LA_RSP_FAILED, 'vote id missed.' );
            return;
        }

        $vid = $_GET ['vid'];
        $uid = $_GET ['uid'];
        $vote = Vote::model()->findByPk($vid);
        $options = Option::model()->findAll("vote_id = $vid");
        $hasVoted = false;
        $result = UserVote::model()->findAll("user_id = $uid and vote_id = $vote->vote_id");
        if($result)
        {
            $hasVoted = true;
        }

        $this->render($viewName,
            array(
                'result' => LA_RSP_SUCCESS,
                'info'   => "list option successful",
                'options' => $options,
                'type'  => $vote->vote_type,
                'voted' => $hasVoted,
            ));

    }

    /*
     * write comment for a discuss group
     */
    public function actionReplyTopic() 
    {
        $viewName = 'reply_topic';
        if (! isset ( $_GET ['tid'] )) 
        {
            $this->renderRetCodeAndInfoView ( $viewName, LA_RSP_FAILED, 'topic id missed.' );
            return;
        }

        if (! isset ( $_GET ['uid'] )) 
        {
            $this->renderRetCodeAndInfoView ( $viewName, LA_RSP_FAILED, 'user id missed.' );
            return;
        }

        if (! isset ( $_GET ['content'] )) 
        {
            $this->renderRetCodeAndInfoView ( $viewName, LA_RSP_FAILED, 'content missed.' );
            return;
        }

        $tid = $_GET ['tid'];
        $topic = Topic::model ()->findByPk ( $tid );
        if (! $topic) 
        {
            $this->renderRetCodeAndInfoView ( $viewName, LA_RSP_FAILED, 'topic does not exist.' );
            return;
        }

        $uid = $_GET['uid'];
        $user = User::model()->findByPk($uid);
        if(!$user)
        {
            $this->renderRetCodeAndInfoView ( $viewName, LA_RSP_FAILED, 'user does not exist.' );
            return;
        }

        $content = $_GET['content'];

        $reply = new Reply;
        $reply->user_id = $uid;
        $reply->topic_id = $tid;
        $reply->reply_create_gmt = time();
        $reply->reply_content = $content;
        $reply->save();

        $this->renderRetCodeAndInfoView ( $viewName, LA_RSP_SUCCESS, 'reply topic ok.' );
        return;
    }

    public function actionDoVote()
    {
        $viewName = 'do_vote';

        if (!isset ( $_GET ['vid']))
        {
            $this->renderRetCodeAndInfoView ( $viewName, LA_RSP_FAILED, 'vote id missed.' );
            return;
        }

        if ((!isset ( $_GET ['oids']) || ($_GET ['oids']) == '' ))
        {
            $this->renderRetCodeAndInfoView ( $viewName, LA_RSP_FAILED, 'option ids missed.' );
            return;
        }


        if (! isset ( $_GET ['uid'] ))
        {
            $this->renderRetCodeAndInfoView ( $viewName, LA_RSP_FAILED, 'user id missed.' );
            return;
        }

        $vid = $_GET ['vid'];
        $vote = Vote::model()->findByPk($vid);
        if(!$vote)
        {
            $this->renderRetCodeAndInfoView ( $viewName, LA_RSP_FAILED, 'vote does not exist.' );
            return;
        }

        $uid = $_GET ['uid'];
        $user = User::model()->findByPk($uid);
        if(!$user)
        {
            $this->renderRetCodeAndInfoView ( $viewName, LA_RSP_FAILED, 'user does not exist.' );
            return;
        }

        $oids = $_GET ['oids'];
        $optionIdList = explode(",", $oids);
        $options = Array();
        foreach ( $optionIdList as $oid ) 
        {
            $userVote = new UserVote ();
            $userVote->user_id = $uid;
            $userVote->option_id = $oid;
            $userVote->vote_id = $vid;
            $userVote->save ();

            $option = Option::model()->findByPk($oid);
            $option->option_count = $option->option_count + 1;
            $option->save ();
            array_push($options, $option);
        }

        $optionArray = Option::model()->findAll("vote_id = $vid");

        $this->render($viewName,
            array(
                'result' => LA_RSP_SUCCESS,
                'info'   => "vote successful",
                'options' => $options,
            ));
        return;

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
                    "readnotification",
                    "listcolumn",
                    "listchannel",
                    "listbanner",
                    "listcontacts",
                    "checkupdate",
                    "columnpage",
                    "createtopic",
                    "listtopic",
                    "listreply",
                    "listvote",
                    "listoption",
                    "dovote",
                    "replytopic",
                    "count",
                    "test",
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
