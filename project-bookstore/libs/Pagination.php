<?php
class Pagination{
	
	private $totalItems;					// Tổng số phần tử
	private $totalItemsPerPage		= 1;	// Tổng số phần tử xuất hiện trên một trang
	private $pageRange				= 5;	// Số trang xuất hiện
	private $totalPage;						// Tổng số trang
	private $currentPage			= 1;	// Trang hiện tại
	
	public function __construct($totalItems, $arrParam){
		$this->totalItems			= $totalItems;
		$this->$totalItemsPerPage	= $arrParam['totalItemsPerPage'];
		
		if($arrParam['pageRange'] %2 == 0) $arrParam['pageRange'] = $arrParam['pageRange'] + 1;
		
		$this->pageRange			= $arrParam['pageRange'];
		$this->currentPage			= $arrParam['currentPage'];
		$this->totalPage			= ceil($totalItems/$arrParam['totalItemsPerPage']);
	}
	

	public function showPagination($link){
		// Pagination
		$paginationHTML = '';
		if($this->totalPage > 1){
			$start 	='<li class="page-item disabled"><a href="" class="page-link"><i class="fas fa-angle-double-left"></i></a></li>';
			$prev 	= '<li class="page-item disabled"><a href="" class="page-link"><i class="fas fa-angle-left"></i></a></li>';
			if($this->currentPage > 1){
				$start 	= '<li class="page-item" onclick="javascript:changPage(1)"><a href="" class="page-link"><i class="fas fa-angle-double-left"></i></a></li>';
				$prev 	= '<li class="page-item" onclick="javascript:changPage('.($this->currentPage-1).')"><a href="" class="page-link"><i class="fas fa-angle-left"></i></a></li>';
			}
		

			$next 	= '<li class="page-item disabled"><a class="page-link" href="#"><i class="fas fa-angle-right"></i></a></li>';
			$end 	= '<li class="page-item disabled"><a class="page-link" href="#"><i class="fas fa-angle-double-right"></i></a></li>';
			if($this->currentPage < $this->totalPage){
				$next 	= ' <li class="page-item" onclick="javascript:changPage('.($this->currentPage+1).')"><a class="page-link" href="#"><i class="fas fa-angle-right"></i></a></li>';
				$end 	= '<li class="page-item" onclick="javascript:changPage('.$this->totalPage.')"><a class="page-link" href="#"><i class="fas fa-angle-double-right"></i></a></li>';
			}
		
			if($this->pageRange < $this->totalPage){
				if($this->currentPage == 1){
					$startPage 	= 1;
					$endPage 	= $this->pageRange;
				}else if($this->currentPage == $this->totalPage){
					$startPage		= $this->totalPage - $this->pageRange + 1;
					$endPage		= $this->totalPage;
				}else{
					$startPage		= $this->currentPage - ($this->pageRange-1)/2;
					$endPage		= $this->currentPage + ($this->pageRange-1)/2;
		
					if($startPage < 1){
						$endPage	= $endPage + 1;
						$startPage = 1;
					}
		
					if($endPage > $this->totalPage){
						$endPage	= $this->totalPage;
						$startPage 	= $endPage - $this->pageRange + 1;
					}
				}
			}else{
				$startPage		= 1;
				$endPage		= $this->totalPage;
			}
		
			for($i = $startPage; $i <= $endPage; $i++){
				if($i == $this->currentPage) {
					$listPages .= '<li class="page-item active"><a class="page-link">'.$i.'</a></li>';
				}else{
					$listPages .= '<li class="page-item" onclick="javascript:changPage('.$i.')"><a class="page-link" href="#">'.$i.'</a></li>';
				}
			}
			//$countAnd 		= '<div class="limit">Page '.$this->currentPage.' of '.$this->totalPage.'</div>';
			$paginationHTML = '<ul class="pagination pagination-sm m-0 float-right">' . $start . $prev . $listPages . $next . $end .'</ul>';
		}
		return $paginationHTML;
	}
}
