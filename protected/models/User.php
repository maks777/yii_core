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
	public $verifyCode;	
	public $rules;
	public $password2;

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
			$this->status = 0;
			$this->salt = md5($this->generateSalt());
			$this->password = $this->hashPassword($this->password, $this->salt);
		}

		return parent::beforeSave();
	}

	public function afterSave()
	{
		$key = new Key();
		$key->user_id = $this->id;
		$key->key = md5($this->username.$this->reg_date);
		$key->save();
		Mail::Send(2, $this->email, array('link'=>Yii::app()->createAbsoluteUrl("user/activate", array('key' => $key->key)))); 
		return parent::beforeSave();
	}

	public static function genRePassKey($email)
	{
		$user = User::model()->findByAttributes(array('email'=>$email), array('select'=>'id, username, reg_date'));							
		if ( $user != null ) {
			$key = new Key();
			$key->user_id = $user->id;
			$key->key = md5($user->username.$user->reg_date);
			if($key->save())	
				return $key->key;
		}else{
			return false;	
		}
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//rules for all
			array('username, password, salt, email', 'required', 'on'=>'registration'),
			array('username, password, salt, password2', 'required', 'on'=>'forget'),
			array('status, reg_date', 'numerical', 'integerOnly'=>true),
			array('username, password, salt, email', 'length', 'max'=>128),
			array('rank', 'length', 'max'=>50),
			array('username, email', 'unique', 'caseSensitive'=>true ),
			//registration
			array('password2', 'required', 'on'=>'registration'),
			array('password2','compare', 'compareAttribute'=>'password', 'on'=>'registration, forget'),
			array('username', 'unique', 'caseSensitive'=>true, 'on'=>'registration'),
			array('rules', 'boolean','on'=>'registration'),
			array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements(),'on'=>'registration'),
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
			'password2'=>'Confirm Password',
			'rules'=>'Rules confim',
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
}
