<?php

namespace core\forms\EntomophagePopup;

use Yii;
use core\entities\EntomophagePopup\EntomophagePopup;
use core\entities\EntomophagePopup\EntomophagePopupQuery;
use core\entities\Entomophage\Entomophage;

class EntomophagePopupForm extends Yii\base\Model
{
    public $entomophage_id;
    public $content;
    public $status;

    /**
     * @var EntomophagePopup
     */
    protected $_entomophagePopup;

    public function __construct(EntomophagePopup $entomophagePopup = null, $config = [])
    {
        if ($entomophagePopup) {
            $this->entomophage_id = $entomophagePopup->entomophage_id;
            $this->content = $entomophagePopup->content;
            $this->status = $entomophagePopup->status;
        } else {

        }

        $this->_entomophagePopup = $entomophagePopup;

        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['entomophage_id', 'content'], 'required'],
            [['entomophage_id', 'status'], 'integer'],
            [['content'], 'string'],
            [['entomophage_id'], 'unique', 'filter' => $this->_entomophagePopup ? ['<>', 'id', $this->_entomophagePopup->id] : null, ],
            [['entomophage_id'], 'exist', 'skipOnError' => true, 'targetClass' => Entomophage::className(), 'targetAttribute' => ['entomophage_id' => 'id']],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'entomophage_id' => Yii::t('app', 'Entomophage ID'),
            'content' => Yii::t('app', 'Content'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    public static function getDb(): Yii\db\Connection
    {
        return Yii::$app->getDb();
    }

    public static function find(): EntomophagePopupQuery
    {
        return new EntomophagePopupQuery(get_called_class());
    }

    public static function tableName(): string
    {
        return 'entomophage_popup';
    }

    public function dataModel(): ?EntomophagePopup
    {
        return $this->_entomophagePopup;
    }
}
