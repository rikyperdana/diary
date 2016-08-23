<?php

class Timezone {

	public function __construct() {
		$this->CI =& get_instance();
        }

	function timezone_list() {
		$timezones['UM12'] = '(UTC - 12:00) Baker/Howland Island';
		$timezones['UM11'] = '(UTC - 11:00) Samoa Time Zone, Niue';
		$timezones['UM10'] = '(UTC - 10:00) Hawaii-Aleutian Standard Time, Cook Islands';
		$timezones['UM95'] = '(UTC - 09:30) Marquesas Islands';
		$timezones['UM9'] = '(UTC - 09:00) Alaska Standard Time, Gambier Islands';
		$timezones['UM8'] = '(UTC - 08:00) Pacific Standard Time, Clipperton Island';
		$timezones['UM7'] = '(UTC - 07:00) Mountain Standard Time';
		$timezones['UM6'] = '(UTC - 06:00) Central Standard Time';
		$timezones['UM5'] = '(UTC - 05:00) Eastern Standard Time, Western Caribbean';
		$timezones['UM45'] = '(UTC - 04:30) Venezuelan Standard Time';
		$timezones['UM4'] = '(UTC - 04:00) Atlantic Standard Time, Eastern Caribbean';
		$timezones['UM35'] = '(UTC - 03:30) Newfoundland Standard Time';
		$timezones['UM3'] = '(UTC - 03:00) Argentina, Brazil, French Guiana, Uruguay';
		$timezones['UM2'] = '(UTC - 02:00) South Georgia/South Sandwich Islands';
		$timezones['UM1'] = '(UTC -1:00) Azores, Cape Verde Islands';
		$timezones['UTC'] = '(UTC) Greenwich Mean Time, Western European Time';
		$timezones['UP1'] = '(UTC +1:00) Central European Time, West Africa Time';
		$timezones['UP2'] = '(UTC +2:00) Central Africa Time, Eastern European Time';
		$timezones['UP3'] = '(UTC +3:00) Moscow Time, East Africa Time';
		$timezones['UP35'] = '(UTC +3:30) Iran Standard Time';
		$timezones['UP4'] = '(UTC +4:00) Azerbaijan Standard Time, Samara Time';
		$timezones['UP45'] = '(UTC +4:30) Afghanistan';
		$timezones['UP5'] = '(UTC +5:00) Pakistan Standard Time, Yekaterinburg Time';
		$timezones['UP55'] = '(UTC +5:30) Indian Standard Time, Sri Lanka Time';
		$timezones['UP575'] = '(UTC +5:45) Nepal Time';
		$timezones['UP6'] = '(UTC +6:00) Bangladesh Standard Time, Bhutan Time, Omsk Time';
		$timezones['UP65'] = '(UTC +6:30) Cocos Islands, Myanmar';
		$timezones['UP7'] = '(UTC +7:00) Jakarta, Cambodia, Laos, Thailand, Vietnam';
		$timezones['UP8'] = '(UTC +8:00) Australian Western Standard Time, Beijing Time';
		$timezones['UP875'] = '(UTC +8:45) Australian Central Western Standard Time';
		$timezones['UP9'] = '(UTC +9:00) Japan Standard Time, Korea Standard Time, Yakutsk';
		$timezones['UP95'] = '(UTC +9:30) Australian Central Standard Time';
		$timezones['UP10'] = '(UTC +10:00) Australian Eastern Standard Time, Vladivostok Time';
		$timezones['UP105'] = '(UTC +10:30) Lord Howe Island';
		$timezones['UP11'] = '(UTC +11:00) Srednekolymsk Time, Solomon Islands, Vanuatu';
		$timezones['UP115'] = '(UTC +11:30) Norfolk Island';
		$timezones['UP12'] = '(UTC +12:00) Fiji, Gilbert Islands, Kamchatka, New Zealand';
		$timezones['1275'] = '(UTC +12:45) Chatham Islands Standard Time';
		$timezones['UP13'] = '(UTC +13:00) Phoenix Islands Time, Tonga';
		$timezones['UP14'] = '(UTC +14:00) Line Islands';
	
		return $timezones;
	}

}

?>
