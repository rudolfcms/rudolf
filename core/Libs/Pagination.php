<?php
/**
 * This file is part of Rudolf libs.
 *
 * This is the pagination lib.
 *
 * @author Mikołaj Pich <m.pich@outlook.com>
 * @package Rudolf\Libs
 * @version 0.1
 */

namespace Rudolf\Libs;

class Pagination {
	
	/**
	 * the number of all elements
	 *
	 * @var int
	 */
	private $total;
		
	/**
	 * current page
	 *
	 * @var int
	 */
	private $pageNumber;

	/**
	 * number of elements on page
	 *
	 * @var int
	 */
	public $onPage;

	/**
	 * number of visible page numbers
	 *
	 * @var int
	 */
	private $navNum;

	/**
	 * previous page
	 *
	 * @var int
	 */
	private $prev;

	/**
	 * next page
	 *
	 * @var int
	 */
	
	private $next;

	/**
	 * variables needed to create a loop
	 *
	 * @var int
	 */
	private $forstart;
	private $forend;

	/**
	 * number of all pages
	 *
	 * @var int
	 */
	public $allPages;

	/**
	 * number of first element to paging
	 *
	 * @var int
	 */
	public $limit;

	/**
	 * Initializes variables.
	 * 
	 * @param int $total Number of all items
	 * @param int $pageNumber Number of current page
	 * @param int $onPage Number of items per page
	 * @param int $navNum Number of items in navigation
	 *
	 * @return void
	 */
	public function __construct($total, $pageNumber = 1, $onPage = 10, $navNum = 7) {
		print_r($onPage);
		$this->total = (int) $total;
		$this->pageNumber = (int) $pageNumber;
		$this->onPage = (int) $onPage;
		$this->navNum = (int) $navNum;
		
		if(($total) < 0 || ($pageNumber) < 0 || ($onPage) < 0 || ($navNum) < 0) {
			throw new \InvalidArgumentException("Bad pagination params");
		}

		$this->calculationVariables();
	}

	/**
	 * It calculates the variables needed to paging.
	 *
	 * @return void
	 */
	protected function calculationVariables() {
		$this->allPages = ceil($this->total/$this->onPage); // round up quotient all elements and elements on page

		// if page number is greater than number of all elements
		if($this->pageNumber > $this->allPages) 
		{
			$this->pageNumber = 1;
		}

		// from which item
		$this->limit = ($this->pageNumber - 1) * $this->onPage;

		// protection in the event that the number of pages proved to be greater than the number of displayed page numbers
		if($this->navNum > $this->allPages)
		{
			$this->navNum = $this->allPages;
		}
	
		// are calculated here the necessary data to properly build a loop
		$this->forstart = $this->pageNumber - floor($this->navNum / 2);
		$this->forend = $this->forstart + $this->navNum;
	
		if($this->forstart <= 0)
		{
			$this->forstart = 1;
		}
	
		$overend = $this->allPages - $this->forend;
		
		if($overend < 0)
		{ 
			$this->forstart = $this->forstart + $overend + 1;
		}
		
		// This line is repeated due to the fact that $ this-> forstart may have changed
		$this->forend = $this->forstart + $this->navNum; 

		// Variables hold the numbers of the previous and next page
		$this->prev = $this->pageNumber - 1;
		$this->next = $this->pageNumber + 1;
	}

	/**
	 * Calculates the next navigation elements.
	 *
	 * @return array with nav element
	 */
	public function nav() {
		return $array = array(
			'page' => $this->pageNumber,
			'forstart' => $this->forstart,
			'forend' => $this->forend,
			'allpages' => $this->allPages,
			'prev' => $this->prev,
			'next' => $this->next
		);
	}
}
