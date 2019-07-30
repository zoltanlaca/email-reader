<?php

namespace ZoltanLaca\EmailReader;

/**
 * Class Folder
 * @package ZoltanLaca\EmailReader
 */
class Folder
{
	/**
	 * @var string
	 */
	private $path;

	/**
	 * @var string
	 */
	private $fullPath;

	/**
	 * @var int
	 */
	private $attributes;

	/**
	 * @var string
	 */
	private $delimiter;

	/**
	 * Folder constructor.
	 * @param string $path
	 * @param string $fullPath
	 * @param int $attributes
	 * @param string $delimiter
	 */
	public function __construct(string $path, string $fullPath, int $attributes, string $delimiter)
	{
		$this->path = $path;
		$this->fullPath = $fullPath;
		$this->attributes = $attributes;
		$this->delimiter = $delimiter;
	}

	/**
	 * @return string
	 */
	public function getPath(): string
	{
		return $this->path;
	}

	/**
	 * @return string
	 */
	public function getFullPath(): string
	{
		return $this->fullPath;
	}

	/**
	 * @return int
	 */
	public function getAttributes(): int
	{
		return $this->attributes;
	}

	/**
	 * @return string
	 */
	public function getDelimiter(): string
	{
		return $this->delimiter;
	}
}
