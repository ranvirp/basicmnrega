<?php

namespace app\modules\correspondence\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\mnrega\models\RequestType;

/**
 * RequestTypeSearch represents the model behind the search form about `app\modules\mnrega\models\RequestType`.
 */
class RequestTypeSearch extends RequestType
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category'], 'integer'],
            [['name'], 'safe'],
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
        $query = RequestType::find();

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
            'category' => $this->category,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
