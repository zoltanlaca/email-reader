<?php

namespace ZoltanLaca\EmailReader\Criteria;

/**
 * Class Keyword
 * @package ZoltanLaca\EmailReader\Criteria
 */
class Keyword extends StringCriteria
{
	/**
	 * @return string
	 */
	protected function getName(): string
	{
		return 'KEYWORD';
	}
}
