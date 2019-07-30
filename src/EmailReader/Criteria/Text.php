<?php

namespace ZoltanLaca\EmailReader\Criteria;

/**
 * Class Text
 * @package ZoltanLaca\EmailReader\Criteria
 */
class Text extends StringCriteria
{
	/**
	 * @return string
	 */
	protected function getName(): string
	{
		return 'TEXT';
	}
}
