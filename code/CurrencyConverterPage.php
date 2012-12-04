<?php

class CurrencyConverterPage extends Page {

	static $icon = "widgets_currencyconverter/images/treeicons/CurrencyConverterPage";

	static $db = array(
		"IntroText" => "Varchar(250)"
	);

	static $has_one = array(
		"MainContent" => "WidgetArea"
	);

	public function canCreate() {
		$bt = defined('DB::USE_ANSI_SQL') ? "\"" : "`";
		return !DataObject::get_one("SiteTree", "{$bt}ClassName{$bt} = 'CurrencyConverterPage'");
	}

	function getCMSFields() {
		$fields = parent::getCMSFields();
		$fields->addFieldToTab("Root.Content.Disclaimer", new TextField("IntroText", "Intro Text (can put disclaimer here)"));
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

