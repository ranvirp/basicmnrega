<?php

namespace app\modules\formats\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\formats\models\Format;

/**
 * FormatSearch represents the model behind the search form about `app\modules\formats\models\Format`.
 */
class FormatSearch extends Format
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'label_hi', 'label_en', 'parameters', 'calcparameters'], 'safe'],
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
        $query = Format::find();

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
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'label_hi', $this->label_hi])
            ->andFilterWhere(['like', 'label_en', $this->label_en])
            ->andFilterWhere(['like', 'parameters', $this->parameters])
            ->andFilterWhere(['like', 'calcparameters', $this->calcparameters]);

        return $dataProvider;
    }
}
