<?php

namespace ZoltanLaca\EmailReader\Criteria;

/**
 * Class Body
 * @package ZoltanLaca\EmailReader\Criteria
 */
class Body extends StringCriteria
{
	/**
	 * @return string
	 */
	protected function getName(): string
	{
		return 'BODY';
	}
}
