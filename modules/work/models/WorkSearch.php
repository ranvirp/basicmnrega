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
            [['id', 'work_admin', 'status', 'created_at', 'updated_at', 'created_by'], 'integer'],
            [['uniqueid', 'workid', 'name_hi', 'name_en', 'description', 'agency_code', 'work_type_code', 'scheme_code', 'district_code', 'block_code', 'panchayat_code', 'village_code', 'district', 'block', 'panchayat', 'village', 'division_code', 'address', 'remarks'], 'safe'],
            [['estcost', 'gpslat', 'gpslong'], 'number'],
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
            'estcost' => $this->estcost,
            'gpslat' => $this->gpslat,
            'gpslong' => $this->gpslong,
            'work_admin' => $this->work_admin,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
        ]);

        $query->andFilterWhere(['like', 'uniqueid', $this->uniqueid])
            ->andFilterWhere(['like', 'workid', $this->workid])
            ->andFilterWhere(['like', 'name_hi', $this->name_hi])
            ->andFilterWhere(['like', 'name_en', $this->name_en])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'agency_code', $this->agency_code])
            ->andFilterWhere(['like', 'work_type_code', $this->work_type_code])
            ->andFilterWhere(['like', 'scheme_code', $this->scheme_code])
            ->andFilterWhere(['like', 'district_code', $this->district_code])
            ->andFilterWhere(['like', 'block_code', $this->block_code])
            ->andFilterWhere(['like', 'panchayat_code', $this->panchayat_code])
            ->andFilterWhere(['like', 'village_code', $this->village_code])
            ->andFilterWhere(['like', 'district', $this->district])
            ->andFilterWhere(['like', 'block', $this->block])
            ->andFilterWhere(['like', 'panchayat', $this->panchayat])
            ->andFilterWhere(['like', 'village', $this->village])
            ->andFilterWhere(['like', 'division_code', $this->division_code])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'remarks', $this->remarks]);

        return $dataProvider;
    }
}
