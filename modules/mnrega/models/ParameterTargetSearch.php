<?php

namespace app\modules\mnrega\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\mnrega\models\ParameterTarget;

/**
 * ParameterTargetSearch represents the model behind the search form about `app\modules\mnrega\models\ParameterTarget`.
 */
class ParameterTargetSearch extends ParameterTarget
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'parameter_id', 'month'], 'integer'],
            [['district_id', 'parameter_target'], 'safe'],
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
        $query = ParameterTarget::find();

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
            'month' => $this->month,
        ]);

        $query->andFilterWhere(['like', 'district_id', $this->district_id])
            ->andFilterWhere(['like', 'parameter_target', $this->parameter_target]);

        return $dataProvider;
    }
}
