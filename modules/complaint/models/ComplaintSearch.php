<?php

namespace app\modules\complaint\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\complaint\models\Complaint;

/**
 * ComplaintSearch represents the model behind the search form about `app\modules\complaint\models\Complaint`.
 */
class ComplaintSearch extends Complaint
{
   public $start_time;
   public $end_time;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name_hi', 'fname', 'mobileno', 'district_code', 'address', 'jobcardno', 'description', 'block_code', 'panchayat_code', 'attachments','complaint_type','created_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Complaint::find()->joinWith('actions')->joinWith('block')->joinWith('district');
        $query->addSelect('complaint.id,complaint.name_hi,complaint.fname,complaint.mobileno,complaint.district_code,complaint.block_code,complaint.description,complaint.address,complaint.attachments,complaint.status,complaint.source,complaint.complaint_type,complaint.complaint_subtype,max(complaint_reply.created_at) as lastactiontime,complaint.created_at')->groupBy('complaint.id,complaint.name_hi,complaint.fname,complaint.mobileno,complaint.district_code,complaint.block_code,complaint.description,complaint.address,complaint.attachments,complaint.status,complaint.source,complaint.complaint_type,complaint.complaint_subtype,complaint.created_at');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
             'sort' => ['attributes' => ['id','lastactiontime']]
        ]);
//var_dump($query->prepare(Yii::$app->db->queryBuilder)->createCommand()->rawSql);
//exit;
$this->load($params);
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
           
            return $dataProvider;
        }

        $query->andFilterWhere([
            'complaint.id' => $this->id,
			'complaint.status'=>$this->status,
			'source'=>$this->source,
			'complaint.district_code'=>$this->district_code,
			'complaint.block_code'=>$this->block_code,
			
        ]);
       $query->andFilterWhere([ 'complaint_type'=>$this->complaint_type]);
        $query->andFilterWhere(['like', 'complaint.name_hi', $this->name_hi])
            ->andFilterWhere(['like', 'complaint.fname', $this->fname])
            ->andFilterWhere(['like', 'complaint.mobileno', $this->mobileno])
            ->andFilterWhere(['like', 'complaint.address', $this->address])
            ->andFilterWhere(['like', 'jobcardno', $this->jobcardno])
            ->andFilterWhere(['like', 'complaint.description', $this->description])
            ->andFilterWhere(['like', 'complaint.panchayat_code', $this->panchayat_code])
            ->andFilterWhere(['like', 'attachments', $this->attachments]);
        $query->andFilterWhere(['between', 'complaint.created_at', $this->start_time, $this->end_time]);

		$query->orderBy('lastactiontime desc');
		//var_dump($dataProvider);
		//exit;
        return $dataProvider;
    }
}
