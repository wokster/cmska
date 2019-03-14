<?php

namespace buben\components\ace;

use yii\web\AssetBundle;

/**
 * Class AceEditorAsset
 * @package trntv\aceeditor
 * @author Eugene Terentev <eugene@terentev.net>
 */
class AceEditorAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@buben/components/ace/assets';

    /**
     * @inheritdoc
     */
    public $js = [
        'ace.js',
        'ext-language_tools.js'
    ];

} 