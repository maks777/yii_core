<?php

/**
 * This is the model class for table "{{postcategories}}".
 *
 * The followings are the available columns in table '{{postcategories}}':
 * @property integer $id
 * @property integer $user_id
 * @property string $title
 * @property integer $parent_category
 * @property string $description
 * @property integer $create_date
 * @property integer $valid
 * @property string $tooltip
 * @property integer $position
 * @property string $url
 */
class Postcategories extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Postcategories the static model class
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
		return '{{postcategories}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, title, parent_category, description, create_date, valid, url', 'required'),
			array('user_id, parent_category, create_date, valid, position', 'numerical', 'integerOnly'=>true),
			array('title, tooltip, url', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, title, parent_category, description, create_date, valid, tooltip, position, url', 'safe', 'on'=>'search'),
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
			'user_id' => 'User',
			'title' => 'Title',
			'parent_category' => 'Parent Category',
			'description' => 'Description',
			'create_date' => 'Create Date',
			'valid' => 'Valid',
			'tooltip' => 'Tooltip',
			'position' => 'Position',
			'url' => 'Url',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('parent_category',$this->parent_category);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('create_date',$this->create_date);
		$criteria->compare('valid',$this->valid);
		$criteria->compare('tooltip',$this->tooltip,true);
		$criteria->compare('position',$this->position);
		$criteria->compare('url',$this->url,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}
