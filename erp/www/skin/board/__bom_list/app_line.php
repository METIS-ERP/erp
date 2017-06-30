<?

 /* 상신 관련 결재 라인 */ 
 
 //변수 초기화
 $app_line = "";

  
if($_GET['p_no'] or $p_no or $_POST['p_no']){
	  
	  	if(!$p_no){
	  		$p_no = $_GET['p_no'];
		}
	  	if(!$p_no){
	  		$p_no = $_POST['p_no'];
		}
		
		/* 결재 라인 등록 id 와 문서 등록자 mb_id 가 같을때 */
		$chk_mb_id = sql_fetch(" SELECT mb_id FROM g4_write_bom_list where wr_10 = '".$p_no."' and wr_is_comment = 0 ");
		if($member[mb_id] == $chk_mb_id[mb_id]){
			
			$mb_dept = sql_fetch(" SELECT * FROM g4_member WHERE mb_id = '".$member[mb_id]."'");
	
			/* 구매랑 자재 분리를 위해 */  
			if($mb_dept[mb_recommend]){ 
				$ex_dept = explode(":",$mb_dept[mb_recommend]);
				$dept_no = $ex_dept[0];
				$dept_nm = $ex_dept[1];
		  	}else{
				$dept_no = $mb_dept[mb_2];
				$dept_nm = $mb_dept[mb_10];
		  	}
			
			 if($dept_no == "254"){ //cS팀
					$app_line = $mb_dept[mb_id]."|".$mb_dept[mb_name]." ".$mb_dept[mb_4]."§"."dkseo01|서동규 이사";
			  }else
			  if($dept_no == "240"){ //구매팀
			  //twkang
			  	if($member[mb_id] == "dhjeon"){
					$app_line = $mb_dept[mb_id]."|".$mb_dept[mb_name]." ".$mb_dept[mb_4]."§"."dkseo01|서동규 이사";
				}else{
					$app_line = $mb_dept[mb_id]."|".$mb_dept[mb_name]." ".$mb_dept[mb_4]."§"."twkang|강태원 부장";
				}
				
			  }else if($dept_no == "230"){ //자재팀
			  //khlee
			  
				$app_line = $mb_dept[mb_id]."|".$mb_dept[mb_name]." ".$mb_dept[mb_4]."§"."khlee|이경훈 차장";
			
			  }else if($dept_no == "10"){ //반도체사업팀
			  //yuji56
			    if($mb_dept[mb_id] == "kmlee"){
					$app_line = $mb_dept[mb_id]."|".$mb_dept[mb_name]." ".$mb_dept[mb_4]."§"."hyjung|정화영 부장";
				}else
			  	if($mb_dept[mb_id] == "gjlee"){
					$app_line = $mb_dept[mb_id]."|".$mb_dept[mb_name]." ".$mb_dept[mb_4]."§yuji56|임학수 과장";
				}else{
					$app_line = $mb_dept[mb_id]."|".$mb_dept[mb_name]." ".$mb_dept[mb_4]."§yuji56|임학수 과장";
				}
				
			  }else if($dept_no == "12"){ //품질보증팀
			   //hyjung
				$app_line = $mb_dept[mb_id]."|".$mb_dept[mb_name]." ".$mb_dept[mb_4]."§"."hyjung|정화영 부장";
			
			  }else if($dept_no == "13"){ //영업팀
			   //mkji
			   
			   if($member[mb_id] == "mwm0000" or $member[mb_id] == "yeijin3820" or $member[mb_id] == "jsm" or $member[mb_id] == "sks" or $member[mb_id] == "pjy0304"){
					$app_line = $mb_dept[mb_id]."|".$mb_dept[mb_name]." ".$mb_dept[mb_4]."§"."twkang|강태원 부장";
					/* 예진씨 요청 // 이진석 사원 요청은 엠플러스 전용이라서 강태원 부장 결재 */
			   }else
			   if(substr($p_no,0,2) == "CQ"){
					$app_line = $mb_dept[mb_id]."|".$mb_dept[mb_name]." ".$mb_dept[mb_4]."§"."ghye0334|김지혜 사원";
				}else{
					$app_line = $mb_dept[mb_id]."|".$mb_dept[mb_name]." ".$mb_dept[mb_4]."§"."dslee|이대성 부장";
				}
			
			  }else if($dept_no == "14"){ //설계팀
			   //dkseo01
				$app_line = $mb_dept[mb_id]."|".$mb_dept[mb_name]." ".$mb_dept[mb_4]."§"."dkseo01|서동규 이사";
			
			  }else if($dept_no == "19"){ //연구소
			  //yym7905
			  //	$app_line = $mb_dept[mb_id]."|".$mb_dept[mb_name]." ".$mb_dept[mb_4]."§"."hbhwang|황현보 과장§yym7905|연영모 차장";
			  //	$app_line = $mb_dept[mb_id]."|".$mb_dept[mb_name]." ".$mb_dept[mb_4]."§hljo|조혜림 사원§hbhwang|황현보 과장";
				if($member[mb_id] == "ssh881108"){
				//	$app_line = $mb_dept[mb_id]."|".$mb_dept[mb_name]." ".$mb_dept[mb_4]."§ssh881108|손승희 사원";
					$app_line = $mb_dept[mb_id]."|".$mb_dept[mb_name]." ".$mb_dept[mb_4]."§"."yym7905|연영모 부장";
				}else{
					$app_line = $mb_dept[mb_id]."|".$mb_dept[mb_name]." ".$mb_dept[mb_4]."§"."yym7905|연영모 부장";
				}
				
			  }else if($dept_no == "3"){ //구매/자재팀
			   
			  }else if($dept_no == "4"){ //관리팀
			  //scbaek
				$app_line = $mb_dept[mb_id]."|".$mb_dept[mb_name]." ".$mb_dept[mb_4]."§"."scbaek|백승철 과장";
			
			  }else if($dept_no == "5"){ //제조부
			  
			  }else if($dept_no == "6"){  //제조지원팀
			  //jykim 
					$app_line = $mb_dept[mb_id]."|".$mb_dept[mb_name]."§jykim|김지연 과장";
								
			  }else if($dept_no == "9"){  //FA사업팀
			  //jmlee
				
				// $app_line = $mb_dept[mb_id]."|".$mb_dept[mb_name]."§jooms111|오민식 차장";  	
				if($mb_dept[mb_id] == "jooms111"){
					$app_line = $mb_dept[mb_id]."|".$mb_dept[mb_name]."§dkseo01|서동규 이사";
				}else{
					$app_line = $mb_dept[mb_id]."|".$mb_dept[mb_name]."§jooms111|오민식 차장§dkseo01|서동규 이사";
				}
				
			
			}
			  
		    $app_line_sql = " UPDATE g4_write_bom_list SET W = '".$app_line."' where wr_10 = '".$p_no."' and wr_is_comment = 0 ";
			if($member[mb_id] == "ssh881108x"){
				echo "app_line = ".$app_line_sql."<BR>";
				exit;
			}else{
				//echo $app_line_sql."<BR>";
				sql_query($app_line_sql);
	
			}
		}
  }else{
	alert("[알림:app_line.php]\n문서 정보를 확인할 수 없습니다.");
  }
  /*
230	자재팀
240	구매팀
10	반도체사업팀
12	품질보증팀
13	영업팀
14	설계팀
19	연구소
3	구매/자재팀
4	관리팀
5	제조부
6	제조지원팀
9	FA사업팀
*/

?>