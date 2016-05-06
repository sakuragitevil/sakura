<?php
namespace backend\models;

use common\models\User;
use yii\base\Model;
use Yii;

/**
 * User form
 */
class UserForm extends Model
{

    /**
     * @inheritdoc
     */
    public function rules()
    {

    }

    /**
     * Update user avatar.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function updateAvatar($avatar)
    {

        $user = User::findIdentity(Yii::$app->user->id);
        $user->setAvatar($avatar);

        return $user->save() ? $user : null;
    }
}
