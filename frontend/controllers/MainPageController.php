<?php


namespace frontend\controllers;


use common\models\Category;
use common\models\Comments;
use common\models\Posts;
use Yii;
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

    public function actionComment($id){
        $model = new Comments();
        $post = $this->request->post('comment');
        $model->name = $post['name'];
        $model->text = $post['text'];
        if($model->addComment($id)){
            return $this->redirect(['main-page/post','id'=>$id]);
        }
    }
    public function actionLike($id){

           $model = Posts::findOne($id);


            $session = Yii::$app->session;
            $session->open();
            $check = true;
            var_dump($id);

            if($session->get($model->title)){
                $session->remove($model->title);
                $model->likes = $model->likes-1;
                $check = false;
            }else{
                $session->set($model->title,'true');
                $session->close();
                $model->likes = $model->likes+1;
            }
        $model->save();
    }

}