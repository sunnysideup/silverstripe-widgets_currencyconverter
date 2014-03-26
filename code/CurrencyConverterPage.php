<?php

class CurrencyConverterPage extends Page {

	private static $icon = "widgets_currencyconverter/images/treeicons/CurrencyConverterPage";

	private static $db = array(
		"IntroText" => "Varchar(250)"
	);

	private static $has_one = array(
		"MainContent" => "WidgetArea"
	);

	public function canCreate($member = null) {
		return SiteTree::get()->filter(array("ClassName" => "CurrencyConverterPage"))->count() ? false : true;
	}

	function getCMSFields() {
		$fields = parent::getCMSFields();
		$fields->addFieldToTab("Root.Disclaimer", new TextField("IntroText", "Intro Text (can put disclaimer here)"));
		return $fields;
	}


}

class CurrencyConverterPage_Controller extends Page_Controller {
	function init() {
		parent::init();
		Requirements::javascript(THIRDPARTY_DIR."/jquery/jquery.js");
		Requirements::javascript("widgets_currencyconverter/javascript/CurrencyConverter.js");
		Requirements::css("widgets_currencyconverter/css/CurrencyConverter.css");
	}
	function index() {
		if(Director::is_ajax() || isset($_GET["ajax"])) {
			return $this->renderWith("CurrencyConverterAjax");
		}
	}
	function CurrencyConverterWidget() {
		$widget = new CurrencyConverterWidget();
		return $widget->renderWith("WidgetHolderMysite");
	}
}

