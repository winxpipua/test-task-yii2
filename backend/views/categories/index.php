<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SearchCategories */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categories-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Categories', ['create', 'parent_id' => $parent_id], ['class' => 'btn btn-success']) ?>
        <?= ( $parent_id > 0 ? ( isset($back->parent_id) && $back->parent_id > 0 ? Html::a(
			   'Back',
			   '/backend/web/index.php?r=categories%2Fsubcat&SearchCategories[parent_id]='.$back->parent_id,
			   ['class'=>'btn btn-primary']
		) : Html::a(
			   'Back',
			   '/backend/web/index.php?r=categories',
			   ['class'=>'btn btn-primary']
		) ) : '' );?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            //'parent_id',
            'name',
            //'description:ntext',
            'alias',
            'position',
            [
            	'attribute' => 'publish',
            	'label'=>'Publish',
            	'format'=>'text',
            	'content'=>function($data){
	                return ( $data->publish == 1 ? 'Publish' : 'Unpublish' );
	            },
	            'filter'=>array("1"=>"Publish","0"=>"Unpublish"),
            ],
            'create_date',
            'update_date',

            [
            	'class' => 'yii\grid\ActionColumn',
            	'template' => '{update} {delete}',
            ],
            [
			    'label' => 'Inside',
			    'format' => 'raw',
			    'value' => function($data){
			    	$back = $data->getParentParentId($data->parent_id);
			        return Html::a(
			            'SubCategories',
			            '/backend/web/index.php?r=categories%2Fsubcat&SearchCategories[parent_id]='.$data->id,
			            [
			                'title' => 'SubCategories',
			                'style' => 'width:100%; display:block;'
			            ]
			        ).' '.
			        Html::a(
			            'Products',
			            '/backend/web/index.php?r=products&SearchProducts[cat_id]='.$data->id,
			            [
			                'title' => 'Products',
			                'style' => 'width:100%; display:block;'
			            ]
			        );
			    }
			],
        ],
    ]); ?>

    <p>
        <?= Html::a('Create Categories', ['create', 'parent_id' => $parent_id], ['class' => 'btn btn-success']) ?>
        <?= ( $parent_id > 0 ? ( isset($back->parent_id) && $back->parent_id > 0 ? Html::a(
			   'Back',
			   '/backend/web/index.php?r=categories%2Fsubcat&SearchCategories[parent_id]='.$back->parent_id,
			   ['class'=>'btn btn-primary']
		) : Html::a(
			   'Back',
			   '/backend/web/index.php?r=categories',
			   ['class'=>'btn btn-primary']
		) ) : '' );?>
    </p>

</div>
