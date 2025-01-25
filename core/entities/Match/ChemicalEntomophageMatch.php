<?php

namespace core\entities\Match;

use Yii;
use core\entities\Chemical\Chemical;
use core\entities\Chemical\ChemicalQuery;
use core\entities\Entomophage\Entomophage;
use core\entities\Entomophage\EntomophageQuery;
use core\traits\ModelTrait;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "chemical_entomophage_match".
 *
 * @property int $id
 * @property int $chemical_id
 * @property int $entomophage_id
 * @property int $match_id
 *
 * @property Chemical $chemical
 * @property Entomophage $entomophage
 * @property Match $match
 */
class ChemicalEntomophageMatch extends ActiveRecord
{
    use ModelTrait;

    public static function tableName(): string
    {
        return 'chemical_entomophage_match';
    }

    public static function create($chemical_id, $entomophage_id, $match_id): self
    {
        $chemicalEntomophageMatch = new static();
        $chemicalEntomophageMatch->chemical_id = $chemical_id;
        $chemicalEntomophageMatch->entomophage_id = $entomophage_id;
        $chemicalEntomophageMatch->match_id = $match_id;
        return $chemicalEntomophageMatch;
    }

    public function edit($chemical_id, $entomophage_id, $match_id): void
    {
        $this->chemical_id = $chemical_id;
        $this->entomophage_id = $entomophage_id;
        $this->match_id = $match_id;
    }

    public function rules(): array
    {
        return [
            [['chemical_id', 'entomophage_id', 'match_id'], 'required'],
            [['chemical_id', 'entomophage_id', 'match_id'], 'integer'],
            [['entomophage_id', 'chemical_id', 'match_id'], 'unique', 'targetAttribute' => ['entomophage_id', 'chemical_id', 'match_id']],
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

    public function getChemical()
    {
        return $this->hasOne(Chemical::className(), ['id' => 'chemical_id']);
    }

    public function getEntomophage()
    {
        return $this->hasOne(Entomophage::className(), ['id' => 'entomophage_id']);
    }

    public function getMatch()
    {
        return $this->hasOne(Match::className(), ['id' => 'match_id']);
    }

    public static function find(): ChemicalEntomophageMatchQuery
    {
        return new ChemicalEntomophageMatchQuery(get_called_class());
    }
}
