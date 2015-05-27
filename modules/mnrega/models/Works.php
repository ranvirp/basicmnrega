<?php

namespace app\modules\mnrega\models;

use Yii;
use yii\base\Model;
use yii\helpers\Html;

/**
 * LoginForm is the model behind the login form.
 */
class Works extends Model
{
public function genCategoriesLink($fin_year,$district_code,$block_code=0)
{
$district=District::findOne($district_code);
if (!$district) return null;
 $link="http://164.100.129.6/netnrega/sec_master_work_cat_work_pd.aspx?district_code=".$district->district_code."&district_name=".rawurlencode($district->district_name)."&state_code=31&state_name=UTTAR%20PRADESH&page=D&fin_year=".$fin_year;
 if ($block_code!=0)
 {
  $block=Block::findOne($block_code);
  if (!$block) return null;
  $link="http://164.100.129.6/netnrega/sec_master_work_cat_work_pd.aspx?district_code=".$district->district_code."&district_name=".rawurlencode($district->district_name)."&state_code=31&state_name=UTTAR%20PRADESH&page=B&fin_year=".$fin_year.'&block_code='.$block->block_code.'&block_name='.rawurlencode($block->block_name);
  return $link;
 }
  return $link;     
}
     public function generateLinkForCategories($page,
     $rcode,$rsubcode,$rsec_code,
     $fin_year,$district_code=0,$block_code=0)
     {
        $link=null;
       if (!$block_code && !$district_code)
        {
          $link="http://164.100.129.6/netnrega/sec_sub_work_category.aspx?state_code=31&page=$page&rcode=$rcode&rsubcode=$rsubcode&rsec_code=$rsec-code&fin_year=$fin_year&state_name=UTTAR%20PRADESH";
        }
        else
         if (!$block_code)
          {
          $district=District::findOne($district_code);
          if ($district) $district_name=$district->district_name;
          else
            return null;
           $link="http://164.100.129.6/netnrega/sec_sub_work_category.aspx?state_code=31&page=$page&rcode=$rcode&rsubcode=$rsubcode&rsec_code=$rsec_code&fin_year=$fin_year&state_name=UTTAR%20PRADESH&district_code=$district_code&district_name=".rawurlencode($district_name);
          }
          else
          {
            $district=District::findOne($district_code);
          if ($district) $district_name=$district->district_name;
          else
            return null;
            $block=Block::findOne($block_code);
          if ($block) $block_name=$block->block_name;
          else
            return null;
           $link="http://164.100.129.6/netnrega/sec_sub_work_category.aspx?state_code=31&page=$page&rcode=$rcode&rsubcode=$rsubcode&rsec_code=$rsec_code&fin_year=$fin_year&state_name=UTTAR%20PRADESH&district_code=$district_code&district_name=".rawurlencode($district_name)."&block_code=$block_code&block_name=".rawurlencode($block_name);
          
          }
        return $link;
     }
     public function genPage($level,$page,$rcode,$rsubcode,$rsec_code,$fin_year)//level=0 district wise level=1 blockwise
     {
       $x='<table>';
       $x.='<tr></tr><tr></tr>';
       if ($level==0)
        {
           $i=1;
          foreach (District::find()->all() as $district)
           {
             $x.="<tr><td>$i</td><td>".Html::a($district->district_name,$this->generateLinkForCategories($page,$rcode,$rsubcode,$rsec_code,$fin_year,$district->district_code)).'</td>'.'<td></td>'.'<td></td>'
             .'<td></td>'.'<td></td>'.'<td></td>'.'<td></td>'.'<td></td>'.'<td></td>'.'</tr>';
           $i++;
           }
        }
        else if ($level==1)
        {
        $i=1;
        foreach (Block::find()->all() as $block)
           {
             $x.="<tr><td>$i</td><td>".Html::a($block->block_name,$this->generateLinkForCategories($page,$rcode,$rsubcode,$rsec_code,$fin_year,$block->district_code,$block->block_code)).'</td>'.'<td></td>'.'<td></td>'
             .'<td></td>'.'<td></td>'.'<td></td>'.'<td></td>'.'<td></td>'.'<td></td>'.'</tr>';
           $i++;
           }
        }
       return $x;
     }
     public function genWorkCategoriesPage($fin_year,$level=0)
     {
   $x='  <table border="0" style="font-size:Medium;" id="rblist">
	<tbody><tr>
		
	</tr>
</tbody></table>';
     $x.='<table>';
       $x.='<tr></tr><tr></tr>';
      $i=1;
      if ($level==0)
      {
          
          foreach (District::find()->all() as $district)
           {
             $x.="<tr><td>$i</td><td>".Html::a($district->district_name,$this->genCategoriesLink($fin_year,$district->district_code)).'</td>'.'<td></td>'.'<td></td>'
             .'<td></td>'.'<td></td>'.'<td></td>'.'<td></td>'.'<td></td>'.'<td></td>'.'</tr>';
           $i++;
           }
           
           return $x;
     }
     if ($level==1)
      {
          
          foreach (Block::find()->all() as $block)
           {
             $x.="<tr><td>$i</td><td>".Html::a($block->block_name,$this->genCategoriesLink($fin_year,$block->district_code,$block->block_code)).'</td>'.'<td></td>'.'<td></td>'
             .'<td></td>'.'<td></td>'.'<td></td>'.'<td></td>'.'<td></td>'.'<td></td>'.'</tr>';
           $i++;
           }
           
           return $x;
     }
   }
}
