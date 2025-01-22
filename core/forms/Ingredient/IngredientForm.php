<?php

namespace core\forms\Ingredient;

use Yii;
use core\entities\Ingredient\Ingredient;
use core\entities\Ingredient\IngredientQuery;

class IngredientForm extends Yii\base\Model
{
    public $name;
    public $status;

    /**
     * @var Ingredient
     */
    protected $_ingredient;

    public function __construct(Ingredient $ingredient = null, $config = [])
    {
        if ($ingredient) {
            $this->name = $ingredient->name;
            $this->status = $ingredient->status;
        } else {

        }

        $this->_ingredient = $ingredient;

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

    public static function find(): IngredientQuery
    {
        return new IngredientQuery(get_called_class());
    }

    public static function tableName(): string
    {
        return 'ingredient';
    }

    public function dataModel(): ?Ingredient
    {
        return $this->_ingredient;
    }
}
