<?php

namespace ZoltanLaca\EmailReader;

use DateTimeInterface;
use ZoltanLaca\EmailReader\Criteria;
use PhpImap\Mailbox;
use Throwable;

/**
 * Class Search
 * @package ZoltanLaca\EmailReader
 */
class Search
{
	/**
	 * @var \PhpImap\Mailbox
	 */
	private $mailbox;

	/**
	 * @var \ZoltanLaca\EmailReader\Folder|null
	 */
	private $folder;

	/**
	 * @var \ZoltanLaca\EmailReader\Criteria\Criteria[]
	 */
	private $criteria;

	/**
	 * Search constructor.
	 * @param \PhpImap\Mailbox $mailbox
	 * @param \ZoltanLaca\EmailReader\Folder|null $folder
	 */
	public function __construct(Mailbox $mailbox, Folder $folder = null)
	{
		$this->mailbox = $mailbox;
		$this->folder = $folder;
		$this->criteria = [];
	}

	/**
	 * @param \ZoltanLaca\EmailReader\Criteria\Criteria $criteria
	 * @return \ZoltanLaca\EmailReader\Search
	 */
	public function pushCriteria(Criteria\Criteria $criteria): self
	{
		$this->criteria[] = $criteria;

		return $this;
	}

	/**
	 * @return \PhpImap\IncomingMail[]
	 */
	public function get(): array
	{
		try {
			$criteriaText = $this->getCriteriaText();

			if ($this->folder) {
				$path = $this->folder->getFullPath();

				$this->mailbox->switchMailbox($path);
			}

			if ($criteriaText === null) {
				$mailIds = $this->mailbox->searchMailbox();
			} else {
				$stream = $this->mailbox->getImapStream();
				$mailIds = imap_search($stream, $criteriaText, SE_FREE, 'UTF-8') ?: [];
			}

			return array_map(function (int $mailId) {
				return $this->mailbox->getMail($mailId, false);
			}, $mailIds);
		} catch (Throwable $exception) {
			return [];
		}
	}

	/**
	 * @param bool $answered
	 * @return \ZoltanLaca\EmailReader\Search
	 */
	public function answered(bool $answered = true): self
	{
		return $this->pushCriteria(new Criteria\Answered($answered));
	}

	/**
	 * @return \ZoltanLaca\EmailReader\Search
	 */
	public function unanswered(): self
	{
		return $this->pushCriteria(new Criteria\Answered(false));
	}

	/**
	 * @param bool $deleted
	 * @return \ZoltanLaca\EmailReader\Search
	 */
	public function deleted(bool $deleted = true): self
	{
		return $this->pushCriteria(new Criteria\Deleted($deleted));
	}

	/**
	 * @return \ZoltanLaca\EmailReader\Search
	 */
	public function undeleted(): self
	{
		return $this->pushCriteria(new Criteria\Deleted(false));
	}

	/**
	 * @param bool $flagged
	 * @return \ZoltanLaca\EmailReader\Search
	 */
	public function flagged(bool $flagged = true): self
	{
		return $this->pushCriteria(new Criteria\Flagged($flagged));
	}

	/**
	 * @return \ZoltanLaca\EmailReader\Search
	 */
	public function unflagged(): self
	{
		return $this->pushCriteria(new Criteria\Flagged(false));
	}

	/**
	 * @return \ZoltanLaca\EmailReader\Search
	 */
	public function new(): self
	{
		return $this->pushCriteria(new Criteria\NewOnly());
	}

	/**
	 * @return \ZoltanLaca\EmailReader\Search
	 */
	public function old(): self
	{
		return $this->pushCriteria(new Criteria\OldOnly());
	}

	/**
	 * @return \ZoltanLaca\EmailReader\Search
	 */
	public function recent(): self
	{
		return $this->pushCriteria(new Criteria\Recent());
	}

	/**
	 * @param bool $seen
	 * @return \ZoltanLaca\EmailReader\Search
	 */
	public function seen(bool $seen = true): self
	{
		return $this->pushCriteria(new Criteria\Seen($seen));
	}

	/**
	 * @return \ZoltanLaca\EmailReader\Search
	 */
	public function unseen(): self
	{
		return $this->pushCriteria(new Criteria\Seen(false));
	}

	/**
	 * @param \DateTimeInterface $before
	 * @return \ZoltanLaca\EmailReader\Search
	 */
	public function before(DateTimeInterface $before): self
	{
		return $this->pushCriteria(new Criteria\Before($before));
	}

	/**
	 * @param \DateTimeInterface $on
	 * @return \ZoltanLaca\EmailReader\Search
	 */
	public function on(DateTimeInterface $on): self
	{
		return $this->pushCriteria(new Criteria\On($on));
	}

	/**
	 * @param \DateTimeInterface $since
	 * @return \ZoltanLaca\EmailReader\Search
	 */
	public function since(DateTimeInterface $since): self
	{
		return $this->pushCriteria(new Criteria\Since($since));
	}

	/**
	 * @param string $from
	 * @return \ZoltanLaca\EmailReader\Search
	 */
	public function from(string $from): self
	{
		return $this->pushCriteria(new Criteria\From($from));
	}

	/**
	 * @param string $to
	 * @return \ZoltanLaca\EmailReader\Search
	 */
	public function to(string $to): self
	{
		return $this->pushCriteria(new Criteria\To($to));
	}

	/**
	 * @param string $bcc
	 * @return \ZoltanLaca\EmailReader\Search
	 */
	public function bcc(string $bcc): self
	{
		return $this->pushCriteria(new Criteria\Bcc($bcc));
	}

	/**
	 * @param string $cc
	 * @return \ZoltanLaca\EmailReader\Search
	 */
	public function cc(string $cc): self
	{
		return $this->pushCriteria(new Criteria\Cc($cc));
	}

	/**
	 * @param string $subject
	 * @return \ZoltanLaca\EmailReader\Search
	 */
	public function subject(string $subject): self
	{
		return $this->pushCriteria(new Criteria\Subject($subject));
	}

	/**
	 * @param string $body
	 * @return \ZoltanLaca\EmailReader\Search
	 */
	public function body(string $body): self
	{
		return $this->pushCriteria(new Criteria\Body($body));
	}

	/**
	 * @param string $text
	 * @return \ZoltanLaca\EmailReader\Search
	 */
	public function text(string $text): self
	{
		return $this->pushCriteria(new Criteria\Text($text));
	}

	/**
	 * @param string $keyword
	 * @return \ZoltanLaca\EmailReader\Search
	 */
	public function keyword(string $keyword): self
	{
		return $this->pushCriteria(new Criteria\Keyword($keyword));
	}

	/**
	 * @param string $unkeyword
	 * @return \ZoltanLaca\EmailReader\Search
	 */
	public function unkeyword(string $unkeyword): self
	{
		return $this->pushCriteria(new Criteria\Unkeyword($unkeyword));
	}

	/**
	 * @return string|null
	 */
	private function getCriteriaText(): ?string
	{
		if (empty($this->criteria)) {
			return null;
		}

		$texts = array_map(function (Criteria\Criteria $criteria) {
			return $criteria->getText();
		}, $this->criteria);

		return implode(' ', $texts);
	}
}
