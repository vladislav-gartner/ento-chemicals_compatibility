<?php

namespace core\entities\Match;

use Yii;
use core\traits\ModelTrait;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "match".
 *
 * @property int $id
 * @property string $name
 * @property string $icon_class
 */
class Match extends ActiveRecord
{
    use ModelTrait;

    public static function tableName(): string
    {
        return 'match';
    }

    public static function create($name, $icon_class): self
    {
        $match = new static();
        $match->name = $name;
        $match->icon_class = $icon_class;
        return $match;
    }

    public function edit($name, $icon_class): void
    {
        $this->name = $name;
        $this->icon_class = $icon_class;
    }

    public function rules(): array
    {
        return [
            [['name', 'icon_class'], 'required'],
            [['name', 'icon_class'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'icon_class' => Yii::t('app', 'Icon Class'),
        ];
    }

    public static function find(): MatchQuery
    {
        return new MatchQuery(get_called_class());
    }
}
