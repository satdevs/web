<?php //use Cake\I18n\Time; ?>
<?xml version="1.0" encoding="UTF-8"?>
<SetPimplePay>
<?php
	$ret = '';
	if( !empty($pays) ){
		$ret .= '<item>';
			$ret .= '<transactionId>' . $simplepay->retTransactionId . '</transactionId>';
			$ret .= '<winszlaStatus>' . $simplepay->winszlaStatus . '</winszlaStatus>';
		$ret .= '</item>';
	}else{
		$ret .= '<item>';
			$ret .= '<transactionId>Empty</transactionId>';
			$ret .= '<winszlaStatus>Empty</winszlaStatus>';
		$ret .= '</item>';
	}
	echo $ret;
?>
</SetPimplePay>
<?php die(); ?>
