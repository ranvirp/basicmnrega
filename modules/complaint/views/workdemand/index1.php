 <?php
 use yii\helpers\Html;
  use yii\helpers\Url;
use yii\grid\GridView;
 ?>
 <style>
 .text-heading
 {
  font-size:165%;
  text-align:center;
 
 }
 </style>
 <script>
 function addRow(elem)
 {
   if (elem.closest('tr').next('tr.newrow').length==0)
   {
     elem.closest('tr').after('<tr class="newrow"><td colspan="8"><div >\
     <button class="btn btn-danger col-md-3" onclick="populateHtml("","id")">File Final Report</button>\
     <button class="btn btn-success col-md-3" onclick="populateHtml("","id")">Add Reply</button>\
     <button class="btn btn-info col-md-3" onclick="populateHtml("","id")">View Replies</button>\
     </div>\
     <div id=elem.attr("data-key")+"-actioncontainer"></div></td></tr>\
     ');
     elem.closest('tr').next('.newrow').slideDown(200);
     //('slide');
     elem.closest('tr').next('.newrow').show('slide');
    }
    else
     {
      elem.closest('tr').next('.newrow').slideToggle();
      
      }
 
 }
 </script>
 <div class="form-title">
        <div class="form-title-span text-heading">
         <span>काम के मांग की सूची</span>
        </div>
    </div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

['header'=>'name_hi',
'attribute'=>'Name',
'value'=>function($model,$key,$index,$column)
{
        return $model['cname'];
},],['header'=>'Father/Husband Name',
'attribute'=>'fname',
'value'=>function($model,$key,$index,$column)
{
                return $model['fname'];
},],['header'=>'Mobile No',
'attribute'=>'mobileno',
'value'=>function($model,$key,$index,$column)
{
                return $model['mobileno'];
},],
'dname',
'bname',
['header'=>'Panchayat',
'attribute'=>'panchayat',
'value'=>function($model,$key,$index,$column)
{
                return $model['panchayat'];
},],
       ['class' => 'yii\grid\ActionColumn',
             'controller'=>'/complaint/complaint',
              'template'=>'{filereport}',
            'urlCreator'=>function($action, $model, $key, $index)
              {
                $params = is_array($model['id']) ? $model['id']: ['id' => (string) $model['id']];
                $params[0] = '/complaint/workdemand'. '/' . $action ;
                return Url::toRoute($params);
              },
              'buttons'=>[
                'filereport'=>function($url,$model,$key)
                {
                  return Html::a('<button class="btn btn-success">'.'File Report'.'</button>',$url.'&returnurl='.urlencode(Url::to(['/complaint/workdemand/my'])));
                }
              ],
              ],
        ],
        'tableOptions'=>['class'=>'table table-striped'],
        ]); ?>
