<?php

namespace app\modules\taxonomy\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\taxonomy\models\Vocabulary;

/**
 * VocabularySearch represents the model behind the search form about `app\modules\taxonomy\models\Vocabulary`.
 */
class VocabularySearch extends Vocabulary
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vocabcode', 'vocabname'], 'safe'],
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
        $query = Vocabulary::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'vocabcode', $this->vocabcode])
            ->andFilterWhere(['like', 'vocabname', $this->vocabname]);

        return $dataProvider;
    }
}
