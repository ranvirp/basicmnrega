<?php

namespace app\modules\documents\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\documents\models\Document;

/**
 * DocumentSearch represents the model behind the search form about `app\modules\documents\models\Document`.
 */
class DocumentSearch extends Document
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'author', 'status', 'create_time', 'update_time'], 'integer'],
            [['name_hi', 'document_type', 'document_subtype', 'description', 'shorttext', 'fulltext', 'attachments', 'gallery'], 'safe'],
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
        $query = Document::find();

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
            'author' => $this->author,
            'status' => $this->status,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
        ]);

        $query->andFilterWhere(['like', 'name_hi', $this->name_hi])
            ->andFilterWhere(['like', 'document_type', $this->document_type])
            ->andFilterWhere(['like', 'document_subtype', $this->document_subtype])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'shorttext', $this->shorttext])
            ->andFilterWhere(['like', 'fulltext', $this->fulltext])
            ->andFilterWhere(['like', 'attachments', $this->attachments])
            ->andFilterWhere(['like', 'gallery', $this->gallery]);

        return $dataProvider;
    }
}
