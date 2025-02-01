<?php

namespace core\forms\Compare;

use Yii;
use core\entities\Compare\Compare;
use core\entities\Compare\CompareEntomophageAssignment;
use core\entities\Compare\CompareEntomophageAssignmentQuery;
use core\entities\Entomophage\Entomophage;

class CompareEntomophageAssignmentForm extends Yii\base\Model
{
    public $compare_id;
    public $entomophage_id;

    /**
     * @var CompareEntomophageAssignment
     */
    protected $_compareEntomophageAssignment;

    public function __construct(CompareEntomophageAssignment $compareEntomophageAssignment = null, $config = [])
    {
        if ($compareEntomophageAssignment) {
            $this->compare_id = $compareEntomophageAssignment->compare_id;
            $this->entomophage_id = $compareEntomophageAssignment->entomophage_id;
        } else {

        }

        $this->_compareEntomophageAssignment = $compareEntomophageAssignment;

        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['compare_id', 'entomophage_id'], 'required'],
            [['compare_id', 'entomophage_id'], 'integer'],
            [['compare_id', 'entomophage_id'], 'unique', 'targetAttribute' => ['compare_id', 'entomophage_id'], 'filter' => $this->_compareEntomophageAssignment ? ['<>', 'id', $this->_compareEntomophageAssignment->id] : null, ],
            [['compare_id'], 'exist', 'skipOnError' => true, 'targetClass' => Compare::className(), 'targetAttribute' => ['compare_id' => 'id']],
            [['entomophage_id'], 'exist', 'skipOnError' => true, 'targetClass' => Entomophage::className(), 'targetAttribute' => ['entomophage_id' => 'id']],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'compare_id' => Yii::t('app', 'Compare ID'),
            'entomophage_id' => Yii::t('app', 'Entomophage ID'),
        ];
    }

    public static function getDb(): Yii\db\Connection
    {
        return Yii::$app->getDb();
    }

    public static function find(): CompareEntomophageAssignmentQuery
    {
        return new CompareEntomophageAssignmentQuery(get_called_class());
    }

    public static function tableName(): string
    {
        return 'compare_entomophage_assignment';
    }

    public function dataModel(): ?CompareEntomophageAssignment
    {
        return $this->_compareEntomophageAssignment;
    }
}
