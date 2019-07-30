<?php

namespace ZoltanLaca\EmailReader\Criteria;

/**
 * Class Seen
 * @package ZoltanLaca\EmailReader\Criteria
 */
class Seen extends BoolCriteria
{
	/**
	 * @return string
	 */
	protected function getName(): string
	{
		return 'SEEN';
	}
}
