<?php

namespace core\forms\Chemical;

use Yii;
use core\entities\Chemical\Chemical;
use core\entities\Chemical\ChemicalIngredientAssignment;
use core\entities\Chemical\ChemicalIngredientAssignmentQuery;
use core\entities\Ingredient\Ingredient;

class ChemicalIngredientAssignmentForm extends Yii\base\Model
{
    public $chemical_id;
    public $ingredient_id;

    /**
     * @var ChemicalIngredientAssignment
     */
    protected $_chemicalIngredientAssignment;

    public function __construct(ChemicalIngredientAssignment $chemicalIngredientAssignment = null, $config = [])
    {
        if ($chemicalIngredientAssignment) {
            $this->chemical_id = $chemicalIngredientAssignment->chemical_id;
            $this->ingredient_id = $chemicalIngredientAssignment->ingredient_id;
        } else {

        }

        $this->_chemicalIngredientAssignment = $chemicalIngredientAssignment;

        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['chemical_id', 'ingredient_id'], 'required'],
            [['chemical_id', 'ingredient_id'], 'integer'],
            [['chemical_id', 'ingredient_id'], 'unique', 'targetAttribute' => ['chemical_id', 'ingredient_id'], 'filter' => $this->_chemicalIngredientAssignment ? ['<>', 'id', $this->_chemicalIngredientAssignment->id] : null, ],
            [['chemical_id'], 'exist', 'skipOnError' => true, 'targetClass' => Chemical::className(), 'targetAttribute' => ['chemical_id' => 'id']],
            [['ingredient_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ingredient::className(), 'targetAttribute' => ['ingredient_id' => 'id']],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'chemical_id' => Yii::t('app', 'Chemical ID'),
            'ingredient_id' => Yii::t('app', 'Ingredient ID'),
        ];
    }

    public static function getDb(): Yii\db\Connection
    {
        return Yii::$app->getDb();
    }

    public static function find(): ChemicalIngredientAssignmentQuery
    {
        return new ChemicalIngredientAssignmentQuery(get_called_class());
    }

    public static function tableName(): string
    {
        return 'chemical_ingredient_assignment';
    }

    public function dataModel(): ?ChemicalIngredientAssignment
    {
        return $this->_chemicalIngredientAssignment;
    }
}
