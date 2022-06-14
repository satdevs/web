<style>
	body{
		font-family: Arial;
		font-size: 10px;
		letter-spacing: .05px;
	}
	table{
		margin-bottom: 20px;
	}
	tr{
		background: transparent;
	}
	th{
		font-size: 12px;
		text-align: center;
		font-family: 'Roboto Condensed', sans-serif;
		border-bottom: 2px solid #000;
		border-top: 1px solid #000;
	}
	td{
		padding-top: 0px;
		padding-bottom: 0px;
		padding-left: 3px;
		font-size: 10px;
		font-family: 'Roboto Condensed', sans-serif;
		text-align: left;
		border-bottom: 1px solid #000;
	}
	p{
		margin: 1px;
		margin-bottom: 0px;
		font-size: 10px;
		font-family: 'Roboto Condensed', sans-serif;
		font-family: 'Oswald', sans-serif;		
	}
	h1{
		font-family: 'Oswald', sans-serif;
		font-family: 'Roboto Condensed', sans-serif;
		margin: 0px;
		font-size: 24px;
	}
	h2{
		font-family: 'Oswald', sans-serif;				/* Keskenyebb */
		font-family: 'Roboto Condensed', sans-serif;	/* Szélesebb */
		margin: 0px;
		font-size: 14px;
		font-weight: bold;
		text-align: left;
	}
	h3{
		font-family: 'Oswald', sans-serif;
		font-family: 'Roboto Condensed', sans-serif;
		text-align: center;
		font-size: 12px;
		margin: 0px;
	}
</style>
<?php
	$margin_left = '';
	$width = 430;
	if($city['City']['name'] == 'Felsőszentiván'){
		$margin_left = 'margin-left: 10px;';
		$width = 680;
	}
?>
<img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/channels/images/logo.png" style="float: left; height: 75px; margin-left: 15px; margin-right: 20px; margin-bottom: 0px; margin-top: 0px;<?php echo $margin_left; ?>" />
<h1 style="text-align: left; margin-bottom: 0px;">Sághy-Sat Kft.</h1>
<p style="font-family: 'Oswald', sans-serif; text-align: left; margin-bottom: 2px; font-size: 13px;">Sághy-Sat Kft. 7754 Bóly, Ady E. u. 9. - Tel.: 69/696-696 - Web: www.saghysat.hu - Email: info@saghysat.hu</p>
<h2 style="margin-bottom: 4px;"><b><?php echo $city['City']['name'];?></b> digitális csatornakiosztása</h2>
<div style="clear: both;"></div>
<div style="float: left; margin-top: 3px; width: <?php echo $width;?>px; <?php echo $margin_left; ?>">
	<table border="0" cellpadding="0" cellspacing="0" style="width: 100%; margin-bottom: 0px;">
		<tr>
			<th style="width: 30px; border-left: 1px solid #000;">Sorszám</th>
			<th style="border-left: 1px solid #000;">Program</th>
			<th style="width: 100px;border-left: 1px solid #000;">Jelleg</th>
			<th style="width: 70px; border-left: 1px solid #000;">Nyelv</th>
			<th style="width: 50px; border-left: 1px solid #000; text-align: center; font-size: 8px; border-right: 1px solid #000;">Családi csomagban<br>fogható</th>
		</tr>		
<?php 
	if($city['City']['name'] != 'Felsőszentiván'){
		$max_lcn = 120;
	}
	if($city['City']['name'] == 'Felsőszentiván'){
		$max_lcn = 999;
	}
	foreach ($programs as $program):
		if($program['PackagesProgram']['lcn']<=$max_lcn){
?>
		<tr>
			<td style="text-align: center; border-left: 1px solid #000;"><?php echo $program['PackagesProgram']['lcn']; ?></td>
			<td style="font-weight: bold; border-left: 1px solid #000;"><?php echo $program['Program']['name'].' '.$program['PackagesProgram']['public_comment']; ?></td>
			<td style="border-left: 1px solid #000;"><?php echo $program['Program']['feature_name']; ?></td>
			<td style="text-align: center; border-left: 1px solid #000;"><?php echo $program['Program']['language']; ?></td>
			<td style="text-align: center; border-left: 1px solid #000; border-right: 1px solid #000;"><?php 
				if($program['PackagesProgram']['packageorder']<3){
					echo "X";
				}
			?></td>
		</tr>
<?php 
		}
	endforeach;
?>

	</table>

</div>


<!-- ############################################# Jobb oldali kis táblácskák ############################################# -->
<?php if($city['City']['name'] != 'Felsőszentiván' ){ ?>
<div style="float: right; width: 270px;">
	<h3>Havidíj ellenében <b>választható digitális csomagjaink</b></h3>
	<table border="0" cellpadding="0" cellspacing="0" style="width: 100%; margin-bottom: 0px;">

<?php 
	$package = '';
	$first=TRUE;
	foreach ($programs as $program):
		if($program['PackagesProgram']['lcn']>120){


			if($package != $program['Package']['popular_name']){
?>
<?php if(!$first){ ?>
		<tr>
			<th colspan="3" style="text-align: center; border: 0px solid #000; height:2px; font-size: 5px;">&nbsp;</th>
		</tr>		
<?php } $first=FALSE; ?>
		<tr>
			<th colspan="3" style="text-align: center; border: 1px solid #000; border-bottom: 2px solid #000;"><?php echo $program['Package']['popular_name']; ?></th>
		</tr>		
<?php } //Új fejléc ?>

		<tr>
			<td style="text-align: center; border-left: 1px solid #000;"><?php echo $program['PackagesProgram']['lcn']; ?></td>
			<td style="font-weight: bold; border-left: 1px solid #000;"><?php echo $program['Program']['name']; ?></td>
			<td style="border-left: 1px solid #000; border-right: 1px solid #000; font-size: 10px;"><?php echo $program['Program']['feature_name']; ?></td>
		</tr>
<?php 
		}
		$package = $program['Package']['popular_name'];
	endforeach;
?>

	</table>
</div>
<?php } //Ha nem felsőszentiván?>

<!-- ############################################# Lábléc ############################################# -->
<div style="clear: both;">
	<p style="float: left; font-size: 10px; <?php echo $margin_left; ?>">A csatornák száma a TV-ben elfoglalt alapbeállítását jelölik. Az egyedileg beállított sorrend ettől eltérő lehet.</p>
	<p style="float: left; font-size: 10px;"><?php echo $last_sentence; ?></p>
	<p style="float: right; font-size: 10px; margin: 0;">File neve: <?php echo $this->pdfConfig['filename']; ?>.pdf</p>
</div>



