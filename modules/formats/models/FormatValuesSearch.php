<?php

namespace app\modules\formats\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\formats\models\FormatValues;

/**
 * FormatValuesSearch represents the model behind the search form about `app\modules\formats\models\FormatValues`.
 */
class FormatValuesSearch extends FormatValues
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_by', 'month'], 'integer'],
            [['format_id', 'finyear', 'scheme', 'district', 'values', 'calcvalues'], 'safe'],
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
        $query = FormatValues::find();

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
            'created_by' => $this->created_by,
            'month' => $this->month,
        ]);

        $query->andFilterWhere(['like', 'format_id', $this->format_id])
            ->andFilterWhere(['like', 'finyear', $this->finyear])
            ->andFilterWhere(['like', 'scheme', $this->scheme])
            ->andFilterWhere(['like', 'district', $this->district])
            ->andFilterWhere(['like', 'values', $this->values])
            ->andFilterWhere(['like', 'calcvalues', $this->calcvalues]);

        return $dataProvider;
    }
}
