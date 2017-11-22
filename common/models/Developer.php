<?php
namespace common\models;

class Developer
{

    /**
     * This returns developer's portfolio webpage
     */
    public static function links()
    {
        return \Yii::t('yii', 'Designed by {developers}', [
            'developers' => '<a href="http://www.yiiframework.com/" rel="external">' . \Yii::t('yii', 'Yinan') . '</a>'
        ]);
    }
}

