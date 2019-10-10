<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%plan}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $tabletype
 * @property double $jf
 * @property string $description
 * @property string $enddate
 * @property integer $is_delete
 */
class Plan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%plan}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'tabletype', 'jf', 'fee'], 'required','message'=>'{attribute}不能为空'],
            [['tabletype', 'is_delete', 'course_id', 'teacher_id'], 'integer'],
            [['jf', 'fee'], 'number'],
            [['description'], 'string'],
            [['name','bkfx','company'], 'string', 'max' => 128],
            [['enddate'], 'string', 'max' => 32],
            [['bkzs','zsdj'], 'string', 'max' => 64],
            [['img'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '活动名称',
            'tabletype' => '活动类型',
            'img' => '活动图片',
            'jf' => '积分',
            'fee' => '费用',
            'description' => '活动描述',
            'enddate' => '结束日期',
            'course_id' => '课程',
            'teacher_id' => '教师',
            'company' => '申报单位',
            'bkfx'  => '报考方向',
            'bkzs'  => '报考证书',
            'zsdj'  => '证书等级',
            'is_delete' => 'Is Delete',
        ];
    }

    public function upload()
    {
        $main_name=date('YmHis'.'-'.rand(100,999));
        $tofilename = Yii::$app->basePath.'/uploads/' . $main_name . '.' . $this->img->extension;
        $this->img->saveAs($tofilename);
        return '/uploads/' . $main_name . '.' . $this->img->extension;
    }

    public function getLession(){
        return $this->hasOne(Lession::className(), ['id' => 'course_id']);
    }

    public function getTeacher(){
        return $this->hasOne(Teacher::className(), ['id' => 'teacher_id']);
    }
    
}
