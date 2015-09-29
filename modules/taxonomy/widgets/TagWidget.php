<?php
namespace app\modules\taxonomy\widgets;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\modules\taxonomy\models\Vocabulary;
use app\modules\taxonomy\models\Term;
class TagWidget extends Widget
{
 public $vocabs;//array of vocabularies
 public $prefix='_tag';
 public $jscontainer='_tags';
 public function init()
 {
  
 }
 public function run()
 {

   parent::run();
   $this->getView()->registerJsFile(\Yii::getAlias('@web').'/js/tag.js');
  // print "<div class='pull-right col-md-3'>\n";
   print $this->vocabDropdown($this->vocabs);
   
 }
 public function vocabDropdown($vocabs)
 {
 //print a table
$x='<script> '.$this->jscontainer.'=new Array(); </script>';
$x.='<div id="taxonomy_div"></div>';
$x.='<div id="'.$this->prefix.'_div"></div>';//container to contain form elements
  $x.='<table  class="table table-striped">';
  $vocabmodels=Vocabulary::find()->all();
 // foreach ($vocabs as $vocab)
  foreach ($vocabmodels as $vocabmodel)
  {
   //$vocabmodel=Vocabulary::findOne($vocab);
   if (!$vocabmodel) continue;
   
  //we shall create a row with three columns--first being Label of vocab, second beign dropdown
  //of tags of that vocab and third being a button to add tag to model
  $x.='<tr>';
  $x.='<td>'.$vocabmodel->vocabname.'</td>';
  $x.='<td>';
  $termdropdown=Html::dropDownList($this->prefix.'_'.$vocabmodel->vocabcode,'',ArrayHelper::map(Term::find()
    //->where(['vocabcode'=>$vocab])
    ->asArray()->all(),
  'termcode','termname'),['id'=>$this->prefix.'_'.$vocabmodel->vocabcode]);
  $x.=$termdropdown;
  $x.='</td>';
  $x.='<td>'.Html::button('Add',['onclick'=>'addTag($("#'.$this->prefix.'_'.$vocabmodel->vocabcode.'").val(),"'.$this->prefix.'")']).'</td>';
  $x.='</tr>';
  
  
  }
  $x.='</table>';
 return $x;
 }

}