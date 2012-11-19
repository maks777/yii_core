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
 * @property string $profile
 *
 * The followings are the available model relations:
 * @property Post[] $posts
 */
class RegisterForm extends CActiveRecord
{

	public $username;
	public $password;
	public $email;
	public $birth_day;
	public $birth_month;
	public $birth_year;
	public $verifyCode;	
	public $password2;
	public $rules;
	public $phones;

/**
	 * Returns the static model of the specified AR class.
	 * @return RegisterForm the static model class
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

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, salt, realname, rules', 'required'),
			array('username, password, salt, email', 'length', 'max'=>128),
			array('profile, username, realname, lastname,  reg_ip, reg_date', 'safe'),
			array('username,', 'email'),
            array('username', 'unique', 'caseSensitive'=>true ),
//            array('realname', 'unique', 'caseSensitive'=>true ),
            array('rules', 'boolean'),
//            array('password2','compare', 'compareAttribute'=>'password'),
			// verifyCode needs to be entered correctly
			array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
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
			'username' => 'E-mail',
			'password' => 'Пароль',
            'password2'=> 'Пароль2',
            'rules'=>'Я согласен<br/> с правилами<br/> сервиса',
			'salt' => 'Salt',
			'email' => 'Email_old',
			'profile' => 'О себе',
		    'realname'=>'Имя',
		     'lastname'=>'Фамилия',
		     'sex'=>'Пол',
		     'reg_ip'=>'Reg_ip',
		     'reg_date'=>'Reg_date',
		     'birth_day'=>'День',
		     'birth_month'=>'Месяц',
		     'birth_year'=>'Год', 
             'verifyCode'=>'Код проверки',
             'city'=>'Город проживания',
             'phones'=>'Контактные телефоны',
		);
	}

	/**
	 * Generates the password hash.
	 * @param string password
	 * @param string salt
	 * @return string hash
	 */
	public function hashPassword($password,$salt)
	{
		return md5 ($salt.$password);
	}

	/**
	 * Generates a salt that can be used to generate a password hash.
	 * @return string the salt
	 */
	protected function generateSalt()
	{
		return uniqid('',true);
	}
	
}
