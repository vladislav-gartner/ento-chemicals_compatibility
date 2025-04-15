<?php

namespace core\forms\ChemicalPopup;

use Yii;
use core\entities\ChemicalPopup\ChemicalPopup;
use core\entities\ChemicalPopup\ChemicalPopupQuery;
use core\entities\Chemical\Chemical;

class ChemicalPopupForm extends Yii\base\Model
{
    public $chemical_id;
    public $content;
    public $status;

    /**
     * @var ChemicalPopup
     */
    protected $_chemicalPopup;

    public function __construct(ChemicalPopup $chemicalPopup = null, $config = [])
    {
        if ($chemicalPopup) {
            $this->chemical_id = $chemicalPopup->chemical_id;
            $this->content = $chemicalPopup->content;
            $this->status = $chemicalPopup->status;
        } else {

        }

        $this->_chemicalPopup = $chemicalPopup;

        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['chemical_id', 'content'], 'required'],
            [['chemical_id', 'status'], 'integer'],
            [['content'], 'string'],
            [['chemical_id'], 'unique', 'filter' => $this->_chemicalPopup ? ['<>', 'id', $this->_chemicalPopup->id] : null, ],
            [['chemical_id'], 'exist', 'skipOnError' => true, 'targetClass' => Chemical::className(), 'targetAttribute' => ['chemical_id' => 'id']],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'chemical_id' => Yii::t('app', 'Chemical ID'),
            'content' => Yii::t('app', 'Content'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    public static function getDb(): Yii\db\Connection
    {
        return Yii::$app->getDb();
    }

    public static function find(): ChemicalPopupQuery
    {
        return new ChemicalPopupQuery(get_called_class());
    }

    public static function tableName(): string
    {
        return 'chemical_popup';
    }

    public function dataModel(): ?ChemicalPopup
    {
        return $this->_chemicalPopup;
    }
}
