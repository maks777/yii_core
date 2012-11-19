<?php

class UserController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
                                'backColor'=>0x868686,
                                'transparent'=>true,
                                'foreColor'=>0x27292A,
                                'testLimit'=>2, // сколько раз капча не меняется
                                'maxLength'=> 5,
                                'minLength'=> 3,

			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}
	
	

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','registration', 'captcha', 'activate', 'forget'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}


	/**
	 * user email activate function 
	 **/

	public function actionActivate($key=false)
	{
		if ( isset($_GET['key']) ) {
			$key = Key::model()->find('key = :act_key', array ( ':act_key' => $_GET['key']));
			$user = User::model()->findByPk($key->user_id);
			$user->status = 1;
			$user->save();

		}else{
			Sysmsg::YcSysMsg(3);
			$this->redirect(array('site/login'));
		}
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new User;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('User');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Display the registration page and control reg process
	 **/
	public function actionRegistration()
	{
                $this->layout='main';
		$model=new User('registration');
		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			
			if($model->validate())
				{
				if ( $model->save() )
					{
						Sysmsg::YcSysMsg(1);
						$this->redirect(array('site/login'));
					}
				else
					{
					throw new CHttpException(501, 'Failed to save your login information');
					}
				}
			}
	
	$this->render('registration',array('model'=>$model));
	}
	


	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new User('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['User']))
			$model->attributes=$_GET['User'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=User::model()->findByPk((int)$id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionForget($email = false, $key = false)
	{
		if ( isset($_POST['User']) ) {
			$key = Key::model()->findByAttributes(array('key'=>$key));
			$user = User::model()->findByPk($key->user_id);
			$user->password = md5($user->salt.$_POST['User']['password']); 
			if($user->save())
			{
				$key->delete();
				Sysmsg::YcSysMsg(6);
				$this->redirect(array('site/login'));
			}
		}

		if ( isset($_POST['LoginForm']['email']) ) {
			$code = User::genRePassKey($_POST['LoginForm']['email']);
			if ( $code != false ) {
				Mail::Send(3, $email, array('link'=>Yii::app()->createAbsoluteUrl("user/forget", array('key' => $code)))); 
				Sysmsg::YcSysMsg(4);
				$this->redirect(array('site/login'));	
			}else{
				Sysmsg::YcSysMsg(5);
				$this->redirect(array('site/login'));	
			}
		}

		if ($key) {
			$key = Key::model()->findByAttributes(array('key'=>$key));
			$user = new User('forget');
													
			$this->render('forget',array(
				'model'=>$user,
			));
		}
	}
}
