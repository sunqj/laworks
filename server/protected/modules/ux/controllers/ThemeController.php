<?php
class ThemeController extends Controller 
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
	public function filters() {
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
	public function accessRules() {
		return array (
				array (
						'allow', // allow all users to perform 'index' and
						               // 'view' actions
                        'actions' => array (
                                'index',
                                'view',
                                'upload' 
                        ),
                        'users' => array (
                                'ux' 
                        ) 
                ),
				array (
						'allow', // allow authenticated user to perform 'create'
						               // and 'update' actions
						'actions' => array (
								'create',
								'update' 
						),
						'users' => array (
                                'ux' 
						) 
				),
				array (
						'allow', // allow admin user to perform 'admin' and
						               // 'delete' actions
						'actions' => array (
								'admin',
								'delete' 
						),
						'users' => array (
                                'ux' 
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
	 *        	the ID of the model to be displayed
	 */
	public function actionView($id) {
		$this->render ( 'view', array (
				'model' => $this->loadModel ( $id ) 
		) );
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view'
	 * page.
	 */
	public function actionCreate() {
		$model = new Theme ();
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if (isset ( $_POST ['Theme'] )) {
			$model->attributes = $_POST ['Theme'];
            $columns = array();
            $modules = array();
            if(isset($_POST['icon']))
            {
            	$columns =  $_POST['icon'];
            }
            if(isset($_POST['modules']))
            {
            	$modules = $_POST['modules'];
            }
			if ($model->save ())
				$this->redirect ( array (
						'view',
						'id' => $model->theme_id 
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
	 *        	the ID of the model to be updated
	 */
	public function actionUpdate($id) {
		$model = $this->loadModel ( $id );
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if (isset ( $_POST ['Theme'] )) {
			$model->attributes = $_POST ['Theme'];
			if ($model->save ())
				$this->redirect ( array (
						'view',
						'id' => $model->theme_id 
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
	 *        	the ID of the model to be deleted
	 */
	public function actionDelete($id) {
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
	public function actionIndex() {
		$dataProvider = new CActiveDataProvider ( 'Theme' );
		$this->render ( 'index', array (
				'dataProvider' => $dataProvider 
		) );
	}
	
	/**
	 * Manages all models.
	 */
	public function actionAdmin() {
		$model = new Theme ( 'search' );
		$model->unsetAttributes (); // clear any default values
		if (isset ( $_GET ['Theme'] ))
			$model->attributes = $_GET ['Theme'];
		
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
	 *        	integer the ID of the model to be loaded
	 */
	public function loadModel($id) {
		$model = Theme::model ()->findByPk ( $id );
		if ($model === null)
			throw new CHttpException ( 404, 'The requested page does not exist.' );
		return $model;
	}
	
	/**
	 * Performs the AJAX validation.
	 * 
	 * @param
	 *        	CModel the model to be validated
	 */
	protected function performAjaxValidation($model) {
		if (isset ( $_POST ['ajax'] ) && $_POST ['ajax'] === 'theme-form') {
			echo CActiveForm::validate ( $model );
			Yii::app ()->end ();
		}
	}
    /**
     * upload icon from client
     */
    public function actionUpload()
    {
        $prefixes = Array('bg', 'banner', 'lg', 'c1', 'c2', 'c3', 'c4', 'c5', 'c6', 'c7', 'o1', 'o2', 'o3');
        foreach ($prefixes as $prefix)
        {
            $varName = $prefix . "Upload";
            if (isset ( $_POST [$varName] ))
            {
                require Yii::app ()->getBasePath () . '/utils/DirUtils.php';
            	
                $uploadImage = CUploadedFile::getInstanceByName ($varName);
                $fileExt = trim ( strtolower ( $uploadImage->getExtensionName () ));
            
                if (($fileExt != 'png') && ($fileExt != 'jpg'))
                {
                    // is not correct file type.
                    echo "1:file extension not match. the file extension is: $fileExt, only jpg and png allowed.";
                    return;
                }
            
                $fileName = time () . ".$fileExt";
            
                $targetFile = getThemeDirAbsolute () . $fileName;
                $ret = $uploadImage->saveAs ( $targetFile );
            
                if ($ret == 1)
                {
                    echo "0:" . getThemeDirRelative() . $fileName;
                    return;
                }
            }
            else 
            {
                continue;
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
}
