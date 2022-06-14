<?xml version="1.0" encoding="UTF-8"?>
<NewPdfInvoices>
<?php
	$ret = '';
	foreach($news as $n){
		$ret .= '<item>';
			$ret .= '<sub_id>'.$n->sub_id.'</sub_id>';
			$ret .= '<activated>'.$n->activated.'</activated>';
			$ret .= '<deactivated>'.$n->deactivated.'</deactivated>';
			$ret .= '<name>'.$n->name.'</name>';
			$ret .= '<city>'.$n->city.'</city>';
			$ret .= '<address>'.$n->address.'</address>';
			$ret .= '<email>'.$n->email.'</email>';
			$ret .= '<phone>'.$n->phone.'</phone>';
			$ret .= '<cb1>'.$n->cb1.'</cb1>';
			$ret .= '<cb2>'.$n->cb2.'</cb2>';
			$ret .= '<cb3>'.$n->cb3.'</cb3>';
			$ret .= '<cb4>'.$n->cb4.'</cb4>';
			$ret .= '<cb5>'.$n->cb5.'</cb5>';
			$ret .= '<type>'.$n->type.'</type>';
			$ret .= '<taxnumber>'.$n->taxnumber.'</taxnumber>';
			$ret .= '<id>'.$n->id.'</id>';
			$ret .= '<hash>'.$n->hash.'</hash>';
		$ret .= '</item>';
	}
	echo $ret;
?>
</NewPdfInvoices>
<?php die(); ?>
