<?php

function is_valid_email($email) {
	if (!mb_eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", trim($email)))
	{
		return false;
	}
	return true;
}
?>