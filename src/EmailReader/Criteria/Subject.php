<?php

namespace ZoltanLaca\EmailReader\Criteria;

/**
 * Class Subject
 * @package ZoltanLaca\EmailReader\Criteria
 */
class Subject extends StringCriteria
{
	/**
	 * @return string
	 */
	protected function getName(): string
	{
		return 'SUBJECT';
	}
}
