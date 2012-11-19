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
			array('name, menu_code, status', 'required'),
			array('update_date, user_id, status', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			// The following rule is used bysearch().
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
	
	public function BeforeSave()
	{

		if ( $this->isNewRecord ) {
			$this->update_date = time();
			$this->user_id = Yii::app()->user->id;
		}else{
			$this->update_date = time();
		}

		return parent::beforeSave();
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
	 * функция генерации правильного массива страниц для виджета меню 
	 **/
	static public function genMenuArray($id = 0)
	{
		$operations = Yii::app()->db->createCommand()
		->select('id, title')
		->from('tbl_page')
		->where('parent='.$id.' and status=2')
		->order('parent')
		->queryAll();
		if ( $id == 0 ) {
			$res = array(array('label'=>'Home', 'url'=>array('post/index')));
		}		
		if ( $operations != null ) {
			foreach ($operations as $one) {
				$res[] = array('label'=>$one['title'], 'url'=>array('page/view?id='.$one['id']),'items'=>Menu::genMenuArray($one['id']));
			}
			return $res;
		}else{
			return array();
		}
	}
	
	static public function genRootMenu()
	{
		$menu = Menu::model()->findByPk(1);						
		if ( $menu === NULL ) {
			$model = new Menu();
			$model->name = 'Root Menu';
			$model->status = 2;
			$model->menu_code = json_encode(Menu::genMenuArray());
			$model->save();
			return true;
		}else{
			$menu->menu_code = json_encode(Menu::genMenuArray());
			$menu->save();
			return true;
		}
	}
}
