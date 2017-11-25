<?php
class Math{
	const PI = M_PI;
	static function pow($base, $exp){
		return $base ** $exp;		//возведение в степень PHP7
	}
}
echo Math::pow(2,3);