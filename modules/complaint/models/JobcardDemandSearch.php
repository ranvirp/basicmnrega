<?php

namespace app\modules\complaint\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\complaint\models\JobcardDemand;

/**
 * JobcardDemandSearch represents the model behind the search form about `app\modules\complaint\models\JobcardDemand`.
 */
class JobcardDemandSearch extends JobcardDemand
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'author', 'create_time', 'update_time'], 'integer'],
            [['name_hi', 'fname', 'mobileno', 'address', 'gender', 'district_code', 'block_code', 'panchayat_code', 'village', 'panchayat'], 'safe'],
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
        $query = JobcardDemand::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'author' => $this->author,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
        ]);

        $query->andFilterWhere(['like', 'name_hi', $this->name_hi])
            ->andFilterWhere(['like', 'fname', $this->fname])
            ->andFilterWhere(['like', 'mobileno', $this->mobileno])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'district_code', $this->district_code])
            ->andFilterWhere(['like', 'block_code', $this->block_code])
            ->andFilterWhere(['like', 'panchayat_code', $this->panchayat_code])
            ->andFilterWhere(['like', 'village', $this->village])
            ->andFilterWhere(['like', 'panchayat', $this->panchayat]);

        return $dataProvider;
    }
}
