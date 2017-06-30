<?
$mtc_no = $member[mb_2];
$use_metis = "";
if($mtc and $member[mb_3] != "vendor"){
	$use_metis = "Y";
	$vd_info = sql_fetch(" SELECT * FROM `g4_member` WHERE `mb_2` LIKE '%".$mtc."%' and `mb_2` <> '' ");
	$ca_name = $vd_info[mb_name];
	$mtc_no = $vd_info[mb_2];
}else
if(!$member[mb_id]){
	echo "정상적으로 접근하여 주십시오.<br/><a href='".$g4[path]."/bbs/logout.php' target='_self' style='color:#0000FF;'font-size:18px;font-weight:bold;'>[ 로그 아웃 후 이동 ]</a>";
	exit;
}else
if($member[mb_3] != "vendor"){
	echo "협력사만 사용 가능합니다.<br/><a href='".$g4[path]."/bbs/logout.php' target='_self' style='color:#0000FF;'font-size:18px;font-weight:bold;'>[ 로그 아웃 후 이동 ]</a>";
	exit;
}

$tm_y = $_GET['tm_y'];
$tm_m = $_GET['tm_m'];
	if($tm_m == "A"){ $month_title = " 1월 "; }else
	if($tm_m == "B"){ $month_title = " 2월 "; }else
	if($tm_m == "C"){ $month_title = " 3월 "; }else
	if($tm_m == "D"){ $month_title = " 4월 "; }else
	if($tm_m == "E"){ $month_title = " 5월 "; }else
	if($tm_m == "F"){ $month_title = " 6월 "; }else
	if($tm_m == "G"){ $month_title = " 7월 "; }else
	if($tm_m == "H"){ $month_title = " 8월 "; }else
	if($tm_m == "I"){ $month_title = " 9월 "; }else
	if($tm_m == "J"){ $month_title = " 10월 "; }else
	if($tm_m == "K"){ $month_title = " 11월 "; }else
	if($tm_m == "L"){ $month_title = " 12월 "; }

$order_uri = explode("&order=",$_SERVER['REQUEST_URI']);
?><style>
body { border:0px; margin:0px; padding:0px; }
</style>
<div style="width:100%; height:24px; border:0px; margin:0px; padding:0px;"></div>
<script>
$(function() { 
	$(".datex").datepicker({
		 showButtonPanel: true,
		 currentText: '오늘 날짜', 
		 closeText: '닫기', 
		 dateFormat: 'yy-mm-dd',
		 changeMonth: true,
		 dayNames: ['일요일', '월요일', '화요일', '수요일', '목요일', '금요일', '토요일'],
		 dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'], 
		 monthNamesShort: ['1','2','3','4','5','6','7','8','9','10','11','12'],
		 monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월']
  });
});
$(function() {
	$(".datex").datepicker({
	});
});
</script>
<script>
function all_checked(sw) {
	//alert("전체 품목 선택 입니다.");
    var f = document.fboardlist;
    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "wr_idx[]"){
            f.elements[i].checked = sw;
		}
    }
	
	var tr_linex = (document.getElementsByClassName('tr_lines').length);
	if(sw == true){
		for(i=0;i<tr_linex;i++){
			document.getElementsByClassName('tr_lines')[i].style.backgroundColor = '#ffdd33';
		}
		document.getElementById('select_ea').value = tr_linex;
		document.getElementById('select_ea2').value = tr_linex;
		document.getElementById('co_select').style.display="block";
	}else{
		for(i=0;i<tr_linex;i++){
			document.getElementsByClassName('tr_lines')[i].style.backgroundColor = '';
		}
		document.getElementById('select_ea').value = "0";
		document.getElementById('select_ea2').value = "0";
		document.getElementById('co_select').style.display="none";
	}
	return false;
}
// 모두 선택된 상태에서 선택하면 색상 변경
function chkto(tr_line, chk_box, bgcolorx, vendor_idx){

	//var tr_line_qty = tr_line + "_qty";
	//var tr_line_qty_org = tr_line + "_qty_org";
	
	var tr_linex = document.getElementsByClassName('tr_lines');
	var co_sel_box = 'co_select';
	var select_ea = document.getElementById('select_ea');
	var select_ea2 = document.getElementById('select_ea2');
	var select_ea_now = parseInt(select_ea.value);
	var select_eaxxx = 0;

	if(document.getElementById(chk_box).checked == true){
		if(bgcolorx){
			document.getElementById(tr_line).style.backgroundColor=bgcolorx;
			//document.getElementById(tr_line_qty).style.display = 'none';
		}else{
			document.getElementById(tr_line).style.backgroundColor='#FFFFFF';
			//document.getElementById(tr_line_qty).style.display = 'none';
			//document.getElementById(tr_line_qty).value = document.getElementById(tr_line_qty_org).value;
		}
		document.getElementById(chk_box).checked = false;
		if(select_ea_now < 1){
		}else{
			select_eaxxx = select_ea_now - 1;
			select_ea.value = select_ea_now - 1;
			select_ea2.value = select_ea.value
			if(select_ea.value == 0){
				document.getElementById('co_select').style.display="none";
				document.getElementById('v_Vendor_Name').value = "";
			}
		}
	}else{
		document.getElementById(tr_line).style.backgroundColor='#FFE434';
		//document.getElementById(tr_line_qty).style.display = '';
		document.getElementById(chk_box).checked = true;
		select_eaxxx = select_ea_now + 1;
		select_ea.value = select_ea_now + 1;
		select_ea2.value = select_ea.value

		document.getElementById(co_sel_box).style.display="block";		
		var vendor_name = document.getElementById(vendor_idx);
		if(vendor_name.value){
			document.getElementById('v_Vendor_Name').value = vendor_name.value;
		}

	} 
	return false;
}


function move2_to(mode){
	var check = 0;
	var updated = "";
	var chk_count = 0;
	var tr_selected = "";
	var f = document.fboardlist;

	for (var i=0; i<f.length; i++) {
		if (f.elements[i].name == "wr_idx[]" && f.elements[i].checked){
			chk_count++;
			updated += f.elements[i].value + ",";
		}
	}

	if (!chk_count) {
		alert("처리할 Part를 하나 이상 선택하십시오.");
		return false;
	}
	
	/* 저장 시작 */
	var r = confirm("[알림] 선택한 "+chk_count+"건의 납품서를 출고 확정 하시겠습니까?");

	if (r == true){
		document.getElementById('outok').value = "Y"; //outok
		document.getElementById('form_id').submit();
		
		//Default RESET VALUE
		document.getElementById('select_ea2').value = "0";
		document.getElementById('select_ea').value = "0";

		for (var i=0; i<chk_count; i++) {
			if(update_array[i]){
				tr_selected = "chk_" + update_array[i];
				document.getElementById(tr_selected).checked = false;
			}
		}
		
	}	
	//alert(iwhere);
	return false;
}

function rpt_backout(rtp_no){
	var msg = "[알림]\n'"+rtp_no+"' 납품서를 출고 취소 하시겠습니까?";
	if(confirm(msg)){
		var url = "http://pjt.imetis.co.kr/bbs/board.php?bo_table=pms&link=rpt&mtc_no="+rtp_no+"&mode=cancel";
		document.getElementById('updated').src = url;
	}
}


function multiful_mtc(){
	//<?=$g4[path]?>/?rpt=<?=$listxt[ca_name]?>

	var check = 0;
	var updated = "";
	var chk_count = 0;
	var tr_selected = "";
	var f = document.fboardlist;

	for (var i=0; i<f.length; i++) {
		if (f.elements[i].name == "wr_idx[]" && f.elements[i].checked){
			chk_count++;
			updated += f.elements[i].value + ",";
		}
	}
	if (!chk_count) {
		alert("처리할 납품서를 하나 이상 선택하십시오.");
		return false;
	}
		
	window.open("<?=$g4[path]?>/skin/board/__pms/rpt_print.php?rpt_no="+updated+"&multiful=yes", "_blank", "toolbar=no,scrollbars=yes,resizable=yes,top=50,left=500,width=865,height=800");
	
}
</script>

<div style="width:100%; border:0px; <? if($use_metis){ ?> top:0px; <? }else{ ?> top:24px; <? } ?> position:fixed; z-index:0;">
<table cellpadding="0" cellspacing="0" style="width:100%; background-color:#FFF;">
 <tr>
  <td>
  	<span style="font-size:22px; color:#4A446F; white-space:nowrap; padding-left:15px; font-family:Malgun Gothic; letter-spacing:-1px;"><? if($use_metis){  ?><strong><?=$ca_name?></strong><? if($tm_m){ echo $month_title; }?>마감 정보<? }else{ ?>4. 월 마감 예상 / 조회<? } ?></span>
    <img src="<?=$g4[path]?>/img/btn_reflash.gif" style="border:0px; cursor:pointer; width:20px; margin-left:4px; margin-top:2px;" onClick="document.location.reload();"/>
  </td>
  <td width="300" rowspan="2" align="right"><img src="<?=$g4[path]?>/img/top_bg_img07a.gif" style="border:0px; height:52px; margin-right:-1px;"/></td>
 </tr>
</table>
<table cellpadding="0" cellspacing="0" style="width:100%; table-layout:fixed; background-color:#AAA; border-top: 1px solid #757576;">
 <tr height="33">
  <td width="100" style="text-align:left; padding-left:10px; font-size:20px; border-right:1px solid #888; <? if($y == "2017" or !$y){ ?> background-color:#EEE; color:#5F4576; font-weight:bold; <? }else{ ?> color:#DDD; font-family:Malgun Gothic; <? } ?>">2017년</td>
  <td width="100" style="text-align:left; padding-left:10px; font-size:20px; border-right:1px solid #888; <? if($y == "2018"){ ?> background-color:#DDFFFC; color:#5900D8; font-weight:bold; <? }else{ ?> color:#DDD; font-family:Malgun Gothic; <? } ?>">2018년</td>
  <td width="100" style="text-align:left; padding-left:10px; font-size:20px; <? if($y == "2019"){ ?> background-color:#DDFFFC; color:#5900D8; font-weight:bold; <? }else{ ?> color:#DDD; font-family:Malgun Gothic; <? } ?>">2019년</td>
  
  <td> </td>
 </tr>
</table>
<table cellpadding="0" cellspacing="0" width="100%" style="table-layout:fixed; border-top:1px solid #CCC; border-left:1px solid #CCC;">
<col width="70">
<col width="111">
<col width="80">
<col width="130">

<col width="80">
<col width="33">
<col width="80">
<col width="100">
<col width="28">
<col width="100">

<col width="130">
<col>

<tr height="24">
 <th rowspan="2" style="border-right:1px solid #CCC; border-bottom:3px double #CCC; background-color:#EEE; font-size:14px;">월</th>
 <th rowspan="2" style="border-right:1px solid #CCC; border-bottom:3px double #CCC; background-color:#EEE; font-size:14px;">납품서</th>
 <th rowspan="2" style="border-right:1px solid #CCC; border-bottom:3px double #CCC; background-color:#EEE; font-size:14px;">품목</th>
 <th rowspan="2" style="border-right:1px solid #CCC; border-bottom:3px double #CCC; background-color:#EEE; font-size:14px;">납품 금액</th>
 <th colspan="6" style="border-right:1px solid #CCC; border-bottom:1px solid #CCC; background-color:#EEE; font-size:14px;">일별 납품 정보</th>
 <th rowspan="2" style="border-right:1px solid #CCC; border-bottom:3px double #CCC; background-color:#EEE; font-size:14px;">-</th>
 <th rowspan="2" style="border-right:1px solid #CCC; border-bottom:3px double #CCC; background-color:#EEE; font-size:14px;">비고</th>
</tr>
<tr height="22">
 <th style="border-right:1px solid #CCC; border-bottom:3px double #CCC; background-color:#EEE; letter-spacing:-1px; font-size:12px;">납품일</th>
 <th style="border-right:1px solid #CCC; border-bottom:3px double #CCC; background-color:#EEE; letter-spacing:-1px; font-size:12px;">QTY</th>
 <th style="border-right:1px solid #CCC; border-bottom:3px double #CCC; background-color:#EEE; letter-spacing:-1px; font-size:12px;">합계</th>
 
 <th style="border-right:1px solid #CCC; border-bottom:3px double #CCC; background-color:#EEE; letter-spacing:-1px; font-size:12px;">납품서 번호</th>
 <th style="border-right:1px solid #CCC; border-bottom:3px double #CCC; background-color:#EEE; letter-spacing:-1px; font-size:12px;">품목</th>
 <th style="border-right:1px solid #CCC; border-bottom:3px double #CCC; background-color:#EEE; letter-spacing:-1px; font-size:12px;">납품서 개별 합계</th>
</tr>
</table>

</div>


<form name="fboardlist" id="form_id" method="post" <? /* onSubmit="return submit_check(this);" */ ?> autocomplete="off"
action="<?=$board_skin_path?>/list.po_process.php" <? if($member[mb_id] == "hbhwang"){ ?> target="_blank" <? }else{ ?> target="updated" <? } ?> enctype="multipart/form-data" method="post">
<input type='hidden' name='bo_table' value='<?=$bo_table?>'>
<input type='hidden' name='sfl'  value='<?=$sfl?>'>
<input type='hidden' name='stx'  value='<?=$stx?>'>
<input type='hidden' name='spt'  value='<?=$spt?>'>
<input type='hidden' name='page' value='<?=$page?>'>
<input type='hidden' name='m_id' value='<?=$m_id?>'>
<input type='hidden' name='sw'   value=''>
<input type='hidden' name='mtc'   value='mtc'>
<input type="hidden" id="select_ea" name="select_ea" value="0"/>
<input type='hidden' name='outok' id='outok'  value=''>

<div style="width:100%; margin:0px; padding:0px; border:0px; <? if($use_metis){ ?> height:62px; <? }else{ ?> height:86px; <? } ?>"></div>

<table cellpadding="0" cellspacing="0" width="100%" style="table-layout:fixed; border-top:1px solid #CCC; border-left:1px solid #CCC;">
<col width="70">
<col width="111">
<col width="80">
<col width="130">

<col width="80">
<col width="33">
<col width="80">
<col width="100">
<col width="28">
<col width="100">

<col width="130">
<col>

<tr height="24">
 <th rowspan="2" style="border-right:1px solid #CCC; border-bottom:3px double #CCC; background-color:#EEE; font-size:14px;">월</th>
 <th rowspan="2" style="border-right:1px solid #CCC; border-bottom:3px double #CCC; background-color:#EEE; font-size:14px;">납품서</th>
 <th rowspan="2" style="border-right:1px solid #CCC; border-bottom:3px double #CCC; background-color:#EEE; font-size:14px;">품목</th>
 <th rowspan="2" style="border-right:1px solid #CCC; border-bottom:3px double #CCC; background-color:#EEE; font-size:14px;">납품 금액</th>
 <th colspan="6" style="border-right:1px solid #CCC; border-bottom:1px solid #CCC; background-color:#EEE; font-size:14px;">일별 납품 정보</th>
 <th rowspan="2" style="border-right:1px solid #CCC; border-bottom:3px double #CCC; background-color:#EEE; font-size:14px;">-</th>
 <th rowspan="2" style="border-right:1px solid #CCC; border-bottom:3px double #CCC; background-color:#EEE; font-size:14px;">비고</th>
</tr>
<tr height="22">
 <th style="border-right:1px solid #CCC; border-bottom:3px double #CCC; background-color:#EEE; letter-spacing:-1px; font-size:12px;">납품일</th>
 <th style="border-right:1px solid #CCC; border-bottom:3px double #CCC; background-color:#EEE; letter-spacing:-1px; font-size:12px;">QTY</th>
 <th style="border-right:1px solid #CCC; border-bottom:3px double #CCC; background-color:#EEE; letter-spacing:-1px; font-size:12px;">합계</th>
 
 <th style="border-right:1px solid #CCC; border-bottom:3px double #CCC; background-color:#EEE; letter-spacing:-1px; font-size:12px;">납품서 번호</th>
 <th style="border-right:1px solid #CCC; border-bottom:3px double #CCC; background-color:#EEE; letter-spacing:-1px; font-size:12px;">품목</th>
 <th style="border-right:1px solid #CCC; border-bottom:3px double #CCC; background-color:#EEE; letter-spacing:-1px; font-size:12px;">납품서 개별 합계</th>
</tr>
<? for($i=1;$i<13;$i++){
	if($i == 1){ $monthx = "A"; }else
	if($i == 2){ $monthx = "B"; }else
	if($i == 3){ $monthx = "C"; }else
	if($i == 4){ $monthx = "D"; }else
	if($i == 5){ $monthx = "E"; }else
	if($i == 6){ $monthx = "F"; }else
	if($i == 7){ $monthx = "G"; }else
	if($i == 8){ $monthx = "H"; }else
	if($i == 9){ $monthx = "I"; }else
	if($i == 10){ $monthx = "J"; }else
	if($i == 11){ $monthx = "K"; }else
	if($i == 12){ $monthx = "L"; }
	?>
<tr>
 <td style="border-right:1px solid #CCC; border-bottom:3px double #CCC; font-size:13px; text-align:center;"><?=$i?>월</td>
 <td style="border-right:1px solid #CCC; border-bottom:3px double #CCC; font-size:13px; text-align:center;"><? 
		$ca_name = date("y").strtoupper(str_replace("-XXX","",$mtc_no))."-".$monthx;	
 //echo $ca_name;
if($tm_y && $tm_m){	
	if($tm_m == $monthx){
		$chk_month = sql_query(" SELECT count(ca_name) as cnt FROM `g4_write_bom_list_po_app` WHERE `ca_name` LIKE '".$ca_name."%' GROUP BY ca_name ");
		
	}
}else{
	$chk_month = sql_query(" SELECT count(ca_name) as cnt FROM `g4_write_bom_list_po_app` WHERE `ca_name` LIKE '".$ca_name."%' GROUP BY ca_name ");

}

 $cntx = 0;
 for($iz=0;$rowc=sql_fetch_array($chk_month);$iz++){
	 $cntx = $cntx + 1;
 }
 if($cntx > 0){
 	 echo "<span style='color:#363998; font-weight:bold; font-size:15px;'>".$cntx."건</span>";
 }else{
	 echo "<span style='color:#CCC;'>0</span>";
 }?></td>
 <td style="border-right:1px solid #CCC; border-bottom:3px double #CCC;  font-size:13px; text-align:center;"><?
 //echo $ca_name;
	
if($tm_y && $tm_m){	
	if($tm_m == $monthx){
 $chk_month2 = sql_fetch(" SELECT count(wr_id) as cnt FROM `g4_write_bom_list_po_app` WHERE `ca_name` like '".$ca_name."%'  ");
	}
}else{
 $chk_month2 = sql_fetch(" SELECT count(wr_id) as cnt FROM `g4_write_bom_list_po_app` WHERE `ca_name` like '".$ca_name."%'  ");

}	

	if($chk_month2[cnt] > 0){
 	 echo "<span style='color:#777; font-weight:bold; font-size:15px;'>".number_format($chk_month2[cnt])."</span>";
 }else{
	 echo "<span style='color:#CCC;'>0</span>";
 }?></td>
 
 <td style="border-right:1px solid #CCC; border-bottom:3px double #CCC;  font-size:13px; text-align:right; padding-right:8px;"><?
 $total_amount = 0;
if($tm_y && $tm_m){	
	if($tm_m == $monthx){
		$chk_month3 = sql_query(" SELECT AX FROM `g4_write_bom_list_po_app` WHERE `ca_name` LIKE '".$ca_name."%' GROUP BY ca_name ");
	}
}else{
	$chk_month3 = sql_query(" SELECT AX FROM `g4_write_bom_list_po_app` WHERE `ca_name` LIKE '".$ca_name."%' GROUP BY ca_name ");

}
	
 // $chk_month3 = sql_query(" SELECT AX FROM `g4_write_bom_list_po_app` WHERE `ca_name` LIKE '".$ca_name."%' GROUP BY ca_name ");
 for($ix=0;$rowx=sql_fetch_array($chk_month3);$ix++){
	 $total_amount = $total_amount + $rowx[AX];
 }
 if($total_amount > 0){
 	 echo "<span style='color:#777; font-weight:bold; font-size:15px;'>".number_format($total_amount)."</span>";
 }else{
	 echo "<span style='color:#CCC;'>0</span>";
 }?></td>
 
 <td style="border-right:1px solid #CCC; border-bottom:3px double #CCC;  font-size:14px; text-align:center;" colspan="6">

 <?
if($tm_y && $tm_m){	
	if($tm_m == $monthx){
 		$chk_month_part = sql_query(" SELECT * FROM `g4_write_bom_list_po_app` WHERE `ca_name` LIKE '".$ca_name."%' GROUP BY AV order by AV asc ");
	}
}else{
	 $chk_month_part = sql_query(" SELECT * FROM `g4_write_bom_list_po_app` WHERE `ca_name` LIKE '".$ca_name."%' GROUP BY AV order by AV asc ");

}		
 // $chk_month_part = sql_query(" SELECT * FROM `g4_write_bom_list_po_app` WHERE `ca_name` LIKE '".$ca_name."%' GROUP BY AV order by AV asc ");
 for($ip=0;$rowp=sql_fetch_array($chk_month_part);$ip++){
	 if($ip == 0){
		?><table cellpadding="0" cellspacing="0" style="border:0px; width:100%;"><?
		$borderx = " style='border-right:1px solid #DDD' ";
		$borderx2 = " style='' ";
	 }else{
		$borderx = " style='border-top:1px solid #CCC; border-right:1px solid #DDD' ";
		$borderx2 = " style='border-top:1px solid #CCC; ' ";
	 }
	 $calc = sql_query(" SELECT * FROM `g4_write_bom_list_po_app` WHERE `ca_name` LIKE '".$ca_name."%' and `AV` = '".$rowp[AV]."' group by ca_name, AV ");
	 $cntzz = 0;
	 $sub_amount = 0;
	 for($izz=0;$rowcz=sql_fetch_array($calc);$izz++){
		 $cntzz = $cntzz + 1;
		 $sub_amount = $sub_amount + $rowcz[AX];
	 }
	 ?><tr>
         <td width="79" <?=$borderx?>><?=$rowp[AV]?></td>
         <td width="32" <?=$borderx?>><?=$cntzz?></td>
         <td width="79" <?=$borderx?> align="right"><?=number_format($sub_amount)?>&nbsp;</td>
         <td align="right" <?=$borderx2?>>
             <table cellpadding="0" cellspacing="0" style="border:0px; padding:0px; width:100%;"><?
             $chk_month_parts = sql_query(" SELECT * FROM `g4_write_bom_list_po_app` WHERE `ca_name` LIKE '".$ca_name."%' and `AV` = '".$rowp[AV]."' GROUP BY ca_name, AV order by ca_name asc");
             for($ipx=0;$rowpx=sql_fetch_array($chk_month_parts);$ipx++){
                 $rowpxcc = sql_fetch(" SELECT count(wr_id) as cnt, sum(AX) as amount FROM `g4_write_bom_list_po_app` WHERE `ca_name` = '".$rowpx[ca_name]."' order by ca_name asc ");
                 if($ipx == 0){
                    $borderxx = " style='border-right:1px solid #DDD; font-size:11px;' ";
                    $borderxxp = " style='border-right:1px solid #DDD; cursor:pointer; color:#0000CC; font-size:11px;' ";
                    $borderxx2 = " style=' padding-right:5px;' ";
                 }else{
                    $borderxx = " style='border-top:1px solid #CCC; border-right:1px solid #DDD; font-size:11px;' ";
                    $borderxxp = " style='border-top:1px solid #CCC; border-right:1px solid #DDD; cursor:pointer; color:#0000CC; font-size:11px;' ";
                    $borderxx2 = " style='border-top:1px solid #CCC; padding-right:5px;  font-size:11px;' ";
                 }
                 ?><tr>
                     <td width="99" align="center" <?=$borderxxp?> onClick='window.open("http://pjt.imetis.co.kr/?rpt=<?=$rowpx[ca_name]?>", "_blank", "toolbar=no,scrollbars=yes,resizable=yes,top=50,left=500,width=840,height=700");'><?=$rowpx[ca_name]?></td>
                     <td width="27" align="center" <?=$borderxx?>><?=$rowpxcc[cnt]?></td>
                     <td align="right" <?=$borderxx2?>><?=number_format($rowpx[AX])?></td>
                 </tr>
                 <?
             }
             ?></table>
             
         </td>
     </tr>
     <?
 }
 if($ip){ ?></table><? 
 }else{ ?>
  <table cellpadding="0" cellspacing="0" style="border:0px; width:100%;"><tr>
         <td width="79" height="18" style='border-right:1px solid #DDD'>&nbsp;</td>
         <td width="32" style='border-right:1px solid #DDD'>&nbsp;</td>
         <td width="79" style='border-right:1px solid #DDD' align="right">&nbsp;</td>
         <td width="99" align="center" style='border-right:1px solid #DDD'>&nbsp;</td>
         <td width="27" align="center" style='border-right:1px solid #DDD'>&nbsp;</td>
         <td align="right" style=''>&nbsp;</td>
  </tr></table>
 <? } ?>


 </td>
 <td style="border-right:1px solid #CCC; border-bottom:3px double #CCC;  font-size:14px; text-align:center;">&nbsp;</td>
 <td style="border-right:1px solid #CCC; border-bottom:3px double #CCC;  font-size:14px; text-align:lefr; padding-left:5px; color:#999;">-</td>
</tr>
<? } ?>
</table>


</form>
<br/><br/>
<br/><br/>
<br/><br/>
<br/><br/>
<?
/*
exit;
?>
<div style="width:100%;">
<iframe src="//sharecad.org/cadframe/load?url=http://oms.imetis.co.kr/dwg/SMZ-005326A_D300-34147A_R000.dxf" scrolling="no" style="width:99%; height:600px; border:0px;"></iframe>
<!--<iframe src="//sharecad.org/cadframe/load?url=http://oms.imetis.co.kr/dwg/KMFA-506257-R006.dwg" scrolling="no" style="width:99%; height:600px; border:0px;"></iframe>-->
</div>

*/
?>
