<?php

namespace core\entities\Chemical;

use Yii;
use core\entities\Compare\Compare;
use core\entities\Compare\CompareChemicalAssignment;
use core\entities\Compare\CompareChemicalAssignmentQuery;
use core\entities\Compare\CompareQuery;
use core\entities\Ingredient\Ingredient;
use core\entities\Ingredient\IngredientQuery;
use core\entities\Match\ChemicalEntomophageMatch;
use core\entities\Match\ChemicalEntomophageMatchQuery;
use core\traits\ModelTrait;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "chemical".
 *
 * @property int $id
 * @property string $name
 * @property int $status
 *
 * @property ChemicalEntomophageMatch[] $chemicalEntomophageMatches
 * @property ChemicalIngredientAssignment[] $chemicalIngredientAssignments
 * @property Ingredient[] $ingredients
 * @property CompareChemicalAssignment[] $compareChemicalAssignments
 * @property Compare[] $compares
 */
class Chemical extends ActiveRecord
{
    use ModelTrait;

    public function behaviors(): array
    {
        return [
            'save-relations-behavior' => [
                'class' => 'lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior',
                'relations' => ['chemicalIngredientAssignments'],
            ],
        ];
    }

    public static function tableName(): string
    {
        return 'chemical';
    }

    public static function create($name, $status): self
    {
        $chemical = new static();
        $chemical->name = $name;
        $chemical->status = $status;
        return $chemical;
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

    public function getChemicalEntomophageMatches()
    {
        return $this->hasMany(ChemicalEntomophageMatch::className(), ['chemical_id' => 'id']);
    }

    public function getChemicalIngredientAssignments()
    {
        return $this->hasMany(ChemicalIngredientAssignment::className(), ['chemical_id' => 'id']);
    }

    public function getIngredients()
    {
        return $this->hasMany(Ingredient::className(), ['id' => 'ingredient_id'])->viaTable('chemical_ingredient_assignment', ['chemical_id' => 'id']);
    }

    public function getCompareChemicalAssignments()
    {
        return $this->hasMany(CompareChemicalAssignment::className(), ['chemical_id' => 'id']);
    }

    public function getCompares()
    {
        return $this->hasMany(Compare::className(), ['id' => 'compare_id'])->viaTable('compare_chemical_assignment', ['chemical_id' => 'id']);
    }

    public static function find(): ChemicalQuery
    {
        return new ChemicalQuery(get_called_class());
    }

    public function assignIngredient($id)
    {
        $assignments = $this->chemicalIngredientAssignments;
        foreach ($assignments as $assignment) {
            if ($assignment->isFor($id)) {
                return;
            }
        }
        $assignments[] = ChemicalIngredientAssignment::create(null, $id);
        $this->chemicalIngredientAssignments = $assignments;
    }

    public function revokeIngredients()
    {
        $this->chemicalIngredientAssignments = [];
    }
}
