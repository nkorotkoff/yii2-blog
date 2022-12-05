<?php

use backend\assets\ImgAsset;
use yii\helpers\Url;
use yii\widgets\LinkPager;

$frontend = ImgAsset::register($this);
?>
<!--================Hero Banner start =================-->
<?php $this->beginBlock('HeroAndBlogSlider') ;?>
<section class="mb-30px">
    <div class="container">
        <div class="hero-banner">
            <div class="hero-banner__content">

                <h3>Tours & Travels</h3>
                <h1>Amazing Places on earth</h1>
                <h4><?= date('Y-m-d ')?></h4>
            </div>
        </div>
    </div>
</section>
<!--================Hero Banner end =================-->

<!--================ Blog slider start =================-->

<!--================ Blog slider end =================-->
<?php $this->endBlock();?>

<div class="col-lg-8">
    <?php if(isset($category)): ?>
        <h2 class="text-center">Searching posts with<?= $category->title?> category</h2>
        <?php endif ?>
    <?php if(isset($hashtag)): ?>
        <h2 class="text-center">Searching posts with <?= $hashtag->name?> tag</h2>
    <?php endif ?>
    <?php foreach ($posts as $post):?>
    <div class="single-recent-blog-post">
        <div class="thumb">
            <img class="img-fluid" src="<?=$frontend->baseUrl . '/' . $post->img?>" width="70%" alt="">
            <ul class="thumb-info">
                <li><i class="ti-user"></i><?= $post->user->username ?></li>
                <li><i class="ti-notepad"></i><?=date("F j, Y",strtotime($post->created_at)) ?></li>
                <li><i class="ti-themify-favicon"></i><?= $post->getComments()->count() ?> Comments</li>
            </ul>
        </div>
        <div class="details mt-20">
            <a href="<?=Url::toRoute(['main-page/post','id'=>$post->id]) ?>">
                <h3><?=$post->title ?>.</h3>
            </a>
            <p class="tag-list-inline">Tags: <?php foreach ($post->hashtags as $hashtag): ?><a href="<?= Url::toRoute(['main-page/hashtags','id'=>$hashtag->id])?>"><?=$hashtag->name ?></a> <?php endforeach;?></p>
            <p><?= $post->subword(700)?></p>
            <a class="button" href="<?=Url::toRoute(['main-page/post','id'=>$post->id]) ?>">Read More <i class="ti-arrow-right"></i></a>
        </div>
    </div>
    <?php endforeach; ?>


        <?php if(isset($pages)):?>
        <?=  \yii\bootstrap5\LinkPager::widget([
                'pagination' => $pages,
            'hideOnSinglePage' => true,

        ])?>
     <?php endif;?>

    <div class="row">
        <div class="col-lg-12">

        </div>
    </div>
</div>