<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Posts $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="posts-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category_id')->dropDownList([ //Active drop down list is more easy
      'Choose Category'=>  ArrayHelper::map($categories, 'id','title'),

    ])->label('Categories') ?>
    <div class="form-group field-posts-title required">
        <label class="control-label" for="hashtags">Hashtags</label>
        <input type="text" id="hashtags" class="form-control control mb-3" maxlength="255" aria-required="true">
        <div class="add__hashtag btn btn-primary">Add</div>

        <div class="help-block"></div>
    </div>
    <div class="d-flex mt-2 hashtags__wrapper mb-3">
        <?php if(isset($model->hashtags)): ?>
            <?php foreach ($model->hashtags as $hashtag):?>
            <div class="inputWrapper">
                <input class="form__hastags" name="hashtags[]" value="<?=$hashtag->name ?>">
                <span class="close">×</span>
            </div>
            <?php endforeach;?>
        <?php endif;?>
    </div>
    <?= $form->field($model, 'text')->textarea(['rows' => 6,]) ?>
    <?= $form->field($model, 'img')->fileInput(['class'=>'m-3']) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$script = <<< JS
    let input, hashtagArray, container, t;
let add__hashtag = document.querySelector(".add__hashtag");
input = document.querySelector(".control");
container = document.querySelector(".hashtags__wrapper");
hashtagArray = [];

let deleteTags = document.querySelectorAll(".close");
    let deleteInputs = document.querySelectorAll(".inputWrapper");
    for (let i = 0; i < deleteTags.length; i++) {
      deleteTags[i].addEventListener("click", () => {
        container.removeChild(deleteInputs[i]);
      });
    }

add__hashtag.addEventListener("click", () => {
  if (event.which == 13 || input.value.length > 0) {
    var wrapper = document.createElement("div");

    wrapper.classList.add("inputWrapper");
    var inputInWrapper = document.createElement("input");
    inputInWrapper.classList.add("form__hastags");
    inputInWrapper.value = input.value;
    inputInWrapper.name = "hashtags[]";
    var spanClose = document.createElement("span");
    spanClose.innerHTML = "&times";
    spanClose.classList.add("close");
    wrapper.append(inputInWrapper);
    wrapper.append(spanClose);

    container.appendChild(wrapper);
    input.value = '';
let deleteTags = document.querySelectorAll(".close");
    let deleteInputs = document.querySelectorAll(".inputWrapper");
    for (let i = 0; i < deleteTags.length; i++) {
      deleteTags[i].addEventListener("click", () => {
        container.removeChild(deleteInputs[i]);
      });
    }
    
  }
});
JS;
$this->registerJs($script);

$this->registerCss(<<< CSS
    .remove {
  cursor: pointer;
  text-decoration: none;
  margin-right: 20px;
}

.chip {
  display: inline-block;
  height: 32px;
  padding: 0 12px;
  margin-right: 1rem;
  font-size: 13px;
  font-weight: 500;
  line-height: 32px;
  color: rgba(0, 0, 0, 0.6);
  cursor: pointer;
  background-color: #eceff1;
  border-radius: 16px;
  -webkit-transition: all 0.3s linear;
  transition: all 0.3s linear;
  text-decoration: none;
}
.form__hastags {
  max-width: 120px;
  border: none;
  background-color: black;
  border-radius: 10px;
  color: white;
  text-align: center;
}

/*.hashtags__wrapper {*/
/*  margin-left: 25%;*/
/*}*/
.inputWrapper {
  margin-left: 5px;
  display: inline;
  position: relative;
}
.close {
  position: absolute;
  padding: 0 5px;
  right: 0;
  color: white;
  cursor: pointer;
}
CSS
);
?>
