<?php

use frontend\assets\AppAsset;
use frontend\assets\ImgAsset;

$frontend = ImgAsset::register($this);
AppAsset::register($this);
?>

<section class="mb-30px">
    <div class="container">
        <div class="hero-banner hero-banner--sm">
            <div class="hero-banner__content">
                <h1>Blog details</h1>
                <nav aria-label="breadcrumb" class="banner-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?= $post->title?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<div class="col-lg-8">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="main_blog_details">
                    <img class="img-fluid" src="<?=$frontend->baseUrl . '/' . $post->img?>" width="90%" alt="">
                    <a href="#"><h4><?= $post->title?></h4></a>
                    <div class="user_details">
                        <div class="float-left">
                            <?php foreach ($post->hashtags as $hashtag): ?>
                            <a href="#"><?=$hashtag->name ?></a>

                            <?php endforeach; ?>
                        </div>
                        <div class="float-right mt-sm-0 mt-3">
                            <div class="media">
                                <div class="media-body">
                                    <h5><?=$post->user->username ?></h5>
                                    <p><?=date("F j, Y",strtotime($post->created_at)) ?></p>
                                </div>

                            </div>
                        </div>
                    </div>
                        <p><?= $post->text?></p>
                    <div class="news_d_footer flex-column flex-sm-row">
                        <a style="margin-right: 10px; text-decoration:none;" href="#"><span class="align-middle mr-2"><i class="ti-heart"></i></span>Number of likes</a>
                        <a style="text-decoration:none;" class="justify-content-sm-center ml-sm-auto mt-sm-0 mt-2" href="#"><span class="align-middle mr-2"><i class="ti-themify-favicon"></i></span>06 Comments</a>
                    </div>
                </div>





                <div class="comments-area">
                    <h4>05 Comments</h4>
                    <div class="comment-list">
                        <div class="single-comment justify-content-between d-flex">
                            <div class="user justify-content-between d-flex">

                                <div class="desc">
                                    <h5><a href="#">Emilly Blunt</a></h5>
                                    <p class="date">December 4, 2017 at 3:12 pm </p>
                                    <p class="comment">
                                        Never say goodbye till the end comes!
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="comment-list left-padding">
                        <div class="single-comment justify-content-between d-flex">
                            <div class="user justify-content-between d-flex">
                                <div class="thumb">
                                    <img src="img/blog/c2.jpg" alt="">
                                </div>
                                <div class="desc">
                                    <h5><a href="#">Elsie Cunningham</a></h5>
                                    <p class="date">December 4, 2017 at 3:12 pm </p>
                                    <p class="comment">
                                        Never say goodbye till the end comes!
                                    </p>
                                </div>
                            </div>
                            <div class="reply-btn">
                                <a href="" class="btn-reply text-uppercase">reply</a>
                            </div>
                        </div>
                    </div>
                    <div class="comment-list left-padding">
                        <div class="single-comment justify-content-between d-flex">
                            <div class="user justify-content-between d-flex">
                                <div class="thumb">
                                    <img src="img/blog/c3.jpg" alt="">
                                </div>
                                <div class="desc">
                                    <h5><a href="#">Annie Stephens</a></h5>
                                    <p class="date">December 4, 2017 at 3:12 pm </p>
                                    <p class="comment">
                                        Never say goodbye till the end comes!
                                    </p>
                                </div>
                            </div>
                            <div class="reply-btn">
                                <a href="" class="btn-reply text-uppercase">reply</a>
                            </div>
                        </div>
                    </div>
                    <div class="comment-list">
                        <div class="single-comment justify-content-between d-flex">
                            <div class="user justify-content-between d-flex">
                                <div class="thumb">
                                    <img src="img/blog/c4.jpg" alt="">
                                </div>
                                <div class="desc">
                                    <h5><a href="#">Maria Luna</a></h5>
                                    <p class="date">December 4, 2017 at 3:12 pm </p>
                                    <p class="comment">
                                        Never say goodbye till the end comes!
                                    </p>
                                </div>
                            </div>
                            <div class="reply-btn">
                                <a href="" class="btn-reply text-uppercase">reply</a>
                            </div>
                        </div>
                    </div>
                    <div class="comment-list">
                        <div class="single-comment justify-content-between d-flex">
                            <div class="user justify-content-between d-flex">
                                <div class="thumb">
                                    <img src="img/blog/c5.jpg" alt="">
                                </div>
                                <div class="desc">
                                    <h5><a href="#">Ina Hayes</a></h5>
                                    <p class="date">December 4, 2017 at 3:12 pm </p>
                                    <p class="comment">
                                        Never say goodbye till the end comes!
                                    </p>
                                </div>
                            </div>
                            <div class="reply-btn">
                                <a href="" class="btn-reply text-uppercase">reply</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="comment-form">
                    <h4>Leave a Reply</h4>
                    <?php $form = \yii\widgets\ActiveForm::begin() ?>
                        <div class="form-group form-inline">
                            <div class="form-group col-lg-6 col-md-6 name mb-3">
                                <input type="text" class="form-control" id="name" placeholder="Enter Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Name'">
                            </div>
                            <div class="form-group col-lg-6 col-md-6 email">

                            </div>
                        </div>
                        <div class="form-group">

                        </div>
                        <div class="form-group mb-3">
                            <textarea class="form-control mb-10" rows="5" name="message" placeholder="Messege" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Messege'" required=""></textarea>
                        </div>
                        <a href="#" class="button submit_btn">Post Comment</a>
                    <?php \yii\widgets\ActiveForm::end()?>
                </div>
            </div>

            <!-- Start Blog Post Siddebar -->
        </div>
        <!-- End Blog Post Siddebar -->
    </div>
</div>