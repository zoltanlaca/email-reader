<?php

namespace ZoltanLaca\EmailReader\Criteria;

/**
 * Class NewOnly
 * @package ZoltanLaca\EmailReader\Criteria
 */
class NewOnly extends Criteria
{
	/**
	 * @return string
	 */
	public function getText(): string
	{
		return 'NEW';
	}
}
