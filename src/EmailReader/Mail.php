<?php

namespace ZoltanLaca\EmailReader;

use PhpImap\IncomingMail;
use PhpImap\Mailbox;

/**
 * Class Mail
 * @package ZoltanLaca\EmailReader
 */
class Mail extends IncomingMail
{
	/**
	 * @var \PhpImap\Mailbox|null
	 */
	protected $mailbox;

	/**
	 * Mail constructor.
	 */
	protected function __construct()
	{
		$this->mailbox = null;
	}

	/**
	 * @param \PhpImap\Mailbox $mailbox
	 */
	protected function setMailbox(Mailbox $mailbox): void
	{
		$this->mailbox = $mailbox;
	}

	/**
	 * @param \PhpImap\Mailbox $mailbox
	 * @param \PhpImap\IncomingMail $incomingMail
	 * @return static
	 */
	public static function fromIncomingMail(Mailbox $mailbox, IncomingMail $incomingMail): self
	{
		$class = self::class;
		$classNameLength = mb_strlen($class);

		$serializedIncomingMail = serialize($incomingMail);
		$serializedMail = preg_replace('/^O:\d+:"[^"]+"/', "O:{$classNameLength}:\"{$class}\"", $serializedIncomingMail);

		/** @var \ZoltanLaca\EmailReader\Mail $mail */
		$mail = unserialize($serializedMail);

		$mail->setMailbox($mailbox);

		return $mail;
	}

	public function markAsRead(): void
	{
		$this->mailbox->markMailAsRead($this->id);
	}

	public function markAsUnread(): void
	{
		$this->mailbox->markMailAsUnread($this->id);
	}

	public function markAsImportant(): void
	{
		$this->mailbox->markMailAsImportant($this->id);
	}

	public function delete(): void
	{
		$this->mailbox->deleteMail($this->id);
	}

	/**
	 * @param \ZoltanLaca\EmailReader\Folder $folder
	 */
	public function move(Folder $folder): void
	{
		$this->mailbox->moveMail($this->id, $folder->getPath());
	}

	/**
	 * @param \ZoltanLaca\EmailReader\Folder $folder
	 */
	public function copy(Folder $folder): void
	{
		$this->mailbox->copyMail($this->id, $folder->getPath());
	}
}
