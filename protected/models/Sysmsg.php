<?php

/**
 * This is the model class for table "{{sysmsg}}".
 *
 * The followings are the available columns in table '{{sysmsg}}':
 * @property integer $id
 * @property string $description
 * @property string $body
 * @property integer $user_id
 * @property integer $create_date
 * @property integer $type
 */
class Sysmsg extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Sysmsg the static model class
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
		return '{{sysmsg}}';
	}

	public function BeforeSave()
	{

		if ( $this->isNewRecord ) {
			$this->create_date  = time();	
			$this->user_id = Yii::app()->user->id;
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
			array('description, body, type', 'required'),
			array('user_id, create_date, type', 'numerical', 'integerOnly'=>true),
			array('description', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, description, body, user_id, create_date, type', 'safe', 'on'=>'search'),
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
			'description' => 'Description',
			'body' => 'Body',
			'user_id' => 'User',
			'create_date' => 'Create Date',
			'type' => 'Type',
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
		$criteria->compare('description',$this->description,true);
		$criteria->compare('body',$this->body,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('create_date',$this->create_date);
		$criteria->compare('type',$this->type);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}

	static public function YcSysMsg($id)
	{
		$msg = Yii::app()->db->createCommand()
		->select('body')
		->from('tbl_sysmsg')
		->where('id='.$id)
		->queryAll();
		if ( $msg != null ) {
			Yii::app()->user->setFlash($id,$msg[0]['body']);
			return true;
		}else{
			return false;
		}
	}

	static public function ViewSysMsgs()
	{
		$msg = Yii::app()->db->createCommand()
		->select('id, type')
		->from('tbl_sysmsg')
		->queryAll();
		if ( $msg != null ) {
			foreach ($msg as $one) {
				$typeArray = Lookup::items('SysMsgType');					
				$type = $typeArray[$one['type']];
				if ( Yii::app()->user->hasFlash($one['id']) ) {
					Yii::app()->clientScript->registerScript(
						'msgHidden_'.$one['id'],
						'$(".flash-'.$type.'").animate({opacity: 1.0}, 5000).fadeOut("slow");',
						CClientScript::POS_READY
					);

					echo '<div class="flash-'.$type.'">';
					echo Yii::app()->user->getFlash($one['id']);
					echo '</div>';
				}													
			}
		}else{
			return false;
		}
	}
}
