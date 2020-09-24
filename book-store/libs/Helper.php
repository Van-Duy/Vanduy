<?php
class Helper
{

	// creat status
	public static function creatStatus($name, $class, $arrParam, $keySelect = 2, $with = null, $id = null, $data = null)
	{
		$html = '<select style="' . $with . '" name="' . $name . '" class="' . $class . '" id="' . $id . '" data="' . $data . '" >';
		if (isset($arrParam) && $arrParam != 'default') {
			foreach ($arrParam as $key => $value) {
				if ($key == $keySelect) {
					$html .= '<option selected="selected" value="' . $key . '">' . $value . '</option>';
				} else {
					$html .= '<option value="' . $key . '">' . $value . '</option>';
				}
			}
		} else {
			$html .= '<option value="">- Select Status -</option>';
		}
		$html .= '</select>';
		return $html;
	}

	// Create Button
	public static function cmsButton($name, $id, $link, $icon, $type = 'new')
	{
		$xhtml  = '<li class="button" id="' . $id . '">';
		if ($type == 'new') {
			$xhtml .= '<a class="modal" href="' . $link . '"><span class="' . $icon . '"></span>' . $name . '</a>';
		} else if ($type == 'submit') {
			$xhtml .= '<a class="modal" href="#" onclick="javascript:submitForm(\'' . $link . '\');"><span class="' . $icon . '"></span>' . $name . '</a>';
		}
		$xhtml .= '</li>';

		return $xhtml;
	}

	// Create Icon Status
	public static function cmsStatus($statusValue, $link, $id)
	{
		$strStatus = ($statusValue == 0) ? 'unpublish' : 'publish';

		$xhtml		= '<a class="jgrid" id="status-' . $id . '" href="javascript:changeStatus(\'' . $link . '\');">
							<span class="state ' . $strStatus . '"></span>
						</a>';
		return $xhtml;
	}

	// Create Icon Special
	public static function cmsSpecial($statusValue, $link, $id)
	{
		$strStatus = ($statusValue == 0) ? 'unpublish' : 'publish';

		$xhtml		= '<a class="jgrid" id="special-' . $id . '" href="javascript:changeSpecial(\'' . $link . '\');">
							<span class="state ' . $strStatus . '"></span>
						</a>';
		return $xhtml;
	}

	// Create Icon Group ACP
	public static function cmsGroupACP($groupAcpValue, $link, $id)
	{
		$strGroupACP 	= ($groupAcpValue == 0) ? 'unpublish' : 'publish';

		$xhtml			= '<a class="jgrid" id="group-acp-' . $id . '" href="javascript:changeGroupACP(\'' . $link . '\');">
								<span class="state ' . $strGroupACP . '"></span>
							</a>';
		return $xhtml;
	}

	// Create Title sort
	public static function cmsLinkSort($name, $column, $columnPost, $orderPost)
	{
		$img	= '';
		$order	= ($orderPost == 'desc') ? 'asc' : 'desc';
		if ($column == $columnPost) {
			$img	= '<img src="' . TEMPLATE_URL . 'admin/main/images/admin/sort_' . $orderPost . '.png" alt="">';
		}
		$xhtml = '<a href="#" onclick="javascript:sortList(\'' . $column . '\',\'' . $order . '\')">' . $name . $img . '</a>';
		return $xhtml;
	}

	// Create Message
	public static function cmsMessage($message)
	{
		$xhtml = '';
		if (!empty($message)) {
			$xhtml = '<dl id="system-message">
							<dt class="' . $message['class'] . '">' . ucfirst($message['class']) . '</dt>
							<dd class="' . $message['class'] . ' message">
								<ul>
									<li>' . $message['content'] . '</li>
								</ul>
							</dd>
						</dl>';
		}
		return $xhtml;
	}

	// Create Input
	public static function cmsInput($type, $name, $id, $value, $class = null, $size = null)
	{
		$strSize	=	($size == null) ? '' : "size='$size'";
		$strClass	=	($class == null) ? '' : "class='$class'";

		$xhtml = "<input type='$type' name='$name' id='$id' value='$value' $strClass $strSize>";

		return $xhtml;
	}

	// Create Row - ADMIN
	public static function cmsRowForm($lblName, $input, $require = false)
	{
		$strRequired = '';
		if ($require == true) $strRequired = '<span class="star">&nbsp;*</span>';
		$xhtml = '<li><label>' . $lblName . $strRequired . '</label>' . $input . '</li>';

		return $xhtml;
	}

	// Create Row - PUBLIC
	public static function cmsRow($lblName, $input, $submit = false)
	{
		if ($submit == false) {
			$xhtml = '<div class="form_row"><label class="contact"><strong>' . $lblName . ':</strong></label>' . $input . '</div>';
		} else {
			$xhtml = '<div class="form_row">' . $input . '</div>';
		}
		return $xhtml;
	}

	// Formate Date
	public static function formatDate($format, $value)
	{
		$result = '';
		if (!empty($value) && $value != '0000-00-00') {
			$result = date($format, strtotime($value));
		}
		return $result;
	}

	// Create Image
	public static function createImage($folder, $prefix, $pictureName, $attribute = null)
	{

		$class	= !empty($attribute['class']) ? $attribute['class'] : '';
		$width	= !empty($attribute['width']) ? $attribute['width'] : '';
		$height	= !empty($attribute['height']) ? $attribute['height'] : '';
		$strAttribute	= "class='$class' width='$width' height='$height'";

		$picturePath	= UPLOAD_PATH . $folder . DS . $prefix . $pictureName;
		if (file_exists($picturePath) == true) {
			$picture		= '<img  ' . $strAttribute . ' src="' . UPLOAD_URL . $folder . DS . $prefix . $pictureName . '">';
		} else {
			$picture	= '<img ' . $strAttribute . ' src="' . UPLOAD_URL . $folder . DS . $prefix . 'default.jpg' . '">';
		}

		return $picture;
	}

	// Create Title - Default
	public static function createTitle($imageURL, $titleName)
	{
		$xhtml = '<div class="title">
						<span class="title_icon"><img src="' . $imageURL . '" alt="" title=""></span>' . $titleName . '
					</div>';
		return $xhtml;
	}

	// Create Item Checkbox
	public static function showItemCheckbox($id)
	{
		$xhtml = '
		<div class="custom-control custom-checkbox">
			<input class="custom-control-input" type="checkbox" id="checkbox-' . $id . '" name="checkbox[]" value="' . $id . '">
			<label for="checkbox-' . $id . '" class="custom-control-label"></label>
		</div>
		';
		return $xhtml;
	}

	// Create Item State
	public static function showItemState($link, $state)
	{
		$class = 'danger';
		$icon = 'minus';
		if ($state == 'active' || $state == 1) {
			$class = 'success';
			$icon = 'check';
		}

		$xhtml = '
		<a href="' . $link . '" class="my-btn-state rounded-circle btn btn-sm btn-' . $class . '"><i class="fas fa-' . $icon . '"></i></a>
		';
		return $xhtml;
	}

	// Create Item ACP
	public static function showItemACP($link, $state)
	{
		$class = 'success';
		$icon = 'check';
		if ($state == 0) {
			$class = 'danger';
			$icon = 'minus';
		}

		$xhtml = '
		<a href="javascript:void(0)" onclick="changeACP(\'' . $link . '\')" class="my-btn-state rounded-circle btn btn-sm btn-' . $class . '"><i class="fas fa-' . $icon . '"></i></a>
		';
		return $xhtml;
	}

	// Create Item ACP
	public static function showItemSpecial($link, $state)
	{
		$class = 'success';
		$icon = 'check';
		if ($state == 0) {
			$class = 'danger';
			$icon = 'minus';
		}

		$xhtml = '
		<a href="javascript:void(0)" onclick="changeSpecial(\'' . $link . '\')" class="my-btn-state rounded-circle btn btn-sm btn-' . $class . '"><i class="fas fa-' . $icon . '"></i></a>
		';
		return $xhtml;
	}

	// Create Item showHome
	public static function showItemShowHome($link, $state)
	{
		$class = 'success';
		$icon = 'check';
		if ($state == 'inactive') {
			$class = 'danger';
			$icon = 'minus';
		}

		$xhtml = '
		<a href="javascript:void(0)" onclick="changeShowHome(\'' . $link . '\')" class="my-btn-state rounded-circle btn btn-sm btn-' . $class . '"><i class="fas fa-' . $icon . '"></i></a>
		';
		return $xhtml;
	}

	// Create Item History
	public static function showItemHistory($by, $time)
	{
		$xhtml = '
		<p class="mb-0 history-by"><i class="far fa-user"> ' . $by . '</i></p>
        <p class="mb-0 history-time"><i class="far fa-clock"> ' . $time . '</i></p>
		';
		return $xhtml;
	}

	// Create Item name - email
	public static function showItemNameEmail($by, $time)
	{
		$xhtml = '
		<p class="mb-0 history-by"><i class="far fa-user"> ' . $by . '</i></p>
        <p class="mb-0 history-time"><i class="far fa-envelope"> ' . $time . '</i></p>
		';
		return $xhtml;
	}

	// Create Item id - username
	public static function showItemIdUsername($by, $time)
	{
		$xhtml = '
		<p class="mb-0 history-by"><i class="fas fa-shopping-cart"> ' . $by . '</i></p>
        <p class="mb-0 history-time"><i class="far fa-user"> ' . $time . '</i></p>
		';
		return $xhtml;
	}

	// Create Item ordering
	public static function showItemOrdering($id, $value, $name = 'chkOrdering')
	{
		$xhtml = '<input type="number" name="' . $name . '" value="' . $value . '" id="' . $id . '" class="chkOrdering form-control
					 form-control-sm m-auto text-center"style="width: 65px" min="1">
		';
		return $xhtml;
	}

	// Create Item ordering
	public static function showItemQuanti($id, $value, $name = 'chkOrdering')
	{
		$xhtml = '<input type="number" name="' . $name . '" value="' . $value . '" id="' . $id . '" class="chkOrdering form-control
					 form-control-sm text-center"style="width: 65px" min="1">
		';
		return $xhtml;
	}

	// Create Item select
	public static function showItemSelect($name, $arrParam, $keySelect, $id, $style = 'unset')
	{

		$xhtml = '<select style="width: ' . $style . '" name="' . $name . '" class="custom-select custom-select-sm text-white bg-warning" id="' . $id . '">';
		if (isset($arrParam)) {
			foreach ($arrParam as $key => $value) {
				if ($value == $keySelect) {
					$xhtml .= '<option selected="selected" value="' . $key . '">' . $value . '</option>';
				} else {
					$xhtml .= '<option value="' . $key . '">' . $value . '</option>';
				}
			}
		}
		$xhtml .= '</select>';
		return $xhtml;
	}

	// Create Item select number
	public static function showItemSelectNumber($name, $arrParam, $keySelect, $id, $style = 'unset')
	{

		$xhtml = '<select style="width: ' . $style . '" name="' . $name . '" class="custom-select custom-select-sm text-white bg-warning" id="' . $id . '">';
		if (isset($arrParam)) {
			foreach ($arrParam as $key => $value) {
				if ($key == $keySelect) {
					$xhtml .= '<option selected="selected" value="' . $key . '">' . $value . '</option>';
				} else {
					$xhtml .= '<option value="' . $key . '">' . $value . '</option>';
				}
			}
		}
		$xhtml .= '</select>';
		return $xhtml;
	}

	// HightLight
	public static function highLight($input, $searchValue)
	{
		$result = $input;
		if ($searchValue != '') {
			$result = preg_replace("/" . preg_quote($searchValue, "/") . "/i", "<mark>$0</mark>", $input);
		}
		return $result;
	}

	// HightLight
	public static function formatPrice($price, $dec_point = '.', $thousands_sep = ',', $denominations)
	{
		return (number_format($price, 0, $dec_point, $thousands_sep)) . $denominations;
	}
}
