<?php

namespace app\modules\complaint\controllers;

use yii\web\Controller;
use app\modules\complaint\models\Complaint;
use app\modules\complaint\models\JobcardDemand;
use app\modules\complaint\models\WorkDemand;
use app\modules\complaint\models\SearchForm;
use Yii;
class DefaultController extends Controller
{

    
    public function actionIndex()
    {
       $x='';
       $model = new SearchForm;
       if ($model->load(Yii::$app->request->post()))
       {
        switch($model->type)
        {
          case 'complaint':
           if ($model=Complaint::findOne($model->id))
            $x= $this->renderPartial('../complaint/view',['model'=>Complaint::findOne($model->id)]);
             else
                      $x='Not Found';
          break;
          case 'jobcarddemand':
          if ($model=JobcardDemand::findOne($model->id))
                      $x= $this->renderPartial('../jobcarddemand/view',['model'=>$model]);
          else
                      $x='Not Found';

          break;
          case 'workdemand':
           if ($model=WorkDemand::findOne($model->id))
                      $x= $this->renderPartial('../workdemand/view',['model'=>WorkDemand::findOne($model->id)]);
            else
                      $x='Not Found';

          break;
          default:
          break;
        }
       
       }
        return $this->render('index',['result'=>$x]);
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
         else
       return $this->render('search',['model'=>$model]);
      
    }
    
}