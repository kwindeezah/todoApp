<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "todoApp".
 *
 * @property int $id
 * @property string $task
 * @property string|null $description
 */
class TodoApp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'todoApp';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['task'], 'required'],
            [['task'], 'string', 'max' => 155],
            [['description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'task' => 'Task',
            'description' => 'Description',
        ];
    }
}
