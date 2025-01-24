<?php

namespace core\entities\Chemical;

use Yii;
use core\entities\Ingredient\Ingredient;
use core\entities\Ingredient\IngredientQuery;
use core\traits\ModelTrait;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "chemical_ingredient_assignment".
 *
 * @property int $chemical_id
 * @property int $ingredient_id
 *
 * @property Chemical $chemical
 * @property Ingredient $ingredient
 */
class ChemicalIngredientAssignment extends ActiveRecord
{
    use ModelTrait;

    public static function tableName(): string
    {
        return 'chemical_ingredient_assignment';
    }

    public static function create($chemical_id, $ingredient_id): self
    {
        $chemicalIngredientAssignment = new static();
        $chemicalIngredientAssignment->chemical_id = $chemical_id;
        $chemicalIngredientAssignment->ingredient_id = $ingredient_id;
        return $chemicalIngredientAssignment;
    }

    public function edit($chemical_id, $ingredient_id): void
    {
        $this->chemical_id = $chemical_id;
        $this->ingredient_id = $ingredient_id;
    }

    public function attributeLabels(): array
    {
        return [
            'chemical_id' => Yii::t('app', 'Chemical ID'),
            'ingredient_id' => Yii::t('app', 'Ingredient ID'),
        ];
    }

    public function getChemical()
    {
        return $this->hasOne(Chemical::className(), ['id' => 'chemical_id']);
    }

    public function getIngredient()
    {
        return $this->hasOne(Ingredient::className(), ['id' => 'ingredient_id']);
    }

    public static function find(): ChemicalIngredientAssignmentQuery
    {
        return new ChemicalIngredientAssignmentQuery(get_called_class());
    }

    public function isFor($id): bool
    {
        return $this->ingredient_id == $id;
    }
}
