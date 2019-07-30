<?php

namespace ZoltanLaca\EmailReader\Criteria;

/**
 * Class Before
 * @package ZoltanLaca\EmailReader\Criteria
 */
class Before extends DateCriteria
{
	/**
	 * @return string
	 */
	protected function getName(): string
	{
		return 'BEFORE';
	}
}
