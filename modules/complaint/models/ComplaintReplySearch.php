<?php

namespace app\modules\complaint\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\complaint\models\ComplaintReply;

/**
 * ComplaintReplySearch represents the model behind the search form about `app\modules\complaint\models\ComplaintReply`.
 */
class ComplaintReplySearch extends ComplaintReply
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'marking_id', 'reply_type', 'complaint_id','created_at', 'updated_at', 'author', 'accepted', 'complaint_id'], 'integer'],
            [['reply', 'attachments'], 'safe'],
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
        $query = ComplaintReply::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            print_r($this->errors);
            exit;
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'marking_id' => $this->marking_id,
            'reply_type' => $this->reply_type,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'author' => $this->author,
            'accepted' => $this->accepted,
            'complaint_id' => $this->complaint_id,
        ]);

        $query->andFilterWhere(['like', 'reply', $this->reply])
            ->andFilterWhere(['like', 'attachments', $this->attachments]);

        return $dataProvider;
    }
}
