<?php

namespace ZoltanLaca\EmailReader\Criteria;

/**
 * Class Flagged
 * @package ZoltanLaca\EmailReader\Criteria
 */
class Flagged extends BoolCriteria
{
	/**
	 * @return string
	 */
	protected function getName(): string
	{
		return 'FLAGGED';
	}
}
