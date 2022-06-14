<?php use Cake\I18n\Time; ?>
<?xml version="1.0" encoding="UTF-8"?>
<NewPimplePays>
<?php
	$ret = '';
	foreach($pays as $p){
		$ret .= '<item>';
			$ret .= '<id>'.$p->id.'</id>';
			$date = Time::parse($p->ipnPaymentDate);
			$ret .= '<date>'.$date->i18nFormat('yyyy.MM.dd. HH:mm').'</date>';
			$ret .= '<sub_id>'.$p->sub_id.'</sub_id>';
			$ret .= '<name>'.$p->name.'</name>';
			$ret .= '<amount>'.$p->amount.'</amount>';
			$ret .= '<transactionId>'.$p->transaction_id.'</transactionId>';
			$ret .= '<ipnSalt>'.$p->ipnSalt.'</ipnSalt>';
		$ret .= '</item>';
	}
	
	if( empty($pays) ){
		$ret .= '<item>';
			$ret .= '<id>Üres</id>';
			$ret .= '<date>Üres</date>';
			$ret .= '<sub_id>Üres</sub_id>';
			$ret .= '<name>Üres</name>';
			$ret .= '<amount>Üres</amount>';
			$ret .= '<transactionId>Üres</transactionId>';
			$ret .= '<ipnSalt>Üres</ipnSalt>';
		$ret .= '</item>';
	}
	
	echo $ret;
?>
</NewPimplePays>
<?php die(); ?>
