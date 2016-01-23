<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SearchProducts */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Products', ['create', 'cat_id' => $cat_id], ['class' => 'btn btn-success']) ?>
        <?= ( isset($back->parent_id) && $back->parent_id > 0 ? Html::a(
               'Back',
               '/backend/web/index.php?r=categories%2Fsubcat&SearchCategories[parent_id]='.$back->parent_id,
               ['class'=>'btn btn-primary']
        ) : Html::a(
               'Back',
               '/backend/web/index.php?r=categories',
               ['class'=>'btn btn-primary']
        ) );?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            //'cat_id',
            'name',
            'description:ntext',
            'alias',
            'position',
            'publish',
            'create_date',
            'update_date',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>

    <p>
        <?= Html::a('Create Products', ['create', 'cat_id' => $cat_id], ['class' => 'btn btn-success']) ?>
        <?= ( isset($back->parent_id) && $back->parent_id > 0 ? Html::a(
               'Back',
               '/backend/web/index.php?r=categories%2Fsubcat&SearchCategories[parent_id]='.$back->parent_id,
               ['class'=>'btn btn-primary']
        ) : Html::a(
               'Back',
               '/backend/web/index.php?r=categories',
               ['class'=>'btn btn-primary']
        ) );?>
    </p>

</div>
