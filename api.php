<?php
	/** General api for the nolinks tool
	 *  
	 *  
	 * */
	$FILE = "../../data.txt";
	 
	if (isset($_GET['mode'])){
		$mode = $_GET['mode'];
		
		print(json_encode(getListSegment(0, 1000)));
		
	}
	
	function getListSegment($startAt=0, $number=1000){
		$text = explode("\n", file_get_contents($FILE));	
		$return = array();
		
		if ($startAt < $text){
			$i = $startAt;	
			while ($i < length($text) && $i < $number){
				$t = explode("\t", $text);
				$return[] = $t[0];
			}
		}
		
		return $return;
	}
?>