<?php

namespace app\modules\work\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\work\models\WorkRating;

/**
 * WorkRatingSearch represents the model behind the search form about `app\modules\work\models\WorkRating`.
 */
class WorkRatingSearch extends WorkRating
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'work_id', 'rating', 'rating_by', 'rating_at'], 'integer'],
            [['rating_comment'], 'safe'],
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
        $query = WorkRating::find();

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
            'work_id' => $this->work_id,
            'rating' => $this->rating,
            'rating_by' => $this->rating_by,
            'rating_at' => $this->rating_at,
        ]);

        $query->andFilterWhere(['like', 'rating_comment', $this->rating_comment]);

        return $dataProvider;
    }
}
