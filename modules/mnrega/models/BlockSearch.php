<?php

namespace app\modules\mnrega\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\mnrega\models\Block;

/**
 * BlockSearch represents the model behind the search form about `app\modules\mnrega\models\Block`.
 */
class BlockSearch extends Block
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['block_code', 'block_name', 'district_code'], 'safe'],
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
        $query = Block::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'block_code', $this->block_code])
            ->andFilterWhere(['like', 'block_name', $this->block_name])
            ->andFilterWhere(['like', 'district_code', $this->district_code]);

        return $dataProvider;
    }
}
