<?php

namespace ZoltanLaca\EmailReader\Criteria;

/**
 * Class From
 * @package ZoltanLaca\EmailReader\Criteria
 */
class From extends StringCriteria
{
	/**
	 * @return string
	 */
	protected function getName(): string
	{
		return 'FROM';
	}
}
