<?php

class ColumnController extends Controller
{
    /**
     *
     * @var string the default layout for the views. Defaults to
     *      '//layouts/column2', meaning
     *      using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

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
                                'upload',
                        		'list',
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
                                '@' 
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

    /**
     * Displays a particular model.
     * 
     * @param integer $id
     *            the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render ( 'view', array (
                'model' => $this->loadModel ( $id ) 
        ) );
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view'
     * page.
     */
    public function actionCreate()
    {
        $model = new Column ();
        
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        
        if (isset ( $_POST ['Column'] ))
        {
            $model->attributes = $_POST ['Column'];
            if ($model->save ())
                $this->redirect ( array (
                        'view',
                        'id' => $model->column_id 
                ) );
        }
        
        $this->render ( 'create', array (
                'model' => $model 
        ) );
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view'
     * page.
     * 
     * @param integer $id
     *            the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel ( $id );
        
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        
        if (isset ( $_POST ['Column'] ))
        {
            $model->attributes = $_POST ['Column'];
            if ($model->save ())
                $this->redirect ( array (
                        'view',
                        'id' => $model->column_id 
                ) );
        }
        
        $this->render ( 'update', array (
                'model' => $model 
        ) );
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin'
     * page.
     * 
     * @param integer $id
     *            the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $columnArray = Column::model()->findAll('enterprise_id = ' . Yii::app()->user->enterprise_id);
        if(count($columnArray) <= 1)
        {
            throw new CHttpException("", "Last column can not be deleted.");
            $this->redirect(Yii::app()->request->urlReferrer, true);
        }
        
        $this->loadModel ( $id )->delete ();
        
        // if AJAX request (triggered by deletion via admin grid view), we
        // should not redirect the browser
        if (! isset ( $_GET ['ajax'] ))
            $this->redirect ( isset ( $_POST ['returnUrl'] ) ? $_POST ['returnUrl'] : array (
                    'admin' 
            ) );
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider ( 'Column' );
        $this->render ( 'index', array (
                'dataProvider' => $dataProvider 
        ) );
    }

    /**
     * Get all columns as a list for dropdown list controls
     */
    public function  actionList()
    {
    	if(!isset($_GET['eid']))
    	{
    		return null;
    	}
    	$eId = $_GET['eid'];
    	$columnList = Column::model()->getEnterpriseColumnList($eId);
    	echo json_encode($columnList);
    }
    
    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new Column ( 'search' );
        $model->unsetAttributes (); // clear any default values
        if (isset ( $_GET ['Column'] ))
            $model->attributes = $_GET ['Column'];
        
        $this->render ( 'admin', array (
                'model' => $model 
        ) );
    }

    /**
     * Returns the data model based on the primary key given in the GET
     * variable.
     * If the data model is not found, an HTTP exception will be raised.
     * 
     * @param
     *            integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model = Column::model ()->findByPk ( $id );
        if ($model === null)
            throw new CHttpException ( 404, 'The requested page does not exist.' );
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * 
     * @param
     *            CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset ( $_POST ['ajax'] ) && $_POST ['ajax'] === 'column-form')
        {
            echo CActiveForm::validate ( $model );
            Yii::app ()->end ();
        }
    }

    function actionUpload()
    {
        if (isset ( $_POST ['Column'] ))
        {
            $model = new Column ();
            require Yii::app ()->getBasePath () . '/utils/DirUtils.php';
            $uploadImage = CUploadedFile::getInstance ( $model, 'column_icon' );
            $fileExt = trim ( strtolower ( $uploadImage->getExtensionName () ) );
            if ($fileExt != 'jpg' && $fileExt != 'jpeg' && $fileExt != 'png' && $fileExt != 'gif')
            {
                // is not correct file type.
                echo "1:file extension not match.";
                return;
            }
            
            $fileName = time () . ".$fileExt";
            $targetFile = getColumnIconDirAbsolute () . $fileName;
            
            $ret = $uploadImage->saveAs ( $targetFile );
            
            if ($ret == 1)
            {
                echo "0:" . getColumnIconDirRelative () . $fileName;
                return;
            }
        }
        echo "1:Unknow error";
        return;
    }

    function init()
    {
        if (isset ( $_POST ['SESSION_ID'] ))
        {
            $session = Yii::app ()->getSession ();
            $session->close ();
            $session->sessionID = $_POST ['SESSION_ID'];
            $session->open ();
        }
    }
}
