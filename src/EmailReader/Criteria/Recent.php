<?php

namespace ZoltanLaca\EmailReader\Criteria;

/**
 * Class Recent
 * @package ZoltanLaca\EmailReader\Criteria
 */
class Recent extends Criteria
{
	/**
	 * @return string
	 */
	public function getText(): string
	{
		return 'RECENT';
	}
}
