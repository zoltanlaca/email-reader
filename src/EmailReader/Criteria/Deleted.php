<?php

namespace ZoltanLaca\EmailReader\Criteria;

/**
 * Class Deleted
 * @package ZoltanLaca\EmailReader\Criteria
 */
class Deleted extends BoolCriteria
{
	protected function getName(): string
	{
		return 'DELETED';
	}
}
