<?php

/**
 * This is the model class for table "{{img}}".
 *
 * The followings are the available columns in table '{{img}}':
 * @property integer $id
 * @property string $name
 * @property string $src
 * @property string $tumb1
 * @property string $tumb2
 * @property integer $user_id
 * @property integer $create_date
 * @property integer $status
 */
class Img extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Img the static model class
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
		return '{{img}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, src, tumb1, tumb2, user_id, create_date, status', 'required'),
			array('user_id, create_date, status', 'numerical', 'integerOnly'=>true),
			array('name, src, tumb1, tumb2', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, src, tumb1, tumb2, user_id, create_date, status', 'safe', 'on'=>'search'),
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
			'src' => 'Src',
			'tumb1' => 'Tumb1',
			'tumb2' => 'Tumb2',
			'user_id' => 'User',
			'create_date' => 'Create Date',
			'status' => 'Status',
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
		$criteria->compare('src',$this->src,true);
		$criteria->compare('tumb1',$this->tumb1,true);
		$criteria->compare('tumb2',$this->tumb2,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('create_date',$this->create_date);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}