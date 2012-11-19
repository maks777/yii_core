<?php

/**
 * This is the model class for table "{{user}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $salt
 * @property string $email
 * @property integer $status
 * @property string $params
 * @property integer $reg_date
 * @property string $rank
 *
 * The followings are the available model relations:
 * @property Post[] $posts
 */
class User extends CActiveRecord
{

	public $newpass;

	/**
	 * Returns the static model of the specified AR class.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user}}';
	}

	public function BeforeSave()
	{

		if ( $this->isNewRecord ) {
			$this->reg_date  = time();	
			$this->salt = md5($this->generateSalt());
			$this->password = $this->hashPassword($this->password, $this->salt);
		}
		
		if ( isset($_POST['User']['newpass']) ) {
			$this->salt = md5($this->generateSalt());
			$this->password = $this->hashPassword($_POST['User']['newpass'], $this->salt);
		}

		return parent::beforeSave();
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, email', 'required'),
			array('status, reg_date', 'numerical', 'integerOnly'=>true),
			array('username, password, salt, email', 'length', 'max'=>128),
			array('rank', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, password, salt, email, status, params, reg_date, rank', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'posts' => array(self::HAS_MANY, 'Post', 'author_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'password' => 'Password',
			'salt' => 'Salt',
			'email' => 'Email',
			'status' => 'Status',
			'params' => 'Params',
			'reg_date' => 'Reg Date',
			'rank' => 'Rank',
			'newpass'=> 'New password',
		);
	}

	public function authenticate($attribute,$params)
	{
		$this->_identity=new UserIdentity($this->username,$this->oldpass);
		if(!$this->_identity->authenticate())
			$this->addError('oldpass','Текущий пароль указан неверно');
	}
	
	/**
	 * Checks if the given password is correct.
	 * @param string the password to be validated
	 * @return boolean whether the password is valid
	 */
	public function validatePassword($password)
	{
		return $this->hashPassword($password,$this->salt)===$this->password;
	}

	
	/**
	 * Generates the password hash.
	 * @param string password
	 * @param string salt
	 * @return string hash
	 */
	public function hashPassword($password,$salt)
	{
		return md5($salt.$password);
	}

	
	/**
	 * Generates a salt that can be used to generate a password hash.
	 * @return string the salt
	 */
	protected function generateSalt()
	{
		return uniqid('',true);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('salt',$this->salt,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('params',$this->params,true);
		$criteria->compare('reg_date',$this->reg_date);
		$criteria->compare('rank',$this->rank,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}


	/**
	 * Функуия возвращения логина пользователя 
	 **/

	static public function getUserName($id)
	{
		$user = User::model()->findByPk($id, array('select'=>array('username')));	
		return $user->username;
	}



	/**
	 * функция генерации списка статусов пользователя
	 **/
	
	static public function getStatusList()
	{
		$operations = Yii::app()->db->createCommand()
		->select('id, name')
		->from('tbl_user_status')
		->queryAll();
		
		foreach ($operations as $one) {
			$res[$one['id']] = $one['name'];
		}

		return $res;
	}

	/**
	 * функция генерации рангов пользователя 
	 **/

	static public function getRankList()
	{
		$operations = Yii::app()->db->createCommand()
		->select('id, name')
		->from('tbl_user_rank')
		->queryAll();
		
		foreach ($operations as $one) {
			$res[$one['name']] = $one['name'];
		}

		return $res;
	}
}
