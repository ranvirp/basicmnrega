<?php

namespace app\modules\documents\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\documents\models\DocumentType;

/**
 * DocumentTypeSearch represents the model behind the search form about `app\modules\documents\models\DocumentType`.
 */
class DocumentTypeSearch extends DocumentType
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shortcode', 'name_hi', 'name_en', 'description'], 'safe'],
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
        $query = DocumentType::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'shortcode', $this->shortcode])
            ->andFilterWhere(['like', 'name_hi', $this->name_hi])
            ->andFilterWhere(['like', 'name_en', $this->name_en])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
