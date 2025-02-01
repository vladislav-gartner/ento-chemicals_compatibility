<?php

namespace core\forms\Compare;

use Yii;
use core\entities\Chemical\Chemical;
use core\entities\Compare\Compare;
use core\entities\Compare\CompareChemicalAssignment;
use core\entities\Compare\CompareChemicalAssignmentQuery;

class CompareChemicalAssignmentForm extends Yii\base\Model
{
    public $compare_id;
    public $chemical_id;

    /**
     * @var CompareChemicalAssignment
     */
    protected $_compareChemicalAssignment;

    public function __construct(CompareChemicalAssignment $compareChemicalAssignment = null, $config = [])
    {
        if ($compareChemicalAssignment) {
            $this->compare_id = $compareChemicalAssignment->compare_id;
            $this->chemical_id = $compareChemicalAssignment->chemical_id;
        } else {

        }

        $this->_compareChemicalAssignment = $compareChemicalAssignment;

        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['compare_id', 'chemical_id'], 'required'],
            [['compare_id', 'chemical_id'], 'integer'],
            [['compare_id', 'chemical_id'], 'unique', 'targetAttribute' => ['compare_id', 'chemical_id'], 'filter' => $this->_compareChemicalAssignment ? ['<>', 'id', $this->_compareChemicalAssignment->id] : null, ],
            [['compare_id'], 'exist', 'skipOnError' => true, 'targetClass' => Compare::className(), 'targetAttribute' => ['compare_id' => 'id']],
            [['chemical_id'], 'exist', 'skipOnError' => true, 'targetClass' => Chemical::className(), 'targetAttribute' => ['chemical_id' => 'id']],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'compare_id' => Yii::t('app', 'Compare ID'),
            'chemical_id' => Yii::t('app', 'Chemical ID'),
        ];
    }

    public static function getDb(): Yii\db\Connection
    {
        return Yii::$app->getDb();
    }

    public static function find(): CompareChemicalAssignmentQuery
    {
        return new CompareChemicalAssignmentQuery(get_called_class());
    }

    public static function tableName(): string
    {
        return 'compare_chemical_assignment';
    }

    public function dataModel(): ?CompareChemicalAssignment
    {
        return $this->_compareChemicalAssignment;
    }
}
