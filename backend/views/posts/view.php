<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\assets\ImgAsset;
$backend = ImgAsset::register($this);
/** @var yii\web\View $this */
/** @var common\models\Posts $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="posts-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            ['attribute'=>'img','value'=>$backend->baseUrl . '/' . $model->img,
                'format' => ['image',['width'=>'100','height'=>'100']]],
            ['attribute'=>'Category',
                'value'=>$model->categories->title],
            'text:ntext',
            'created_at',
            'user_id',
            ['attribute'=>'hashtags',
                'value'=>function($model){
                        $value = '';
                        foreach ($model->HashtagsShow as $hashtag){
                            $value = $value .' ' . $hashtag->name;
                        }
                        return $value;
                }
                ],
            'views',
            'likes',
        ],
    ]) ?>

</div>
