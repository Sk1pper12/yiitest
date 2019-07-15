<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%Sheet}}".
 *
 * @property int $sheet_id
 * @property int $dept_id
 * @property string $sheet_time_start
 * @property string $sheet_time_end
 * @property string $sheet_notes
 * @property int $sheet_state
 * @property int $version
 * @property string $username
 * @property string $operation_date
 *
 * @property Registry[] $registries
 * @property Dept $dept
 */
class Sheet extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%Sheet}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dept_id', 'sheet_state', 'version'], 'integer'],
            [['sheet_time_start', 'sheet_time_end', 'username', 'operation_date'], 'required'],
            [['sheet_time_start', 'sheet_time_end', 'operation_date'], 'safe'],
            [['sheet_notes'], 'string', 'max' => 200],
            [['username'], 'string', 'max' => 50],
            [['dept_id'], 'exist', 'skipOnError' => true, 'targetClass' => Dept::className(), 'targetAttribute' => ['dept_id' => 'dept_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sheet_id' => 'ID відомості',
            'dept_id' => 'ID підрозділу',
            'sheet_time_start' => 'Початок облікового періоду',
            'sheet_time_end' => 'Кінець облікового періоду',
            'sheet_notes' => 'Примітки',
            'sheet_state' => 'Статус відомості',
            'version' => 'Версія відомості',
            'username' => 'Користувач',
            'operation_date' => 'Дата',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegistries()
    {
        return $this->hasMany(Registry::className(), ['sheet_id' => 'sheet_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDept()
    {
        return $this->hasOne(Dept::className(), ['dept_id' => 'dept_id']);
    }
}
