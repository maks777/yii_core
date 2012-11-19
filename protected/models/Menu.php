<?php

/**
 * This is the model class for table "{{menu}}".
 *
 * The followings are the available columns in table '{{menu}}':
 * @property integer $id
 * @property string $name
 * @property integer $update_date
 * @property integer $user_id
 * @property string $menu_code
 * @property integer $status
 * @property string $params
 */
class Menu extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Menu the static model class
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
		return '{{menu}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, update_date, user_id, menu_code, status, params', 'required'),
			array('update_date, user_id, status', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, update_date, user_id, menu_code, status, params', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'update_date' => 'Update Date',
			'user_id' => 'User',
			'menu_code' => 'Menu Code',
			'status' => 'Status',
			'params' => 'Params',
		);
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('update_date',$this->update_date);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('menu_code',$this->menu_code,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('params',$this->params,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * функция извлекает и декодирует массив параметров меню 
	 **/
	static public function getMenuDecodeArrey($id)
	{
		$menu = Menu::model()->findByPk($id, array('select'=>array('menu_code')));
		$res = json_decode($menu->menu_code,true);
		$res[] = array('label'=>'Registration', 'url'=>array('user/registration'), 'visible'=>Yii::app()->user->isGuest);
		$res[] = array('label'=>'Login', 'url'=>array('site/login'), 'visible'=>Yii::app()->user->isGuest);
		$res[] = array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('site/logout'), 'visible'=>!Yii::app()->user->isGuest);
		return $res;
	}
}
