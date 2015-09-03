<?php
namespace app\modules\mnrega\controllers;
use yii\web\Controller;
class ReportController extends Controller
{
 public function actionSummary()
 {
  return $this->render('../pond/summary');
 }

}

?>