<?php

namespace core\forms\Match;

use Yii;
use core\entities\Match\Match;
use core\entities\Match\MatchQuery;

class MatchForm extends Yii\base\Model
{
    public $name;
    public $icon_class;

    /**
     * @var Match
     */
    protected $_match;

    public function __construct(Match $match = null, $config = [])
    {
        if ($match) {
            $this->name = $match->name;
            $this->icon_class = $match->icon_class;
        } else {

        }

        $this->_match = $match;

        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['name', 'icon_class'], 'required'],
            [['name', 'icon_class'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'icon_class' => Yii::t('app', 'Icon Class'),
        ];
    }

    public static function getDb(): Yii\db\Connection
    {
        return Yii::$app->getDb();
    }

    public static function find(): MatchQuery
    {
        return new MatchQuery(get_called_class());
    }

    public static function tableName(): string
    {
        return 'match';
    }

    public function dataModel(): ?Match
    {
        return $this->_match;
    }
}
