<?php
	/** General api for the nolinks tool
	 *  
	 *  
	 * */

	require "/home/bjelleklang/public_html/db.php";

	if (isset($_GET['mode'])){
		$mode = $_GET['mode'];
		$data = "";
        $p = 0;

		if ($mode == "list"){
            if (isset($_GET['p'])){
                $p = $_GET['p'];
            }
			$data = getListSegment($p*1000);
		} else if ($mode == "count"){
			$data = getNumArticles();
		} else if ($mode == "remove" && isset($_GET['p'])){
            removeArticle($_GET['p']);
        }

		print json_encode($data);
	}

	
	function getListSegment($p){
		$db = getDbConn();
		$q = "SELECT pageid, pagetitle, pagelen, numlinks FROM nolinks WHERE checked = 0 LIMIT 1000" 
			. " OFFSET " . mysql_real_escape_string($p) . ";";

        $return = array();

        $tmp = mysql_query($q);
        while ($data = mysql_fetch_row($tmp)){
            $return[] = $data;
        }

		return $return;
	}

    function getNumArticles(){
        $db = getDbConn();

        $q = "SELECT COUNT(pageid) as NUM FROM nolinks WHERE checked = 0";
    	$tmp = mysql_fetch_assoc(mysql_query($q));
	    return $tmp;
    }

    function removeArticle($p){
//        if (!isBlocked($_SERVER['REMOTE_ADDR'])){
            $db = getDbConn();
            $q = "UPDATE nolinks SET checked = 1 WHERE pageid = " . mysql_real_escape_string($p);
            mysql_query($q);

            vRegister($_SERVER['REMOTE_ADDR'], $p);
 //       }
    }

    function isBlocked($ip){
        $db = getDbConn();
        $q = "SELECT ip FROM blocklist WHERE bip = '" . mysql_real_escape_string($ip) . "'";
        $num = mysql_num_rows(mysql_query($q, $db));
        
        if ($num ==0) 
            return false; 
        else 
            return true;
    }

    function vRegister($ip, $pid){
        $db = getDbConn();
        $q = "INSERT INTO verification VALUES (null, '" . mysql_real_escape_string($ip) . "', '" . mysql_real_escape_string($pid) . "', null)";
        mysql_query($q);
    }
?>
