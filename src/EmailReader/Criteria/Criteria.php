<?php

namespace ZoltanLaca\EmailReader\Criteria;

/**
 * Class Criteria
 * @package ZoltanLaca\EmailReader\Criteria
 */
abstract class Criteria
{
	/**
	 * @return string
	 */
	abstract public function getText(): string;
}
