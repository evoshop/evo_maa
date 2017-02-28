<?php
namespace backend\components;

use Yii;

class UserRule extends \yii\rbac\Rule
{
    public function execute($user, $item, $params)
    {
        // TODO: Implement execute() method.
        //由于只针对“update”操作，当操作不是update操作时直接返回true
        //当更新的用户id登录当前的用户id时，可以进行更新
        if(Yii::$app->controller->action->id !== 'update' || Yii::$app->user->id == $params['id']){
            return true;
        }
        else
        {
            return false;
        }
    }


}
?>