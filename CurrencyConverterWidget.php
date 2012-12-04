<?php

/*
				$page->defaultFromCurrencyCode = "NZD";
				$page->Defaultto_currency_code = "EUR";
				$page->DefaultAmount = "100";
*/

class CurrencyConverterWidget extends Widget {

	static $title = 'Currency Converter';

	static $cmsTitle = 'Currency Converter';

	static $description = 'Allows users to convert any amount FROM one TO another currency.';

	static $db = array(
		"DefaultFromCurrency" => "Varchar(3)",
		"DefaultToCurrency" => "Varchar(3)",
		"DefaultAmount" => "Currency"
	);

	static $defaults = array(
		"DefaultFromCurrency" => "NZD",
		"DefaultToCurrency" => "EUR",
		"DefaultAmount" => "1"
	);

	static function set_default_from_currency($v) {
		self::$defaults["DefaultFromCurrency"] = $v;
	}

	static function set_default_to_currency($v) {
		self::$defaults["DefaultToCurrency"] = $v;
	}

	static function set_default_amount($v) {
		self::$defaults["DefaultAmount"] = $v;
	}

	static function add_to_array_of_currencies_to_show($arrayOfCodes) {
		if(is_array($arrayOfCodes)) {
			foreach($arrayOfCodes as $code) {
				if(3 == strlen($code)) {
					self::$array_of_currencies_to_show[] = $code;
				}
			}
		}
		elseif(3 == strlen($arrayOfCodes)) {
			self::$array_of_currencies_to_show[] = $arrayOfCodes;
		}
		else{
			debug::show("add_to_array_of_currencies_to_show is not provided with right argument");
		}
	}

	protected static $array_of_currencies_to_show = array();

	protected static $currency_list = array(
"-0-" => "-- Select Currency --",
"usd"=>"us dollar",
"afn"=>"afghanistan afghani",
"all"=>"albanian lek",
"dzd"=>"algerian dinar",
"adf"=>"andorran franc",
"adp"=>"andorran peseta",
"aoa"=>"angolan kwanza",
"aon"=>"angolan new kwanza",
"ars"=>"argentine peso",
"amd"=>"armenian dram",
"awg"=>"aruban florin",
"aud"=>"australian dollar",
"ats"=>"austrian schilling",
"azm"=>"azerbaijan manat",
"azn"=>"azerbaijan new manat",
"bsd"=>"bahamian dollar",
"bhd"=>"bahraini dinar",
"bdt"=>"bangladeshi taka",
"bbd"=>"barbados dollar",
"byr"=>"belarusian ruble",
"bef"=>"belgian franc",
"bzd"=>"belize dollar",
"bmd"=>"bermudian dollar",
"btn"=>"bhutan ngultrum",
"bob"=>"bolivian boliviano",
"bam"=>"bosnian mark",
"bwp"=>"botswana pula",
"brl"=>"brazilian real",
"gbp"=>"british pound",
"bnd"=>"brunei dollar",
"bgn"=>"bulgarian lev",
"bif"=>"burundi franc",
"xof"=>"cfa franc bceao",
"xaf"=>"cfa franc beac",
"xpf"=>"cfp franc",
"khr"=>"cambodian riel",
"cad"=>"canadian dollar",
"cve"=>"cape verde escudo",
"kyd"=>"cayman islands dollar",
"clp"=>"chilean peso",
"cny"=>"chinese yuan renminbi",
"cop"=>"colombian peso",
"kmf"=>"comoros franc",
"cdf"=>"congolese franc",
"crc"=>"costa rican colon",
"hrk"=>"croatian kuna",
"cuc"=>"cuban convertible peso",
"cup"=>"cuban peso",
"cyp"=>"cyprus pound",
"czk"=>"czech koruna",
"dkk"=>"danish krone",
"djf"=>"djibouti franc",
"dop"=>"dominican r. peso",
"nlg"=>"dutch guilder",
"xeu"=>"ecu",
"xcd"=>"east caribbean dollar",
"ecs"=>"ecuador sucre",
"egp"=>"egyptian pound",
"svc"=>"el salvador colon",
"eek"=>"estonian kroon",
"etb"=>"ethiopian birr",
"eur"=>"European Union euro",
"fkp"=>"falkland islands pound",
"fjd"=>"fiji dollar",
"fim"=>"finnish markka",
"frf"=>"french franc",
"gmd"=>"gambian dalasi",
"gel"=>"georgian lari",
"dem"=>"german mark",
"ghc"=>"ghanaian cedi",
"ghs"=>"ghanaian new cedi",
"gip"=>"gibraltar pound",
"xau"=>"gold (oz.)",
"grd"=>"greek drachma",
"gtq"=>"guatemalan quetzal",
"gnf"=>"guinea franc",
"gyd"=>"guyanese dollar",
"htg"=>"haitian gourde",
"hnl"=>"honduran lempira",
"hkd"=>"hong kong dollar",
"huf"=>"hungarian forint",
"isk"=>"iceland krona",
"inr"=>"indian rupee",
"idr"=>"indonesian rupiah",
"irr"=>"iranian rial",
"iqd"=>"iraqi dinar",
"iep"=>"irish punt",
"ils"=>"israeli new shekel",
"itl"=>"italian lira",
"jmd"=>"jamaican dollar",
"jpy"=>"japanese yen",
"jod"=>"jordanian dinar",
"kzt"=>"kazakhstan tenge",
"kes"=>"kenyan shilling",
"kwd"=>"kuwaiti dinar",
"kgs"=>"kyrgyzstanian som",
"lak"=>"lao kip",
"lvl"=>"latvian lats",
"lbp"=>"lebanese pound",
"lsl"=>"lesotho loti",
"lrd"=>"liberian dollar",
"lyd"=>"libyan dinar",
"ltl"=>"lithuanian litas",
"luf"=>"luxembourg franc",
"mop"=>"macau pataca",
"mkd"=>"macedonian denar",
"mga"=>"malagasy ariary",
"mgf"=>"malagasy franc",
"mwk"=>"malawi kwacha",
"myr"=>"malaysian ringgit",
"mvr"=>"maldive rufiyaa",
"mtl"=>"maltese lira",
"mro"=>"mauritanian ouguiya",
"mur"=>"mauritius rupee",
"mxn"=>"mexican peso",
"mdl"=>"moldovan leu",
"mnt"=>"mongolian tugrik",
"mad"=>"moroccan dirham",
"mzm"=>"mozambique metical",
"mzn"=>"mozambique new metical",
"mmk"=>"myanmar kyat",
"ang"=>"nl antillian guilder",
"nad"=>"namibia dollar",
"npr"=>"nepalese rupee",
"nzd"=>"new zealand dollar",
"nio"=>"nicaraguan cordoba oro",
"ngn"=>"nigerian naira",
"kpw"=>"north korean won",
"nok"=>"norwegian kroner",
"omr"=>"omani rial",
"pkr"=>"pakistan rupee",
"xpd"=>"palladium (oz.)",
"pab"=>"panamanian balboa",
"pgk"=>"papua new guinea kina",
"pyg"=>"paraguay guarani",
"pen"=>"peruvian nuevo sol",
"php"=>"philippine peso",
"xpt"=>"platinum (oz.)",
"pln"=>"polish zloty",
"pte"=>"portuguese escudo",
"qar"=>"qatari rial",
"rol"=>"romanian lei",
"ron"=>"romanian new lei",
"rub"=>"russian rouble",
"rwf"=>"rwandan franc",
"wst"=>"samoan tala",
"std"=>"sao tome/principe dobra",
"sar"=>"saudi riyal",
"rsd"=>"serbian dinar",
"scr"=>"seychelles rupee",
"sll"=>"sierra leone leone",
"xag"=>"silver (oz.)",
"sgd"=>"singapore dollar",
"skk"=>"slovak koruna",
"sit"=>"slovenian tolar",
"sbd"=>"solomon islands dollar",
"sos"=>"somali shilling",
"zar"=>"south african rand",
"krw"=>"south-korean won",
"esp"=>"spanish peseta",
"lkr"=>"sri lanka rupee",
"shp"=>"st. helena pound",
"sdd"=>"sudanese dinar",
"sdp"=>"sudanese old pound",
"sdg"=>"sudanese pound",
"srd"=>"suriname dollar",
"srg"=>"suriname guilder",
"szl"=>"swaziland lilangeni",
"sek"=>"swedish krona",
"chf"=>"swiss franc",
"syp"=>"syrian pound",
"twd"=>"taiwan dollar",
"tjs"=>"tajikistani somoni",
"tzs"=>"tanzanian shilling",
"thb"=>"thai baht",
"top"=>"tonga pa'anga",
"ttd"=>"trinidad/tobago dollar",
"tnd"=>"tunisian dinar",
"try"=>"turkish lira",
"trl"=>"turkish old lira",
"tmm"=>"turkmenistan manat",
"tmt"=>"turkmenistan new manat",
"ugx"=>"uganda shilling",
"uah"=>"ukraine hryvnia",
"uyu"=>"uruguayan peso",
"aed"=>"utd. arab emir. dirham",
"uzs"=>"uzbekistan som",
"vuv"=>"vanuatu vatu",
"veb"=>"venezuelan bolivar",
"vef"=>"venezuelan bolivar fuerte",
"vnd"=>"vietnamese dong",
"yer"=>"yemeni rial",
"yun"=>"yugoslav dinar",
"zmk"=>"zambian kwacha",
"zwd"=>"zimbabwe dollar"
	);

	protected static $rates = array();

	protected static $from_currency_code = '';

	protected static $to_currency_code = '';

	private static $debug = false;

	protected $amount = 0;

	// set once....

	static function set_debug_mode($trueOrFalse) {
		self::$debug = $trueOrFalse;
	}

	static function get_currency_list() {
		if(count(self::$array_of_currencies_to_show)) {
			foreach(self::$array_of_currencies_to_show as $code) {
				$array[$code] = self::$currency_list[$code];
			}
		}
		else {
			$array = self::$currency_list;
		}
		return $array;
	}

	static function set_from_currency_code($v) {
		if(self::currency_exists($v)) {
			self::$from_currency_code = $v;
			Session::set("CurrencyConverter.from_currency_code", $v);
		}
	}

	static function set_to_currency_code($v) {
		if(self::currency_exists($v)) {
			self::$to_currency_code = $v;
			Session::set("CurrencyConverter.to_currency_code", $v);
		}
	}

	static function get_from_currency_code() {
		self::retrieve_defaults();
		return self::$from_currency_code;
	}

	static function get_to_currency_code() {
		self::retrieve_defaults();
		return self::$to_currency_code;
	}

	static function from_equals_to() {
		self::retrieve_defaults();
		return (strtolower(self::$to_currency_code) == strtolower(self::$from_currency_code));
	}

	static function has_from_and_to_currencies() {
		self::retrieve_defaults();
		if(self::$to_currency_code && self::$from_currency_code) {
			return true;
		}
	}


	static function get_rate() {
		//$url = http://finance.yahoo.com/currency/convert?amt=1&from=NZD&to=USD&submit=Convert
		if(self::has_from_and_to_currencies() && !self::from_equals_to()) {
			if(isset(self::$rates[self::$from_currency_code.".".self::$to_currency_code]) && self::$rates[self::$from_currency_code.".".self::$to_currency_code] > 0) {
				return self::$rates[self::$from_currency_code.".".self::$to_currency_code]+0;
			}
			else {
				$url = 'http://download.finance.yahoo.com/d/quotes.csv?s='.self::$from_currency_code.self::$to_currency_code.'=X&f=sl1d1t1ba&e=.csv';
				if (($ch = @curl_init())) {
				$timeout = 5; // set to zero for no timeout
				curl_setopt ($ch, CURLOPT_URL, "$url");
				curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
				$record = curl_exec($ch);
				if(self::$debug) {echo "-- CURL:"; print_r($record);}
				curl_close($ch);
				}
				if(!$record) {
					$record = file_get_contents($url);
					//if(self::$debug) {echo "-- FILE_GET_CONTENTS:"; print_r($record);}
				}
				if ($record) {
					$currency_data = explode(',', $record);
					self::$rates[self::$from_currency_code.".".self::$to_currency_code] = $currency_data[1];
					if(!isset(self::$rates[self::$from_currency_code.".".self::$to_currency_code]) || !self::$rates[self::$from_currency_code.".".self::$to_currency_code]) {
						self::$rates[self::$from_currency_code.".".self::$to_currency_code] = $currency_data[2];
					}
				}
				else {
					if(self::$debug) {echo "-- could not retrieve data";}
				}
			}
		}
		elseif(self::from_equals_to()) {
			self::$rates[self::$from_currency_code.".".self::$to_currency_code] = 1;
			return self::$rates[self::$from_currency_code.".".self::$to_currency_code]+0;
		}
		else {
			if(self::$debug) {echo "-- could not find from and to values!";}
		}
		if(isset(self::$rates[self::$from_currency_code.".".self::$to_currency_code])) {
			return self::$rates[self::$from_currency_code.".".self::$to_currency_code]+0;
		}
		else {
			return 0;
		}
	}

	static function get_exchanged_value($amount = 0, $digits = 2) {
		self::retrieve_defaults();
		if(self::$debug) {echo "-- from ".self::$from_currency_code;}
		if(self::$debug) {echo "-- to ".self::$to_currency_code;}
		if(self::$debug) {echo "-- amount ".$amount;}
		$rate = self::get_rate();
		if(self::$debug) {echo "-- rate ".$rate;}
		return strtoupper(self::$to_currency_code).' '.round(floatval($rate * $amount), $digits);
	}

	private static function retrieve_defaults() {
		if(!self::$from_currency_code) {
			if(self::$from_currency_code = Session::get("CurrencyConverter.from_currency_code")) {
			}
			else {
				self::$from_currency_code = self::$defaults["DefaultFromCurrency"];
			}
			if(!self::$from_currency_code && self::$to_currency_code) {
				self::$from_currency_code = self::$to_currency_code;
			}
		}
		if(!self::$to_currency_code) {
			if(self::$to_currency_code = Session::get("CurrencyConverter.to_currency_code")) {
			}
			else {
				self::$to_currency_code = self::$defaults["DefaultToCurrency"];
			}
			if(self::$from_currency_code && !self::$to_currency_code) {
				self::$to_currency_code = self::$from_currency_code;
			}
		}
	}


	private static function currency_exists($v) {
		$outcome = array_key_exists($v, self::$currency_list);
		if(!$outcome && self::$debug) {
			die( "$v currency could not be found!");
		}
		return $outcome;
	}

	//CMS ...

	public function getCMSFields() {
		return new FieldSet(
			new TextField("defaultFromCurrencyCode", _t('CurrencyConverterWidget.defaultFromCurrencyCode', "Default From Currency Code")),
			new TextField("Defaultto_currency_code", _t('CurrencyConverterWidget.Defaultto_currency_code', "Default To Currency Code")),
			new CurrencyField("DefaultAmount", _t('CurrencyConverterWidget.DefaultAmount', "Default Amount to be Converted"))
		);
	}

	//set for every transaction....

	public function setAmount($amount = 0) {
		$this->amount = floatval($amount);
		Session::set("CurrencyConverter.Amount", $amount);
	}

	// get for every transaction ...

	public function getExchangedAmount($amount = 0) {
		$this->getValues();
		if($amount) {
			$this->amount = $amount;
		}
		$this->amount = floatval($this->amount);
		return self::get_exchanged_value($this->amount);
	}

	// for templates ...

	public function CurrencyConverter() {
		$this->getValues();
		$convertedAmount = $this->getExchangedAmount();
		$output = new DataObjectSet();
		$output->push(
			new ArrayData(
			array(
				"from_currency_code" =>  self::$from_currency_code,
				"to_currency_code" => self::$to_currency_code,
				"amount" => $this->amount,
				"rate" => floatval(self::$rates[self::$from_currency_code.".".self::$to_currency_code]+0),
				"convertedAmount" => $convertedAmount
			)
			)
		);
		return $output;
	}

	public function Currencies() {
		$this->getValues();
		$currencies = new DataObjectSet;
		foreach(self::$currency_list as $key => $value) {
			$from = ($key == self::$from_currency_code);
			$to = ($key == self::$to_currency_code);
			$item = new ArrayData(
			Array(
				"code" => $key,
				"name" => $value,
				"currentFrom" => $from,
				"currentTo" => $to
			)
			);
			$currencies->push($item);
		}
		return $currencies;
	}


	private function retrieveGetValues() {
		if(isset($_GET["f"])  ) {
			self::set_from_currency_code(strtolower(substr($_GET["f"], 0, 3)));
		}
		if( isset($_GET["t"])  ) {
			self::set_to_currency_code(strtolower(substr($_GET["t"], 0, 3)));
		}
		if(isset($_GET["a"]) ) {
			$this->amount = floatval($_GET["a"]);
			$this->setAmount($this->amount);
		}
	}



}


class CurrencyConverterWidget_Controller extends ContentController {
	function __construct($dataRecord = Null) {
		parent::__construct($dataRecord);
	}

	function getRate() {
		$CurrencyConverterWidgetObject = new CurrencyConverterWidget();
		//$CurrencyConverterWidgetObject->debug = true;
		echo $CurrencyConverterWidgetObject->getExchangedAmount();
	}
}
