<?php require_once("../../includes/session.php");?>
<?php require_once("../../includes/db_connection.php");?>
<?php require_once("../../includes/functions.php");?>
<?php confirm_logged_in(); ?>
<?php include("../../includes/layouts/header.php");?>
<?php
$pd = array
   (
   array("A1,L1","F1,L2","C1,L3","E1,L4","TD1,L5","L6","A2,L31","F2,L32","C2,L33","E2,L34","TD2,L35","L36"),
   array("B1,L7","G1,L8","D1,L9","TA1,L10","TF1,T11","L12","B2,L37","G2,L38","D2,L39","TA2,L40","TF2,L41","L42"),
   array("C1,L13","F1,L14","E1,L15","TB1,L16","TG1,L17","L18","C2,L43","F2,L44","E2,L45","TE2,L46","TG2,L47","L48"),
   array("D1,L19","A1,L20","F1,L21","C1,L22","TE1,L23","L24","D2,L49","A2,L50","F2,L51","C2,L52","TE2,L53","L54"),
   array("E1,L25","B1,L26","G1,L27","D1,L28","TC1,L29","L30","E2,L55","B2,L56","G2,L57","D2,L58","TC2,L59","L60")
   );
   $matrix = zeros(5, 12);
$query = "SELECT * FROM faculty";
$result = mysqli_query($conn, $query);
confirm_query($result);
while ($title = mysqli_fetch_assoc($result)) {
	$name = $title['COL1'];
	$stat=$title['state'];
	if($stat==1)continue;
	/*echo "out";
	echo $name; echo "<br>";*/
	$query_name = "SELECT * FROM faculty WHERE COL1 = '{$name}' ";
	$result_name = mysqli_query($conn, $query_name);
	confirm_query($result_name);
	for ($i=0; $i <5 ; $i++) { 
		# code...
		for ($j=0; $j <13 ; $j++) { 
			# code...
			$matrix[$i][$j]=0;
		}
	}
	
	//echo "land";
	while ($name_list= mysqli_fetch_assoc($result_name))
	{
		//echo "aghd";
		/*echo "in";
		echo $name; echo "<br>";*/
		$id_now_to_be_del = $name_list['id'];
		$query_del = "UPDATE faculty SET state = 1 WHERE id = {$id_now_to_be_del} ";
        $result_del = mysqli_query($conn, $query_del);
        $query = "SELECT * FROM faculty";
		$result = mysqli_query($conn, $query);
		$title = mysqli_fetch_assoc($result);
	/*$final_query = "SELECT name FROM faculty_final";
	$final_result = mysqli_query($conn, $final_query);*/
	//confirm_query($final_result);
	//$c = 0;
	/*while ($list = mysqli_fetch_assoc($final_result)) {
		$check = $list['name'];
		if ($name==$check) {
			$c=1;
			break;
		} 
	}*/
	//if($c==1)continue;
	//echo "Not found";
		$col2 = $name_list['COL 2'];
		$period_delm = explode("+", $col2);
		$period_delm_size = sizeof($period_delm);
		//echo "choot";
		for ($m=0; $m < $period_delm_size; $m++) { 
			//echo "m";
		    for($j=0;$j<5;$j++) {
		    	//echo "j";
		        for($k=0;$k<12;$k++) {
		        	//echo "k";
		        	$sent2 = $pd[$j][$k];
		        	$pdjk_value_array= explode(",", $sent2);
		        	$pdjk_value_array_size=sizeof($pdjk_value_array);
		        	for ($ind=0; $ind <$pdjk_value_array_size ; $ind++) { 
		        		# code...
		        		if($pdjk_value_array[$ind]==$period_delm[$m])
		        		{
		        			$matrix[$j][$k]=1;
		        			break;
		        		}
		        	}
		        }
		    }
		}
		        	//echo $sent2;
		        	//echo "lol";
		        	/*$sent1 = $period_delm[$m]."*";
		            $sry=array("$sent1 $sent2");
		            //print_r($sry);
		            $temp = $period_delm[$m];
		            $n2 = strlen($temp);
		            $s = implode(" ", $sry);
		            $n = strlen($s);
		            $Z = new SplFixedArray($n);
		            $Z[0] = $n;
		            $L = 0;
		            $R = 0;
		            for ($i= 1; $i < $n; $i++) { 
		                if ($i> $R) {
		                    $L = $R = $i;
		                    while ($R < $n && $s[$R-$L+$i]==$s[$R-$L]) {
		                        $R++;
		                    }
		                    $Z[$i] = $R-$L;
		                    $R--;           
		                } else {
		                    $kl = $i-$L;
		                    if ($Z[$kl]<$R-$i+1) {
		                        $Z[$kl] = $Z[$i];
		                    } else {
		                        $L = $i;
		                        while ($R < $n && $s[$R-$L+$i]==$s[$R-$L]) {
		                            $R++;
		                        }
		                        $Z[$i] = $R-$L;
		                        $R--;
		                    }
		                }
		            } 
		            $flag=0;    
		            for ($i=1; $i < $n ; $i++) { 
		                if ($Z[$i]==$n2) {                                              
		                    $matrix[$j][$k]=1;
		                    
		                    break;
		               	}
		           	}
		        }
		    }
		}
		*/
	/*$delete="DELETE FROM faculty WHERE id = {$id_now_to_be_del}";
	mysqli_query($conn, $delete);*/
	//echo "next";
		
	}	
	                
	$temparr="";
	for($i=0;$i<5;$i++) {
		for($j=0;$j<12;$j++) {
			if($j==5) {
				$temparr=$temparr.$matrix[$i][$j]." 2 ";
			} else { 
				$temparr=$temparr.$matrix[$i][$j]." ";
			}
		}

	}
	/*echo $name;
	echo "&nbsp;";
	echo $temparr;
	echo "<br>"; */
	$query_final = "INSERT INTO faculty_final (name, period) VALUES ('{$name}', '{$temparr}')";
    mysqli_query($conn, $query_final);	


	//echo "Prashant";
}	
?>

<?php include("../../includes/layouts/footer.php");?>