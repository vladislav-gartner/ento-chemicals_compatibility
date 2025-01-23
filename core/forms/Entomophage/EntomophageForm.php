<?php

namespace core\forms\Entomophage;

use Yii;
use core\entities\Entomophage\Entomophage;
use core\entities\Entomophage\EntomophageQuery;

class EntomophageForm extends Yii\base\Model
{
    public $name;
    public $status;

    /**
     * @var Entomophage
     */
    protected $_entomophage;

    public function __construct(Entomophage $entomophage = null, $config = [])
    {
        if ($entomophage) {
            $this->name = $entomophage->name;
            $this->status = $entomophage->status;
        } else {

        }

        $this->_entomophage = $entomophage;

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

    public static function find(): EntomophageQuery
    {
        return new EntomophageQuery(get_called_class());
    }

    public static function tableName(): string
    {
        return 'entomophage';
    }

    public function dataModel(): ?Entomophage
    {
        return $this->_entomophage;
    }
}
