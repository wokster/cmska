<?php
/**
 * Created by internetsite.com.ua
 * User: Tymofeiev Maksym
 * Date: 14.03.2019
 * Time: 18:09
 */

namespace buben\components\modularadmin;


use yii\web\AssetBundle;

class ModularAdminAssets extends AssetBundle
{
	/**
	 * @inheritdoc
	 */
	public $sourcePath = '@buben/components/modularadmin/assets';

	/**
	 * @inheritdoc
	 */
	public $js = [
		'js/vendor.js',
		'js/app.js'
	];

	/**
	 * @inheritdoc
	 */
	public $css = [
		'css/vendor.css',
		'css/app.css',
	];
}