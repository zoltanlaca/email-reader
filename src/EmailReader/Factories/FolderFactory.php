<?php

namespace ZoltanLaca\EmailReader\Factories;

use ZoltanLaca\EmailReader\Exceptions\RequiredFieldMissingException;
use ZoltanLaca\EmailReader\Folder;

/**
 * Class MailboxFactory
 * @package ZoltanLaca\EmailReader\Factories
 */
class FolderFactory
{
	/**
	 * @param array $folder
	 * @return \ZoltanLaca\EmailReader\Folder
	 * @throws \ZoltanLaca\EmailReader\Exceptions\RequiredFieldMissingException
	 */
	public static function create(array $folder): Folder
	{
		$requiredFields = ['shortpath', 'fullpath', 'attributes', 'delimiter'];

		foreach ($requiredFields as $requiredField) {
			if (!array_key_exists($requiredField, $folder)) {
				throw new RequiredFieldMissingException();
			}
		}

		return new Folder(
			$folder['shortpath'],
			$folder['fullpath'],
			$folder['attributes'],
			$folder['delimiter']
		);
	}
}
