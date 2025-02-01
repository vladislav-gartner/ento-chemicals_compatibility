<?php

namespace core\forms\Compare;

use Yii;
use core\entities\Compare\Compare;
use core\entities\Compare\CompareQuery;
use core\entities\User\User;
use core\forms\Chemical\CompareChemicalForm;
use core\forms\Entomophage\CompareEntomophageForm;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

/**
 * @property CompareChemicalForm $chemicals
 * @property CompareEntomophageForm $entomophages
 */
class CompareForm extends \core\forms\CompositeForm
{
    public $user_id;
    public $created_at;

    /**
     * @var Compare
     */
    protected $_compare;

    public function __construct(Compare $compare = null, $config = [])
    {
        if ($compare) {
            $this->user_id = $compare->user_id;
            $this->created_at = $compare->created_at;
            $this->chemicals = new CompareChemicalForm($compare);
            $this->entomophages = new CompareEntomophageForm($compare);
        } else {
            $this->chemicals = new CompareChemicalForm();
            $this->entomophages = new CompareEntomophageForm();
        }

        $this->_compare = $compare;

        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['user_id', ], 'required'],
            [['user_id', 'created_at'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    public function beforeValidate(): bool
    {
        if (parent::beforeValidate()) {

            if ($user = $this->currentUser()) {
                $this->user_id = $user->id;
            }
            return true;
        }
        return false;
    }

    public static function getDb(): Yii\db\Connection
    {
        return Yii::$app->getDb();
    }

    public static function find(): CompareQuery
    {
        return new CompareQuery(get_called_class());
    }

    public static function tableName(): string
    {
        return 'compare';
    }

    public function dataModel(): ?Compare
    {
        return $this->_compare;
    }

    public function internalForms(): array
    {
        return ['chemicals', 'entomophages'];
    }
}
