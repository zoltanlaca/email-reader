<?php

namespace ZoltanLaca\EmailReader\Criteria;

/**
 * Class Cc
 * @package ZoltanLaca\EmailReader\Criteria
 */
class Cc extends StringCriteria
{
	/**
	 * @return string
	 */
	protected function getName(): string
	{
		return 'FROM';
	}
}
