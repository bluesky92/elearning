<?php
class DateClass
{
	public function __construct() {
		date_default_timezone_set(TTH_TIMEZONE);
	}

	public function vnTime($time) {
		if($time>0) return self::time($time);
		else return '';
	}
	public function vnDate($time) {
		if($time>0) return self::date($time);
		else return '';
	}
	public function vnDateTime($time) {
		if($time>0) return self::dateTime($time);
		else return '';
	}
	public function vnOther($time, $_Phare) {
		if($time>0) {
			$out_date = date($_Phare, $time);
			return $out_date;
		} else return '';
	}
	public function vnFull($time) {
		if($time>0) {
			$out_date = date(TTH_FULL_DATE_FORMAT, $time);
			$str_search = array(
					"Mon",
					"Tue",
					"Wed",
					"Thu",
					"Fri",
					"Sat",
					"Sun",
					"AM",
					"PM",
					":"
			);
			$str_replace = array(
					"Thứ hai",
					"Thứ ba",
					"Thứ tư",
					"Thứ năm",
					"Thứ sáu",
					"Thứ bảy",
					"Chủ nhật",
					" phút, sáng",
					" phút, chiều",
					":"
			);
			return str_replace($str_search, $str_replace, $out_date);
		} else return '';
	}

	public function time($time) {
		$out_date = date(TTH_TIME_FORMAT, $time);
		return $out_date;
	}
	public function date($time) {
		$out_date = date(TTH_DATE_FORMAT, $time);
		return $out_date;
	}
	public function dateTime($time) {
		$out_date = date(TTH_DATETIME_FORMAT, $time);
		return $out_date;
	}

	public function dmYtoYmd($datetime) {
		$result = $datetime;
		$time = "";
		if (strpos($datetime, ":") > 0) {
			$time = substr($datetime,10).":00";
		}
		$date = substr($datetime,0,10);
		if (strpos($date,"/")	> 0) {
			$item	=	explode("/",$date);
			$result = $item[2]."-".$item[1]."-".$item[0];
		}
		else if (strpos($date,"-")	> 0) {
			$item	=	explode("-",$date);
			$result = $item[2]."-".$item[1]."-".$item[0];
		}
		$result = strtotime($result.$time);
		if($result > 0) return date('Y-m-d H:i:s', $result);
		else return '';
	}

	public function dmYtoYmd2($date) {
		$result = $date;
		$date = substr($date,0,10);
		if (strpos($date,"/")	> 0) {
			$item	=	explode("/",$date);
			$result = $item[2]."-".$item[1]."-".$item[0];
		}
		else if (strpos($date,"-")	> 0) {
			$item	=	explode("-",$date);
			$result = $item[2]."-".$item[1]."-".$item[0];
		}
		$result = strtotime($result);
		if($result > 0) return date('Y-m-d', $result);
		else return '';
	}
}