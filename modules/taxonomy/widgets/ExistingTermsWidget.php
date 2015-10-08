<?php
namespace app\modules\taxonomy\widgets;
use yii\base\Widget;
use yii\helpers\Html;
use app\modules\taxonomy\models\Tagging;
use app\modules\taxonomy\models\Term;
use app\modules\taxonomy\models\Taggable;
class ExistingTermsWidget extends Widget
{
 public $model;//existing terms models

 
 public function init()
 {
   
    parent::init();
 }
 public function run()
 {
 	 $taggable=Taggable::findOne(['classname'=>get_class($this->model)]); 
$x='';
    if (!$taggable)
    	print '';
    else
    {
    	 $taggableclass=$taggable->classname;
 	     $pk=$taggableclass::primaryKey()[0];
       $shortcode=$taggable->shortname;
       foreach (Tagging::find()->where(['taggedtype'=>$shortcode,'taggedtypepk'=>$this->model->$pk])->all() as $tag)
       {
       	$termname=Term::findOne($tag->termcode)->termname;
       $x.='<div class="single-term">'.Html::a($termname.' '.'x',['/taxonomy/tagging/remove?dtype='.$shortcode.'&did='.$this->model->$pk.'&tid='.$tag->termcode]).'</div>';
       }

    }
    print '<p>Tags</p>'.$x;

 }
}