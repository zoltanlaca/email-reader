<?php

namespace ZoltanLaca\EmailReader;

use ZoltanLaca\EmailReader\Contracts\Credentials;
use ZoltanLaca\EmailReader\Exceptions\FolderNotExistsException;
use ZoltanLaca\EmailReader\Factories\FolderFactory;

/**
 * Class EmailReader
 * @package ZoltanLaca\EmailReader
 */
class EmailReader
{
	/**
	 * @var \ZoltanLaca\EmailReader\Contracts\Credentials
	 */
	private $credentials;

	/**
	 * @var \ZoltanLaca\EmailReader\Folder[]|null
	 */
	private $folders;

	/**
	 * EmailReader constructor.
	 * @param \ZoltanLaca\EmailReader\Contracts\Credentials $credentials
	 */
	public function __construct(Credentials $credentials)
	{
		$this->credentials = $credentials;
		$this->folders = null;
	}

	/**
	 * @param string $path
	 * @return \ZoltanLaca\EmailReader\Folder
	 * @throws \ZoltanLaca\EmailReader\Exceptions\FolderNotExistsException
	 * @throws \ZoltanLaca\EmailReader\Exceptions\RequiredFieldMissingException
	 */
	public function getFolder(string $path = null): Folder
	{
		$folders = $this->getFolders();

		if (!$path && array_key_exists('INBOX', $folders)) {
			return $folders['INBOX'];
		}

		if (!array_key_exists($path, $folders)) {
			throw new FolderNotExistsException($path);
		}

		return $folders[$path];
	}

	/**
	 * @return \ZoltanLaca\EmailReader\Folder[]
	 * @throws \ZoltanLaca\EmailReader\Exceptions\RequiredFieldMissingException
	 */
	public function getFolders(): array
	{
		if ($this->folders) {
			return $this->folders;
		}

		$mailboxes = $this->credentials->getMailbox()->getMailboxes('*');
		$folders = [];

		foreach ($mailboxes as $mailbox) {
			$folder = FolderFactory::create($mailbox);

			$folders[$folder->getPath()] = $folder;
		}

		return $this->folders = $folders;
	}

	/**
	 * @param \ZoltanLaca\EmailReader\Folder|null $folder
	 * @param bool $markAsSeen
	 * @return \PhpImap\IncomingMail[]
	 */
	public function getEmails(Folder $folder = null, bool $markAsSeen = false): array
	{
		return $this->searchEmails($folder)->get($markAsSeen);
	}

	/**
	 * @param \ZoltanLaca\EmailReader\Folder|null $folder
	 * @return \ZoltanLaca\EmailReader\Search
	 */
	public function searchEmails(Folder $folder = null): Search
	{
		$mailbox = $this->credentials->getMailbox();

		return new Search($mailbox, $folder);
	}
}
