<?php

namespace core\forms\Chemical;

use Yii;
use core\entities\Chemical\Chemical;
use core\entities\Chemical\ChemicalQuery;
use core\forms\Ingredient\ChemicalIngredientForm;
use yii\helpers\ArrayHelper;

/**
 * @property ChemicalIngredientForm $ingredients
 */
class ChemicalForm extends \core\forms\CompositeForm
{
    public $name;
    public $status;

    /**
     * @var Chemical
     */
    protected $_chemical;

    public function __construct(Chemical $chemical = null, $config = [])
    {
        if ($chemical) {
            $this->name = $chemical->name;
            $this->status = $chemical->status;
            $this->ingredients = new ChemicalIngredientForm($chemical);
        } else {
            $this->ingredients = new ChemicalIngredientForm();
        }

        $this->_chemical = $chemical;

        parent::__construct($config);
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

    public static function getDb(): Yii\db\Connection
    {
        return Yii::$app->getDb();
    }

    public static function find(): ChemicalQuery
    {
        return new ChemicalQuery(get_called_class());
    }

    public static function tableName(): string
    {
        return 'chemical';
    }

    public function dataModel(): ?Chemical
    {
        return $this->_chemical;
    }

    public function internalForms(): array
    {
        return ['ingredients'];
    }
}
