<?php

namespace ZoltanLaca\EmailReader\Contracts;

use PhpImap\Mailbox;

/**
 * Interface Credentials
 * @package ZoltanLaca\EmailReader\Contracts
 */
interface Credentials
{
	/**
	 * @return \PhpImap\Mailbox
	 */
	public function getMailbox(): Mailbox;
}
