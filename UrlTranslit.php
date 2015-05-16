<?php

/**
 * Class UrlTranslit
 */
class UrlTranslit extends CWidget
{

	/**
	 * @var string URL where to look assets.
	 */
	public $assetsUrl;

	/**
	 * @var string script name.
	 */
	public $scriptFile;

	/**
	 * @var string stylesheet.
	 */
	public $cssFile;

	/**
	 * @var string Id button
	 */
	public $btn = 'translit-btn';

	/**
	 * @var string
	 */
	public $from = 'name';

	/**
	 * @var string
	 */
	public $to = 'url';

	/**
	 * @var array extension options.
	 */
	public $options = array();

	/**
	 * Init widget.
	 */
	function init()
	{
		if($this->assetsUrl === null)
			$this->assetsUrl = Yii::app()->getAssetManager()->publish(dirname(__FILE__).'/assets', false, -1, YII_DEBUG);

		if($this->scriptFile === null)
			$this->scriptFile = YII_DEBUG ? 'urlify.js' : 'urlify.min.js';

		if($this->cssFile === null)
			$this->cssFile = 'urlify.css';

		$this->registerClientScript();
	}

	/**
	 * Register CSS and Script.
	 * @return void
	 */
	protected function registerClientScript()
	{
		$cs = Yii::app()->getClientScript();
		if($this->cssFile !== false)
			$cs->registerCssFile($this->assetsUrl.'/'.$this->cssFile);
		$cs->registerCoreScript('jquery');
		$cs->registerScriptFile($this->assetsUrl.'/'.$this->scriptFile);
		$cs->registerScript($this->getId(), "$('#".$this->btn."').click(function() {
			$('#".$this->to."').val(URLify($('#".$this->from."').val()));
		});", CClientScript::POS_READY);
	}

	/**
	 * Run widget.
	 */
	public function run()
	{
	}

}