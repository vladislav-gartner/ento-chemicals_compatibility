<?php

namespace core\entities\Chemical;

use Yii;
use core\traits\ModelTrait;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "chemical".
 *
 * @property int $id
 * @property string $name
 * @property int $status
 */
class Chemical extends ActiveRecord
{
    use ModelTrait;

    public static function tableName(): string
    {
        return 'chemical';
    }

    public static function create($name, $status): self
    {
        $chemical = new static();
        $chemical->name = $name;
        $chemical->status = $status;
        return $chemical;
    }

    public function edit($name, $status): void
    {
        $this->name = $name;
        $this->status = $status;
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

    public static function find(): ChemicalQuery
    {
        return new ChemicalQuery(get_called_class());
    }
}
