<?php

/**
 * This is the model class for table "{{mail}}".
 *
 * The followings are the available columns in table '{{mail}}':
 * @property integer $id
 * @property string $name
 * @property string $subject
 * @property string $body
 * @property string $params
 * @property integer $hidden_copy
 * @property integer $create_date
 * @property integer $user_id
 */
class Mail extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Mail the static model class
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
		return '{{mail}}';
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
			array('name, subject, body', 'required'),
			array('type, hidden_copy, create_date, user_id', 'numerical', 'integerOnly'=>true),
			array('name, subject', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, subject, body, params, hidden_copy, create_date, user_id', 'safe', 'on'=>'search'),
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
			'subject' => 'Subject',
			'body' => 'Body',
			'params' => 'Params',
			'hidden_copy' => 'Send Hidden Copy?',
			'create_date' => 'Create Date',
			'user_id' => 'User',
			'type' => 'Content Type',
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
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('body',$this->body,true);
		$criteria->compare('params',$this->params,true);
		$criteria->compare('hidden_copy',$this->hidden_copy);
		$criteria->compare('create_date',$this->create_date);
		$criteria->compare('user_id',$this->user_id);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}

	static public function Send($id, $umail, $pa=array())
	{
		$mail = Yii::app()->db->createCommand()
		->select('subject, body, type, hidden_copy')
		->from('tbl_mail')
		->where('id='.$id)
		->queryAll();
		if ( $mail != null ) {
			$bomail = Yii::app()->params['adminEmail'];

			$headers = 'From: ' . $bomail . "\r\n";
			$headers .= 'Reply-To: ' . $bomail . "\r\n";
			if ( $mail[0]['hidden_copy'] == 1 ) {
				$headers .= 'Bcc: '.$bomail . "\r\n";
			}
			$headers .= 'MIME-Version: 1.0' . "\r\n";
			if ($mail[0]['type'] == 1) {
				$headers .= 'Content-type: text/plain; charset="UTF-8"' . "\r\n";
			}elseif($mail[0]['type'] == 2){
				$headers .= 'Content-type: text/html; charset="UTF-8"' . "\r\n";
			}
			$subject = $mail[0]['subject'];
			$subject = '=?UTF-8?B?' . base64_encode($subject) . '?=';
			if ( count($pa) > 0) {
				foreach ($pa as $key=>$value) {
					$body = str_replace('{'.$key.'}',$value,$mail[0]['body']);
				}
				mail($umail, $subject, $body, $headers);
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
}
