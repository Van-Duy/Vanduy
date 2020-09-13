<?php
class Form{
    // Create Selectbox
	public static function cmsSelectbox($name, $class, $arrValue, $keySelect = 'default', $style = null)
	{
		$xhtml = '<select style="' . $style . '" name="' . $name . '" class="' . $class . '" >';
		foreach ($arrValue as $key => $value) {
			if ($key == $keySelect && is_numeric($keySelect)) {
				$xhtml .= '<option selected="selected" value = "' . $key . '">' . $value . '</option>';
			} else {
				$xhtml .= '<option value = "' . $key . '">' . $value . '</option>';
			}
		}
		$xhtml .= '</select>';
		return $xhtml;
	}

	// Create Selectbox
	public static function cmsSelectboxNotNumber($name, $class, $arrValue, $keySelect = 'default', $style = null)
	{
		$xhtml = '<select style="' . $style . '" name="' . $name . '" class="' . $class . '" >';
		foreach ($arrValue as $key => $value) {
			if ($key == $keySelect) {
				$xhtml .= '<option selected="selected" value = "' . $key . '">' . $value . '</option>';
			} else {
				$xhtml .= '<option value = "' . $key . '">' . $value . '</option>';
			}
		}
		$xhtml .= '</select>';
		return $xhtml;
	}

}