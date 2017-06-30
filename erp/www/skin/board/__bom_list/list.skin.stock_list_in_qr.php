<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

##예외 처리 - 업체명이 없을 경우
$sqlx = sql_query(" SELECT * FROM `g4_write_bom_list_po_app` WHERE `AI` = '' ");
for($ix=0;$rowx=sql_fetch_array($sqlx);$ix++){
	$vendor_name = explode("|",$rowx[wr_8]);
	if($vendor_name[1]){
		$skip_update = sql_query(" UPDATE `g4_write_bom_list_po_app` SET `AI`='".$vendor_name[1]."' WHERE `wr_id`='".$rowx[wr_id]."'  ");
	}
}

##예외 처리 - 일신정밀 ==> ㈜일신정밀
$sqlx = sql_query(" SELECT * FROM `g4_write_bom_list_po_app` WHERE `AI` = '일신정밀' ");
for($ix=0;$rowx=sql_fetch_array($sqlx);$ix++){
	sql_query(" UPDATE `g4_write_bom_list_po_app` SET `AI`='㈜일신정밀' WHERE `wr_id`='".$rowx[wr_id]."'  ");
}
##예외 처리 - 커미조아 ==> ㈜커미조아
$sqlx = sql_query(" SELECT * FROM `g4_write_bom_list_po_app` WHERE `AI` = '커미조아' ");
for($ix=0;$rowx=sql_fetch_array($sqlx);$ix++){
	sql_query(" UPDATE `g4_write_bom_list_po_app` SET `AI`='㈜커미조아' WHERE `wr_id`='".$rowx[wr_id]."'  ");
}
##예외 처리 - 파워테크(주) ==> 파워테크
$sqlx = sql_query(" SELECT * FROM `g4_write_bom_list_po_app` WHERE `AI` = '파워테크(주)' ");
for($ix=0;$rowx=sql_fetch_array($sqlx);$ix++){
	sql_query(" UPDATE `g4_write_bom_list_po_app` SET `AI`='파워테크' WHERE `wr_id`='".$rowx[wr_id]."'  ");
}
##예외 처리 - (주)천음테크 ==> 천음테크
$sqlx = sql_query(" SELECT * FROM `g4_write_bom_list_po_app` WHERE `AI` = '(주)천음테크' ");
for($ix=0;$rowx=sql_fetch_array($sqlx);$ix++){
	sql_query(" UPDATE `g4_write_bom_list_po_app` SET `AI`='천음테크' WHERE `wr_id`='".$rowx[wr_id]."'  ");
}
// 선택옵션으로 인해 셀합치기가 가변적으로 변함
?><!--
list.skin.stock_list_in_qr.php
-->
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

function category_mode(mode){
	var url = "<?=$g4[path]?>/bbs/board.php?bo_table=bom_list&stock=in&qr=y&m_id=371&cis_part=<?=$cis_part?>&part_name=<?=$part_name?>&wr_num=<?=$wr_num?>&ca_name=<?=$ca_name?>&wr_content=<?=$wr_content?>&AI=<?=$AI?>&po_name=<?=$po_name?>&category_mode="+mode;
	document.location.href=url;
	
}


function category_vendor(vendor_nm){
	
	if(vendor_nm == "reset"){
		var url = "<?=$g4[path]?>/bbs/board.php?bo_table=bom_list&stock=in&qr=y&m_id=371&cis_part=<?=$cis_part?>&part_name=<?=$part_name?>&wr_num=<?=$wr_num?>&ca_name=<?=$ca_name?>&wr_content=<?=$wr_content?>&AI=<?=$AI?>&po_name=<?=$po_name?>&category_mode=<?=$category_mode?>";
	}else{
		var url = "<?=$g4[path]?>/bbs/board.php?bo_table=bom_list&stock=in&qr=y&m_id=371&cis_part=<?=$cis_part?>&part_name=<?=$part_name?>&wr_num=<?=$wr_num?>&ca_name=<?=$ca_name?>&wr_content=<?=$wr_content?>&AI=<?=$AI?>&po_name=<?=$po_name?>&category_mode=<?=$category_mode?>&slt_vendor="+vendor_nm;
	}
	document.location.href=url;
	
}


function cancel_in(mtc_no){
	if(confirm("[알림]\n납품서 `"+mtc_no+"`의 입고를 취소 하시겠습니까?")){
		urlx = "<?=$g4[path]?>/skin/board/__bom_list/stock_process_mtc.php?modex=cancel_in&ca_name="+mtc_no;
		document.getElementById('hiddenFramex').src = urlx;
	}
}

</script>
<style>
body { margin:0px; padding:0px; border:0px }
.part_list th { background-color:#DEDEDE; color:#444; font-size:11px; white-space:nowrap; letter-spacing:0px; border-right:1px solid #CCC; border-bottom:1px solid #BBB; height:20px; }
.part_list td { color:#444; border-right:1px solid #E2E2E2; border-bottom:1px solid #DDD; padding-left:2px; }
</style>

<?
$limit = " limit 0, 1000 ";
$orderby = " order by AV desc, ca_name desc   ";

$po_list = " SELECT * FROM `g4_write_bom_list_po_app` WHERE `ca_name` <> '' and `AU` <> '' and `AV` <> ''  ";
/*
if($date_a and $date_b){
	$po_list .= " and ( `AM` between '".$date_a." 00:00:00' and '".$date_b." 23:59:59' ) ";
}
*/

if($category_mode){
	if($category_mode == "all"){
		$po_list .= "  ";
	}else
	if($category_mode == "today"){
		$po_list .= " and ( `BJ` NOT LIKE '%,%' and `BJ` != '' ) ";
	}else
	if($category_mode == "wait"){
		$po_list .= " and ( `BJ` = '' ) ";
	}else
	if($category_mode == "done"){
		$po_list .= " and ( `BJ` NOT LIKE '%,%' and `BJ` != '' ) ";
	}
	$limit = '';
}



		
if($t17A or $t17B or $t17C or $t17D or $t17E or $t17F or $t17G or $t17H or $t17I or $t17J  or $t17K or $t17L  ){
	$slt_date = "y";
}



if($cis_part){
	$po_list .= " and ( `M` LIKE '%".$cis_part."%'  or `N` LIKE '%".$cis_part."%' ) ";
	$limit = '';
}

if($part_name){
	$po_list .= " and ( `P` LIKE '%".$part_name."%'  or `Q` LIKE '%".$part_name."%' or `U` LIKE '%".$part_name."%' ) ";
	$limit = '';
}

if($wr_num){
	$po_list .= " and ( `wr_num` LIKE '%".$wr_num."%'   ) ";
	$limit = '';
}

if($ca_name){
	$po_list .= " and ( `ca_name` LIKE '%".$ca_name."%'   ) ";
	$limit = '';
	?><script>document.getElementById('search_info').innerHTML += "<span style='padding:1px 8px; background-color:#FFEE77; color:#000099; font-size:11px;'>납품서 번호 : <B><?=$ca_name?></B></span>&nbsp;";</script><?
}

if($wr_content){
	$po_list .= " and ( `wr_content` LIKE '%".$wr_content."%'   ) ";
	$limit = '';
	?><script>document.getElementById('search_info').innerHTML += "<span style='padding:1px 8px; background-color:#FFEE77; color:#000099; font-size:11px;'>PO 번호 : <B><?=$wr_content?></B></span>&nbsp;";</script><?
}

if($AI){
	$po_list .= " and ( `AI` LIKE '%".$AI."%'   ) ";
	$limit = '';
	?><script>document.getElementById('search_info').innerHTML += "<span style='padding:1px 8px; background-color:#FFEE77; color:#000099; font-size:11px;'>업체명 : <B><?=$AI?></B></span>&nbsp;";</script><?
}else
if($slt_vendor){
	$po_list .= " and ( `AI` LIKE '%".$slt_vendor."%'   ) ";

}

if($po_name){
	$po_list .= " and `wr_content` = '".$po_name."' ";
	$limit = '';
}


?>

<table width="100%" cellpadding="0" cellspacing="0" style="table-layout:fixed; border-top:5px solid #111111;">
<tr bgcolor="#111111">
 <td width="118" height="20" onclick="category_mode('all');" style=" padding-left:8px; <? if($category_mode == "all" ){ ?> border-bottom:1px solid #FFFFFF; background-color:#FFFFFF; color:#555; <? }else{ ?> border-bottom:1px solid #111111; background-color:#999999; color:#555; <? } ?>  text-align:left; border-right:2px solid #111111; border-left:2px solid #111111; cursor:pointer; ">모든 QR 납품서</td>
 <td width="118" height="20" onclick="category_mode('wait');" style=" padding-left:8px; <? if($category_mode == "wait" ){ ?> border-bottom:1px solid #FFFFFF; background-color:#FFFFFF; color:#555; <? }else{ ?> border-bottom:1px solid #111111; background-color:#999999; color:#555; <? } ?> text-align:left; cursor:pointer; border-right:2px solid #111111; border-left:2px solid #111111;">입고 예정</td>
 <td width="118" height="20" onclick="category_mode('today');" style=" padding-left:8px; <? if($category_mode == "today" ){ ?> border-bottom:1px solid #FFFFFF; background-color:#FFFFFF; color:#555; <? }else{ ?> border-bottom:1px solid #111111; background-color:#999999; color:#555; <? } ?> text-align:left; cursor:pointer;  border-right:2px solid #111111; border-left:2px solid #111111;">입고 완료 (금일)</td>
 <td width="118" height="20" onclick="category_mode('done');" style=" padding-left:8px; <? if($category_mode == "done" ){ ?> border-bottom:1px solid #FFFFFF; background-color:#FFFFFF; color:#555; <? }else{ ?> border-bottom:1px solid #111111; background-color:#999999; color:#555; <? } ?> text-align:left; cursor:pointer;  border-right:2px solid #111111; border-left:2px solid #111111;">모든 입고 완료건</td>
 <td style="padding-left:20px;border-bottom:1px solid #111111; "><div id="search_info"></div></td>
 <td>&nbsp;</td>
 </tr>
</tr>
<? if($category_mode == "today"){ }else{ ?>
<tr>
<td colspan="6">
	<div style="width:98%; padding-left:5px; padding-top:4px;"><? 
		$sql_vendor  = " SELECT * FROM `g4_write_bom_list_po_app` WHERE `ca_name` <> '' and `AU` <> '' and `AV` <> '' group by AI "; 
		$result_vendor = sql_query($sql_vendor);
		if($slt_vendor or !$category_mode){
			?><div  onclick="category_vendor('reset');" style="width:160px; overflow:hidden; letter-spacing:0px; white-space:nowrap; background-color:#FAFAFA; text-align:center; padding:2px; cursor:pointer; font-size:11px; border-right:5px solid #FFF; border-bottom:3px solid #FFF; font-family:Dotum !important; display:inline-block; "> 업체 ALL 보기 </div><?
		}else{
			?><div  onclick="category_vendor('reset');" style="width:160px; overflow:hidden; letter-spacing:0px; white-space:nowrap; text-align:center; padding:2px; cursor:pointer; font-size:11px; border-right:5px solid #FFF; border-bottom:3px solid #FFF; font-family:Dotum !important; display:inline-block; font-weight:bold; background-color:#353535; color:#FFE500; "> 업체 ALL </div><?
		}
		// if($member[mb_id] == "ssh881108"){
			
			for($iv=0; $vendor_list = sql_fetch_array($result_vendor); $iv++){
				$tmp_vendor = str_replace("(주)","",$vendor_list[AI]);
				$tmp_vendor = str_replace("주식회사 ","",$tmp_vendor);
				$tmp_vendor = str_replace("㈜","",$tmp_vendor);
				
				$vendor_arrayx[] = $tmp_vendor;
			}			
			
			
			sort($vendor_arrayx);
			for($ivx=0; $ivx < count($vendor_arrayx); $ivx++){
				$vendor_info = sql_fetch(" SELECT mb_2, mb_name FROM g4_member where mb_name LIKE '%".$vendor_arrayx[$ivx]."%' ");
				if($slt_vendor == $vendor_arrayx[$ivx]){ 
					$ori_slt_vendor = $vendor_info[mb_name];
					$ori_slt_vendor_code = $vendor_info[mb_2];

				}
				?><div  onclick="category_vendor('<?=$vendor_arrayx[$ivx]?>');" style="width:160px; overflow:hidden; letter-spacing:0px; white-space:nowrap; <? if($slt_vendor == $vendor_arrayx[$ivx]){ ?> background-color:#FFD600; color:#111;  <? }else{ ?>background-color:#CCCCCC; color:#333;  <? } ?> 
			   text-align:left; padding:2px; cursor:pointer; font-size:11px; border-right:5px solid #FFF; border-bottom:3px solid #FFF; font-family:Dotum !important; display:inline-block; "
			   <? if($slt_vendor == $vendor_arrayx[$ivx]){ }else{ ?> onMouseOver="this.style.backgroundColor='#DDBA62';" onMouseOut="this.style.backgroundColor='#CCCCCC';" <? } ?>>[<?=$vendor_info[mb_2]?>] <?=$vendor_arrayx[$ivx]?></div><?
			}
		/*	
		}else{
			for($iv=0; $vendor_list = sql_fetch_array($result_vendor); $iv++){
				?><div  onclick="category_vendor('<?=$vendor_list[AI]?>');" style="width:140px; overflow:hidden; letter-spacing:0px; white-space:nowrap; <? if($slt_vendor == $vendor_list[AI]){ ?> background-color:#FFD600; color:#111;  <? }else{ ?>background-color:#CCCCCC; color:#333;  <? } ?> 
			   text-align:center; padding:2px; cursor:pointer; font-size:11px; border-right:5px solid #FFF; border-bottom:3px solid #FFF; font-family:Dotum !important; display:inline-block; "
			   <? if($slt_vendor == $vendor_list[AI]){ }else{ ?> onMouseOver="this.style.backgroundColor='#DDBA62';" onMouseOut="this.style.backgroundColor='#CCCCCC';" <? } ?>><?=$vendor_list[AI]?></div><?
			}
		} */
		?>
    </div>
</td>
</tr>
<?

if(!$category_mode and !$slt_vendor){
	?></table><br/>
    <span style="padding-left:20px; font-size:11px; color:#9E2F31;">
    [!] `업체`를 선택하거나 `업체 ALL 보기`를 선택하면 조회가 가능 합니다.
    </span>
	<?
    exit;
	
}else{ ?><tr>
<td colspan="5" style="padding:5px;">

  <table cellpadding="0" cellspacing="0" width="98%">
 <tr height="32"><td colspan="2" valign="top"><span style="font-size:18px; font-weight:bold; padding:3px;"><?=$ori_slt_vendor?></span></td></tr>
  <tr><td width="49%" valign="top">
	<table cellpadding="0" cellspacing="0" width="570" style="display:inline-block;">
    <tr><td style="border:0px; padding:0px;"><span style="font-weight:bold; background-color:#3B3B3B; font-size:14px; padding:1px 15px; color:#EEEEEE;">2017년</span></td>
    <tr><td style="border:2px solid #3B3B3B; padding:3px;">
    	<? 
		$tmp_url = $_SERVER['REQUEST_URI'];
		
		$tmp_url = str_replace("&t17A=y","",$tmp_url);
		$tmp_url = str_replace("&t17B=y","",$tmp_url);
		$tmp_url = str_replace("&t17C=y","",$tmp_url);
		$tmp_url = str_replace("&t17D=y","",$tmp_url);
		$tmp_url = str_replace("&t17E=y","",$tmp_url);
		$tmp_url = str_replace("&t17F=y","",$tmp_url);
		$tmp_url = str_replace("&t17G=y","",$tmp_url);
		$tmp_url = str_replace("&t17H=y","",$tmp_url);
		$tmp_url = str_replace("&t17I=y","",$tmp_url);
		$tmp_url = str_replace("&t17J=y","",$tmp_url);
		$tmp_url = str_replace("&t17K=y","",$tmp_url);
		$tmp_url = str_replace("&t17L=y","",$tmp_url);
			
		$server_urlx = $tmp_url;
		//&t17A=y&t17B=y&t17C=y&t17D=y&t17E=y&t17F=y&t17G=y&t17H=y&t17I=y&t17J=y&t17K=y&t17L=y
	
		?>
    	<input type="radio" name="chk_month[]" id="t17A" value="17A" <? if($t17A){ ?> checked <? } ?>
        onClick="document.location.href='<? echo $g4[path]; if(!$t17A){ $s17A='y'; } echo str_replace(array('&t17A=y','&t17A='), '', $server_urlx); echo "&t17A=".$s17A; ?>';"/><label for="t17A" style=" cursor:pointer;
        <? if($t17A){ ?> font-weight:bold; color:#0000FF; <? }else{ ?> color:#777777; <? } ?>">1월</label>
    	<input type="radio" name="chk_month[]" id="t17B" value="17B" <? if($t17B){ ?> checked <? } ?>
        onClick="document.location.href='<? echo $g4[path]; if(!$t17B){ $s17B='y'; } echo str_replace(array('&t17B=y','&t17B='), '', $server_urlx); echo "&t17B=".$s17B; ?>';"/><label for="t17B" style=" cursor:pointer;
        <? if($t17B){ ?> font-weight:bold; color:#0000FF; <? }else{ ?> color:#777777; <? } ?>">2월</label>
    	<input type="radio" name="chk_month[]" id="t17C" value="17C" <? if($t17C){ ?> checked <? } ?>
        onClick="document.location.href='<? echo $g4[path]; if(!$t17C){ $s17C='y'; } echo str_replace(array('&t17C=y','&t17C='), '', $server_urlx); echo "&t17C=".$s17C; ?>';"/><label for="t17C" style=" cursor:pointer;
        <? if($t17C){ ?> font-weight:bold; color:#0000FF; <? }else{ ?> color:#777777; <? } ?>">3월</label>
    	<input type="radio" name="chk_month[]" id="t17D" value="17D" <? if($t17D){ ?> checked <? } ?>
        onClick="document.location.href='<? echo $g4[path]; if(!$t17D){ $s17D='y'; } echo str_replace(array('&t17D=y','&t17D='), '', $server_urlx); echo "&t17D=".$s17D; ?>';"/><label for="t17D" style=" cursor:pointer;
        <? if($t17D){ ?> font-weight:bold; color:#0000FF; <? }else{ ?> color:#777777; <? } ?>">4월</label>
    	<input type="radio" name="chk_month[]" id="t17E" value="17E" <? if($t17E){ ?> checked <? } ?>
        onClick="document.location.href='<? echo $g4[path]; if(!$t17E){ $s17E='y'; } echo str_replace(array('&t17E=y','&t17E='), '', $server_urlx); echo "&t17E=".$s17E; ?>';"/><label for="t17E" style=" cursor:pointer;
        <? if($t17E){ ?> font-weight:bold; color:#0000FF; <? }else{ ?> color:#777777; <? } ?>">5월</label>
    	<input type="radio" name="chk_month[]" id="t17F" value="17F" <? if($t17F){ ?> checked <? } ?>
        onClick="document.location.href='<? echo $g4[path]; if(!$t17F){ $s17F='y'; } echo str_replace(array('&t17F=y','&t17F='), '', $server_urlx); echo "&t17F=".$s17F; ?>';"/><label for="t17F" style=" cursor:pointer;
        <? if($t17F){ ?> font-weight:bold; color:#0000FF; <? }else{ ?> color:#777777; <? } ?>">6월</label>
    	<input type="radio" name="chk_month[]" id="t17G" value="17G" <? if($t17G){ ?> checked <? } ?>
        onClick="document.location.href='<? echo $g4[path]; if(!$t17G){ $s17G='y'; } echo str_replace(array('&t17G=y','&t17G='), '', $server_urlx); echo "&t17G=".$s17G; ?>';"/><label for="t17G" style=" cursor:pointer;
        <? if($t17G){ ?> font-weight:bold; color:#0000FF; <? }else{ ?> color:#777777; <? } ?>">7월</label>
    	<input type="radio" name="chk_month[]" id="t17H" value="17H" <? if($t17H){ ?> checked <? } ?>
        onClick="document.location.href='<? echo $g4[path]; if(!$t17H){ $s17H='y'; } echo str_replace(array('&t17H=y','&t17H='), '', $server_urlx); echo "&t17H=".$s17H; ?>';"/><label for="t17H" style=" cursor:pointer;
        <? if($t17H){ ?> font-weight:bold; color:#0000FF; <? }else{ ?> color:#777777; <? } ?>">8월</label>
    	<input type="radio" name="chk_month[]" id="t17I" value="17I" <? if($t17I){ ?> checked <? } ?>
        onClick="document.location.href='<? echo $g4[path]; if(!$t17I){ $s17I='y'; } echo str_replace(array('&t17I=y','&t17I='), '', $server_urlx); echo "&t17I=".$s17I; ?>';"/><label for="t17I" style=" cursor:pointer;
        <? if($t17I){ ?> font-weight:bold; color:#0000FF; <? }else{ ?> color:#777777; <? } ?>">9월</label>
    	<input type="radio" name="chk_month[]" id="t17J" value="17J" <? if($t17J){ ?> checked <? } ?>
        onClick="document.location.href='<? echo $g4[path]; if(!$t17J){ $s17J='y'; } echo str_replace(array('&t17J=y','&t17J='), '', $server_urlx); echo "&t17J=".$s17J; ?>';"/><label for="t17J" style=" cursor:pointer;
        <? if($t17J){ ?> font-weight:bold; color:#0000FF; <? }else{ ?> color:#777777; <? } ?>">10월</label>
    	<input type="radio" name="chk_month[]" id="t17K" value="17K" <? if($t17K){ ?> checked <? } ?>
        onClick="document.location.href='<? echo $g4[path]; if(!$t17K){ $s17K='y'; } echo str_replace(array('&t17K=y','&t17K='), '', $server_urlx); echo "&t17K=".$s17K; ?>';"/><label for="t17K" style=" cursor:pointer;
        <? if($t17K){ ?> font-weight:bold; color:#0000FF; <? }else{ ?> color:#777777; <? } ?>">11월</label>
    	<input type="radio" name="chk_month[]" id="t17L" value="17L" <? if($t17L){ ?> checked <? } ?>
        onClick="document.location.href='<? echo $g4[path]; if(!$t17L){ $s17L='y'; } echo str_replace(array('&t17L=y','&t17L='), '', $server_urlx); echo "&t17L=".$s17L; ?>';"/><label for="t17L" style=" cursor:pointer;
        <? if($t17L){ ?> font-weight:bold; color:#0000FF; <? }else{ ?> color:#777777; <? } ?>">12월</label>
    </td>
    </tr>
    </table>
   
   </td>
   <td width="49%" valign="bottom">
    <? if($slt_vendor){ 
	   
	if($t17A){ $tm_y = "17"; $tm_m = "A";  }else
	if($t17B){ $tm_y = "17"; $tm_m = "B";  }else
	if($t17C){ $tm_y = "17"; $tm_m = "C";  }else
	if($t17D){ $tm_y = "17"; $tm_m = "D";  }else
	if($t17E){ $tm_y = "17"; $tm_m = "E";  }else
	if($t17F){ $tm_y = "17"; $tm_m = "F";  }else
	if($t17G){ $tm_y = "17"; $tm_m = "G";  }else
	if($t17H){ $tm_y = "17"; $tm_m = "H";  }else
	if($t17I){ $tm_y = "17"; $tm_m = "I";  }else
	if($t17J){ $tm_y = "17"; $tm_m = "J";  }else
	if($t17K){ $tm_y = "17"; $tm_m = "K";  }else
	if($t17L){ $tm_y = "17"; $tm_m = "L";  }
?>
    <a href="http://pjt.imetis.co.kr/bbs/board.php?bo_table=pms&link=cost&mtc=<?=$ori_slt_vendor_code?>&tm_y=<?=$tm_y?>&tm_m=<?=$tm_m?>" target="_blank" style=" display:inline-block; border:1px sold #333333; background-color:#555555; color:#FFFFFF; padding:1px 10px;"><strong><?=$slt_vendor?></strong> 업체 마감 정보 보기</a><?
	} ?>
   </td>
   </tr>
   </table>

</td>
</tr>

<? } ?>
<?
if(!$slt_date){
	?></table><br/>
    <span style="padding-left:20px; font-size:11px; color:#9E2F31;">
    [!] `마감월`을 선택하면 조회가 가능 합니다.
    </span>
	<?
    exit;
	
}?>

</table>
<table cellpadding="0" cellspacing="0" class="part_list" style="table-layout:fixed; border-left:1px solid #CCC; width:100%; border-top:1px solid #AAA;">
<col width="22">
<col width="30">
<col width="140">
<col width="120">
<col width="99">
<col width="280">
<col width="72">
<col width="110">
<col width="180">
<col>
<tr>
 <th><input onclick="if (this.checked) all_checked(true); else all_checked(false);" type="checkbox"></th>
 <th>No</th>
 <th>납품 업체명</th>
 <th>INVOICE No</th>
 <th>업체 출고일</th>
 <th>품명</th>
 <th>지정수량</th>
 <th>합계</th>
 <th style="letter-spacing:-1px;">METIS 입고 확정</th>
 <th>비고</th>
</tr>
<?
$mtc = "";
if($slt_vendor){
	$chk_mtc = sql_fetch(" SELECT * FROM `g4_member` WHERE `mb_name` LIKE '%".$slt_vendor."%' ");
	$mtc = $chk_mtc[mb_2];
}
$add_query = "";
if($t17A){ $tm_y = "17"; $tm_m = "A"; $add_query .= " and `ca_name` like '".$tm_y.$mtc."-".$tm_m."%' "; }else
if($t17B){ $tm_y = "17"; $tm_m = "B"; $add_query .= " and `ca_name` like '".$tm_y.$mtc."-".$tm_m."%' "; }else
if($t17C){ $tm_y = "17"; $tm_m = "C"; $add_query .= " and `ca_name` like '".$tm_y.$mtc."-".$tm_m."%' "; }else
if($t17D){ $tm_y = "17"; $tm_m = "D"; $add_query .= " and `ca_name` like '".$tm_y.$mtc."-".$tm_m."%' "; }else
if($t17E){ $tm_y = "17"; $tm_m = "E"; $add_query .= " and `ca_name` like '".$tm_y.$mtc."-".$tm_m."%' "; }else
if($t17F){ $tm_y = "17"; $tm_m = "F"; $add_query .= " and `ca_name` like '".$tm_y.$mtc."-".$tm_m."%' "; }else
if($t17G){ $tm_y = "17"; $tm_m = "G"; $add_query .= " and `ca_name` like '".$tm_y.$mtc."-".$tm_m."%' "; }else
if($t17H){ $tm_y = "17"; $tm_m = "H"; $add_query .= " and `ca_name` like '".$tm_y.$mtc."-".$tm_m."%' "; }else
if($t17I){ $tm_y = "17"; $tm_m = "I"; $add_query .= " and `ca_name` like '".$tm_y.$mtc."-".$tm_m."%' "; }else
if($t17J){ $tm_y = "17"; $tm_m = "J"; $add_query .= " and `ca_name` like '".$tm_y.$mtc."-".$tm_m."%' "; }else
if($t17K){ $tm_y = "17"; $tm_m = "K"; $add_query .= " and `ca_name` like '".$tm_y.$mtc."-".$tm_m."%' "; }else
if($t17L){ $tm_y = "17"; $tm_m = "L"; $add_query .= " and `ca_name` like '".$tm_y.$mtc."-".$tm_m."%' "; }

	
$po_list .= " {$add_query}  group by ca_name ".$orderby.$limit;
$po_list_top = " SELECT * FROM `g4_write_bom_list_po_app` WHERE `AI` <> '' and `wr_comment_reply` <> ''  and `AW` != '' group by AW desc, ca_name desc";

$total_cnt = 0;
$total_amount = 0;

$r_in_qty  = 0;
$r_in_amount = 0;?><!--
FIXED SQL :: <?=$sqlx?>
--><?
$sqlx = sql_query($po_list);
for($i=0;$listx=sql_fetch_array($sqlx);$i++){
	
	$stock_in = "";
	$mtc_list = sql_fetch(" SELECT count(wr_id) as cnt FROM `g4_write_bom_list_po_app` WHERE `ca_name` = '".$listx[ca_name]."'  ");
	$total_cnt = $mtc_list[cnt] + $total_cnt;

	//입고 체크
	$in_cnt = 0;
	$status_x = sql_fetch(" SELECT count(wr_id) as cnt, s_d_date FROM `g4_write_bom_list_po_ea` WHERE `po_memo`='".$listx[ca_name]."' and `po_type`='in' and `s_d_code` LIKE 'S1%' and `app_wr_id` > 0 ");
	
	if($mtc_list[cnt] > $status_x[cnt] and $status_x[cnt] > 0){
		$stock_in = "일부 입고";
		
	}else
	if($mtc_list[cnt] == $status_x[cnt]){
		$stock_in = "입고 완료";
		
		$chk_out = sql_fetch(" SELECT count(wr_id) as cnt FROM `g4_write_bom_list_po_ea` WHERE `po_memo`='".$listx[ca_name]."' and `po_type`='out' and `s_d_code` LIKE 'D1%' and `app_wr_id` > 0 ");
		if($mtc_list[cnt] > $chk_out[cnt] and $chk_out[cnt] > 0){
			$stock_in = "일부 출고";
		}else
		if($mtc_list[cnt] == $chk_out[cnt]){
			$stock_in = "출고 완료";
		}
	}
	$r_in_qty = $r_in_qty + $status_x[cnt];


	if($i == 0){
		$numt = 0;
		$tr_style = ' style="background-color:#FFDDEE; cursor:pointer;" ';
		$split_line = "";
		$sqlxt = sql_query($po_list_top);	
		for($it=0;$listxt=sql_fetch_array($sqlxt);$it++){
			$numt = $numt + 1;
			//Check sotck_in
			$chk_in = sql_fetch(" SELECT * FROM `g4_write_bom_list_po_ea` WHERE `po_code` = '".$listxt[wr_content]."' and `s_d_code` like 'S%' and `po_id` = '".$listxt[wr_id]."' ");
			if($chk_in[s_d_date]){
				//$tr_style = ' style="background-color:#EEFFD4;" ';
				$in_icon = '<img src="'.$g4[path].'/img/btn_rev2.gif" style="border:0px;"/>';	
			}
			
			$mtc_list = sql_fetch(" SELECT count(wr_id) as cnt FROM `g4_write_bom_list_po_app` WHERE `ca_name` = '".$listxt[ca_name]."'  ");
			//$total_cnt = $mtc_list[cnt] + $total_cnt;
			?>
			<tr class="tr_lines"  id="tr_<?=$listxt[wr_id]?>"  <?=$tr_style?>  style="cursor:pointer;"> 
			 <td align="left"><input type="checkbox" id="chk_<?=$listxt[wr_id]?>" name="wr_idx[]" value="<?=$listxt[wr_id]?>" <? if($listxt[BJ]){ ?> disabled <? } ?>/><input type="hidden" id="tr_<?=$listxt[wr_id]?>_qty_org" value="<?=$listxt[AC]?>"/></td>
			 <td align="right" style="padding-right:5px;" onClick="chkto('tr_<?=$listxt[wr_id]?>', 'chk_<?=$listxt[wr_id]?>');">&bull;</td>
			 <td dis="AM" align="center" <? if($onClick){ ?> onClick="chkto('tr_<?=$listxt[wr_id]?>', 'chk_<?=$listxt[wr_id]?>');" <? } ?>><?=$listx[AI]?></td>
			 <td align="left">
				<table cellpadding="0" cellspacing="0" width="100%"><tr>
				<td width="55%" style="border:0px; padding:0px 0px 1px 0px; margin:0px; font-weight:bold; text-decoration:underline; cursor:pointer;  color:#830001;"
				 onClick='window.open("http://pjt.imetis.co.kr/?e=&rpt=<?=$listxt[ca_name]?>", "_blank", "toolbar=no,scrollbars=yes,resizable=yes,top=50,left=500,width=840,height=700");'><img src="<?=$g4[path]?>/img/ico_preview.gif" style="cursor:pointer; border:0px; padding-right:4px; width:14px; margin-top:1px; height:14px;"/><?=$listxt[ca_name]?></td>
				</td></tr>
				</table>
			 </td>
		
			 <td dis="AG" align="center" <? if($onClick){ ?> onClick="chkto('tr_<?=$listxt[wr_id]?>', 'chk_<?=$listxt[wr_id]?>');" <? } ?> style="font-size:11px;"><?=substr($listxt[AG],0,10)?></td>
		
			 <td align="left"><div style="white-space:nowrap; overflow:hidden; font-size:12px; font-weight:bold; letter-spacing:-1px;" <? if($onClick){ ?> onClick="chkto('tr_<?=$listxt[wr_id]?>', 'chk_<?=$listxt[wr_id]?>');" <? } ?>><?
				if(strlen($listxt[P]) > 25){
					echo mb_strcut($listxt[P],0,25,'euc-kr')."...";
					if($mtc_list[cnt] > 1){
						echo " <span style='font-size:11px; color:#888;'>외&nbsp;";
						echo ($mtc_list[cnt]-1)."건";
					}
					echo "</span>";
				}else{
					echo $listxt[P];
					if($mtc_list[cnt] > 1){
						echo "... <span style='font-size:11px; color:#888;'>외&nbsp;";
						echo "&nbsp;".($mtc_list[cnt]-1)."건";
					}
					echo "</span>";
				}
				?></div>
			 </td>
			 
			 <td align="center" style="font-weight:bold; color:#B70000; font-size:11px;" onClick="chkto('tr_<?=$listxt[wr_id]?>', 'chk_<?=$listxt[wr_id]?>');"><?=$mtc_list[cnt]?></td>
			 <td align="right" style="padding-right:4px; font-size:11px; color:#00467A;" onClick="chkto('tr_<?=$listxt[wr_id]?>', 'chk_<?=$listxt[wr_id]?>');" style="font-size:11px;"><?=number_format($listxt[AX])?></td>
			 <td align="left" style="padding-left:5px;font-size:11px; color:#999;" onClick="chkto('tr_<?=$listxt[wr_id]?>', 'chk_<?=$listxt[wr_id]?>');" style="font-size:11px;"><?
			 if($listxt[AV]){ 
				echo "<span style='font-size:11px; color:#5B00DC;'>메티스 입고 확인 中</span>";
			 }else
			 if($listxt[AW]){
				$msgx = explode("|",$listxt[AW]);
				echo "<span style='font-size:11px; color:#DC001B; font-weight:bold;'><img src='".$g4[path]."/img/ico_del_part.gif' style='border:0px; padding-right:3px;'/><span style='color:#A70002; font-weight:bold; font-size:11px;'>
				재발주 요청";
				if(trim($msgx[2])){ echo " (".$msgx[2].")";
				}
				echo "</span>";
			 }else{
				echo "&nbsp;";
			 } ?>
			 </td>
			 <td><?
			  if($listxt[AW]){ ?>
				<div style="width:98%; white-space:nowrap; overflow:hidden; background-color:transparent; letter-spacing:-1px; font-size:11px; color:#DC001B;"><img src="<?=$g4[path]?>/img/board_info.gif" style="width:11px; border:0px; padding-left:4px; padding-right:3px;"/><?=$msgx[3]?>
			  <?
			  }else
			  if($listxt[AV]){ ?>
			  <img src="<?=$g4[path]?>/img/btn_backit3.gif" style="cursor:pointer; border:0px;"/>
			  <? } ?>
			 </td>
			</tr>
			<?
		}
		if($it > 0){
		?><tr><td colspan="10" height="11" bgcolor="#E0E0E0" style="border-top:1px solid #999; border-bottom:1px solid #CCC;"></td></tr><?
		}
	}
	$tr_style = ' style="background-color:#FFFFFF;" ';
	
	$view = "1";
	if($category_mode == "today"){
		$view = "";
		if(date("Y-m-d") == substr($status_x[s_d_date],0,10)){
			$view = "1";
		}
	}
	if($view){ ?>
        <tr class="tr_lines"  id="tr_<?=$listx[wr_id]?>"  <? if($stock_in){ ?> style="background-color:#E8E8E8 !important;" <? }else{ ?> <?=$tr_style?>  style="cursor:pointer; <? if($status_x[cnt] > 0){ ?> background-color:#FFFECC; <? } ?> " <? } ?>> 
         <td align="left"><input type="checkbox" id="chk_<?=$listx[wr_id]?>" name="wr_idx[]" value="<?=$listx[wr_id]?>"/><input type="hidden" id="tr_<?=$listx[wr_id]?>_qty_org" value="<?=$listx[AC]?>"/></td>
         <td align="right" style="padding-right:5px; font-size:10px; color:#777;" onClick="chkto('tr_<?=$listx[wr_id]?>', 'chk_<?=$listx[wr_id]?>');"><?=($i+1)?></td>
         
         <td align="left" style="padding-left:5px; font-size:11px; font-weight:bold; letter-spacing:-1px; <? if($stock_in){ ?> color:#909090; <? } ?> "><?=$listx[AI]?></td>
    
         <td align="left" style="cursor:pointer; text-decoration:underline; <? if(!$stock_in){ ?> color:#A20002; <? }else{ ?> color:#909090; <? }?>" onClick='window.open("http://pjt.imetis.co.kr/?e=y&rpt=<?=$listx[ca_name]?>", "_blank", "toolbar=no,scrollbars=yes,resizable=yes,top=50,left=500,width=840,height=700");'><img src="<?=$g4[path]?>/img/btn_quick_search<? if(!$stock_in){ echo "1"; } ?>.gif" style="border:0px; width:12px; float:left;"/>&nbsp;<?=$listx[ca_name]?><? if($stock_in){ ?><img src="<?=$g4[path]?>/img/ico_ok.gif" style="width:10px; padding-left:3px; border:0px;"/><?
            } ?>
         </td>
    
         <td dis="AM" align="center" <? if($onClick){ ?> onClick="chkto('tr_<?=$listx[wr_id]?>', 'chk_<?=$listx[wr_id]?>');" <? } ?> style="font-size:11px; letter-spacing:0px; <? if($stock_in){ ?> color:#909090; <? } ?> "><?
		 	if($listx[AY] != "0000-00-00 00:00:00"){
				echo substr($listx[AY],0,10);
			}else
		 	if($listx[AV] != "0000-00-00 00:00:00"){
				echo substr($listx[AV],0,10);
			}				
			?></td>
    
         <td align="left"><div style="white-space:nowrap; overflow:hidden; font-size:12px; font-weight:bold; letter-spacing:-1px;" <? if($onClick){ ?> onClick="chkto('tr_<?=$listx[wr_id]?>', 'chk_<?=$listx[wr_id]?>');" <? } ?>><?
            if(strlen($listx[P]) > 25){
                echo mb_strcut($listx[P],0,25,'euc-kr')."...";
                if($mtc_list[cnt] > 1){
                    echo " <span style='font-size:11px; color:#888;'>외&nbsp;";
                    echo ($mtc_list[cnt]-1)."건";
                }
                echo "</span>";
            }else{
                echo $listx[P];
                if($mtc_list[cnt] > 1){
                    echo "... <span style='font-size:11px; color:#888;'>외&nbsp;";
                    echo "&nbsp;".($mtc_list[cnt]-1)."건";
                }
                echo "</span>";
            }
            ?></div>
         </td>
         
         <td align="center" style="font-weight:bold; <? if($stock_in){ ?> color:#808080; <? }else{ ?> color:#BC0000; <? } ?> font-size:11px;" onClick="chkto('tr_<?=$listx[wr_id]?>', 'chk_<?=$listx[wr_id]?>');"><?=$mtc_list[cnt]?></td>
         <td align="right" style="padding-right:4px;" onClick="chkto('tr_<?=$listx[wr_id]?>', 'chk_<?=$listx[wr_id]?>');" style="font-size:11px;"><?=number_format($listx[AX])?></td>
         <td align="left" style="padding-left:5px;font-size:11px; color:#999;" onClick="chkto('tr_<?=$listx[wr_id]?>', 'chk_<?=$listx[wr_id]?>');" style="font-size:11px;"><?
         if($listx[AV]){ 
            if($stock_in == "입고 완료"){
                echo "<span style='font-size:11px; color:#808080;'>입고 완료 (".substr($status_x[s_d_date],0,16).")</span>";
            }else
            if($stock_in == "일부 입고"){
                echo "<span style='font-size:11px; color:#DC4400;'>".$status_x[cnt]."건 입고</span>";
            }else
            if($stock_in == "일부 출고"){
                echo "<span style='font-size:11px; color:#DC4400;'>".$chk_out[cnt]."건 출고</span>";
            }else
            if($stock_in == "출고 완료"){
                echo "<span style='font-size:11px; color:#6600FF;'>출고 완료</span>";
            }else{
                echo "<span style='font-size:11px; color:#DD6E6E;'>입고 예정</span>";
            }
         }else{
            echo "&nbsp;";
         } ?>
         </td>
         
         <?
		 if($stock_in == "입고 완료" and ( $member[mb_recommend] == "230:자재팀" or $member[mb_id] == "hbhwang" or $member[mb_id] == "ssh881108") ){ ?>
             <td onMouseOver="document.getElementById('cancel_<?=$listx[wr_id]?>').style.display='';"  onMouseOut="document.getElementById('cancel_<?=$listx[wr_id]?>').style.display='none';">
             	<div id="cancel_<?=$listx[wr_id]?>"  style="display:none; padding-left:5px; background-color:#FFFFFF; width:90%;">
                <?=$listx[ca_name]?> 입고 <img src="<?=$g4[path]?>/img/btn_backit.gif" style="cursor:pointer; border:0px; margin-top:2px;"
                onClick="cancel_in('<?=$listx[ca_name]?>');"/>
                </div>
             </td>
             <?
		 }else{ ?>
         	<td>
            <!-- (!) -->
            </td><?
         } ?>
         </td>
        </tr>
        <?
        $total_amount = $listx[AX] + $total_amount;
        if($stock_in){
        $total_in_amount = $listx[AX] + $total_in_amount;
        }
	}
	
}
if($i > 0){
	if($category_mode == "today"){ }else{ ?>
    <tr>
     <td colspan="6" align="right" height="26" style="padding-right:10px; font-size:11px; color:#888; border-top:3px double #DDD; border-right:0px;">예정 합계 : </td>
     <td align="center" style="font-size:18px; font-weight:bold; color:#885843; border-top:3px double #DDD;"><?=$total_cnt?></td>
     <td align="right" style="padding-right:5px; font-weight:bold; color:#885843; border-top:3px double #DDD; font-size:18px;"><?=number_format($total_amount)?></td>
     <td colspan="2" style=" border-top:3px double #DDD;">&nbsp;  </td>
    </tr>
    <? } ?>
    <tr>
     <td colspan="6" align="right" height="26" style="padding-right:10px; font-size:11px; color:#888; border-top:3px double #DDD; border-right:0px;">실 입고 합계 : </td>
     <td align="center" style="font-size:18px; font-weight:bold; color:#0000FF; border-top:3px double #DDD;"><?=$r_in_qty ?></td>
     <td align="right" style="padding-right:5px; font-weight:bold; color:#0000FF; border-top:3px double #DDD; font-size:18px;"><?=number_format($total_in_amount)?></td>
     <td colspan="2" style=" border-top:3px double #DDD;">&nbsp;  </td>
    </tr>
    <?
}
?>

<? } ?>

</table>
</form>
<?
$tab_margin = "- 300";
?>
<script>
// 탭 iframe Resize
$('#updatedx').height(($(window).height() <?=$tab_margin?>)); 
$( window ).resize(function() {
	$('#updatedx').height(($(window).height() <?=$tab_margin?>));
}); 
</script>

<div style="display:none; visibility:none;">
<iframe name="hiddenFramex" id="hiddenFramex" width="99%" height="200" scrolling="auto" frameborder="0"></iframe>
</div>
<br/><br/>

<?
exit;
?>