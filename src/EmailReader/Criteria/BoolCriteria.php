<?php

namespace ZoltanLaca\EmailReader\Criteria;

/**
 * Class StringCriteria
 * @package ZoltanLaca\EmailReader\Criteria
 */
abstract class BoolCriteria extends Criteria
{
	/**
	 * @var bool
	 */
	protected $value;

	/**
	 * BoolCriteria constructor.
	 * @param bool $value
	 */
	public function __construct(bool $value)
	{
		$this->value = $value;
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
		$name = $this->getName();

		return $this->value ? $name : "UN{$name}";
	}
}
