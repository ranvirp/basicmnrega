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
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name_hi', 'fname', 'mobileno', 'district_code', 'address', 'jobcardno', 'description', 'block_code', 'panchayat_code', 'attachments','complaint_type'], 'safe'],
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
        $query->addSelect('complaint.id,complaint.name_hi,complaint.fname,complaint.mobileno,complaint.district_code,complaint.block_code,complaint.description,complaint.address,complaint.attachments,complaint.status,complaint.source,complaint.complaint_type,complaint.complaint_subtype,max(complaint_reply.created_at) as lastactiontime')->groupBy('complaint.id,complaint.name_hi,complaint.fname,complaint.mobileno,complaint.district_code,complaint.block_code,complaint.description,complaint.address,complaint.attachments,complaint.status,complaint.source,complaint.complaint_type,complaint.complaint_subtype');

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
            'id' => $this->id,
			'status'=>$this->status,
			'source'=>$this->source,
			
        ]);
       $query->andFilterWhere([ 'complaint_type'=>$this->complaint_type]);
        $query->andFilterWhere(['like', 'name_hi', $this->name_hi])
            ->andFilterWhere(['like', 'fname', $this->fname])
            ->andFilterWhere(['like', 'mobileno', $this->mobileno])
            ->andFilterWhere(['like', 'district_code', $this->district_code])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'jobcardno', $this->jobcardno])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'block_code', $this->block_code])
            ->andFilterWhere(['like', 'panchayat_code', $this->panchayat_code])
            ->andFilterWhere(['like', 'attachments', $this->attachments]);
		$query->orderBy('lastactiontime desc');
		//var_dump($dataProvider);
		//exit;
        return $dataProvider;
    }
}
