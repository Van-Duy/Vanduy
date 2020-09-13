<?php
class Pagination
{

	public $totalItems;					// Tổng số phần tử
	public $totalItemsPerPage		= 1;	// Tổng số phần tử xuất hiện trên một trang
	public $pageRange				= 5;	// Số trang xuất hiện
	public $totalPage;						// Tổng số trang
	public $currentPage				= 1;	// Trang hiện tại

	public function __construct($totalItems, $arrParam)
	{
		$this->totalItems			= $totalItems;
		$this->totalItemsPerPage	= $arrParam['totalItemsPerPage'];

		if ($arrParam['pageRange'] % 2 == 0) $arrParam['pageRange'] = $arrParam['pageRange'] + 1;

		$this->pageRange			= $arrParam['pageRange'];
		$this->currentPage			= $arrParam['currentPage'];
		$this->totalPage			= ceil($totalItems / $arrParam['totalItemsPerPage']);
	}


	public function showPagination($link)
	{
		// Pagination
		$paginationHTML = '';

		//Nối đường dẫn
		$queryStr = $_SERVER['QUERY_STRING'];
		$arr = [];
		parse_str($queryStr, $arr);
		unset($arr['filter_page']);
		$queryString = http_build_query($arr);
		$link = 'index.php?' . $queryString . '&filter_page=';


		if ($this->totalPage > 1) {
			$start 	= '<li class="page-item disabled"><a href="" class="page-link"><i class="fas fa-angle-double-left"></i></a></li>';
			$prev 	= '<li class="page-item disabled"><a href="" class="page-link"><i class="fas fa-angle-left"></i></a></li>';
			if ($this->currentPage > 1) {
				$start 	= ' <li class="page-item"><a class="page-link" href="' . $link . '1"><i class="fas fa-angle-double-left"></i></a></li>';
				$prev 	= '<li class="page-item" ><a class="page-link" href="' . $link . ($this->currentPage - 1) . '"><i class="fas fa-angle-left"></i></a></li>';
			}
			$next 	= '<li class="page-item disabled"><a class="page-link" href="#"><i class="fas fa-angle-right"></i></a></li>';
			$end 	= '<li class="page-item disabled"><a class="page-link" href="#"><i class="fas fa-angle-double-right"></i></a></li>';
			if ($this->currentPage < $this->totalPage) {
				$next 	= ' <li class="page-item"><a class="page-link" href="' . $link . ($this->currentPage + 1) . '"><i class="fas fa-angle-right"></i></a></li>';
				$end 	= '<li class="page-item"><a class="page-link" href="' . $link . ($this->totalPage) . '"><i class="fas fa-angle-double-right"></i></a></li>';
			}

			if ($this->pageRange < $this->totalPage) {
				if ($this->currentPage == 1) {
					$startPage 	= 1;
					$endPage 	= $this->pageRange;
				} else if ($this->currentPage == $this->totalPage) {
					$startPage		= $this->totalPage - $this->pageRange + 1;
					$endPage		= $this->totalPage;
				} else {
					$startPage		= $this->currentPage - ($this->pageRange - 1) / 2;
					$endPage		= $this->currentPage + ($this->pageRange - 1) / 2;

					if ($startPage < 1) {
						$endPage	= $endPage + 1;
						$startPage = 1;
					}

					if ($endPage > $this->totalPage) {
						$endPage	= $this->totalPage;
						$startPage 	= $endPage - $this->pageRange + 1;
					}
				}
			} else {
				$startPage		= 1;
				$endPage		= $this->totalPage;
			}

			$listPages = "";
			for ($i = $startPage; $i <= $endPage; $i++) {
				if ($i == $this->currentPage) {
					$listPages .= '<li class="page-item active"><a class="page-link">' . $i . '</a></li>';
				} else {
					$listPages .= '<li class="page-item" ><a class="page-link" href="' . $link . $i . '">' . $i . '</a></li>';
				}
			}
			$paginationHTML = '<ul class="pagination pagination-sm m-0 float-right">' . $start . $prev . $listPages . $next . $end . '</ul>';
		}
		return $paginationHTML;
	}

	public function showPaginationCategory($link)
	{
		// Pagination
		$paginationHTML = '';

		//Nối đường dẫn
		$queryStr = $_SERVER['QUERY_STRING'];
		$arr = [];
		parse_str($queryStr, $arr);
		unset($arr['filter_page']);
		$queryString = http_build_query($arr);
		$link = 'index.php?' . $queryString . '&filter_page=';


		// <li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
		// <li> <a href="#" aria-label="Next"><span aria-hidden="true">»</span> </a> </li>



		if ($this->totalPage > 1) {
			$start 	= '<li class=" disabled"><a href=""><span class="fas fa-angle-double-left">Start</span></a></li>';
			$prev 	= '<li class=" disabled"><a href=""><span class="fas fa-angle-left"></span>«</a></li>';
			if ($this->currentPage > 1) {
				$start 	= ' <li class=""><a  href="' . $link . '1"><span>Start</span></a></li>';
				$prev 	= '<li class="" ><a  href="' . $link . ($this->currentPage - 1) . '"><span >«</span></a></li>';
			}
			$next 	= '<li class=" disabled"><a  href="#"><span class="fas fa-angle-right">»</span></a></li>';
			$end 	= '<li class=" disabled"><a  href="#"><span class="fas fa-angle-double-right">End</span></a></li>';
			if ($this->currentPage < $this->totalPage) {
				$next 	= ' <li class=""><a  href="' . $link . ($this->currentPage + 1) . '"><span>»</span></a></li>';
				$end 	= '<li class=""><a  href="' . $link . ($this->totalPage) . '"><span >End</span></a></li>';
			}

			if ($this->pageRange < $this->totalPage) {
				if ($this->currentPage == 1) {
					$startPage 	= 1;
					$endPage 	= $this->pageRange;
				} else if ($this->currentPage == $this->totalPage) {
					$startPage		= $this->totalPage - $this->pageRange + 1;
					$endPage		= $this->totalPage;
				} else {
					$startPage		= $this->currentPage - ($this->pageRange - 1) / 2;
					$endPage		= $this->currentPage + ($this->pageRange - 1) / 2;

					if ($startPage < 1) {
						$endPage	= $endPage + 1;
						$startPage = 1;
					}

					if ($endPage > $this->totalPage) {
						$endPage	= $this->totalPage;
						$startPage 	= $endPage - $this->pageRange + 1;
					}
				}
			} else {
				$startPage		= 1;
				$endPage		= $this->totalPage;
			}

			$listPages = "";
			for ($i = $startPage; $i <= $endPage; $i++) {
				if ($i == $this->currentPage) {
					$listPages .= '<li class="active"><a href="#">' . $i . '<span class="sr-only">(current)</span></a></li>';
				} else {
					$listPages .= ' <li><a href="' . $link . $i . '">' . $i . '<span class="sr-only"></span></a></li>';
				}
			}
			$paginationHTML = '<ul class="pagination">' . $start . $prev . $listPages . $next . $end . '</ul>';
		}
		return $paginationHTML;
	}

	public function showPaginationFront($link)
	{
		// Pagination
		$paginationHTML = '';

		//Nối đường dẫn
		$queryStr = $_SERVER['QUERY_STRING'];
		$arr = [];
		parse_str($queryStr, $arr);
		unset($arr['filter_page']);
		$queryString = http_build_query($arr);
		$link = 'index.php?' . $queryString . '&filter_page=';


		if ($this->totalPage > 1) {
			$start 	= '<li class="page-item disabled"><a href="" class="page-link"><i class="fa fa-angle-double-left"></i></a></li>';
			$prev 	= '<li class="page-item disabled"><a href="" class="page-link"><i class="fa fa-angle-left"></i></a></li>';
			if ($this->currentPage > 1) {
				$start 	= ' <li class="page-item"><a class="page-link" href="' . $link . '1"><i class="fa fa-angle-double-left"></i></a></li>';
				$prev 	= '<li class="page-item" ><a class="page-link" href="' . $link . ($this->currentPage - 1) . '"><i class="fa fa-angle-left"></i></a></li>';
			}
			$next 	= '<li class="page-item disabled"><a class="page-link" href="#"><i class="fa fa-angle-right"></i></a></li>';
			$end 	= '<li class="page-item disabled"><a class="page-link" href="#"><i class="fa fa-angle-double-right"></i></a></li>';
			if ($this->currentPage < $this->totalPage) {
				$next 	= ' <li class="page-item"><a class="page-link" href="' . $link . ($this->currentPage + 1) . '"><i class="fa fa-angle-right"></i></a></li>';
				$end 	= '<li class="page-item"><a class="page-link" href="' . $link . ($this->totalPage) . '"><i class="fa fa-angle-double-right"></i></a></li>';
			}

			if ($this->pageRange < $this->totalPage) {
				if ($this->currentPage == 1) {
					$startPage 	= 1;
					$endPage 	= $this->pageRange;
				} else if ($this->currentPage == $this->totalPage) {
					$startPage		= $this->totalPage - $this->pageRange + 1;
					$endPage		= $this->totalPage;
				} else {
					$startPage		= $this->currentPage - ($this->pageRange - 1) / 2;
					$endPage		= $this->currentPage + ($this->pageRange - 1) / 2;

					if ($startPage < 1) {
						$endPage	= $endPage + 1;
						$startPage = 1;
					}

					if ($endPage > $this->totalPage) {
						$endPage	= $this->totalPage;
						$startPage 	= $endPage - $this->pageRange + 1;
					}
				}
			} else {
				$startPage		= 1;
				$endPage		= $this->totalPage;
			}

			$listPages = "";
			for ($i = $startPage; $i <= $endPage; $i++) {
				if ($i == $this->currentPage) {
					$listPages .= '<li class="page-item active"><a class="page-link">' . $i . '</a></li>';
				} else {
					$listPages .= '<li class="page-item" ><a class="page-link" href="' . $link . $i . '">' . $i . '</a></li>';
				}
			}
			$paginationHTML = '<nav aria-label="Page navigation"><nav><ul class="pagination">' . $start . $prev . $listPages . $next . $end . '</ul></nav></nav>';
		}
		return $paginationHTML;
	}
}
