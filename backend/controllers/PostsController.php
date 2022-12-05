<?php

namespace backend\controllers;

use common\models\Category;
use common\models\Hashtags;
use common\models\Posts;
use backend\models\Posts as PostsSearch;
use Yii;
use yii\base\BaseObject;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * PostsController implements the CRUD actions for Posts model.
 */
class PostsController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['@'],

                        ],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Posts models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PostsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Posts model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**

     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Posts();

        if ($this->request->isPost) {

            if ($model->load($this->request->post())) {
              $model->img =UploadedFile::getInstance($model,'img');
             $model->savePost();

             foreach (Yii::$app->request->post('hashtags') as $hashtag){
                 $hashtags = new Hashtags();
                 if($hashtags::find()->where(['name'=>$hashtag])->one()){
                   $hashtags =  $hashtags::find()->where(['name'=>$hashtag])->one();
                 }else{
                     $hashtags ->name = $hashtag;
                     $hashtags->save();
                 }

                 $model->link('hashtags',$hashtags);
             }
                    return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }
        $categories = Category::find()->asArray()->all();

        return $this->render('create', [
            'model' => $model,
            'categories'=>$categories
        ]);

    }

    /**
     * Updates an existing Posts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {

            if(UploadedFile::getInstance($model,'img')){
                $model->img =UploadedFile::getInstance($model,'img');
            }

            $model->savePost();
//            var_dump($model);
            $hashtags = Yii::$app->request->post('hashtags') ;

            foreach ($model->hashtags as $hashtag){

                if(!in_array($hashtag->name,$hashtags)){
//                    var_dump($hashtags);
                    $model->unlink('hashtags',$hashtag);
                }
            }

            foreach ($hashtags as $hashtag){
                $hashtags = new Hashtags();
                if($hashtags::find()->where(['name'=>$hashtag])->one() && !$model->getHashtags()->where(['=','name',$hashtag])->one()){
                    $hashtags =  $hashtags::find()->where(['name'=>$hashtag])->one();
                    $model->link('hashtags',$hashtags);
                }elseif(!$model->getHashtags()->where(['=','name',$hashtag])->one()){
                    $hashtags ->name = $hashtag;
                    $hashtags->save();
                    $model->link('hashtags',$hashtags);
                }


            }

            return $this->redirect(['view', 'id' => $model->id]);
        }
        $categories = Category::find()->asArray()->all();
        return $this->render('update', [
            'model' => $model,
            'categories'=>$categories
        ]);
    }

    /**
     * Deletes an existing Posts model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Posts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Posts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Posts::findOne(['id' => $id])) !== null) {
            $model->HashtagsShow =$model->hashtags;
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
