<?php


namespace frontend\controllers;


use common\models\Category;
use common\models\Posts;
use yii\web\Controller;

class MainPageController extends Controller
{

    public function actions()
    {
        $categories = Category::find()->all();
        $this->view->params['categories'] =$categories;
        return parent::actions(); // TODO: Change the autogenerated stub
    }

    public function actionIndex(){

        $posts = Posts::find()->all();
        return $this->render('index',['posts'=>$posts]);
    }
    public function actionPost($id){
        $post = Posts::findOne($id);
        $post->incrementPost();
        return $this->render('blogDetails',['post'=>$post]);
    }

    public function actionComment(){

    }

}