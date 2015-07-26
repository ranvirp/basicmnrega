<?php

namespace app\modules\complaint\controllers;

use yii\web\Controller;
use app\modules\complaint\models\Complaint;
use app\modules\complaint\models\JobcardDemand;
use app\modules\complaint\models\WorkDemand;
use Yii;
class DefaultController extends Controller
{

    
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionJobdemand()
    {
       $model=new \app\modules\complaint\models\JobDemand;
       return $this->render('jobdemand',['model'=>$model]);
      
    }
    public function actionComplaint()
    {
       $model=new \app\modules\complaint\models\JobDemand;
       return $this->render('jobdemand',['model'=>$model]);
      
    }
     public function actionSearch()
    {
       $model=new \app\modules\complaint\models\SearchForm;
       if ($model->load(Yii::$app->request->post()) && $model->validate())
         {
            switch ($model->type)
            {
              case 'complaint':
                 if ($complaint=Complaint::findOne($model->id))
                  return $this->render('../complaint/view2',['model'=>$complaint]);
                else
                  return $this->renderContent('Does Not exist');
              break;
              case 'jobcarddemand':
                if ($jobcarddemand=JobcardDemand::findOne($model->id))
                  return $this->render('../jobcarddemand/view',['model'=>$jobcarddemand]);
                else
                  return $this->renderContent('Does Not exist');

              break;
              case 'workdemand':
                if ($workdemand=WorkDemand::findOne($model->id))
                  return $this->render('../workdemand/view',['model'=>$workdemand]);
                else
                  return $this->renderContent('Does Not exist');

              break;
              
            
            }
         
         }
       return $this->render('search',['model'=>$model]);
      
    }
    
}
