<?php

class ContactsController extends Controller
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
                                'view' ,
                                'import',
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
                                'update',
                                'excelupload',
                                'import',
                                'upload',
                                'preview' 
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
                                'delete',
                                'excelupload',
                                'import',
                                'upload',
                                'preview' 
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
        $model = new Contacts ();
        
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        
        if (isset ( $_POST ['Contacts'] ))
        {
            $model->attributes = $_POST ['Contacts'];
            if ($model->save ())
                $this->redirect ( array (
                        'view',
                        'id' => $model->contacts_id 
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
        
        if (isset ( $_POST ['Contacts'] ))
        {
            $model->attributes = $_POST ['Contacts'];
            if ($model->save ())
                $this->redirect ( array (
                        'view',
                        'id' => $model->contacts_id 
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
        $dataProvider = new CActiveDataProvider ( 'Contacts' );
        $this->render ( 'index', array (
                'dataProvider' => $dataProvider 
        ) );
    }

    /**
     * import users and contacts from an excel file
     */
    public function actionUpload()
    {
        if (isset ( $_POST ['uploadFile'] ))
        {
            $this->redirect ( array (
                    'preview',
                    'filename' => $_POST ['uploadFile'] 
            ) );
        }
        $this->render ( 'upload' );
    }

    /**
     * preview imported excel
     */
    public function actionPreview()
    {
        $excelFile = $_GET['filename'];
        $retVal = Contacts::parseExcelFileToArray ( $excelFile );
        $this->render ('preview', array (
                'user'           => $retVal['user'],
                'badLine'        => $retVal['badLine'],
                'contacts'       => $retVal['contacts'],
                'filename'       => $retVal['filename'],
                'department'     => $retVal['department'],
                'duplicateUser'  => $retVal['duplicateLine'],
                'userDepartment' => $retVal['userDepartment'],
        ));
    }

    /**
     * import real excel file related users, contacts, departments, and user_department 
     */
    
    public function actionImport()
    {
        $excelFile = $_POST['filename'];
        $retVal = Contacts::parseExcelFileToArray($excelFile);
        Contacts::importAll($retVal);
        $this->redirect(array('admin'));
    }
    
    /**
     * upload excel file from client
     */
    public function actionExcelUpload()
    {
        if (isset ( $_POST ['excelUpdload'] ))
        {
            require Yii::app ()->getBasePath () . '/utils/utils.php';
            $uploadImage = CUploadedFile::getInstanceByName ( 'excelUpdload' );
            $fileExt = trim ( strtolower ( $uploadImage->getExtensionName () ) );
            if ($fileExt != 'xls')
            {
                // is not correct file type.
                echo "1:file extension not match.";
                return;
            }
            
            $fileName = time () . ".$fileExt";
            $targetFile = getExcelFileDirAbsolute () . $fileName;
            $ret = $uploadImage->saveAs ( $targetFile );
            
            if ($ret == 1)
            {
                echo "0:" . $fileName;
                return;
            }
        }
        echo "1:Unknow error";
        return;
    }

    /**
     * replace session id for MUploadify
     */
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

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new Contacts ( 'search' );
        $model->unsetAttributes (); // clear any default values
        if (isset ( $_GET ['Contacts'] ))
            $model->attributes = $_GET ['Contacts'];
        
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
        $model = Contacts::model ()->findByPk ( $id );
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
        if (isset ( $_POST ['ajax'] ) && $_POST ['ajax'] === 'contacts-form')
        {
            echo CActiveForm::validate ( $model );
            Yii::app ()->end ();
        }
    }
}
