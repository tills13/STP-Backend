<?php
    namespace SVX\Common\Utility;

    class Utilities {
        public static function niceBytes($bytes) {
            $sizes = ['', 'K', 'M', 'G'];

			for ($j = 0; $bytes >= 1024; $j++) $bytes /= 1024;

			$bytes = round($bytes, 2);

			if ($bytes != 1) $pBytes = 'Bytes';
			else $pBytes = 'Byte';

			return "{$bytes} {$sizes[($j)]}{$pBytes}";
        }

        public static function ago($time) {
            $periods = ["second", "minute", "hour", "day", "week", "month", "year", "decade"];
			$lengths = ["60", "60", "24", "7", "4.35", "12", "10"];

			$now = time();
			$difference = $now - $time;
			$tense = "ago";

			for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; $j++) $difference /= $lengths[$j];
			$difference = round($difference);

			if ($difference != 1) $periods[$j] .= "s";
			if ($difference <= 10 && $j == 0) return "just now";
			else return "{$difference} {$periods[$j]} ago";
		}
    }