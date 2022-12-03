<?php


namespace frontend\controllers;


use yii\web\Controller;

class MainPageController extends Controller
{
    public function actionIndex(){
        return $this->render('index');
    }
}