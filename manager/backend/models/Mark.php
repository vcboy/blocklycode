<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%mark}}".
 *
 * @property integer $id
 * @property integer $mid
 * @property integer $course_score
 * @property integer $teacher_score
 * @property integer $teacher_id
 * @property integer $course_id
 * @property integer $datetime
 * @property integer $is_delete
 * @property string $message
 */
class Mark extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%mark}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mid', 'course_score', 'teacher_score', 'teacher_id', 'course_id', 'datetime', 'is_delete'], 'integer'],
            [['message'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'mid' => '会员id',
            'course_score' => '课程评分',
            'teacher_score' => '教师评分',
            'teacher_id' => '教师id',
            'course_id' => '课程id',
            'datetime' => '评分时间',
            'is_delete' => 'Is Delete',
            'message' => '评论',
        ];
    }

    public function getMember(){
        return $this->hasOne(Member::className(), ['id' => 'mid']);
    }

    public function getAverage($type,$id){
        if($type == 'lession'){
            $where = "is_delete = 0 and course_id = $id";
            $field = 'course_score';
        }else{
            $where = "is_delete = 0 and teacher_id = $id";
            $field = 'teacher_score';
        }
        $average = $this::find()->where($where)->average($field);
        return $average;
    }
}
