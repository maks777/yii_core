<?php

/**
 * This is the model class for table "{{page}}".
 *
 * The followings are the available columns in table '{{page}}':
 * @property integer $id
 * @property integer $user_id
 * @property integer $create_date
 * @property integer $update_date
 * @property string $title
 * @property string $content
 * @property string $urlname
 * @property integer $status
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keys
 * @property integer $parent
 * @property string $params
 */
class Page extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Page the static model class
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
		return '{{page}}';
	}

	public function BeforeSave()
	{

		if ( $this->isNewRecord ) {
			$this->create_date  = time();	
			$this->update_date = time();
			$this->user_id = Yii::app()->user->id;
		}else{
			$this->update_date = time();
		}

		return parent::beforeSave();
	}

	public function afterSave()
	{
		Menu::genRootMenu();					
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
			array('title, content, status,', 'required'),
			array('user_id, create_date, update_date, status, parent', 'numerical', 'integerOnly'=>true),
			array('title, urlname, meta_title, meta_description, meta_keys', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, create_date, update_date, title, content, urlname, status, meta_title, meta_description, meta_keys, parent, params', 'safe', 'on'=>'search'),
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
			'create_date' => 'Create Date',
			'update_date' => 'Update Date',
			'title' => 'Title',
			'content' => 'Content',
			'urlname' => 'Urlname',
			'status' => 'Status',
			'meta_title' => 'Meta Title',
			'meta_description' => 'Meta Description',
			'meta_keys' => 'Meta Keys',
			'parent' => 'Parent',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('create_date',$this->create_date);
		$criteria->compare('update_date',$this->update_date);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('urlname',$this->urlname,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('meta_title',$this->meta_title,true);
		$criteria->compare('meta_description',$this->meta_description,true);
		$criteria->compare('meta_keys',$this->meta_keys,true);
		$criteria->compare('parent',$this->parent);
		$criteria->compare('params',$this->params,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * функция возвращающая заголовок страницы 
	 **/

	static public function getPageTitle($id)
	{
		if ( $id == 0 ) {
			return 'it is root page';
		}else{
			$page = Page::model()->findByPk($id, array('select'=>array('title')));	
			return $page->title;
		}
	}

	/**
	 * функция генерации списка родительских страниц  
	 **/
	
	static public function getParentList($id = 0, $n = 0)
	{
		$operations = Yii::app()->db->createCommand()
		->select('id, title')
		->from('tbl_page')
		->where('parent='.$id.' and status=2')
		->order('parent')
		->queryAll();
		if ( $operations != null ) {
			$n = $n + 1;
			
			foreach ($operations as $one) {
			$res[] = array($one['id'] =>Page::genDif($n).$one['title']);
				$res1 = Page::getParentList($one['id'], $n);							
				if ( $res1 != false ) {
					$res = array_merge($res, $res1);
				}	
			}
			return $res;
		}else{
			return false;
		}
	}

	static public function getPropList($array, $title)
	{
		$res = array('0'=>$title);
		if ( $array != array() ) {
			foreach ($array as $one) {
				if ( isset($one) ) {
					foreach ($one as $key=>$value) {
						$res[$key] = $value;	
					}	
				}
			}	
		}		

		return $res;
	}

	static public function genDif($n)
	{
		$res = '';

		for ( $i = 0; $i < $n; $i++ ) {
			$res = $res.'-';
		}

		return $res;
	}


}
