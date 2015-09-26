<?php

namespace app\modules\correspondece\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * RequestSearch represents the model behind the search form about `app\modules\mnrega\models\Request`.
 */
class RequestSearch extends Request
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'request_type_id', 'author_id', 'create_time', 'update_time'], 'integer'],
            [['request_subject', 'content', 'attachments'], 'safe'],
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
        $query = Request::find();

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
            'request_type_id' => $this->request_type_id,
            'author_id' => $this->author_id,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
        ]);

        $query->andFilterWhere(['like', 'request_subject', $this->request_subject])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'attachments', $this->attachments]);

        return $dataProvider;
    }
}
