<?php
namespace app\modules\Complaint\models;
use Yii;
class ComplaintReply extends \yii\db\ActiveRecord
{
 const QUESTION=0;
const ENQUIRY_REPORT=1;

const ATR_REPORT=2;
const INSTRUCTION=3;
const AGENT_FEEDBACK=4;
const REPLY_TO_QUESTION=5;

public static function types()
{
 return 
   [
     self::QUESTION=>Yii::t('app','Question'),
     self::ENQUIRY_REPORT=>Yii::t('app','Enquiry Report'),
     
     self::ATR_REPORT=>Yii::t('app','Action Taken Report'),
     self::INSTRUCTION=>Yii::t('app','Instruction'),
     self::AGENT_FEEDBACK=>Yii::t('app','Agent Feedback'),
     self::REPLY_TO_QUESTION=>Yii::t('app','Reply To Question'),
     
   ];
 

}
public static function replyOptions($marking)
{
 $a=  [
     self::QUESTION=>Yii::t('app','Question'),
     ];
if ($marking->status==Complaint::PENDING_FOR_ATR)
  return [
    // self::ENQUIRY_REPORT=>Yii::t('app','Enquiry Report'),
     self::QUESTION=>Yii::t('app','Question'),
     self::ATR_REPORT=>Yii::t('app','Action Taken Report'),
  
  ];
  else
    if ($marking->status==Complaint::PENDING_FOR_ENQUIRY)
  return [
  self::QUESTION=>Yii::t('app','Question'),
     self::ENQUIRY_REPORT=>Yii::t('app','Enquiry Report'),
     
    
  ];
  else if ((Yii::$app->user->can('complaintagent') || Yii::$app->user->can('complaintadmin')))
      return self::types();
      else return $a;
     
 

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
            [['reply',  'marking_id','reply_type','complaint_id'], 'required'],
            [['attachments'],'safe'],
            [['reply_type'],'integer'],
            [['created_at','updated_at','author'],'integer'],
            
            
            
        ];
    }
     public static function lastReply($markingid)
    {
       return self::find()->where(['marking_id'=>$markingid])->orderBy('created_at desc')->limit(1)->one();
       
    }
    public function search($params)
     {
       $query = ComplaintReply::find();
       $this->load($params);

       $query->andFilterWhere([
        'reply_type' => $this->reply_type,
        'marking_id'=>$this->marking_id,
        'complaint_id'=>$this->complaint_id,
        

    ]);
     $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
        ]);

        return $dataProvider;
       
     }

}


?>