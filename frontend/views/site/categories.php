<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Categories';
$this->params['breadcrumbs'][] = ( !$modelParent ? $this->title : ['label' => $this->title, 'url' => ['site/categories']] );
if( $modelParent ) {

	if ( !empty($parent_breadcrumbs[0]) ) {
		foreach (array_reverse($parent_breadcrumbs) as $key => $field) {
			$this->params['breadcrumbs'][] = ['label' => $field['name'], 'url' => ['site/categories', 'parent_id' => $field['id']]];
		}
	}
	
	$this->params['breadcrumbs'][] = $modelParent['name'];
}
?>
<div class="site-categories">
    <h1><?= Html::encode($this->title) ?></h1>

    <? /* Categories */ ?>

   	<?php foreach ($model as $key => $field) : ?>
   		<div class="wrapp_cat">
   			<div class="name"><?=$field['name']?></div>
   			<div class="decsription"><?=$field['description']?></div>
   			<?= Html::a('Show', ['categories', 'parent_id'=>$field['id']], ['class'=>'btn btn-primary']) ?>
   		</div>
   	<?php endforeach; ?>

   	<? /* Products */ ?>

   	<?php if( !empty($products) ) { ?>

	   	<div class="clear"></div>

	   	<h2>Products</h2>

	   	<?php foreach ($products as $products_key => $products_field) : ?>
	   		<div class="wrapp_cat">
	   			<div class="name"><?=$products_field['name']?></div>
	   			<div class="decsription"><?=$products_field['description']?></div>
	   			<?= Html::a('Show', ['products', 'id'=>$products_field['id']], ['class'=>'btn btn-primary']) ?>
	   		</div>
	   	<?php endforeach; ?>

   	<?php } ?>

</div>