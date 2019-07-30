<?php

namespace ZoltanLaca\EmailReader\Criteria;

/**
 * Class All
 * @package ZoltanLaca\EmailReader\Criteria
 */
class All extends Criteria
{
	/**
	 * @return string
	 */
	public function getText(): string
	{
		return 'ALL';
	}
}
