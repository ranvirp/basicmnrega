<?php

namespace app\modules\work\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\work\models\Work;

/**
 * WorkSearch represents the model behind the search form about `app\modules\work\models\Work`.
 */
class WorkSearch extends Work
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'agency_id', 'work_type_id', 'scheme_id', 'district_id', 'work_admin', 'status', 'created_at', 'updated_at'], 'integer'],
            [['workid', 'name_hi', 'name_en', 'description', 'address', 'block_code', 'panchayat_code', 'village_code', 'remarks'], 'safe'],
            [['totvalue', 'gpslat', 'gpslong'], 'number'],
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
        $query = Work::find();

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
            'agency_id' => $this->agency_id,
            'work_type_id' => $this->work_type_id,
            'totvalue' => $this->totvalue,
            'scheme_id' => $this->scheme_id,
            'district_id' => $this->district_id,
            'gpslat' => $this->gpslat,
            'gpslong' => $this->gpslong,
            'work_admin' => $this->work_admin,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'workid', $this->workid])
            ->andFilterWhere(['like', 'name_hi', $this->name_hi])
            ->andFilterWhere(['like', 'name_en', $this->name_en])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'block_code', $this->block_code])
            ->andFilterWhere(['like', 'panchayat_code', $this->panchayat_code])
            ->andFilterWhere(['like', 'village_code', $this->village_code])
            ->andFilterWhere(['like', 'remarks', $this->remarks]);

        return $dataProvider;
    }
}
