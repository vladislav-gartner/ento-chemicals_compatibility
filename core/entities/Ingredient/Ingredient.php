<?php

namespace core\entities\Ingredient;

use Yii;
use core\entities\Chemical\Chemical;
use core\entities\Chemical\ChemicalIngredientAssignment;
use core\entities\Chemical\ChemicalIngredientAssignmentQuery;
use core\entities\Chemical\ChemicalQuery;
use core\traits\ModelTrait;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "ingredient".
 *
 * @property int $id
 * @property string $name
 * @property int $status
 *
 * @property ChemicalIngredientAssignment[] $chemicalIngredientAssignments
 * @property Chemical[] $chemicals
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

    public function getChemicalIngredientAssignments()
    {
        return $this->hasMany(ChemicalIngredientAssignment::className(), ['ingredient_id' => 'id']);
    }

    public function getChemicals()
    {
        return $this->hasMany(Chemical::className(), ['id' => 'chemical_id'])->viaTable('chemical_ingredient_assignment', ['ingredient_id' => 'id']);
    }

    public static function find(): IngredientQuery
    {
        return new IngredientQuery(get_called_class());
    }
}
