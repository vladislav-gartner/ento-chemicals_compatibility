<?php

namespace core\entities\User;

use Yii;
use core\entities\Auth\AuthItem;
use core\entities\Auth\AuthItemQuery;
use core\entities\Compare\Compare;
use core\entities\Compare\CompareQuery;
use core\traits\ModelTrait;
use core\traits\UserTrait;
use yii\base\Exception;
use yii\db\ActiveRecord;
use yiidreamteam\upload\ImageUploadBehavior;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string|null $username
 * @property string|null $fio
 * @property string|null $company
 * @property string|null $image
 * @property string $auth_key
 * @property string|null $password_hash
 * @property string|null $password_reset_token
 * @property string|null $email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property string|null $email_confirm_token
 * @property int $is_banned
 * @property int $activity_at
 *
 * @property AuthAssignment[] $authAssignments
 * @property AuthItem[] $itemNames
 * @property Compare[] $compares
 * @property UserNetwork[] $userNetworks
 * @property UserToken[] $userTokens
 *
 * @mixin ImageUploadBehavior
 */
class User extends ActiveRecord
{
    use ModelTrait;
    use UserTrait;

    const STATUS_BANNED = -10;
    const STATUS_WAIT = 0;
    const STATUS_ACTIVE = 10;
    const BANNED_YES = 1;
    const BANNED_NO = 0;

    public function behaviors(): array
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    yii\db\ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
            'image-upload-behavior' => [
                'class' => '\yiidreamteam\upload\ImageUploadBehavior',
                'attribute' => 'image',
                'thumbs' => [
                    'default' => ['width' => 240, 'height' => 120],
                ],
                'filePath' => '@upload/user/[[pk]].[[extension]]',
                'fileUrl' => '/upload/user/[[pk]].[[extension]]',
                'thumbPath' => '@upload/user/[[profile]]_[[pk]].[[extension]]',
                'thumbUrl' => '/upload/user/[[profile]]_[[pk]].[[extension]]',
                'createThumbsOnRequest' => true,
            ],
        ];
    }

    public static function tableName(): string
    {
        return 'user';
    }

    /**
     * @throws Exception
     */
    public static function create($username, $fio, $company, $image, $email, $is_banned, $password = null): self
    {
        $username = $username ? $username : null;
        $fio = $fio ? $fio : null;
        $company = $company ? $company : null;
        $image = $image ? $image : null;
        $email = $email ? $email : null;

        $user = new static();
        $user->username = $username;
        $user->fio = $fio;
        $user->company = $company;
        $user->image = $image;
        $user->email = $email;
        $user->is_banned = $is_banned;

        $user->setPassword(!empty($password) ? $password : Yii::$app->security->generateRandomString());
        $user->status = self::STATUS_ACTIVE;
        $user->created_at = time();
        $user->generateAuthKey();
        return $user;
    }

    public function edit($username, $fio, $company, $image, $email, $is_banned): void
    {
        $username = $username ? $username : null;
        $fio = $fio ? $fio : null;
        $company = $company ? $company : null;
        $image = $image ? $image : null;
        $email = $email ? $email : null;

        $this->username = $username;
        $this->fio = $fio;
        $this->company = $company;
        $this->image = $image;
        $this->email = $email;
        $this->is_banned = $is_banned;
    }

    public function rules(): array
    {
        return [
            [['status', 'created_at', 'updated_at', 'is_banned', 'activity_at'], 'integer'],
            [['username', 'fio', 'company', 'password_hash', 'password_reset_token', 'email', 'email_confirm_token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['email'], 'unique'],
            [['username'], 'unique'],
            [['password_reset_token'], 'unique'],
            ['image', 'file', 'extensions' => 'jpg, jpeg, png'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'fio' => Yii::t('app', 'Fio'),
            'company' => Yii::t('app', 'Company'),
            'image' => Yii::t('app', 'Image'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'email' => Yii::t('app', 'Email'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'email_confirm_token' => Yii::t('app', 'Email Confirm Token'),
            'is_banned' => Yii::t('app', 'Is Banned'),
            'activity_at' => Yii::t('app', 'Activity At'),
            'role' => Yii::t('app', 'Role'),
        ];
    }

    public function getAuthAssignments()
    {
        return $this->hasMany(AuthAssignment::className(), ['user_id' => 'id']);
    }

    public function getItemNames()
    {
        return $this->hasMany(AuthItem::className(), ['name' => 'item_name'])->viaTable('auth_assignment', ['user_id' => 'id']);
    }

    public function getCompares()
    {
        return $this->hasMany(Compare::className(), ['user_id' => 'id']);
    }

    public function getUserNetworks()
    {
        return $this->hasMany(UserNetwork::className(), ['user_id' => 'id']);
    }

    public function getUserTokens()
    {
        return $this->hasMany(UserToken::className(), ['user_id' => 'id']);
    }

    public function isBanned(): bool
    {
        return $this->is_banned == 1;
    }

    public static function find(): UserQuery
    {
        return new UserQuery(get_called_class());
    }
}
