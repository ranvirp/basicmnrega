<?php

namespace app\modules\complaint\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\complaint\models\Complaint_marking;

/**
 * Complaint_markingSearch represents the model behind the search form about `app\modules\complaint\models\Complaint_marking`.
 */
class Complaint_markingSearch extends Complaint_marking
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'complaint_id', 'sender', 'receiver', 'status', 'create_time', 'update_time', 'read_time'], 'integer'],
            [['dateofmarking', 'deadline'], 'safe'],
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
        $query = Complaint_marking::find();

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
            'complaint_id' => $this->complaint_id,
            'sender' => $this->sender,
            'receiver' => $this->receiver,
            'dateofmarking' => $this->dateofmarking,
            'deadline' => $this->deadline,
            'status' => $this->status,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
            'read_time' => $this->read_time,
        ]);

        return $dataProvider;
    }
}
