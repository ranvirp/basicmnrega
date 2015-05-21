<?php

namespace app\modules\mnrega\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\mnrega\models\Marking;

/**
 * MarkingSearch represents the model behind the search form about `app\modules\mnrega\models\Marking`.
 */
class MarkingSearch extends Marking
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'request_id', 'sender', 'receiver', 'create_time', 'update_time', 'read_time'], 'integer'],
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
        $query = Marking::find();

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
            'request_id' => $this->request_id,
            'sender' => $this->sender,
            'receiver' => $this->receiver,
            'dateofmarking' => $this->dateofmarking,
            'deadline' => $this->deadline,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
            'read_time' => $this->read_time,
        ]);

        return $dataProvider;
    }
}
