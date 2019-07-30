<?php

namespace ZoltanLaca\EmailReader\Criteria;

/**
 * Class On
 * @package ZoltanLaca\EmailReader\Criteria
 */
class On extends DateCriteria
{
	/**
	 * @return string
	 */
	protected function getName(): string
	{
		return 'ON';
	}
}
