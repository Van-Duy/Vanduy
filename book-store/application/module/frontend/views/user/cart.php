<?php
$nameCart    	= HtmlFront::createNameLogin('Giỏ hàng');
$html 		= "";

if (!empty($this->items)) {
	foreach ($this->items as $value) {
		$id 			= $value['id'];
		$list 			= $value['category_id'];
		$name 			= $value['name'];
		$picture 		= $value['picture'];
		$price 			= $value['price'];
		$quantify 		= $value['quantify'];
		$sale_off 		= $value['sale_off'];
		$priceAffSaleN  = ($price - ($price * $sale_off / 100)) * $quantify;
		$priceAffSale   = number_format($price - ($price * $sale_off / 100));
		$img        	= Html::createImageSrc($picture, $picture, 'book', '252x323-');
		$link       	= URL::createLink($this->arrParam['module'], 'category', 'list', ['list' => $list, 'id' => $id]);
		$totalPrice		+= $priceAffSaleN;

		$productInCart 		= HtmlFront::createproductCart($name, $sale_off, $link, $img, $price, $id, $quantify);
		$inputID			= Html::cmsInput("form[carID][]", "hidden", "", $id, $id);
		$inputName			= Html::cmsInput("form[name][]", "hidden", "", $name, $id);
		$inputQuantify		= Html::cmsInput("form[quantify][]", "hidden", "", $quantify, $id);
		$inputPrice			= Html::cmsInput("form[price][]", "hidden", "", $priceAffSale, $id);
		$inputPicture		= Html::cmsInput("form[picture][]", "hidden", "", $picture, $id);
		$inputTime			= Html::cmsInput("form[time]", "hidden", "", date(" Y-m-d H:i:s", time()));

		$html .= $productInCart . $inputID . $inputName . $inputQuantify . $inputPrice . $inputPicture . $inputTime;
	}
}
$sumCart 		= HtmlFront::sumCart('Tổng', number_format($totalPrice), $totalPrice);
$linkContiBuy 	= URL::createLink($this->arrParam['module'], 'category', 'index','','category.html');

?>

<?php echo $nameCart; ?>

<form action="" method="POST" name="admin-form" id="admin-form">
	<section class="cart-section section-b-space">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<table class="table cart-table table-responsive-xs">
						<thead>
							<tr class="table-head">
								<th scope="col">Hình ảnh</th>
								<th scope="col">Tên sách</th>
								<th scope="col">Giá</th>
								<th scope="col">Số Lượng</th>
								<th scope="col"></th>
								<th scope="col">Thành tiền</th>
							</tr>
						</thead>
						<tbody>
							<?php echo $html; ?>
						</tbody>

					</table>
					<?php echo $sumCart; ?>
				</div>
			</div>
			<div class="row cart-buttons">
				<div class="col-6"><a href="<?php echo $linkContiBuy; ?>" class="btn btn-solid">Tiếp tục mua sắm</a></div>
				<div class="col-6"><button type="submit" class="btn btn-solid">Đặt hàng</button></div>
			</div>
		</div>
	</section>
</form>