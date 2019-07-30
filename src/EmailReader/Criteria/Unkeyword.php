<?php

namespace ZoltanLaca\EmailReader\Criteria;

/**
 * Class Unkeyword
 * @package ZoltanLaca\EmailReader\Criteria
 */
class Unkeyword extends StringCriteria
{
	/**
	 * @return string
	 */
	protected function getName(): string
	{
		return 'UNKEYWORD';
	}
}
