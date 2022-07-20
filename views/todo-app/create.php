<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TodoApp */

$this->title = 'Create Todo App';
$this->params['breadcrumbs'][] = ['label' => 'Todo List', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="todo-app-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
