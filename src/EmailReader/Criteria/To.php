<?php

namespace ZoltanLaca\EmailReader\Criteria;

/**
 * Class To
 * @package ZoltanLaca\EmailReader\Criteria
 */
class To extends StringCriteria
{
	/**
	 * @return string
	 */
	protected function getName(): string
	{
		return 'TO';
	}
}
