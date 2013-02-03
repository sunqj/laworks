<?php

class ClientController extends Controller
{
    //just a test action for all
    public function actionTest()
    {
        echo "this is a test action!!!";
    }

    //login with username and password, username is password
    public function actionPhoneLogin()
    {
        $username = $_GET['username'];
        $password = $_GET['password'];
        $version  = $_GET['ver'];
        echo "enterprise info";
    }
    
    public function actionImeidLogin()
    {
        $username = $_GET['imeid'];
        $password = $_GET['password'];
        $version  = $_GET['ver'];
        
        echo "entperprise logo,enterprise id column and tianyi_channel";
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
                                "phonelogin",
                                "imeidlogin",
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
