<?php

namespace app\modules\taxonomy\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\taxonomy\models\Term;

/**
 * TermSearch represents the model behind the search form about `app\modules\taxonomy\models\Term`.
 */
class TermSearch extends Term
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['termcode', 'vocabcode', 'termname'], 'safe'],
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
        $query = Term::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'termcode', $this->termcode])
            ->andFilterWhere(['like', 'vocabcode', $this->vocabcode])
            ->andFilterWhere(['like', 'termname', $this->termname]);

        return $dataProvider;
    }
}
