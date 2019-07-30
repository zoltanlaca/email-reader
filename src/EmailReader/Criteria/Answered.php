<?php

namespace ZoltanLaca\EmailReader\Criteria;

/**
 * Class Answered
 * @package ZoltanLaca\EmailReader\Criteria
 */
class Answered extends BoolCriteria
{
	/**
	 * @return string
	 */
	protected function getName(): string
	{
		return 'ANSWERED';
	}
}
