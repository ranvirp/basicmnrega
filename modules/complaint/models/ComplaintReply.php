<?php
namespace app\modules\Complaint\models;
use Yii;
class ComplaintReply extends \yii\db\ActiveRecord
{
 const QUESTION=0;
const ENQUIRY_REPORT=1;
const ATR_CUM_ENQUIRY_REPORT=2;

const ATR_REPORT=3;
const INSTRUCTION=4;
const AGENT_FEEDBACK=5;

public static function types()
{
 return 
   [
     self::QUESTION=>Yii::t('app','Question'),
     self::ENQUIRY_REPORT=>Yii::t('app','Enquiry Report'),
      self::ATR_CUM_ENQUIRY_REPORT=>Yii::t('app','ATR cum Enquiry Report'),
    
     self::ATR_REPORT=>Yii::t('app','Action Taken Report'),
     self::INSTRUCTION=>Yii::t('app','Instruction'),
     self::AGENT_FEEDBACK=>Yii::t('app','Agent Feedback'),
     
   ];
 

}
  public static function tableName()
  {
    return '{{%complaint_reply}}';
  }
  /**
     * @inheritdoc
     */
    public  function behaviors()
    {
        return 
        [
          [
                'class' => \app\modules\reply\behaviors\FileAttachmentBehavior::className(),
                'attribute' => 'attachments',
          ],
         
        ];
    }
       /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['reply',  'marking_id'], 'required'],
            [['attachments'],'safe'],
            [['created_at','updated_at','author'],'integer'],
            
            
            
        ];
    }
     public static function lastReply($markingid)
    {
       return self::find()->where(['marking_id'=>$markingid])->orderBy('created_at desc')->limit(1)->one();
       
    }

}


?>