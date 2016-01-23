<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Product';
$this->params['breadcrumbs'][] = ( !$modelParent ? 'Categories' : ['label' => 'Categories', 'url' => ['site/categories']] );
if( $modelParent ) {

	if ( !empty($parent_breadcrumbs[0]) ) {
		foreach (array_reverse($parent_breadcrumbs) as $key => $field) {
			$this->params['breadcrumbs'][] = ['label' => $field['name'], 'url' => ['site/categories', 'parent_id' => $field['id']]];
		}
	}
	
	$this->params['breadcrumbs'][] = ['label' => $modelParent['name'], 'url' => ['site/categories', 'parent_id' => $modelParent['id']]];
}
?>
<div class="site-categories">
    <h1><?= Html::encode($this->title) ?>: <?= Html::encode($product['name']) ?></h1>

    <div class="description"><?=$product['description']?></div>

</div>