<?

 /* ��� ���� ���� ���� */ 
 
 //���� �ʱ�ȭ
 $app_line = "";

  
if($_GET['p_no'] or $p_no or $_POST['p_no']){
	  
	  	if(!$p_no){
	  		$p_no = $_GET['p_no'];
		}
	  	if(!$p_no){
	  		$p_no = $_POST['p_no'];
		}
		
		/* ���� ���� ��� id �� ���� ����� mb_id �� ������ */
		$chk_mb_id = sql_fetch(" SELECT mb_id FROM g4_write_bom_list where wr_10 = '".$p_no."' and wr_is_comment = 0 ");
		if($member[mb_id] == $chk_mb_id[mb_id]){
			
			$mb_dept = sql_fetch(" SELECT * FROM g4_member WHERE mb_id = '".$member[mb_id]."'");
	
			/* ���Ŷ� ���� �и��� ���� */  
			if($mb_dept[mb_recommend]){ 
				$ex_dept = explode(":",$mb_dept[mb_recommend]);
				$dept_no = $ex_dept[0];
				$dept_nm = $ex_dept[1];
		  	}else{
				$dept_no = $mb_dept[mb_2];
				$dept_nm = $mb_dept[mb_10];
		  	}
			
			 if($dept_no == "254"){ //cS��
					$app_line = $mb_dept[mb_id]."|".$mb_dept[mb_name]." ".$mb_dept[mb_4]."��"."dkseo01|������ �̻�";
			  }else
			  if($dept_no == "240"){ //������
			  //twkang
			  	if($member[mb_id] == "dhjeon"){
					$app_line = $mb_dept[mb_id]."|".$mb_dept[mb_name]." ".$mb_dept[mb_4]."��"."dkseo01|������ �̻�";
				}else{
					$app_line = $mb_dept[mb_id]."|".$mb_dept[mb_name]." ".$mb_dept[mb_4]."��"."twkang|���¿� ����";
				}
				
			  }else if($dept_no == "230"){ //������
			  //khlee
			  
				$app_line = $mb_dept[mb_id]."|".$mb_dept[mb_name]." ".$mb_dept[mb_4]."��"."khlee|�̰��� ����";
			
			  }else if($dept_no == "10"){ //�ݵ�ü�����
			  //yuji56
			    if($mb_dept[mb_id] == "kmlee"){
					$app_line = $mb_dept[mb_id]."|".$mb_dept[mb_name]." ".$mb_dept[mb_4]."��"."hyjung|��ȭ�� ����";
				}else
			  	if($mb_dept[mb_id] == "gjlee"){
					$app_line = $mb_dept[mb_id]."|".$mb_dept[mb_name]." ".$mb_dept[mb_4]."��yuji56|���м� ����";
				}else{
					$app_line = $mb_dept[mb_id]."|".$mb_dept[mb_name]." ".$mb_dept[mb_4]."��yuji56|���м� ����";
				}
				
			  }else if($dept_no == "12"){ //ǰ��������
			   //hyjung
				$app_line = $mb_dept[mb_id]."|".$mb_dept[mb_name]." ".$mb_dept[mb_4]."��"."hyjung|��ȭ�� ����";
			
			  }else if($dept_no == "13"){ //������
			   //mkji
			   
			   if($member[mb_id] == "mwm0000" or $member[mb_id] == "yeijin3820" or $member[mb_id] == "jsm" or $member[mb_id] == "sks" or $member[mb_id] == "pjy0304"){
					$app_line = $mb_dept[mb_id]."|".$mb_dept[mb_name]." ".$mb_dept[mb_4]."��"."twkang|���¿� ����";
					/* ������ ��û // ������ ��� ��û�� ���÷��� �����̶� ���¿� ���� ���� */
			   }else
			   if(substr($p_no,0,2) == "CQ"){
					$app_line = $mb_dept[mb_id]."|".$mb_dept[mb_name]." ".$mb_dept[mb_4]."��"."ghye0334|������ ���";
				}else{
					$app_line = $mb_dept[mb_id]."|".$mb_dept[mb_name]." ".$mb_dept[mb_4]."��"."dslee|�̴뼺 ����";
				}
			
			  }else if($dept_no == "14"){ //������
			   //dkseo01
				$app_line = $mb_dept[mb_id]."|".$mb_dept[mb_name]." ".$mb_dept[mb_4]."��"."dkseo01|������ �̻�";
			
			  }else if($dept_no == "19"){ //������
			  //yym7905
			  //	$app_line = $mb_dept[mb_id]."|".$mb_dept[mb_name]." ".$mb_dept[mb_4]."��"."hbhwang|Ȳ���� �����yym7905|������ ����";
			  //	$app_line = $mb_dept[mb_id]."|".$mb_dept[mb_name]." ".$mb_dept[mb_4]."��hljo|������ �����hbhwang|Ȳ���� ����";
				if($member[mb_id] == "ssh881108"){
				//	$app_line = $mb_dept[mb_id]."|".$mb_dept[mb_name]." ".$mb_dept[mb_4]."��ssh881108|�ս��� ���";
					$app_line = $mb_dept[mb_id]."|".$mb_dept[mb_name]." ".$mb_dept[mb_4]."��"."yym7905|������ ����";
				}else{
					$app_line = $mb_dept[mb_id]."|".$mb_dept[mb_name]." ".$mb_dept[mb_4]."��"."yym7905|������ ����";
				}
				
			  }else if($dept_no == "3"){ //����/������
			   
			  }else if($dept_no == "4"){ //������
			  //scbaek
				$app_line = $mb_dept[mb_id]."|".$mb_dept[mb_name]." ".$mb_dept[mb_4]."��"."scbaek|���ö ����";
			
			  }else if($dept_no == "5"){ //������
			  
			  }else if($dept_no == "6"){  //����������
			  //jykim 
					$app_line = $mb_dept[mb_id]."|".$mb_dept[mb_name]."��jykim|������ ����";
								
			  }else if($dept_no == "9"){  //FA�����
			  //jmlee
				
				// $app_line = $mb_dept[mb_id]."|".$mb_dept[mb_name]."��jooms111|���ν� ����";  	
				if($mb_dept[mb_id] == "jooms111"){
					$app_line = $mb_dept[mb_id]."|".$mb_dept[mb_name]."��dkseo01|������ �̻�";
				}else{
					$app_line = $mb_dept[mb_id]."|".$mb_dept[mb_name]."��jooms111|���ν� �����dkseo01|������ �̻�";
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
	alert("[�˸�:app_line.php]\n���� ������ Ȯ���� �� �����ϴ�.");
  }
  /*
230	������
240	������
10	�ݵ�ü�����
12	ǰ��������
13	������
14	������
19	������
3	����/������
4	������
5	������
6	����������
9	FA�����
*/

?>