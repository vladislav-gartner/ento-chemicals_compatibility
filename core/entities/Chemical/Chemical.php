<?php

namespace core\entities\Chemical;

use Yii;
use core\entities\Ingredient\Ingredient;
use core\entities\Ingredient\IngredientQuery;
use core\traits\ModelTrait;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "chemical".
 *
 * @property int $id
 * @property string $name
 * @property int $status
 *
 * @property ChemicalIngredientAssignment[] $chemicalIngredientAssignments
 * @property Ingredient[] $ingredients
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

    public function getChemicalIngredientAssignments()
    {
        return $this->hasMany(ChemicalIngredientAssignment::className(), ['chemical_id' => 'id']);
    }

    public function getIngredients()
    {
        return $this->hasMany(Ingredient::className(), ['id' => 'ingredient_id'])->viaTable('chemical_ingredient_assignment', ['chemical_id' => 'id']);
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
