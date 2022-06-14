<?php
namespace App\Controller\Component;
use Cake\Controller\Component;

class MyComponent extends Component{

	//-------- Adott hosszban állít elő véletlen karakterláncot --------------------
	public function generateRandomString($length = 8) {
	    //$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    //$characters = "0123456789ABCDEFGHIJKLMNOPRSTUVXYZ";
	    $characters = "123456789ABCDEFGHIJKL123456789MNPRSTUVXYZ123456789ABCDEFGHIJKL123456789MNPRSTUVXYZ";
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	    	if( rand(0,9) >=5 ){
		        $randomString .= strtolower($characters[rand(0, $charactersLength - 1)]);
	    	}else{
	        	$randomString .= $characters[rand(0, $charactersLength - 1)];	    		
	    	}
	    }
	    //return '123456789A';
	    //return 'BCDEFGHIJK';
	    //return 'LMNPRSTUVX';
	    //return 'NPRSTUVXYZ';
	    return $randomString;
	}

	//-------- Stringet alakít át pl.: Szóközöket helyettesíti _ -val és még sok minden más...
    public static function normalizeString($str = ''){
        $str = strip_tags($str); 
        $str = preg_replace('/[\r\n\t ]+/', ' ', $str);
        $str = preg_replace('/[\"\*\/\:\<\>\?\'\|]+/', ' ', $str);
        $str = iconv('utf-8','iso-8859-2//TRANSLIT', $str);	//Zs.
		$str = strtolower($str);
        $str = iconv('iso-8859-2','utf-8//TRANSLIT', $str);	//Zs.
        $str = html_entity_decode( $str, ENT_QUOTES, "utf-8" );
        $str = htmlentities($str, ENT_QUOTES, "utf-8");
        $str = preg_replace("/(&)([a-z])([a-z]+;)/i", '$2', $str);
        $str = str_replace(' ', '-', $str);
        $str = rawurlencode($str);
        $str = str_replace('%', '-', $str);
        return $str;
    }

    //http://php.net/manual/en/function.array-multisort.php
    //---------- Több dimenziós tömb sorbarendezése...
    //Pl.: $descartes = $this->My->array_msort($descartes, array('catv'=>SORT_DESC, 'net'=>SORT_DESC, 'tel'=>SORT_DESC));
	public function array_msort($array, $cols)	{
	    $colarr = array();
	    foreach ($cols as $col => $order) {
	        $colarr[$col] = array();
	        foreach ($array as $k => $row) { $colarr[$col]['_'.$k] = strtolower($row[$col]); }
	    }
	    $eval = 'array_multisort(';
	    foreach ($cols as $col => $order) {
	        $eval .= '$colarr[\''.$col.'\'],'.$order.',';
	    }
	    $eval = substr($eval,0,-1).');';
	    eval($eval);
	    $ret = array();
	    foreach ($colarr as $col => $arr) {
	        foreach ($arr as $k => $v) {
	            $k = substr($k,1);
	            if (!isset($ret[$k])) $ret[$k] = $array[$k];
	            $ret[$k][$col] = $array[$k][$col];
	        }
	    }
	    return $ret;
	}


	//--------------------------- DESCARTES SZORZAT RÉSZHALMAZÁNAK KIIRATÁSA ------------------------
	public function print_array($array, $die=null)	{
		echo "<pre>";
		$bg = "";
		$i = 0;
		// width="80%" 
		echo '<table border="1" align="center" cellpadding="0" cellspacing="0" style="border: 3px double #ccc;">';
		$first = true;
		foreach ($array as $d) {
			//if($bg != $d['net']){
			//	$bgcolor =  "#ffffff";
			//}
			if($first){
				echo "<tr>";
				echo '<th style="background: #efefef; color: #888; padding: 5px 10px; border: 1px solid #ccc; border-bottom: 1px solid #333;">#</th>';
				foreach ($d as $row => $value) {
					echo '<th style="padding: 5px 10px; border: 1px solid #ccc; border-bottom: 1px solid #333;">'.$row.'</th>';
					$first = false;
				}
				echo "</tr>";
			}
			echo "<tr>";
				echo '<td align="center" style="font-size: 16px; padding: 5px; background: #efefef; color: #888; border: 1px solid #ccc;">#'.$i++."</td>";
				foreach ($d as $row => $value) {
					$align = "center";
					if(gettype($value)=="string"){
						$align = "left";
					}
					$color = "#000";
					if(gettype($value)=="integer" && $value==0){
						$color = "#ccc";
					}
					echo '<td align="'.$align.'" style="color: '.$color.';font-size: 16px; padding: 5px 10px; font-weight: bold;  border: 1px solid #ccc;">'.$value."</td>";
				}
			echo "</tr>";
			//$bg = $d['net'];
		}
		echo "</table>";
		//--------------------------- /.DESCARTES SZORZAT RÉSZHALMAZÁNAK KIIRATÁSA ------------------------
		if($die){
			die();
		}
	}


	//--------------- ARRAY SUPER UNIQUE - ERROR!!!!! ----------------------
	public function super_unique($array) {
	  $result = array_map("unserialize", array_unique(array_map("serialize", $array)));
	  foreach ($result as $key => $value)	  {
	    if ( is_array($value) )	    {
	      $result[$key] = super_unique($value);
	    }
	  }
	  return $result;
	}

	//--------------- /.ARRAY SUPER UNIQUE ----------------------





}

?>