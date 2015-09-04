  <div class="listView">

   <?php
    echo \yii\widgets\ListView::widget([
   'dataProvider' => $dataProvider,
   //'filterModel'=>$model,
    'itemView' => '_complaintreply',
    ]);
    ?>

  </div>