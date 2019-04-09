<?php
/**
 * Created by internetsite.com.ua
 * User: Tymofeiev Maksym
 * Date: 14.03.2019
 * Time: 18:09
 */
namespace buben\assets;

use yii\web\AssetBundle;

class BubenAssets extends AssetBundle
{
	public $basePath = '@webroot';
	public $baseUrl = '@web';

	/**
	 * @inheritdoc
	 */
	public $js = [
		'js/main.js',
	];

	/**
	 * @inheritdoc
	 */
	public $css = [
		'css/main.css',
	];

	/**
	 * @inheritdoc
	 */
	public $depends = [
		'buben\components\modularadmin\ModularAdminAssets',
	];
}