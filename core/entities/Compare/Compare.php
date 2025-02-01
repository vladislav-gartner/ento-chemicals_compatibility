<?php

namespace core\entities\Compare;

use Yii;
use core\entities\Chemical\Chemical;
use core\entities\Chemical\ChemicalQuery;
use core\entities\Entomophage\Entomophage;
use core\entities\Entomophage\EntomophageQuery;
use core\entities\User\User;
use core\entities\User\UserQuery;
use core\traits\ModelTrait;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "compare".
 *
 * @property int $id
 * @property int $user_id
 * @property int $created_at
 *
 * @property User $user
 * @property CompareChemicalAssignment[] $compareChemicalAssignments
 * @property Chemical[] $chemicals
 * @property CompareEntomophageAssignment[] $compareEntomophageAssignments
 * @property Entomophage[] $entomophages
 */
class Compare extends ActiveRecord
{
    use ModelTrait;

    public function behaviors(): array
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
            ],
            'blameable' => [
                'class' => 'yii\behaviors\BlameableBehavior',
                'createdByAttribute' => 'user_id',
                'updatedByAttribute' => false,
            ],
            'save-relations-behavior' => [
                'class' => 'lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior',
                'relations' => ['compareChemicalAssignments', 'compareEntomophageAssignments'],
            ],
        ];
    }

    public static function tableName(): string
    {
        return 'compare';
    }

    public static function create($user_id, $created_at): self
    {
        $compare = new static();
        $compare->user_id = $user_id;
        $compare->created_at = $created_at;
        return $compare;
    }

    public function edit($user_id, $created_at): void
    {
        $this->user_id = $user_id;
        $this->created_at = $created_at;
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

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getCompareChemicalAssignments()
    {
        return $this->hasMany(CompareChemicalAssignment::className(), ['compare_id' => 'id']);
    }

    public function getChemicals()
    {
        return $this->hasMany(Chemical::className(), ['id' => 'chemical_id'])->viaTable('compare_chemical_assignment', ['compare_id' => 'id']);
    }

    public function getCompareEntomophageAssignments()
    {
        return $this->hasMany(CompareEntomophageAssignment::className(), ['compare_id' => 'id']);
    }

    public function getEntomophages()
    {
        return $this->hasMany(Entomophage::className(), ['id' => 'entomophage_id'])->viaTable('compare_entomophage_assignment', ['compare_id' => 'id']);
    }

    public static function find(): CompareQuery
    {
        return new CompareQuery(get_called_class());
    }

    public function unBlameable($ownerOverwrite = false)
    {
        if ($ownerOverwrite) {
            $this->detachBehavior('blameable');
        }
    }

    public function assignChemical($id)
    {
        $assignments = $this->compareChemicalAssignments;
        foreach ($assignments as $assignment) {
            if ($assignment->isFor($id)) {
                return;
            }
        }
        $assignments[] = CompareChemicalAssignment::create(null, $id);
        $this->compareChemicalAssignments = $assignments;
    }

    public function revokeChemicals()
    {
        $this->compareChemicalAssignments = [];
    }

    public function assignEntomophage($id)
    {
        $assignments = $this->compareEntomophageAssignments;
        foreach ($assignments as $assignment) {
            if ($assignment->isFor($id)) {
                return;
            }
        }
        $assignments[] = CompareEntomophageAssignment::create(null, $id);
        $this->compareEntomophageAssignments = $assignments;
    }

    public function revokeEntomophages()
    {
        $this->compareEntomophageAssignments = [];
    }
}
