<?php

namespace app\modules\mnrega\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\mnrega\models\ParameterValue;

/**
 * ParameterValueSearch represents the model behind the search form about `app\modules\mnrega\models\ParameterValue`.
 */
class ParameterValueSearch extends ParameterValue
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'parameter_id', 'update_time'], 'integer'],
            [['district_id', 'parameter_value'], 'safe'],
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
        $query = ParameterValue::find();

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
            'parameter_id' => $this->parameter_id,
            'update_time' => $this->update_time,
        ]);

        $query->andFilterWhere(['like', 'district_id', $this->district_id])
            ->andFilterWhere(['like', 'parameter_value', $this->parameter_value]);

        return $dataProvider;
    }
}
