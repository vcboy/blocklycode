<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sc_cc_serveriplist".
 *
 * @property integer $id
 * @property string $ip
 */
class Serveriplist extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sc_cc_serveriplist';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ip'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ip' => 'Ip',
        ];
    }
}
