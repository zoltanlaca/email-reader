<?php

namespace ZoltanLaca\EmailReader\Criteria;

use DateTimeInterface;

/**
 * Class DateCriteria
 * @package ZoltanLaca\EmailReader\Criteria
 */
abstract class DateCriteria extends Criteria
{
	/**
	 * @var \DateTimeInterface
	 */
	private $date;

	/**
	 * DateCriteria constructor.
	 * @param \DateTimeInterface $date
	 */
	public function __construct(DateTimeInterface $date)
	{
		$this->date = $date;
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
		return "{$this->getName()} {$this->getFormattedDate()}";
	}

	/**
	 * @return string
	 */
	private function getFormattedDate(): string
	{
		$months = [
			'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
			'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec',
		];

		$monthIndex = (int)$this->date->format('n') - 1;
		$month = $months[$monthIndex];

		return $this->date->format('d') . "-{$month}-" . $this->date->format('Y');
	}
}
