<?php

namespace ZoltanLaca\EmailReader\Credentials;

use ZoltanLaca\EmailReader\Contracts\Credentials;
use ZoltanLaca\EmailReader\Exceptions\InvalidCredentialsException;
use ZoltanLaca\EmailReader\Exceptions\InvalidParameterException;
use PhpImap\Exceptions\InvalidParameterException as PhpImapInvalidParameterException;
use PhpImap\Mailbox;
use Throwable;

/**
 * Class Imap
 * @package ZoltanLaca\EmailReader\Credentials
 */
class Imap implements Credentials
{
	/**
	 * @var string
	 */
	private $host;

	/**
	 * @var string
	 */
	private $username;

	/**
	 * @var string
	 */
	private $password;

	/**
	 * @var int
	 */
	private $port;

	/**
	 * @var string|null
	 */
	private $encrypt;

	/**
	 * @var string|null
	 */
	private $folder;

	/**
	 * @var string
	 */
	private $encoding;

	/**
	 * @var \PhpImap\Mailbox
	 */
	private $mailbox;

	/**
	 * Imap constructor.
	 * @param string $host
	 * @param string $username
	 * @param string $password
	 * @param int $port
	 * @param string $encrypt
	 * @param string|null $folder
	 * @param string $encoding
	 * @throws \ZoltanLaca\EmailReader\Exceptions\InvalidCredentialsException
	 * @throws \ZoltanLaca\EmailReader\Exceptions\InvalidParameterException
	 */
	public function __construct(
		string $host,
		string $username,
		string $password,
		int $port = 993,
		string $encrypt = 'ssl',
		string $folder = null,
		string $encoding = 'UTF-8'
	)
	{
		if (!in_array($encrypt, [null, 'ssl', 'tls', 'notls'], true)) {
			throw new InvalidParameterException();
		}

		$this->host = $host;
		$this->username = $username;
		$this->password = $password;
		$this->port = $port;
		$this->encrypt = $encrypt;
		$this->folder = $folder;
		$this->encoding = $encoding;

		try {
			$this->mailbox = new Mailbox($this->getPath(), $username, $password, null, $encoding);

			$this->mailbox->setTimeouts(0);
			$this->mailbox->setAttachmentsIgnore(true);

			$this->mailbox->checkMailbox();
		} catch (Throwable $exception) {
			throw new InvalidCredentialsException('', 0, $exception);
		}
	}

	/**
	 * @param string $path
	 * @return \ZoltanLaca\EmailReader\Credentials\Imap
	 * @throws \ZoltanLaca\EmailReader\Exceptions\InvalidParameterException
	 */
	public function setAttachmentsPath(string $path): self
	{
		if (!is_dir($path) && !mkdir($path, 0777, true)) {
			throw new InvalidParameterException("Unable to create folder '{$path}'.");
		}

		try {
			$this->mailbox->setAttachmentsIgnore(false);
			$this->mailbox->setAttachmentsDir($path);
		} catch (PhpImapInvalidParameterException $exception) {
			var_dump($exception);
		}

		return $this;
	}

	/**
	 * @param int $timeout
	 * @return \ZoltanLaca\EmailReader\Credentials\Imap
	 */
	public function setTimeout(int $timeout): self
	{
		try {
			$this->mailbox->setTimeouts($timeout);
		} catch (PhpImapInvalidParameterException $exception) {

		}

		return $this;
	}

	/**
	 * @return string
	 */
	private function getPath(): string
	{
		$encryptFlag = $this->encrypt ? "/{$this->encrypt}" : '';
		$path = "{{$this->host}:{$this->port}/imap{$encryptFlag}}";

		return $this->folder ? "{$path}{$this->folder}" : $path;
	}

	/**
	 * @return \PhpImap\Mailbox
	 */
	public function getMailbox(): Mailbox
	{
		return $this->mailbox;
	}
}
