<?php

namespace ZoltanLaca\EmailReader\Criteria;

/**
 * Class StringCriteria
 * @package ZoltanLaca\EmailReader\Criteria
 */
abstract class StringCriteria extends Criteria
{
	/**
	 * @var string
	 */
	protected $string;

	/**
	 * StringCriteria constructor.
	 * @param string $string
	 */
	public function __construct(string $string)
	{
		$this->string = $string;
	}

	/**
	 * @return string
	 */
	abstract protected function getName(): string;

	/**
	 * @return string
	 */
	public function getText(): string
	{
		return "{$this->getName()} \"{$this->string}\"";
	}
}
