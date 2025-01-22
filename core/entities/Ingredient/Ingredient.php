<?php

namespace core\entities\Ingredient;

use Yii;
use core\traits\ModelTrait;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "ingredient".
 *
 * @property int $id
 * @property string $name
 * @property int $status
 */
class Ingredient extends ActiveRecord
{
    use ModelTrait;

    public static function tableName(): string
    {
        return 'ingredient';
    }

    public static function create($name, $status): self
    {
        $ingredient = new static();
        $ingredient->name = $name;
        $ingredient->status = $status;
        return $ingredient;
    }

    public function edit($name, $status): void
    {
        $this->name = $name;
        $this->status = $status;
    }

    public function rules(): array
    {
        return [
            [['name'], 'required'],
            [['status'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    public static function find(): IngredientQuery
    {
        return new IngredientQuery(get_called_class());
    }
}
