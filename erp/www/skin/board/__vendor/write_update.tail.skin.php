<?


if($member[mb_id] == "ssh881108"){
	// $log = 1;
}


if($chk_wr_id){
	if($log){
		echo "&nbsp;&bull;&nbsp;&nbsp;UPDATE COUNT : ".count($chk_wr_id)."<br/><br/><br/>";
	}

    for($i=0;$i<count($chk_wr_id);$i++){
		$update_sql = "";
		if($log)     echo ($i+1).". wr_id : ".$wr_id."<br/>";
		
			$update_sql .= " ca_name ='".$_POST[ca_name]."', wr_subject ='".$_POST[vendor_name]."' ,  wr_content ='".$_POST[vendor_name]."' ";
		for($ix=0;$ix<17;$ix++){
			//fix_1_<?=$list[$i][wr_id]
			$chk_value = "fix_".$ix."_new";


			if($ix == 0){
				if($update_sql){ $update_sql .= ", "; }
			
				$tmp_wr_last = "";
				for($ia=0;$ia<count($_POST[$chk_value]);$ia++){
					if($tmp_wr_last){ $tmp_wr_last .= "#"; }
					$tmp_wr_last .= $_POST[$chk_value][$ia];
				}
				
				$update_sql .= " wr_last='".$tmp_wr_last."' ";
				if($log)     echo "&nbsp;&bull;&nbsp;wr_last : ".$tmp_wr_last;
				if($log)     echo "<br/>";
			}
			if($ix == 1){
				if($update_sql){ $update_sql .= ", "; }
				$update_sql .= " wr_link1='".$_POST[$chk_value]."' ";
				if($log)     echo "&nbsp;&bull;&nbsp;wr_link1 : ".$_POST[$chk_value];
				if($log)     echo "<br/>";
			}
			if($ix == 2){
				if($update_sql){ $update_sql .= ", "; }
				$update_sql .= " wr_1x='".$_POST[$chk_value]."' ";
				if($log)     echo "&nbsp;&bull;&nbsp;wr_1x : ".$_POST[$chk_value];
				if($log)     echo "<br/>";
			}
			if($ix == 3){
				if($update_sql){ $update_sql .= ", "; }
				$update_sql .= " cri_type='".$_POST[$chk_value]."' ";
				if($log)     echo "&nbsp;&bull;&nbsp;cri_type : ".$_POST[$chk_value];
				if($log)     echo "<br/>";
			}
			if($ix == 4){
				if($update_sql){ $update_sql .= ", "; }
			
				$tmp_cri_no = "";
				for($ia=0;$ia<count($_POST[$chk_value]);$ia++){
					if($tmp_cri_no){ $tmp_cri_no .= "#"; }
					$tmp_cri_no .= $_POST[$chk_value][$ia];
				}
				
				$update_sql .= " cri_no='".$tmp_cri_no."' ";
				if($log)     echo "&nbsp;&bull;&nbsp;cri_no : ".$tmp_cri_no;
				if($log)     echo "<br/>";
			}
			if($ix == 5){
				if($update_sql){ $update_sql .= ", "; }
			
				$tmp_cri_cate = "";
				for($ia=0;$ia<count($_POST[$chk_value]);$ia++){
					if($tmp_cri_cate){ $tmp_cri_cate .= "#"; }
					$tmp_cri_cate .= $_POST[$chk_value][$ia];
				}
				
				$update_sql .= " cri_cate='".$tmp_cri_cate."' ";
				if($log)     echo "&nbsp;&bull;&nbsp;cri_cate : ".$tmp_cri_cate;
				if($log)     echo "<br/>";
			}
			if($ix == 6){
				if($update_sql){ $update_sql .= ", "; }
				$update_sql .= " outwork='".$_POST[$chk_value]."' ";
				if($log)     echo "&nbsp;&bull;&nbsp;outwork : ".$_POST[$chk_value];
				if($log)     echo "<br/>";
			}
			/*
			if($ix == 7){
				if($update_sql){ $update_sql .= ", "; }
				$update_sql .= " amount_2015='".$_POST[$chk_value]."' ";
				if($log)     echo "&nbsp;&bull;&nbsp;amount_2015 : ".$_POST[$chk_value];
				if($log)     echo "<br/>";
			}
			if($ix == 8){
				if($update_sql){ $update_sql .= ", "; }
				$update_sql .= " amount_2016='".$_POST[$chk_value]."' ";
				if($log)     echo "&nbsp;&bull;&nbsp;amount_2016 : ".$_POST[$chk_value];
				if($log)     echo "<br/>";
			}
			if($ix == 9){
				if($update_sql){ $update_sql .= ", "; }
				$update_sql .= " amount_2017='".$_POST[$chk_value]."' ";
				if($log)     echo "&nbsp;&bull;&nbsp;amount_2017 : ".$_POST[$chk_value];
				if($log)     echo "<br/>";
			}
			if($ix == 10){
				if($update_sql){ $update_sql .= ", "; }
				$update_sql .= " amount_2018='".$_POST[$chk_value]."' ";
				if($log)     echo "&nbsp;&bull;&nbsp;amount_2018 : ".$_POST[$chk_value];
				if($log)     echo "<br/>";
			}*/
			if($ix == 11){
				if($update_sql){ $update_sql .= ", "; }
				$update_sql .= " wr_1='".$_POST[$chk_value]."' ";
				if($log)     echo "&nbsp;&bull;&nbsp;wr_1 : ".$_POST[$chk_value];
				if($log)     echo "<br/>";
			}
			
			if($ix == 12){
				if($update_sql){ $update_sql .= ", "; }
				$update_sql .= " wr_5='".$_POST[$chk_value]."' ";
				if($log)     echo "&nbsp;&bull;&nbsp;wr_5 : ".$_POST[$chk_value];
				if($log)     echo "<br/>";
			}
			if($ix == 13){
				if($update_sql){ $update_sql .= ", "; }
				$update_sql .= " wr_email='".$_POST[$chk_value]."' ";
				if($log)     echo "&nbsp;&bull;&nbsp;wr_email : ".$_POST[$chk_value];
				if($log)     echo "<br/>";
			}
			if($ix == 14){
				if($update_sql){ $update_sql .= ", "; }
				$update_sql .= " wr_3='".$_POST[$chk_value]."' ";
				if($log)     echo "&nbsp;&bull;&nbsp;wr_3 : ".$_POST[$chk_value];
				if($log)     echo "<br/>";
			}
			if($ix == 16){
				if($update_sql){ $update_sql .= ", "; }
				$update_sql .= " wr_9='".$_POST[$chk_value]."' ";
				if($log)     echo "&nbsp;&bull;&nbsp;wr_9 : ".$_POST[$chk_value];
				if($log)     echo "<br/>";
			}

		}
		
		$chk_valuex = "fix_a_new";
		if($_POST[$chk_valuex]){
			if($update_sql){ $update_sql .= ", "; }
			$update_sql .= " wr_nogood='1' ";
			if($log)     echo "&nbsp;&bull;&nbsp;wr_nogood : 1";
			if($log)     echo "<br/>";
		}else{
			if($update_sql){ $update_sql .= ", "; }
			$update_sql .= " wr_nogood='0' ";
			if($log)     echo "&nbsp;&bull;&nbsp;wr_nogood : 0";
			if($log)     echo "<br/>";
		}

		$chk_file_del0 = "bf_file_del_new_0";
		$chk_file_del1 = "bf_file_del_new_1";
		$chk_file_del2 = "bf_file_del_new_2";
		$chk_file_del3 = "bf_file_del_new_3";
		
		if($_POST[$chk_file_del0] or $_POST[$chk_file_del1] or $_POST[$chk_file_del2] or $_POST[$chk_file_del3]){
			if($_POST[$chk_file_del0]){
				$row = sql_fetch(" select bf_source, bf_file from `g4_board_file` where bo_table = '$bo_table' and wr_id = '".$wr_id."' and bf_no = '0' ");
				if(!$log){
				@unlink("$g4[path]/data/file/$bo_table/$row[bf_file]");
			    sql_query(" delete from `g4_board_file` where bo_table = '$bo_table' and wr_id = ".$wr_id." and bf_no = '0' ");
				}
				if($log)  echo "&nbsp;&shy;&gt;&nbsp;attach_0 file deleted. (".$row[bf_source].")<br/>";
			}
			if($_POST[$chk_file_del1]){
				$row = sql_fetch(" select bf_file from `g4_board_file` where bo_table = '$bo_table' and wr_id = ".$wr_id." and bf_no = '1' ");
				if(!$log){
				@unlink("$g4[path]/data/file/$bo_table/$row[bf_file]");
			    sql_query(" delete from `g4_board_file` where bo_table = '$bo_table' and wr_id = ".$wr_id." and bf_no = '0' ");
				}
				if($log)  echo "&nbsp;&shy;&gt;&nbsp;attach_1 file deleted. (".$row[bf_source].")<br/>";
			}
			if($_POST[$chk_file_del2]){
				$row = sql_fetch(" select bf_file from `g4_board_file` where bo_table = '$bo_table' and wr_id = ".$wr_id." and bf_no = '2' ");
				if(!$log){
				@unlink("$g4[path]/data/file/$bo_table/$row[bf_file]");
			    sql_query(" delete from `g4_board_file` where bo_table = '$bo_table' and wr_id = ".$wr_id." and bf_no = '0' ");
				if($log)  echo "&nbsp;&shy;&gt;&nbsp;attach_2 file deleted. (".$row[bf_source].")<br/>";
				}
			}
			if($_POST[$chk_file_del3]){
				$row = sql_fetch(" select bf_file from `g4_board_file` where bo_table = '$bo_table' and wr_id = ".$wr_id." and bf_no = '3' ");
				if(!$log){
				@unlink("$g4[path]/data/file/$bo_table/$row[bf_file]");
			    sql_query(" delete from `g4_board_file` where bo_table = '$bo_table' and wr_id = ".$wr_id." and bf_no = '0' ");
				}
				if($log)  echo "&nbsp;&shy;&gt;&nbsp;attach_3 file deleted. (".$row[bf_source].")<br/>";
			}
		
		}else{

			$chk_filex = "bf_file_new";
			for($iv=0;$iv<4;$iv++){
				if($_FILES[$chk_filex][name][$iv]){
					echo "&nbsp;&bull;&nbsp;".$iv.". file name : ";
					echo $_FILES[$chk_filex][name][$iv]."<br/>";
					
	
					$tmp_file  = $_FILES[$chk_filex][tmp_name][$iv];
					$filesize  = $_FILES[$chk_filex][size][$iv];
					$filename  = $_FILES[$chk_filex][name][$iv];
					$filename  = preg_replace('/(\s|\<|\>|\=|\(|\))/', '_', $filename);
	
	
					$upload[$i][source] = $filename;
					$upload[$i][filesize] = $filesize;
					
			
					// �Ʒ��� ���ڿ��� �� ������ -x �� �ٿ��� ����θ� �˴��� ������ ���� ���ϵ��� ��
					$filename = preg_replace("/\.(php|phtm|htm|cgi|pl|exe|jsp|asp|inc)/i", "$0-x", $filename);
			
					// ���̻縦 ���� ���ϸ�
					//$upload[$i][file] = abs(ip2long($_SERVER[REMOTE_ADDR])).'_'.substr(md5(uniqid($g4[server_time])),0,8).'_'.urlencode($filename);
					// �޺��µ��� ���� : �ѱ������� urlencode($filename) ó���� �Ұ�� '%'�� �ٿ��ְ� �Ǵµ� '%'ǥ�ô� �̵���÷��̾ �ν��� ���ϱ� ������ ����� �ȵ˴ϴ�. �׷��� ������ ���ϸ��� '%'�κ��� ���ָ� �ذ�˴ϴ�. 
					//$upload[$i][file] = abs(ip2long($_SERVER[REMOTE_ADDR])).'_'.substr(md5(uniqid($g4[server_time])),0,8).'_'.str_replace('%', '', urlencode($filename)); 
					$chars_array = array_merge(range(0,9), range('a','z'), range('A','Z'));
					shuffle($chars_array);
					$shuffle = implode("", $chars_array);
			
					// ÷������ ÷�ν� ÷�����ϸ� ������ ���ԵǾ� ������ �Ϻ� PC���� ������ �ʰų� �ٿ�ε� ���� �ʴ� ������ �ֽ��ϴ�. (����� �� 090925)
					//$upload[$i][file] = abs(ip2long($_SERVER[REMOTE_ADDR])).'_'.substr($shuffle,0,8).'_'.str_replace('%', '', urlencode($filename)); 
					$upload[$i][file] = abs(ip2long($_SERVER[REMOTE_ADDR])).'_'.substr($shuffle,0,8).'_'.str_replace('%', '', urlencode(str_replace(' ', '_', $filename))); 
			
					$dest_file = "$g4[path]/data/file/$bo_table/" . $upload[$i][file];
					echo $dest_file."<br/>";
			
					// ���ε尡 �ȵȴٸ� �����޼��� ����ϰ� �׾�����ϴ�.
					$error_code = move_uploaded_file($tmp_file, $dest_file) or die($_FILES[$chk_filex][error][$i]);
			
					// �ö� ������ �۹̼��� �����մϴ�.
					chmod($dest_file, 0606);
			
					//$upload[$i][image] = @getimagesize($dest_file);
					$row = sql_fetch(" select count(*) as cnt from `g4_board_file` where bo_table = '$bo_table' and wr_id = '".$wr_id."' and bf_no = '$iv' ");
					if ($row[cnt]) 
					{
						// ������ üũ�� �ְų� ������ �ִٸ� ������Ʈ�� �մϴ�.
						// �׷��� �ʴٸ� ���븸 ������Ʈ �մϴ�.
						if ($upload[$i][del_check] || $upload[$i][file]) 
						{
							$sql = " update `g4_board_file`
										set bf_source = '{$upload[$i][source]}',
											bf_file = '{$upload[$i][file]}',
											bf_content = '{$bf_content[$i]}',
											bf_filesize = '{$upload[$i][filesize]}',
											bf_width = '{$upload[$i][image][0]}',
											bf_height = '{$upload[$i][image][1]}',
											bf_type = '{$upload[$i][image][2]}',
											bf_datetime = '$g4[time_ymdhis]'
									  where bo_table = '$bo_table'
										and wr_id = '".$wr_id."'
										and bf_no = '$iv' ";
							sql_query($sql);
						} 
						else 
						{
							$sql = " update `g4_board_file`
										set bf_content = '{$bf_content[$i]}' 
									  where bo_table = '$bo_table'
										and wr_id = '".$wr_id."'
										and bf_no = '$iv' ";
				
							sql_query($sql);
						}
					} 
					else 
					{
						$sql = " insert into `g4_board_file`
									set bo_table = '$bo_table',
										wr_id = '".$wr_id."',
										bf_no = '$iv',
										bf_source = '{$upload[$i][source]}',
										bf_file = '{$upload[$i][file]}',
										bf_content = '{$bf_content[$i]}',
										bf_download = 0,
										bf_filesize = '{$upload[$i][filesize]}',
										bf_width = '{$upload[$i][image][0]}',
										bf_height = '{$upload[$i][image][1]}',
										bf_type = '{$upload[$i][image][2]}',
										bf_datetime = '$g4[time_ymdhis]' ";
				
						sql_query($sql);
					}
				
				}
			}
		} //end check DELETE file;
		
		
		$exec_sql = " UPDATE `g4_write_vendor` SET ".$update_sql." WHERE `wr_id` = '".$wr_id."' ";
		if($log){
			echo "<BR> ==> SQL ".$exec_sql."<br/>";
		}else{
			if($update_sql){
				sql_query($exec_sql);
			}
		}
		if($log)     echo "<Br/>";
	}

		
	if($member[mb_id] == "ssh881108"){
		// g4_member�� ������Ʈ ���ִ� ���μ��� 
		//INSERT INTO `g4_member` (`mb_id`, `mb_3`, `mb_2`, `mb_name`, `mb_nick`, `mb_password`, `mb_level`) VALUES ('id', 'vendor', '���ֹ�ȣ', '��ü��', '��ü��nick', '*89C6B530AA78695E257E55D63C00A6EC9AD3E977', '2')
		
		$chk_vendor_id = sql_fetch(" SELECT * FROM g4_member where mb_3 ='vendor' and mb_id like 'vd%' order by mb_no desc limit 0, 1");
		$last_vendor_id = str_replace("vd","",$chk_vendor_id[mb_id]);
		$new_vendor_mb_id = "vd".($last_vendor_id+1);
		$insert_mb_sql = "INSERT INTO `g4_member` (`mb_id`, `mb_3`, `mb_2`, `mb_name`, `mb_nick`, `mb_password`, `mb_level`) VALUES ('".$new_vendor_mb_id."', 'vendor', '', '".$_POST[vendor_name]."', '".$_POST[vendor_name]."', '*89C6B530AA78695E257E55D63C00A6EC9AD3E977', '2')
		";
		if($log > 0){
			echo " <BR> == > member table vendor insert query = ".$insert_mb_sql."<BR>";
		}else{
			sql_query($insert_mb_sql);
		}
		
		
		$vendor_infox = sql_fetch( " SELECT * FROM g4_write_vendor where wr_id = '".$wr_id."' ");
		$writer = explode(":",$vendor_infox[wr_name]);
		// ���� �߼��ϴ� ���μ��� !! 
		
		include_once("$g4[path]/lib/mailer.lib.php");

		require ($g4[path].'/adm/PHPMailerAutoload.php');

		
		$send_mail_addr = "ssh881108@naver.com|ssh881108@imetis.co.kr";
		$ex_send_mail_addr = explode("|",$send_mail_addr);
		
		for($iz=0; $iz < count($ex_send_mail_addr); $iz++){


			
			if($member[mb_id] == "ssh881108"){ echo "wr_email = ". $ex_send_mail_addr[$iz]."<BR>";}
			$to = $ex_send_mail_addr[$iz];


			if($to){ 


				$subject = "[".$_POST[vendor_name]."] �ű� ��ü ��ǰ�� �ڵ� ��� ��û ";
				$subject2 = " �ű� ��ü�� ��ǰ�� �ڵ带 ��� �Ͽ� �ֽñ� �ٶ��ϴ�.   ";
				$wr_content = " ��ǰ�� �ڵ� �������� ��ü������ ��ǰ���� ����/��� �� �� �����ϴ�.  <BR> <BR> <span style='color:#coo'> ���� ó�� ��Ź�帳�ϴ�. </span>";
				$link_url = "http://dev.imetis.co.kr/skin/board/__vendor/mail_vendor_code.php?bo_table=vendor&vendor_idx=".$wr_id."&vd_id=".$new_vendor_mb_id;
				$content = '<!doctype html>
				<html lang="ko">
				<head>
				<meta charset="euc-kr">
				<title>'.$subject.'</title>
				</head>
				<body>

				<div style="width:100%;border:10px solid #f7f7f7; font-family:Malgun Gothic, Dotum, Arial;" onmouseover=\"check_mail($chk_annual[wr_id]);">
					<div style="border:1px solid #dedede">
						<h1 style="padding:10px 10px 10px 30px;background:#f7f7f7;color:#555;font-size:1.8em;font-weight:bold;font-family:Apple SD Gothic Neo,Malgun Gothic,Dotum;">
							'.$subject2.'
						</h1>
						<span style="display:block;padding:10px 30px 10px 10px;background:#FBFBFB;text-align:right;font-family:Apple SD Gothic Neo,Malgun Gothic,Dotum;">
							<b>'.$writer[0].'</b>('.$writer[1].')
						</span>
						<div style="margin:10px 0 0;padding:10px 30px 50px;min-height:60px;height:auto !important;height:60px;border-bottom:1px solid #eee;font-family:Apple SD Gothic Neo,Malgun Gothic,Dotum;"><span style="font-size:14px;">
							<BR />
						'.$wr_content.'
						</span>
						</div>

						<a href="'.$link_url.'" onClick="window.open(this.href, \'\', \'width=543, height=660\'); return false;"
						style="display:block;padding:20px 0;cursor:pointer;background:#484848;color:#fff;text-decoration:none;text-align:center;font-family:Apple SD Gothic Neo,Malgun Gothic,Dotum;" >
							�˾�â���� ��ü �ڵ� ����ϱ�  
						</a>
						<div style="width:100%; padding:10px;">
							<span style="font-size:11px; color:#990000; font-family:Apple SD Gothic Neo,Malgun Gothic,Dotum;">
							* �� ���� �ּҴ� �߽ſ����θ� ���˴ϴ�.
							</span>
						</div>
						<br/>&nbsp;

					</div>
				</div>
				<div style="padding:10px; width:99%; text-align:center;font-family:Apple SD Gothic Neo,Malgun Gothic,Dotum;">
					<strong>Metis</strong>
					<span style="font-size:11px;">- Mechatronics Total Intelligence System</span>
				</div>
				</body>
				</html>';







				// mailer('Matis', 'admin@imetis.co.kr', $to, $subject, $content, 1, '','');
				//$mail->Host = "mail_imetis_co_kr"; // ���ܸ� ����Ͽ�, Host ���� ������ ������ ������. 
				$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch 
				$mail->IsSMTP(); // telling the class to use SMTP 

				$mail->Host = "mail.imetis.co.kr"; // SMTP server
				$mail->Port = '25'; // SMTP Port 
				//$mail->SMTPDebug  = 2; 	// enables SMTP debug information, ���� �޽����� ���� ���ؼ��� �ּ��� �����ϰ� 2 �� ������ ��. ���� �޽����� "ȸ�����Ϲ߼� > �׽�Ʈ" ��ư�� �������� ������ ��Ÿ��. 


				//$mail->SMTPSecure = "tls";                	// sets the prefix to the servier 
				$mail->SMTPAuth  = true; 						// enable SMTP authentication 
				$mail->Username = 'admin@imetis.co.kr';
				$mail->Password = 'a1111'; 

				$mail->CharSet = "UTF-8"; // class.phpmailer.php �� �⺻���� iso-8859-1 �̹Ƿ�, UTF-8 �� ������. 
				$mail->Encoding = "base64"; // �⺻���� 8bit �̹Ƿ�, base64�� ������. 
				$mail->SetFrom = iconv("euc-kr","UTF-8",$fname);
				$mail->AddReplyTo= iconv("euc-kr","UTF-8",$fmail);
				//$mail->SMTPKeepAlive = true; 
				$mail->Mailer = "smtp"; 
				$mail->AddAddress($to); // ������ 
				$mail->Subject = iconv("euc-kr","UTF-8",$subject); // ���� 
				$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically 
				$mail->MsgHTML(iconv("euc-kr","UTF-8",$content)); 
				if ($cc) 
					$mail->AddCC($cc); 
				if ($bcc) 
					$mail->AddBCC($bcc); 
				//print_r2($file); exit; 
				if ($file != "") { 
					foreach ($file as $f) { 
						$mail->AddAttachment($f['path'], $f['name']); 
					} 
				} 

				if($mail->Send()){ 
					$message = "������ �߼��߽��ϴ�.<p></p>\n"; 
					$send_ea = $send_ea + 1;
				} 

			} // to�� ������

		} // for 
		?>
		<script>
		 alert("  MTC �ڵ� ä�� ��û ���� �߼��� �Ϸ� �Ͽ����ϴ� [!]");

		</script>
		<?
		
		
		
	}
	
	?>
<script>
	alert("[�˸�]\n���� ������ �����Ͽ����ϴ�.");
	<? if($log){ }else{ ?> document.location.href='<?=$g4[path]?>/bbs/write.php?bo_table=vendor&m_id=337'; <? } ?>
	</script>
    <?
	
}
exit;
?>