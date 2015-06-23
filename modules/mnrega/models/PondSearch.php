<?php

namespace app\modules\mnrega\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\mnrega\models\Pond;

/**
 * PondSearch represents the model behind the search form about `app\modules\mnrega\models\Pond`.
 */
class PondSearch extends Pond
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['workid', 'name_hi', 'name_en', 'district_code', 'block_code', 'panchayat_code', 'village', 'gatasankhya', 'totarea', 'remarks'], 'safe'],
            [['estcost', 'gpslat', 'gpslong'], 'number'],
            [['persondays', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
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
        $query = Pond::find();

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
            'estcost' => $this->estcost,
            'persondays' => $this->persondays,
            'gpslat' => $this->gpslat,
            'gpslong' => $this->gpslong,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'workid', $this->workid])
            ->andFilterWhere(['like', 'name_hi', $this->name_hi])
            ->andFilterWhere(['like', 'name_en', $this->name_en])
            ->andFilterWhere(['like', 'district_code', $this->district_code])
            ->andFilterWhere(['like', 'block_code', $this->block_code])
            ->andFilterWhere(['like', 'panchayat_code', $this->panchayat_code])
            ->andFilterWhere(['like', 'village', $this->village])
            ->andFilterWhere(['like', 'gatasankhya', $this->gatasankhya])
            ->andFilterWhere(['like', 'totarea', $this->totarea])
            ->andFilterWhere(['like', 'remarks', $this->remarks]);

        return $dataProvider;
    }
}
