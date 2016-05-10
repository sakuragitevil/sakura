<?php
namespace backend\models;

use backend\helpers\Common;
use common\models\User;
use yii\base\Model;
use Yii;

/**
 * User form
 */
class FilehandlerForm extends Model
{

    /**
     * @inheritdoc
     */
    public function rules()
    {

    }

    /**
     * Set user avatar
     *
     * @return $avatarUrl String
     */
    public function setUserAvatar($data)
    {
        $avatarUrl = "";

        if ($data['avatarMode'] == 1) {//set your avatar with image which you crop from image are uploaded

            if (array_key_exists('cropData', $data)
                && array_key_exists('imgData', $data)
                && array_key_exists('cropBoxData', $data)
            ) {
                $cropBoxData = $data['cropBoxData'];
                $cropData = $data['cropData'];
                $imgData = $data['imgData'];

                $nimg = imagecreatetruecolor($cropBoxData['width'], $cropBoxData['height']);
                $im_src = imagecreatefromjpeg(Common::getAvatarTempPath($imgData['fileName']));
                if ($cropData['rotate'] != 0) {
                    $im_src = imagerotate($im_src, $cropData['rotate'] * -1, 0);
                }

                imagecopyresampled($nimg, $im_src, 0, 0, $cropData['x'], $cropData['y'], $imgData['width'], $imgData['height'], $imgData['naturalWidth'], $imgData['naturalHeight']);
                imagejpeg($nimg, Common::getAvatarPath($imgData['fileName']), 90);
                imagejpeg($nimg, Common::getAvatarWebPath($imgData['fileName']), 90);

                $avatarUrl = Common::getAvatarUrl($imgData['fileName']);
                unlink(Common::getAvatarTempPath($imgData['fileName']));
                if (array_key_exists('oldFileName', $imgData) && $imgData['oldFileName'] != 'default.png') {
                    unlink(Common::getAvatarWebPath($imgData['oldFileName']));
                }

                $user = new UserForm();
                $user->updateAvatar($imgData['fileName']);
            }
        } elseif ($_POST['avatarMode'] == 2) {//set your avatar with image which you choose from your image
            if (file_exists(Common::getAvatarWebPath($data['oldFileName'])))
                unlink(Common::getAvatarWebPath($data['oldFileName']));
            if (file_exists(Common::getAvatarPath($data['fileName'])))
                copy(Common::getAvatarPath($data['fileName']), Common::getAvatarWebPath($data['fileName']));

            $avatarUrl = Common::getAvatarUrl($data['fileName']);

            $user = new UserForm();
            $user->updateAvatar($data['fileName']);
        }

        return $avatarUrl;

    }
}
