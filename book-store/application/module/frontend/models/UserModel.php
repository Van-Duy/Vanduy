<?php

class UserModel extends Model{
	
	public function __construct(){
		parent::__construct();
		$this->setTable(TBL_CATEGORY);
		
	}

	public function ShowProductInCart(){
			$cart 		= Session::get('cart');
			$carId 		= $cart['quantify'];
			$price 		= $cart['price'];

			if($cart != null){
				$Cid 		=   "(";
				foreach($carId AS $key => $value){
					$Cid .= $key . ",";
				}
				$Cid .= "0)";
			}
			if(isset($Cid)){
				$query[] 	= 'SELECT `id`,`name`,`picture`,`price`,`sale_off`,`category_id`';
				$query[] 	= "FROM `".TBL_BOOK."`";
				$query[] 	= 'WHERE `status` = "active" AND id IN' . $Cid;
				$query[]	= "ORDER BY `ordering` asc";
			
		
				$query		= implode(" ", $query);
				$result		= $this->fetchAll($query);
				
				foreach($result AS $key => $value){
				$result[$key]['quantify']  	= $carId[$value['id']];
				$result[$key]['total'] 		= $price[$value['id']];
				}
			}
			
			
			return $result;
	}

	public function buyProduct($arrParam,$option = null){
		if($option == null){
				$cart 			= Session::get('cart');
				$carId 			= $arrParam['id'];
				$query 			= 'SELECT `price`,`sale_off` FROM '.TBL_BOOK.' WHERE `id` = '.$carId.'';
				$result 		= $this->fetchRow($query);
				$price 			= $result['price'] - ($result['price'] * $result['sale_off'] / 100);
				$quantify   	= ($arrParam['quantify'] != null) ? $arrParam['quantify'] : 1 ;

				if(empty($cart)){
					$cart['quantify'][$carId] 	= $quantify;
					$cart['price'][$carId] 		= $price * $quantify;
	
				}else{
						$cart['quantify'][$carId] 	+= $quantify;
						$cart['price'][$carId] 		= $price * $cart['quantify'][$carId] ;
				}
	
				Session::set('cart',$cart);
				$sumQuantify 	= array_sum($cart['quantify']);
				$sumprice 		= array_sum($cart['price']);
				
				return ['quantify' => $sumQuantify,'price' => $sumprice];
		}
	}

	public function saveProduct($arrParam,$option = null){
		if($option == null){
			$username 		=  (Session::get('user'))['info']['username'];
			$id 			=  $this->randomString(7);
			$carID 			=  json_encode($arrParam['form']['carID']);
			$prices 		=  json_encode($arrParam['form']['price']);
			$quantities 	=  json_encode($arrParam['form']['quantify']);
			$name 			=  json_encode($arrParam['form']['name'],JSON_UNESCAPED_UNICODE);
			$pictures 		=  json_encode($arrParam['form']['picture']);
			$status 		=  0;
			$date 			=  $arrParam['form']['time'];
	
			$query 	= "INSERT INTO `".TBL_CART."` (`id`,`username`,`books`,`prices`,`quantities`,`names`,`pictures`,`status`,`date`)
											VALUES ('$id','$username','$carID','$prices','$quantities','$name','$pictures','$status','$date')";
			$this->query($query);
			Session::delete('cart');
			Session::set('message', array('class' => 'success', 'content' => 'Đã xác nhận đơn hàng !!!..'));
		}
	}

	public function deleteProduct($arrParam,$option = null){
		if($option == null){
			$cart 			= Session::get('cart');
			$carId 			= $arrParam['id'];
			$quantify		= $cart['quantify'][$carId];
			
			unset($cart['quantify'][$carId],$cart['price'][$carId]);
			Session::set('cart',$cart);
			$sumprice 		= array_sum($cart['price']);
			return ['quantify' => $quantify,'sumPrice' => $sumprice];
		}
	}

	public function getProduct(){
		$username 		=  (Session::get('user'))['info']['username'];
		$query[] 		= 'SELECT `id`,`username`,`books`,`prices`,`quantities`,`names`,`pictures`,`date`,`status`';
		$query[] 		= "FROM `".TBL_CART."`";
		$query[] 		= 'WHERE `username` = "'.$username .'"';
		$query[]		= "ORDER BY `date` desc";

		$query		= implode(" ", $query);
		$result		= $this->fetchAll($query);
		return $result;
	}

	public function changeQuantify($arrParam,$option = null){
		if($option == null){
			$cart 						= Session::get('cart');
			$carId 						= $arrParam['id'];
			$query 						= 'SELECT `price`,`sale_off` FROM '.TBL_BOOK.' WHERE `id` = '.$carId.'';
			$result 					= $this->fetchRow($query);
			$priceOld 					= $result['price'] - ($result['price'] * $result['sale_off'] / 100);
			

			$quantify					= $arrParam['quantify'];
			$change						= $quantify - $cart['quantify'][$carId];
			$cart['price'][$carId]		= $priceOld * $quantify;
			$cart['quantify'][$carId]	= $quantify;
			Session::set('cart',$cart);
			$sumQuantify 				= array_sum($cart['quantify']);
			$sumPrice 					= array_sum($cart['price']);

			if($change > 0){
				$message = 'Đã tăng '.$change.' sản phẩm thành công';
			}else{
				$message = 'Đã giảm '.abs($change).' sản phẩm thành công';
			}
			return ['message' => $message,'sumQuantify' => $sumQuantify,'sumPrice' => $sumPrice];
		}
	}

	public function getUser(){
		$username 		=  (Session::get('user'))['info']['username'];
		$query[] 		= 'SELECT `id`,`username`,`password`,`email`,`fullname`,`address`,`phone`';
		$query[] 		= "FROM `".TBL_USER."`";
		$query[] 		= 'WHERE `username` = "'.$username .'"';
		$query		= implode(" ", $query);
		$result		= $this->fetchRow($query);
		return $result;
	}

	public function savePassWord($arrParam,$option = null){
		if($option == null){
			$username 		=  (Session::get('user'))['info']['username'];
			$pass 			= md5($arrParam['passWordNew']);
			$where          = "Update `user` SET `password` = '$pass' WHERE  `username` = '" . $username . "'";
			$this->query($where);
			Session::set('message', array('class' => 'success', 'content' => 'Cập nhật mật khẩu mới thành công .'));
		}
	}

	public function updateUser($arrParam,$option = null){
		if($option == null){
			$email 			= $arrParam['email'];
			$fullname 		= $arrParam['fullname'];
			$phone 			= $arrParam['phone'];
			$address 		= $arrParam['address'];

			$where          = "Update `user` SET `fullname` = '$fullname',`phone` = '$phone',`address` = '$address' WHERE  `email` = '" . $email . "'";
			$this->query($where);
			Session::set('message',array('class' => 'success','content' =>'Cập nhật dữ liệu thành công !!!'));
		}
	}

	private  function randomString($length = 5){
	
		$arrCharacter = array_merge(range('a','z'), range(0,9));
		@$arrCharacter = implode($arrCharacter, '');
		$arrCharacter = str_shuffle($arrCharacter);
	
		$result		= substr($arrCharacter, 0, $length);
		return $result;
	}
}