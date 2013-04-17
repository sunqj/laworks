<?php
function getLocalAddr()
{
	return gethostbyname($_SERVER['SERVER_ADDR']);
}
