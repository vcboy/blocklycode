<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%teacher}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $phone
 * @property integer $course_id
 */
class Teacher extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%teacher}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'course_id'], 'required','message'=>'{attribute}不能为空'],
            [['course_id'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['phone'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '姓名',
            'phone' => '电话',
            'course_id' => '课程名称',
            'average' => '平均分',
        ];
    }

    public function getLession(){
        return $this->hasOne(Lession::className(), ['id' => 'course_id']);
    }
}
