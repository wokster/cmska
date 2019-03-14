<?php

namespace buben\components\ace;

use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\InputWidget;

/**
 * Class AceEditor
 * @package trntv\aceeditor
 * @author Eugene Terentev <eugene@terentev.net>
 */
class AceEditor extends InputWidget
{   
     /**
     * @var boolean Read-only mode on/off (false=off - default)
     */
    public $readOnly = false;
    
    /**
     * @var string Programming Language Mode
     */
    public $mode = 'html';

    /**
     * @var string Editor theme
     * $see Themes List
     * @link https://github.com/ajaxorg/ace/tree/master/lib/ace/theme
     */
    public $theme = 'github';

    public $editorOptions = [
        'enableBasicAutocompletion' => true,
        'enableSnippets' => true,
        'enableLiveAutocompletion' => true
    ];

    /**
     * @var array Div options
     */
    public $containerOptions = [
        'style' => 'width: 100%; min-height: 400px'
    ];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        AceEditorAsset::register($this->getView());
        $editor_id = $this->getId();
        $editor_var = 'aceeditor_' . $editor_id;
        $view = $this->getView();
        $view->registerJs("var {$editor_var} = ace.edit(\"{$editor_id}\")");
        $view->registerJs("{$editor_var}.setTheme(\"ace/theme/{$this->theme}\")");
        $view->registerJs("{$editor_var}.getSession().setMode(\"ace/mode/{$this->mode}\")");
        $view->registerJs("{$editor_var}.setReadOnly({$this->readOnly})");

        foreach ($this->editorOptions as $k => $one){
            $opt = is_array($one) ? Json::encode($one) : "'$one'";
            $view->registerJs("{$editor_var}.setOption('{$k}',{$opt})");
        }

        $textarea_var = 'acetextarea_' . $editor_id;
        $view->registerJs("
            var {$textarea_var} = $('#{$this->options['id']}').hide();
            {$editor_var}.getSession().setValue({$textarea_var}.val());
            {$editor_var}.getSession().on('change', function(){
                {$textarea_var}.val({$editor_var}.getSession().getValue());
            });
        ");
        Html::addCssStyle($this->options, 'display: none');
        $this->containerOptions['id'] = $editor_id;
        $view->registerCss("#{$editor_id}{position:relative}");
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $content = Html::tag('div', '', $this->containerOptions);
        if ($this->hasModel()) {
            $content .= Html::activeTextarea($this->model, $this->attribute, $this->options);
        } else {
            $content .= Html::textarea($this->name, $this->value, $this->options);
        }
        return $content;
    }
}
