<?php

namespace app\modules\taxonomy\controllers;

use Yii;

use app\modules\taxonomy\models\Taggable;
use app\modules\taxonomy\models\Tagging;

use app\modules\taxonomy\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TaggableController implements the CRUD actions for Taggable model.
 */
class TaggingController extends Controller
{
   public function actionRemove($tid,$dtype,$did)
   {
   	  if (Yii::$app->user->can('webadmin'))
   	  {
   	  	$taggable=Taggable::findOne($dtype);
   	  	if ($taggable)
   	  	{
   	  		$tagging=Tagging::findOne(['taggedtypepk'=>$did,'taggedtype'=>$dtype,'termcode'=>$tid]);
   	  		if ($tagging)
   	  		{
   	  			
   	  			print $tid. 'removed from '.$dtype.' of id '.$did;
   	  		}
   	  	}

   	  }
   	  print "Could not remove";
   	  Yii::$app->end();
   }

}