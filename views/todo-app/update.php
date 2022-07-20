<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TodoApp */

$this->title = 'Update Task: ' . $model->task;
$this->params['breadcrumbs'][] = ['label' => 'Todo List', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="todo-app-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
