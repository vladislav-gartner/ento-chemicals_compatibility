<?php

namespace core\forms\Match;

use Yii;
use core\entities\Chemical\Chemical;
use core\entities\Entomophage\Entomophage;
use core\entities\Match\ChemicalEntomophageMatch;
use core\entities\Match\ChemicalEntomophageMatchQuery;
use core\entities\Match\Match;

class ChemicalEntomophageMatchForm extends Yii\base\Model
{
    public $chemical_id;
    public $entomophage_id;
    public $match_id;

    /**
     * @var ChemicalEntomophageMatch
     */
    protected $_chemicalEntomophageMatch;

    public function __construct(ChemicalEntomophageMatch $chemicalEntomophageMatch = null, $config = [])
    {
        if ($chemicalEntomophageMatch) {
            $this->chemical_id = $chemicalEntomophageMatch->chemical_id;
            $this->entomophage_id = $chemicalEntomophageMatch->entomophage_id;
            $this->match_id = $chemicalEntomophageMatch->match_id;
        } else {

        }

        $this->_chemicalEntomophageMatch = $chemicalEntomophageMatch;

        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['chemical_id', 'entomophage_id', 'match_id'], 'required'],
            [['chemical_id', 'entomophage_id', 'match_id'], 'integer'],
            [['entomophage_id', 'chemical_id', 'match_id'], 'unique', 'targetAttribute' => ['entomophage_id', 'chemical_id', 'match_id'], 'filter' => $this->_chemicalEntomophageMatch ? ['<>', 'id', $this->_chemicalEntomophageMatch->id] : null, ],
            [['chemical_id'], 'exist', 'skipOnError' => true, 'targetClass' => Chemical::className(), 'targetAttribute' => ['chemical_id' => 'id']],
            [['entomophage_id'], 'exist', 'skipOnError' => true, 'targetClass' => Entomophage::className(), 'targetAttribute' => ['entomophage_id' => 'id']],
            [['match_id'], 'exist', 'skipOnError' => true, 'targetClass' => Match::className(), 'targetAttribute' => ['match_id' => 'id']],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'chemical_id' => Yii::t('app', 'Chemical ID'),
            'entomophage_id' => Yii::t('app', 'Entomophage ID'),
            'match_id' => Yii::t('app', 'Match ID'),
        ];
    }

    public static function getDb(): Yii\db\Connection
    {
        return Yii::$app->getDb();
    }

    public static function find(): ChemicalEntomophageMatchQuery
    {
        return new ChemicalEntomophageMatchQuery(get_called_class());
    }

    public static function tableName(): string
    {
        return 'chemical_entomophage_match';
    }

    public function dataModel(): ?ChemicalEntomophageMatch
    {
        return $this->_chemicalEntomophageMatch;
    }
}
