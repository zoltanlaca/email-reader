<?php

namespace ZoltanLaca\EmailReader\Criteria;

/**
 * Class Since
 * @package ZoltanLaca\EmailReader\Criteria
 */
class Since extends DateCriteria
{
	/**
	 * @return string
	 */
	protected function getName(): string
	{
		return 'SINCE';
	}
}
