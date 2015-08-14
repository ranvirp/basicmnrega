<?php

namespace app\modules\work\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\work\models\PondAttributes;

/**
 * PondAttributesSearch represents the model behind the search form about `app\modules\work\models\PondAttributes`.
 */
class PondAttributesSearch extends PondAttributes
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['workid', 'gatanumber', 'estpersondays'], 'safe'],
            [['totalarea'], 'number'],
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
        $query = PondAttributes::find();

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
            'totalarea' => $this->totalarea,
        ]);

        $query->andFilterWhere(['like', 'workid', $this->workid])
            ->andFilterWhere(['like', 'gatanumber', $this->gatanumber])
            ->andFilterWhere(['like', 'estpersondays', $this->estpersondays]);

        return $dataProvider;
    }
}
