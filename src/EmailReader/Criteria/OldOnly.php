<?php

namespace ZoltanLaca\EmailReader\Criteria;

/**
 * Class OldOnly
 * @package ZoltanLaca\EmailReader\Criteria
 */
class OldOnly extends Criteria
{
	/**
	 * @return string
	 */
	public function getText(): string
	{
		return 'OLD';
	}
}
