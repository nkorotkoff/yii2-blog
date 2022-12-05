<?php

use backend\assets\ImgAsset;
use yii\helpers\Url;
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
    <?php foreach ($posts as $post):?>
    <div class="single-recent-blog-post">
        <div class="thumb">
            <img class="img-fluid" src="<?=$frontend->baseUrl . '/' . $post->img?>" width="70%" alt="">
            <ul class="thumb-info">
                <li><a href="#"><i class="ti-user"></i><?= $post->user->username ?></a></li>
                <li><a href="#"><i class="ti-notepad"></i><?=date("F j, Y",strtotime($post->created_at)) ?></a></li>
                <li><a href="#"><i class="ti-themify-favicon"></i>2 Comments</a></li>
            </ul>
        </div>
        <div class="details mt-20">
            <a href="blog-single.html">
                <h3><?=$post->title ?>.</h3>
            </a>
            <p class="tag-list-inline">Tags: <?php foreach ($post->hashtags as $hashtag): ?><a href="#"><?=$hashtag->name ?></a> <?php endforeach;?></p>
            <p><?= $post->subword()?></p>
            <a class="button" href="<?=Url::toRoute(['main-page/post','id'=>$post->id]) ?>">Read More <i class="ti-arrow-right"></i></a>
        </div>
    </div>
    <?php endforeach; ?>




    <div class="row">
        <div class="col-lg-12">
            <nav class="blog-pagination justify-content-center d-flex">
                <ul class="pagination">
                    <li class="page-item">
                        <a href="#" class="page-link" aria-label="Previous">
                                  <span aria-hidden="true">
                                      <i class="ti-angle-left"></i>
                                  </span>
                        </a>
                    </li>
                    <li class="page-item active"><a href="#" class="page-link">1</a></li>
                    <li class="page-item"><a href="#" class="page-link">2</a></li>
                    <li class="page-item">
                        <a href="#" class="page-link" aria-label="Next">
                                  <span aria-hidden="true">
                                      <i class="ti-angle-right"></i>
                                  </span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>