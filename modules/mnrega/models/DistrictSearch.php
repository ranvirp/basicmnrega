<?php

namespace app\modules\mnrega\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\mnrega\models\District;

/**
 * DistrictSearch represents the model behind the search form about `app\modules\mnrega\models\District`.
 */
class DistrictSearch extends District
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['district_code', 'district_name'], 'safe'],
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
        $query = District::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'district_code', $this->district_code])
            ->andFilterWhere(['like', 'district_name', $this->district_name]);

        return $dataProvider;
    }
}
