<?php
namespace app\modules\api;

use Yii;
use yii\base\Model;
use yii\helpers\Url;
use yii\web\ServerErrorHttpException;

/**
 * CreateAction implements the API endpoint for creating a new model from the given data.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class WorkFindAction extends \yii\rest\Action
{
    /**
     * @var string the scenario to be assigned to the new model before it is validated and saved.
     */
    public $scenario = Model::SCENARIO_DEFAULT;
    /**
     * @var string the name of the view action. This property is need to create the URL when the model is successfully created.
     */
    public $viewAction = 'view';


    /**
     * Creates a new model.
     * @return \yii\db\ActiveRecordInterface the model newly created
     * @throws ServerErrorHttpException if there is any error when creating the model
     */
    public function run()
    {
        if ($this->checkAccess) {
            call_user_func($this->checkAccess, $this->id);
        }
        $designation=\app\modules\users\models\Designation::find()->where(['officer_userid'=>Yii::$app->user->id])->one();
	   $district=$designation->level->code;
	   $district_name=$designation->level->name_en;
	   $x=[];//array of works
	   foreach (\app\modules\mnrega\models\Block::find()->where(['district_code'=>$district])->all() as $block)
	   {
	    
        $works=\app\modules\mnrega\models\Pond::find()->where(['block_code'=>$block->code])->select('name_hi,workid,panchayat_code,block')->asArray()->all();
        foreach ($works as $work)
        {
         $x[$work['block']][$work['panchayat_code']][]=$work;
        }
       }  
       // $response = Yii::$app->getResponse();
      //  $response->setStatusCode(201);
        return $x;
    }
}
