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
                        <div style="margin-right: 10px; text-decoration:none;" ><span class="align-middle mr-2"><i style="margin-right: 5px; cursor:pointer;" class="<?= $post->checkLike()?> fa-heart heart"></i></span><span class="likes" ><?= $post->likes?></span></div>
                        <div style="text-decoration:none;" class="justify-content-sm-center ml-sm-auto mt-sm-0 mt-2" ><span class="align-middle mr-2"><i style="margin-right: 5px" class="ti-themify-favicon"></i></span><?= $post->getComments()->count() ?> Comments</div>
                    </div>
                </div>





                <div class="comments-area">
                    <h4><?= $post->getComments()->count() ?> Comments</h4>
                    <?php foreach ($post->comments as $comment): ?>
                    <div class="comment-list" style="padding-bottom: 20px;">
                        <div class="single-comment justify-content-between d-flex">
                            <div class="user justify-content-between d-flex">

                                <div class="desc">
                                    <h5><?=$comment->name ?></h5>
                                    <p class="date"><?= $comment->created_at ?></p>
                                    <p class="comment">
                                        <?= $comment->text ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php  endforeach;?>

                </div>
                <div class="comment-form">
                    <h4>Leave a Reply</h4>
                    <?php $form = \yii\widgets\ActiveForm::begin(['action'=>['main-page/comment','id'=>$post->id]]) ?>
                        <div class="form-group form-inline">
                            <div class="form-group col-lg-6 col-md-6 name mb-3">
                                <input type="text" name="comment[name]" class="form-control" id="name" placeholder="Enter Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Name'">
                            </div>
                            <div class="form-group col-lg-6 col-md-6 email">

                            </div>
                        </div>
                        <div class="form-group">

                        </div>
                        <div class="form-group mb-3">
                            <textarea class="form-control mb-10" rows="5" name="comment[text]" placeholder="Message" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Messege'" required=""></textarea>
                        </div>
                        <button type="submit" href="#" class="button submit_btn">Post Comment</button>
                    <?php \yii\widgets\ActiveForm::end()?>
                </div>
            </div>

            <!-- Start Blog Post Siddebar -->
        </div>
        <!-- End Blog Post Siddebar -->
    </div>
</div>

<script>
    $item = document.querySelector('.heart');
    let likes = document.querySelector('.likes')
    // console.log(likes.textContent =parseInt(likes.textContent) +1 )
    $item.addEventListener('click',function (){
        if($item.classList.contains('fa-solid')){
            $item.classList.remove('fa-solid')
            $item.classList.add('fa-regular')
            likes.textContent = parseInt(likes.textContent) -1;
            $.ajax({
                url: '<?php echo \Yii::$app->getUrlManager()->createUrl(['main-page/like','id'=>$post->id]) ?>',
                type: 'POST',

                success: function(data) {


                }
            });

        }else{
        $.ajax({
            url: '<?php echo \Yii::$app->getUrlManager()->createUrl(['main-page/like','id'=>$post->id]) ?>',
            type: 'POST',

            success: function(data) {


            }
        });
            likes.textContent = parseInt(likes.textContent) +1;
            $item.classList.remove('fa-regular')
            $item.classList.add('fa-solid')
        }

    })
</script>