<?php

namespace ZoltanLaca\EmailReader\Criteria;

/**
 * Class Bcc
 * @package ZoltanLaca\EmailReader\Criteria
 */
class Bcc extends StringCriteria
{
	/**
	 * @return string
	 */
	protected function getName(): string
	{
		return 'BCC';
	}
}
