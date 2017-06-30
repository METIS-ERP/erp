<?
if(!$member[mb_id]){
	echo "정상적으로 접근하여 주십시오.<br/><a href='".$g4[path]."/bbs/logout.php' target='_self' style='color:#0000FF;'font-size:18px;font-weight:bold;'>[ 로그 아웃 후 이동 ]</a>";
	exit;
}else
if($member[mb_3] != "vendor"){
	echo "협력사만 사용 가능합니다.<br/><a href='".$g4[path]."/bbs/logout.php' target='_self' style='color:#0000FF;'font-size:18px;font-weight:bold;'>[ 로그 아웃 후 이동 ]</a>";
	exit;
}


if($recal_price){
	
}


##예외 처리 - 업체명이 없을 경우
$sqlx = sql_query(" SELECT wr_8 FROM `g4_write_bom_list_po_app` WHERE `AI` = '' ");
for($ix=0;$rowx=sql_fetch_array($sqlx);$ix++){
	if($member[mb_3] == "vendor"){
		$skip_update = sql_query(" UPDATE `g4_write_bom_list_po_app` SET `AI`='".$member[mb_name]."' WHERE `wr_id`='".$rowx[wr_id]."'  ");
	}
}





$order_uri = explode("&order=",$_SERVER['REQUEST_URI']);
if($mtc_no and $mode == "cancel"){
	$sqlx = " UPDATE `g4_write_bom_list_po_app` SET `AV` = '', `AW` = '', `AY` = ''  WHERE (`ca_name`='".$mtc_no."') ";
	sql_query($sqlx); ?>
    <script>
	alert("[알림]\n출고 취소 되었습니다.!!");
	<? if($wc){ ?>
	opener.document.location.reload();
	window.close();
	<? }else{ ?>	
	parent.document.location.reload();
	<? } ?>
	</script><?
	exit;
}
?>
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
		//if(vendor_name.value){
		//	document.getElementById('v_Vendor_Name').value = vendor_name.value;
		//}

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
		alert("[알림]\n처리할 납품서를 하나 이상 선택하십시오.");
		return false;
	}
	if(document.getElementById('out_date').value == ''){
		alert("[알림]\n납품서 출고일을 지정하여 주십시오.");
		return false;
	}
	
	/* 저장 시작 */
	var r = confirm("[알림]\n선택한 "+chk_count+"건의 납품서를\n"+document.getElementById('out_date').value+" 날짜로 출고 처리 하시겠습니까?");

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
	var chk_count = 0;
	var f = document.fboardlist;
	for (var i=0; i<f.length; i++) {
		if (f.elements[i].name == "wr_idx[]" && f.elements[i].checked){
			chk_count++;
		}
	}
	if (!chk_count) {
		alert("[알림]\n일괄 출력할 납품서를 하나 이상 선택하십시오.");
		return false;
	}
	var url = "<?=$g4[path]?>/skin/board/__pms/rpt_print.php";
	var title  = "printx";
	var status = "toolbar=no, scrollbars=yes, resizable=yes, top=50, left=500, width=865, height=800"; 
	window.open("", title,status); 
	f.target = title;
	f.action = url; 
	f.method = "post";
	f.submit();     	
}

function multiful_mtc2(){
	var chk_count = 0;
	var f = document.fboardlist;
	for (var i=0; i<f.length; i++) {
		if (f.elements[i].name == "wr_idx[]" && f.elements[i].checked){
			chk_count++;
		}
	}
	if (!chk_count) {
		alert("[알림]\n일괄 출력할 납품서를 하나 이상 선택하십시오.");
		return false;
	}
	var url = "<?=$g4[path]?>/skin/board/__pms/rpt_prints.php";
	var title  = "printx";
	var status = "toolbar=no, scrollbars=yes, resizable=yes, top=50, left=500, width=865, height=800"; 
	window.open("", title,status); 
	f.target = title;
	f.action = url; 
	f.method = "post";
	f.submit();     	
}
</script>



<div id="bg_trans" style="position:fixed; cursor:no-drop; top:0px;left:0px;width:100%;height:2500px;border:none;margin:0px;visibility:hidden;z-index:999;background:url(<?=$g4[path]?>/img/bg_trans5.png);"></div>

<div id='updatedx' style="position:fixed; top:80px; width:80%; height:350px; display:none; background-color:#FFFFFF; overflow:hidden; margin-left:10%; border:5px solid #363200; z-index:5000;">
<table cellpadding="0" cellspacing="0" style="width:100%;">
    <tr>
        <td height="58" valign="middle" align="left" style="background:#504a00 url(<?=$g4[path]?>/img/bg_pr_ok.gif) left top no-repeat;">
            <span style="font-size:28px; padding-left:70px; font-weight:normal; color:#FFFFFF; font-family:Malgun Gothic;">&nbsp;&nbsp;지정 완료</span>
            <span style="font-size:12px; font-weight:normal; padding-left:20px; color:#FFF7D7; font-family:Dotum;">아래는 방금 지정된 품목 리스트 입니다.</span>
        </td>
        <td width="100" bgcolor="#504a00" align="center">
            <img src="<?=$g4[path]?>/img/btn_pop_close.gif" style="border:0px; cursor:pointer;"
            onClick="document.getElementById('updatedx').style.display='none';document.getElementById('bg_trans').style.visibility='hidden';return false;" alt="확인 및 창 닫기"/>
        </td>
    </tr>
</table>
    <div style="width:100%; height:800px; overflow:auto; border:0px; margin:0px;">
        <iframe name="updated" id="updated" src="" frameborder="0" allowtransparency="YES" scrolling="auto" width="100%" style="width:100%; height:800px; overflow:auto; border:0px;"></iframe>
    </div>
</div>



<div style="width:100%; position:fixed; border:0px; top:0px; padding-top:24px; background-color:#FFFFFF; z-index:0; ">
<table cellpadding="0" cellspacing="0" style=" height:72px; width:100%;">
 <tr>
  <td height="40" valign="bottom">
  	<span style="font-size:22px; color:#444; white-space:nowrap; padding-left:15px; font-family:Malgun Gothic; letter-spacing:-1px;">3.  출고 및 납품서 출력</span>

    <img src="<?=$g4[path]?>/img/btn_all_print.gif" style="margin-left:10px; cursor:pointer; border:0px;" onclick="multiful_mtc();"/>
    <img src="<?=$g4[path]?>/img/btn_all_print2.gif" style="margin-left:10px; cursor:pointer; border:0px;" onclick="multiful_mtc2();"/>

  </td>
  <td width="300" rowspan="2"><img src="<?=$g4[path]?>/img/top_bg_imgN4x3.gif" style="border:0px; height:87px; margin-right:-1px;"/></td>
 </tr>
 <tr>
  <td colspan="2" align="left" style="padding:2px 10px;">
  	<form id="po_list" name="po_list" method="get" enctype="application/x-www-form-urlencoded">
    <input type="hidden" name="bo_table" value="<?=$bo_table?>"/>
    <input type="hidden" name="link" value="<?=$link?>"/><?
	 $ori_last = date("Y-m-d");
	 $s_day = date('Y-m-d',strtotime($ori_last.'-90 days')); //-90일 전 
	 $e_day = date("Y-m-d");
	?>
  	<table cellpadding="0" cellspacing="0">
    <tr>
     <td colspan="2"><span style="font-size:11px; color:#555; padding:2px 5px; background-color:#005A94; color:#EEE;">출고 여부</span></td>
     <td colspan="2"><span style="font-size:11px; color:#555; padding:2px 5px; background-color:#930045; color:#EEE;">납품서 번호</span></td>
     <td colspan="2"><span style="font-size:11px; color:#555; padding:2px 5px; background-color:#444; color:#EEE;">PO 번호</span></td>
     <td colspan="2"><span style="font-size:11px; color:#555; padding:2px 5px; background-color:#444; color:#EEE;">EW Code / M-PJT</span></td>
     <td colspan="2"><span style="font-size:11px; color:#555; padding:2px 5px; background-color:#444; color:#EEE;">Part No / CIS No</span></td>
     <td colspan="3"><span style="font-size:11px; color:#555; padding:2px 5px; background-color:#444; color:#EEE;">품명 / Spec</span></td>
    </tr>
    <tr>
     <td bgcolor="#005A94" style="padding-right:15px;">
     	<input type="radio" id="part_out1" name="part_out" value="all" <? if(!$part_out or $part_out == "all"){ ?> checked <? } ?> /><label for="part_out1" style="cursor:pointer; color:#EEE; font-size:11px; ">모두</label>
     	<input type="radio" id="part_out2" name="part_out" value="no" <? if($part_out == "no"){ ?> checked <? } ?> /><label for="part_out2" style="cursor:pointer; color:#EEE; font-size:11px;">미출고</label>
     	<input type="radio" id="part_out3" name="part_out" value="yes" <? if($part_out == "yes"){ ?> checked <? } ?> /><label for="part_out3" style="cursor:pointer; color:#EEE;font-size:11px; ">출고</label>
     </td>
     <td width="5"></td>
     <td><input type="text" id="wr_num" name="wr_num" value="<?=$wr_num?>" style="width:110px; height:17px;text-align:left; padding-left:3px; border:2px solid #930045; <? if($wr_num){ ?>font-weight:bold; background-color:#FFF96D; <? } ?>"/><? if($wr_num){ ?><img src="<?=$g4[path]?>/img/btn_empty.gif" style="border:0px; width:15px; margin-top:4px; margin-left:-20px; cursor:pointer; position:absolute; z-index:0;" onClick="document.getElementById('wr_num').value='';document.getElementById('po_list').submit();"/><? } ?></td>
     <td width="5"></td>
     <td><input type="text" id="po_name" name="po_name" value="<?=$po_name?>" style="width:110px; height:17px;text-align:left; padding-left:3px; border:2px solid #444; <? if($po_name){ ?>font-weight:bold; background-color:#FFF96D; <? } ?>"/><? if($po_name){ ?><img src="<?=$g4[path]?>/img/btn_empty.gif" style="border:0px; width:15px; margin-top:4px; margin-left:-20px; cursor:pointer; position:absolute; z-index:0;" onClick="document.getElementById('po_name').value='';document.getElementById('po_list').submit();"/><? } ?></td>
     <td width="5"></td>
     <td><input type="text" id="pjt_code" name="pjt_code" value="<?=$pjt_code?>" style="width:110px; height:17px;text-align:left; padding-left:3px; border:2px solid #444;<? if($pjt_code){ ?>font-weight:bold; background-color:#FFF96D; <? } ?>"/><? if($pjt_code){ ?><img src="<?=$g4[path]?>/img/btn_empty.gif" style="border:0px; width:15px; margin-top:4px; margin-left:-20px; cursor:pointer; position:absolute; z-index:0;" onClick="document.getElementById('pjt_code').value='';document.getElementById('po_list').submit();"/><? } ?></td>
     <td width="5"></td>
     <td><input type="text" id="cis_part" name="cis_part" value="<?=$cis_part?>" style="width:110px; height:17px;text-align:left; padding-left:3px; border:2px solid #444; <? if($cis_part){ ?>font-weight:bold; background-color:#FFF96D; <? } ?>"/><? if($cis_part){ ?><img src="<?=$g4[path]?>/img/btn_empty.gif" style="border:0px; width:15px; margin-top:4px; margin-left:-20px; cursor:pointer; position:absolute; z-index:0;" onClick="document.getElementById('cis_part').value='';document.getElementById('po_list').submit();"/><? } ?></td>
     <td width="5"></td>
     <td><input type="text" id="part_name" name="part_name" value="<?=$part_name?>" style="width:110px; height:17px;text-align:left; padding-left:3px; border:2px solid #444; <? if($part_name){ ?>font-weight:bold; background-color:#FFF96D; <? } ?>"/><? if($part_name){ ?><img src="<?=$g4[path]?>/img/btn_empty.gif" style="border:0px; width:15px; margin-top:4px; margin-left:-20px; cursor:pointer; position:absolute; z-index:0;" onClick="document.getElementById('part_name').value='';document.getElementById('po_list').submit();"/><? } ?></td>
     <td width="5"></td>
     <td><input type="image" src="<?=$g4[path]?>/img/btn_searchx23.gif" style="cursor:pointer; border:0px;"/></td>
     <td><img src="<?=$g4[path]?>/img/btn_reflash.gif" style=" cursor:pointer; border:0px; width:23px; margin-left:8px; margin-right:10px;" onClick="document.location.reload();"/></td>

    </tr>
    <TR height="2">
      <td colspan="12" >&nbsp;</td>
	</tr>
    <TR>
      <td colspan="1" ><span style="font-size:11px; color:#555; padding:2px 5px; background-color:#005A94; color:#EEE;">2017년</span></td>
		</tr>
		<tr>
		<td colspan="6" bgcolor="#005A94" style="color:#EEEEEE;">
		<table cellpadding="0" cellspacing="0" width="570" style="display:inline-block; float:none;">
		<tr><td style="border:2px solid #3B3B3B; padding:3px;background-color: #FFF;">
			<? 
			$tmp_url = $_SERVER['REQUEST_URI'];
			if($chk_month){
			}else{
				$this_month = date("m");
			}

			?>
			<input type="radio" name="chk_month" id="A" value="A" <? if($chk_month =="A" or $this_month == "01"){ $chk_month ="A"; ?> checked <? } ?> /><label for="A" style=" cursor:pointer;
			<? if($chk_month =="A"){ ?> font-weight:bold; color:#0000FF; <? }else{ ?> color:#777777; <? } ?>">1월</label>
			<input type="radio" name="chk_month" id="B" value="B" <? if($chk_month =="B" or $this_month == "02"){ $chk_month ="B"; ?> checked <? } ?> /><label for="B" style=" cursor:pointer;
			<? if($chk_month =="B"){ ?> font-weight:bold; color:#0000FF; <? }else{ ?> color:#777777; <? } ?>">2월</label>
			<input type="radio" name="chk_month" id="C" value="C" <? if($chk_month =="C" or $this_month == "03"){ $chk_month ="C"; ?> checked <? } ?> /><label for="C" style=" cursor:pointer;
			<? if($chk_month =="C"){ ?> font-weight:bold; color:#0000FF; <? }else{ ?> color:#777777; <? } ?>">3월</label>
			<input type="radio" name="chk_month" id="D" value="D" <? if($chk_month =="D" or $this_month == "04"){ $chk_month ="D"; ?> checked <? } ?> /><label for="D" style=" cursor:pointer;
			<? if($chk_month =="D"){ ?> font-weight:bold; color:#0000FF; <? }else{ ?> color:#777777; <? } ?>">4월</label>
			<input type="radio" name="chk_month" id="E" value="E" <? if($chk_month =="E" or $this_month == "05"){ $chk_month ="E"; ?> checked <? } ?> /><label for="E" style=" cursor:pointer;
			<? if($chk_month =="E"){ ?> font-weight:bold; color:#0000FF; <? }else{ ?> color:#777777; <? } ?>">5월</label>
			<input type="radio" name="chk_month" id="F" value="F" <? if($chk_month =="F" or $this_month == "06"){ $chk_month ="F"; ?> checked <? } ?> /><label for="F" style=" cursor:pointer;
			<? if($chk_month == "F"){ ?> font-weight:bold; color:#0000FF; <? }else{ ?> color:#777777; <? } ?>">6월</label>
			<input type="radio" name="chk_month" id="G" value="G" <? if($chk_month =="G" or $this_month == "07"){ $chk_month ="G"; ?> checked <? } ?> /><label for="G" style=" cursor:pointer;
			<? if($chk_month =="G"){ ?> font-weight:bold; color:#0000FF; <? }else{ ?> color:#777777; <? } ?>">7월</label>
			<input type="radio" name="chk_month" id="H" value="H" <? if($chk_month =="H" or $this_month == "08"){ $chk_month ="H"; ?> checked <? } ?>/><label for="H" style=" cursor:pointer;
			<? if($chk_month =="H"){ ?> font-weight:bold; color:#0000FF; <? }else{ ?> color:#777777; <? } ?>">8월</label>
			<input type="radio" name="chk_month" id="I" value="I" <? if($chk_month =="I" or $this_month == "09"){ $chk_month ="I"; ?> checked <? } ?> /><label for="I" style=" cursor:pointer;
			<? if($chk_month =="I"){ ?> font-weight:bold; color:#0000FF; <? }else{ ?> color:#777777; <? } ?>">9월</label>
			<input type="radio" name="chk_month" id="J" value="J" <? if($chk_month =="J" or $this_month == "10"){ $chk_month ="J"; ?> checked <? } ?> /><label for="J" style=" cursor:pointer;
			<? if($chk_month =="J"){ ?> font-weight:bold; color:#0000FF; <? }else{ ?> color:#777777; <? } ?>">10월</label>
			<input type="radio" name="chk_month" id="K" value="K" <? if($chk_month =="K" or $this_month == "11"){ $chk_month ="K"; ?> checked <? } ?> /><label for="K" style=" cursor:pointer;
			<? if($chk_month =="K"){ ?> font-weight:bold; color:#0000FF; <? }else{ ?> color:#777777; <? } ?>">11월</label>
			<input type="radio" name="chk_month" id="L" value="L" <? if($chk_month =="L" or $this_month == "12"){ $chk_month ="L"; ?> checked <? } ?> /><label for="L" style=" cursor:pointer;
			<? if($chk_month =="L"){ ?> font-weight:bold; color:#0000FF; <? }else{ ?> color:#777777; <? } ?>">12월</label>
		</td>
		</tr>
		</table>

	<? /*
		<input type="text" name="date_a" value="<? if($date_a){ echo $date_a; }else{ echo $s_day; }?>" style="width:80px; height:17px; text-align:center; border:2px solid #005A94;" class="datex"/>-<input type="text" name="date_b" value="<? if($date_a){ echo $date_b; }else{ echo $e_day; }?>" style="width:80px; height:17px; text-align:center; border:2px solid #005A94;" class="datex"/>*/ ?>
	</td>
    </TR>
    </table>
    </form>
  </td>
 </tr>
</table>

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
<input type='hidden' name='out_date' id='out_date'  value=''>


<div id="listup" style=" position:fixed; padding:0px; z-index:10; top:27px; right:180px; z-index:599; background-color:#FEE; border:2px solid #222;">
  <table cellpadding="0" cellspacing="0" width="320">
   <tr>
    <td height="15" bgcolor="#333333" valign="bottom" style="padding:0px 2px;">
        <div style="float:left;">
            <span style="color:#FFF; font-size:11px; font-family:Dotum; cursor:pointer;">&nbsp;선택 정보 : <span style="color:#FC6; font-family:Dotum; font-size:14px; font-weight:bold;">총 <input id="select_ea2" value="0" style="background-color:transparent; color:#FC6; font-family:Dotum; font-size:14px; font-weight:bold; border:0px; width:28px; text-align:right;"/>건 선택 됨.</span>
            </span>
        </div>
        <div style="float:right">
            <span id='menu_off' style="float:right; display:block; padding-right:5px; cursor:pointer; color:#FFF; font-size:11px; font-family:Dotum;"
            onClick="this.style.display='none';document.getElementById('co_select').style.display='none';document.getElementById('menu_on').style.display='block';">&nbsp;▲&nbsp;</span>
            <span id='menu_on' style="float:right; display:none; padding-right:5px; cursor:pointer; color:#FFF; font-size:11px; font-family:Dotum;"
            onClick="this.style.display='none';document.getElementById('co_select').style.display='block';document.getElementById('menu_off').style.display='block';">&nbsp;▼&nbsp;</span>
        </div>
    </td>
   </tr>
  </table>
  
      <table cellpadding="0" cellspacing="0" width="320" id="co_select" style="display:none;">
      <tr>
            <td width="130" bgcolor="#F1F1F1" valign="top" align="right"><div style="margin-top:5px;"><span style="font-size:11px; color:#333; font-weight:bold;">&bull; 선택한 납품서 :&nbsp;</span></td>
            <td bgcolor="#F1F1F1" colspan="2" align="left" valign="top" style="padding-top:2px;"><input type="hidden" name="co_name" value="<?=$member[mb_name]?>"/>
                <img onclick="move2_to('av');" src="<?=$g4[path]?>/img/btn_confirm_out.gif" style="border:0px;cursor:pointer;"/>
            </td>
      </tr>
      <tr>
            <td bgcolor="#F1F1F1" valign="top" align="right" style="padding-top:2px;"><div style="margin-top:5px;"><span style="font-size:11px; color:#A40002; font-weight:bold;">&bull; 납품서 출고일 지정 :&nbsp;</span></td>
            <td bgcolor="#F1F1F1" align="left" style="padding-top:2px;"><input type='text' style="width:110px; font-size:11px; " id='out_date_select' class="datex" required placeholder="납품서 출고 날짜"
            onChange="document.getElementById('out_date').value = this.value;"/></td>
      </tr>
      <tr><td colspan="3" height="4"></td></tr>
      </table>
  
</div>

<table cellpadding="0" cellspacing="0" width="100%" class="part_list" style="table-layout:fixed; margin-left:0px; border-left:1px solid #CCC; border-top:1px solid #BBB;">
<col width="22">
<col width="30">
<col width="102">
<col width="220">
<col width="78">
<col width="38">
<col width="230">
<col width="52">
<col width="120">
<col width="150">
<col>
<tr>
 <th><input onclick="if (this.checked) all_checked(true); else all_checked(false);" type="checkbox"></th>
 <th>순번</th>

 <th dis="AU" style="letter-spacing:-1px;"><? if($order == "AU"){ ?><span style="font-weight:bold; color:#0A00FF;"><? } ?>납품서 지정일<? if($order == "AU"){ ?></span><? } ?>
 	<a href="<?=$g4[path]?><?=$order_uri[0]?>&order=AU&by=asc" style="font-size:11px; <? if($order == "AU" and $by == "asc"){ ?> color:#0A00FF !important; <? } ?>color:#AAA;">▲</a><a
    href="<?=$g4[path]?><?=$order_uri[0]?>&order=AU&by=desc" style="font-size:11px; <? if($order == "AU" and $by == "desc"){ ?> color:#0A00FF !important; <? } ?>color:#AAA;">▼</a></th>

 <th><? if($order == "AU"){ ?><span style="font-weight:bold; color:#0A00FF;"><? } ?>납품서 번호<? if($order == "ca_name"){ ?></span><? } ?> <a href="<?=$g4[path]?><?=$order_uri[0]?>&order=ca_name&by=asc" style="font-size:11px; <? if($order == "ca_name" and $by == "asc"){ ?> color:#0A00FF !important; <? } ?>color:#AAA;">▲</a><a
    href="<?=$g4[path]?><?=$order_uri[0]?>&order=ca_name&by=desc" style="font-size:11px; <? if($order == "ca_name" and $by == "desc"){ ?> color:#0A00FF !important; <? } ?>color:#AAA;">▼</a> &nbsp; &nbsp; 출고 정보</th>
 <th dis="AG">요청 납기일</th>
 <th>현품표</th>
 <th>품명</th>
 <th>지정수량</th>
 <th>합계</th>
 <th style="letter-spacing:-1px;">METIS 입고 확정</th>
 <th>비고</th>
</tr>
</table>
</div>


<style>
body { margin:0px; padding:0px; border:0px }
.part_list th { background-color:#DEDEDE; color:#444; font-size:11px; white-space:nowrap; letter-spacing:0px; border-right:1px solid #CCC; border-bottom:1px solid #BBB; height:20px; }
.part_list td { color:#444; border-right:1px solid #E2E2E2; border-bottom:1px solid #DDD; padding-left:2px; }
</style>

<div style="width:99%; height:167px; border:0px;">&nbsp;</div>

<table cellpadding="0" cellspacing="0" class="part_list" style="table-layout:fixed; border-left:1px solid #CCC; width:100%;">
<col width="22">
<col width="30">
<col width="102">
<col width="220">
<col width="78">
<col width="38">
<col width="230">
<col width="52">
<col width="120">
<col width="150">
<col>
<tr>
 <th><input onclick="if (this.checked) all_checked(true); else all_checked(false);" type="checkbox"></th>
 <th>순번</th>
 <th dis="AM">납품서 지정일 ▲ ▼</th>
 <th>납품서 번호 / 출고일 정보</th>
 <th dis="AG">요청 납기일</th>
 <th>현품표</th>
 <th>품명</th>
 <th>지정수량</th>
 <th>합계</th>
 <th style="letter-spacing:-1px;">METIS 입고 정보</th>
 <th>비고</th>
</tr>
<?


	
$limit = " limit 0, 500 ";

//$orderby = " order by wr_datetime desc, wr_id asc   ";

$po_list_top = " SELECT * FROM `g4_write_bom_list_po_app` WHERE `AI` LIKE '%".$member[mb_name]."%' and `wr_comment_reply` <> ''  and `AW` != '' group by AW desc, ca_name desc";
$po_list = " SELECT * FROM `g4_write_bom_list_po_app` WHERE `AI` LIKE '%".$member[mb_name]."%' and `wr_comment_reply` <> ''  and `AW` = '' ";
/*
if($date_a and $date_b){
	$po_list .= " and ( `AM` between '".$date_a." 00:00:00' and '".$date_b." 23:59:59' ) ";
}
*/
if($cis_part){
	$po_list .= " and ( `M` LIKE '%".$cis_part."%'  or `N` LIKE '%".$cis_part."%' ) ";
	$limit = '';
}

if($part_name){
	$po_list .= " and ( `P` LIKE '%".$part_name."%'  or `Q` LIKE '%".$part_name."%' or `U` LIKE '%".$part_name."%' ) ";
	$limit = '';
}

if($wr_num){
	$po_list .= " and ( `ca_name` LIKE '%".$wr_num."%'   ) ";
	$limit = '';
}

if($po_name){ 
	$po_list .= " and `wr_content` = '".$po_name."' ";
	$limit = '';
}

if($pjt_code){
	$po_list .= " and ( `wr_1` LIKE '%".$pjt_code."%'  or `wr_option` LIKE '%".$pjt_code."%' ) and ( `wr_option` <> '' and  `wr_option` <> '-' ) ";
	$limit = '';
}
	
if($chk_month){
	$po_list .= " and ( `ca_name` LIKE '%-".$chk_month."%' ) ";
	$limit = '';
}

$po_list .= " group by AW, ca_name ";
$orderby = " order by wr_last desc, ca_name desc ";
if($order and $by){
	$orderby = " order by $order $by ";
}
$po_list .= $orderby;
$po_list .= $limit;
$numxx = 0;
$total_cnt = 0;
$total_amount = 0;
$total_in_amount = 0;
$total_in_qty = 0;
$now_ca_name = "";
?><!--<?=$po_list?>--><?
$sqlx = sql_query($po_list);
$split_line = "";
$no_split_line = "";
for($i=0;$listx=sql_fetch_array($sqlx);$i++){
	
	$deli_day = substr($listx[AG],0,10);
	$start2 = new DateTime($deli_day);
	$end2 = new DateTime(date("Y-m-d"));
	$daysx = round(($end2->format('U') - $start2->format('U')) / (60*60*24));
	$sql_won = sql_fetch(" SELECT `won` FROM `g4_write_bom_list_stock` WHERE `wr_id` = '".$listx[wr_hit]."' LIMIT 0,1 ");
	$mb_po = explode("|",$listx[wr_8]);
	$mb_info = sql_fetch(" SELECT * FROM `g4_member` WHERE `mb_id` = '".$mb_po[0]."' ");
	
	$in_icon = "";
	if($i == 0){
		$numt = 0;
		$tr_style = ' style="background-color:#FFCFE6; cursor:pointer;" ';
		$split_line = "";
		$sqlxt = sql_query($po_list_top);	
		for($it=0;$listxt=sql_fetch_array($sqlxt);$it++){
			$numt = $numt + 1;
			//Check sotck_in
			$chk_in = sql_fetch(" SELECT * FROM `g4_write_bom_list_po_ea` WHERE `po_code` = '".$listxt[wr_content]."' and `s_d_code` like 'S%' and `po_id` = '".$listxt[wr_id]."' ");
			if($chk_in[s_d_date]){
				//$tr_style = ' style="background-color:#EEFFD4; cursor:pointer;" ';
				$in_icon = '<img src="'.$g4[path].'/img/btn_rev2.gif" style="border:0px;"/>';	
			}
			
			$mtc_list = sql_fetch(" SELECT count(wr_id) as cnt FROM `g4_write_bom_list_po_app` WHERE `ca_name` = '".$listxt[ca_name]."'  ");
			//$total_cnt = $mtc_list[cnt] + $total_cnt;
			if($mtc_list[cnt] > 20){
				$tr_style = ' style="background-color:#FFC6C6 !important; cursor:pointer;" ';
			}
			?>
			<tr class="tr_lines"  id="tr_<?=$listxt[wr_id]?>"  <?=$tr_style?>  style="cursor:pointer;"> 
			 <td align="left"><div style="display:none;"><input type="checkbox" id="chk_<?=$listxt[wr_id]?>" name="wr_idx[]" value="<?=$listxt[ca_name]?>"/><input
             type="hidden" id="tr_<?=$listxt[wr_id]?>_qty_org" value="<?=$listxt[AC]?>"/></div></td>
			 <td align="right" style="padding-right:5px;" <? if($onClick){ ?> onClick="chkto('tr_<?=$listxt[wr_id]?>', 'chk_<?=$listxt[wr_id]?>');" <? } ?>><?=($numt)?></td>
			 <td dis="AM" align="center" <? if($onClick){ ?> onClick="chkto('tr_<?=$listxt[wr_id]?>', 'chk_<?=$listxt[wr_id]?>');" <? } ?>><?=substr($listxt[AU],0,10)?></td>
			 <td align="left">
				<table cellpadding="0" cellspacing="0" width="100%"><tr>
				<td width="55%" style="border:0px; padding:0px 0px 1px 0px; margin:0px; font-weight:bold; text-decoration:underline; cursor:pointer;"
				onClick='window.open("<?=$g4[path]?>/?rpt=<?=$listxt[ca_name]?>", "_blank", "toolbar=no,scrollbars=yes,resizable=yes,top=50,left=500,width=840,height=700");'><img src="<?=$g4[path]?>/img/ico_preview.gif" style="cursor:pointer; border:0px; padding-right:4px; width:14px; margin-top:1px; height:14px;"/><?=$listxt[ca_name]?></td>
				<td width="45%" style="border:0px; padding:0px; margin:0px; padding-right:8px; font-weight:bold; font-size:11px; color:#003194" align="left"><?
					if($listxt[AV]){ 
						?><img src="<?=$g4[path]?>/img/btn_rev2.gif" style="border:0px; padding-right:3px;"/><?
						if($listxt[AY] == '0000-00-00 00:00:00'){
							echo substr($listxt[AB],0,10);
						}else{
							echo substr($listxt[AY],0,10);
						}
					}else
					if($listxt[AW]){
						?><img src="<?=$g4[path]?>/img/ico_del_part.gif" style="border:0px; padding-right:3px;"/><span style="color:#A70002; font-weight:bold; font-size:11px;">재출고 요청</span><?
						
					}else{
					?><img src="<?=$g4[path]?>/img/btn_rev3.gif" style="border:0px;"/><span style="font-size:11px; color:#BBB; letter-spacing:; font-weight:normal;">미출고</span><?
					} ?>
				</td></tr>
				</table>
			 </td>
		
			 <td dis="AG" align="center" <? if($onClick){ ?> onClick="chkto('tr_<?=$listxt[wr_id]?>', 'chk_<?=$listxt[wr_id]?>');" <? } ?> style="font-size:11px;"><?=substr($listxt[AG],0,10)?></td>
             
             <td dis="현품표" align="center"><? 
             if($member[mb_2] == "MTA08"){ ?>
                 <span style="background-color:#A20002; color:#FFF; padding:0px 4px; cursor:pointer; border:0px; "
                 onClick='window.open("<?=$g4[path]?>/?rpt=<?=$listxt[ca_name]?>&s=y&m=5", "_blank", "toolbar=no,scrollbars=yes,resizable=yes,top=50,left=500,width=840,height=700");'>1</span>

                 <span style="background-color:#A20002; color:#FFF; padding:0px 4px; cursor:pointer; border:0px; "
                 onClick='window.open("<?=$g4[path]?>/?rpt=<?=$listxt[ca_name]?>&s=y&m=10", "_blank", "toolbar=no,scrollbars=yes,resizable=yes,top=50,left=500,width=840,height=700");'>2</span>
             
             <? }else{ ?>
             	<img src="<?=$g4[path]?>/img/home/ico_edoc_doc.gif" style="cursor:pointer; border:0px; width:14px; height:12px; padding-right:3px;"
             	onClick='window.open("<?=$g4[path]?>/?rpt=<?=$listxt[ca_name]?>&s=y", "_blank", "toolbar=no,scrollbars=yes,resizable=yes,top=50,left=500,width=840,height=700");'/>
             <? } ?>
         	 <? /* onClick="if(confirm('[알림]\n이 PO의 리스트 및 현품표 엑셀을 다운로드 하시겠습니까?')){ window.open('<?=$g4[path]?>/po_report_xls.php?po_no=<?=$listx[wr_content]?>&orderby2=&xls=skip','_blank'); } " */ ?>
             </td>
		
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
			 
			 <td align="center" style="font-weight:bold; color:#0024FF; font-size:11px;" <? if($onClick){ ?> onClick="chkto('tr_<?=$listxt[wr_id]?>', 'chk_<?=$listxt[wr_id]?>');" <? } ?>><?=$mtc_list[cnt]?></td>
             
			 <td align="right" style="padding-right:4px; font-size:11px; color:#00467A;" <? if($onClick){ ?> onClick="chkto('tr_<?=$listxt[wr_id]?>', 'chk_<?=$listxt[wr_id]?>');" <? } ?> style="font-size:11px;"><?
			 	if(!$listxt[AX]){ ?> <span style="font-size:11px; letter-spacing:-1px; color:#DD975A;">납품서 확인 후 표시</span><? }else{ echo number_format($listxt[AX]); } ?></td>
             
			 <td align="left" style="padding-left:5px;font-size:11px; color:#999;" <? if($onClick){ ?> onClick="chkto('tr_<?=$listxt[wr_id]?>', 'chk_<?=$listxt[wr_id]?>');" <? } ?> style="font-size:11px;"><?
			 if($listxt[AV]){ 
				echo "<span style='font-size:11px; color:#5B00DC;'>메티스 입고 확인 中</span>";
			 }else
			 if($listxt[AW]){
				$msgx = explode("|",$listxt[AW]);
				echo "<span style='font-size:11px; color:#DC001B; font-weight:bold;'>재발주 요청 : ".$msgx[2]."</span>";
			 }else{
				echo "&nbsp;";
			 } ?>
			 </td>
			 <td style="cursor:default;"><?
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
			$now_ca_name = $listxt[ca_name];
		}
		
		if($it > 0){ 
			?><tr><td colspan="10" height="11" bgcolor="#E0E0E0" style="border-top:1px solid #999; border-bottom:1px solid #CCC;"></td></tr><?
		}
		
	}
	
	$tr_style = ' style="background-color:#FFFFFF; cursor:pointer;" ';	
	$view = "Y";
	//chkeck_reported part
	if($listx[wr_comment_reply] == "QR"){
		$chk_rpt = sql_fetch(" SELECT * FROM `g4_write_bom_list_po_app` WHERE `wr_parent` = '".$listx[wr_id]."' ");
		if($chk_rpt[wr_id]){
			$view = "";
		}
		
	}
	
	//Check sotck_in
	$in_icon = "";
	$mtc_list = sql_fetch(" SELECT count(wr_id) as cnt FROM `g4_write_bom_list_po_app` WHERE `ca_name` = '".$listx[ca_name]."'  ");
	$total_cnt = $mtc_list[cnt] + $total_cnt;
	$bgx = "#FFFFFF";
	
	$onClick = "1";
	if($listx[AV]){
		$tr_style = ' style="background-color:#F3FFE1; cursor:pointer;" ';
		$bgx = "#F3FFE1";
	}
	if($listx[BJ]){
		$tr_style = ' style="background-color:#FAFAFA; cursor:pointer;" ';
		$bgx = "#FAFAFA";
		$onClick = "";
	}

	$chk_in = sql_fetch(" SELECT * FROM `g4_write_bom_list_po_ea` WHERE `po_code` = '".$listx[wr_content]."' and `s_d_code` like 'S%' and `po_memo` = '".$listx[ca_name]."' ");
	if($chk_in[s_d_date]){
		//$tr_style = ' style="background-color:#EEFFD4;" ';
		$in_icon = '<img src="'.$g4[path].'/img/btn_rev2.gif" style="border:0px;"/>';	
	}
	

	
	/*
	if($i > 0 and substr($listx[ca_name],0,9) != substr($now_ca_name,0,9)){
	?><tr>
     <td colspan="8" align="right" height="32" style="padding-right:10px; font-size:11px; color:#888; border-top:3px double #DDD; border-right:0px;"><span style="font-size:11px; color:#888;"><? if($mm){ echo $mm."월"; } ?> 합계 : </span>
     <span style="font-size:16px; font-weight:bold; color:#4B608B; letter-spacing:-1px;"><?=number_format($sub_total_cnt)?></span><span style="font-size:11px; color:#888; padding-left:2px;">건</span></td>
     <td align="right" style="padding-right:5px; font-weight:bold; letter-spacing:-1px; color:#0000FF; border-top:3px double #DDD; font-size:16px;"><?=number_format($sub_total_amount)?><span style="font-size:11px; color:#888; padding-left:2px;">원</span></td>
     <td style=" border-top:3px double #DDD;">&nbsp;  </td>
     <td style=" border-top:3px double #DDD;">&nbsp;&bull;&nbsp;입고 완료 정보 (총 <B><?=$total_in_qty?></B>건 / <B><?=number_format($total_in_amount)?></B>원)</td>
    </tr>
    <?
	$numxx = 0;
	$sub_total_cnt = 0;
	$sub_total_amount = 0;
	}
	*/
	
	if(substr($listx[ca_name],0,9) != substr($now_ca_name,0,9)){
	?><tr><td colspan="11" height="17" bgcolor="#E0E0E0" valign="bottom" style="border-top:1px solid #999; font-size:11px; padding-left:5px; font-weight:bold; border-bottom:1px solid #CCC;"><?
		$yyx = substr($listx[ca_name],0,2);
		$mmx = substr($listx[ca_name],8,1);
		$mm = "";
		$numx = 0;
		if($mmx == "A"){ $mm = "1"; }else
		if($mmx == "B"){ $mm = "2"; }else
		if($mmx == "C"){ $mm = "3"; }else
		if($mmx == "D"){ $mm = "4"; }else
		if($mmx == "E"){ $mm = "5"; }else
		if($mmx == "F"){ $mm = "6"; }else
		if($mmx == "G"){ $mm = "7"; }else
		if($mmx == "H"){ $mm = "8"; }else
		if($mmx == "I"){ $mm = "9"; }else
		if($mmx == "J"){ $mm = "10"; }else
		if($mmx == "K"){ $mm = "11"; }else
		if($mmx == "L"){ $mm = "12"; }
		echo "<img src='".$g4[path]."/img/home/ico_days.gif' style='border:0px; width:11px; height:11px; padding-right:2px;'>20".$yyx."년 ";
		if($mm){ echo $mm."월"; } 	?>
		&nbsp;
		<img id="hidex" src="<?=$g4[path]?>/img/order_desc.gif" style="border:0px; cursor:pointer;" onClick="$('.<?="tr_".$mmx?>').css('display','none');"/>
		<img id="showx" src="<?=$g4[path]?>/img/order_asc.gif" style="border:0px; cursor:pointer;" onClick="$('.<?="tr_".$mmx?>').css('display','');"/>
    </td></tr><?
	}
	
	$numx = $numx + 1;?>
    <tr <? if($onClick){ ?> class="tr_lines <?="tr_".$mmx?>" <? }else{ ?> class="<?="tr_".$mmx?>" <? } ?> id="tr_<?=$listx[wr_id]?>"  <?=$tr_style?> > 
     <td align="left" onClick="chkto('tr_<?=$listx[wr_id]?>', 'chk_<?=$listx[wr_id]?>', '<?=$bgx?>');">
     	<input type="checkbox" id="chk_<?=$listx[wr_id]?>" name="wr_idx[]" value="<?=$listx[wr_id]?>" onClick="chkto('tr_<?=$listx[wr_id]?>', 'chk_<?=$listx[wr_id]?>', '<?=$bgx?>');"/>
        <input type="hidden" id="tr_<?=$listx[wr_id]?>_qty_org" value="<?=$listx[AC]?>"/>
	 </td>
     <td align="right" style="padding-right:5px;" onClick="chkto('tr_<?=$listx[wr_id]?>', 'chk_<?=$listx[wr_id]?>', '<?=$bgx?>');"><?=$numx?></td>
     <td dis="AM" align="center" onClick="chkto('tr_<?=$listx[wr_id]?>', 'chk_<?=$listx[wr_id]?>', '<?=$bgx?>');"><?=substr($listx[AU],0,10)?></td>
     <td align="left">
	 	<table cellpadding="0" cellspacing="0" width="100%"><tr>
        <td width="50%" style="border:0px; padding:0px 0px 1px 0px; margin:0px; font-weight:bold; text-decoration:underline; cursor:pointer;"
        onClick='window.open("<?=$g4[path]?>/?rpt=<?=$listx[ca_name]?>", "_blank", "toolbar=no,scrollbars=yes,resizable=yes,top=50,left=500,width=840,height=700");'><img src="<?=$g4[path]?>/img/ico_preview.gif" style="cursor:pointer; border:0px; padding-right:4px; width:11px; height:11px; margin-top:1px; margin-right:-2px; "/><?=$listx[ca_name]?></td>
        <td width="50%" style="border:0px; padding:0px; margin:0px; padding-right:8px; font-weight:bold; font-size:11px; color:#003194; cursor:pointer;" align="left" onClick="chkto('tr_<?=$listx[wr_id]?>', 'chk_<?=$listx[wr_id]?>', '<?=$bgx?>');"><?
			if($listx[AY] != "0000-00-00 00:00:00" or $listx[AV] != ""){ 
				?><img src="<?=$g4[path]?>/img/btn_rev2.gif" style="border:0px; padding-right:5px; padding-right:10px;"/><?
				if($listx[AY] == '0000-00-00 00:00:00'){
					echo substr($listx[AV],0,10);
				}else{
					echo substr($listx[AY],0,10);
				}
			}else
			if($listx[AW]){
				?><img src="<?=$g4[path]?>/img/ico_del_part.gif" style="border:0px; padding-right:3px;"/><span style="color:#A70002; font-weight:bold; font-size:11px;">재출고 요청</span><?
            }else{
			?><img src="<?=$g4[path]?>/img/bull_blue.gif" style="border:0px;"/><span style="font-size:11px; letter-spacing:; font-weight:normal; padding-left:3px; color:#0010CC;">출고 대기</span><?
            } ?>
        </td></tr>
        </table>
     </td>

     <td dis="AG" align="center" onClick="chkto('tr_<?=$listx[wr_id]?>', 'chk_<?=$listx[wr_id]?>', '<?=$bgx?>');" style="font-size:11px; color:#9F0002;"><?=substr($listx[AG],0,10)?></td>

     <td dis="현품표" align="center"><!--
			<img src="<?=$g4[path]?>/img/home/ico_edoc_doc.gif" style="cursor:pointer; border:0px; width:14px; height:12px; padding-right:3px;"
     		onClick='window.open("http://pjt.imetis.co.kr/?rpt=<?=$listx[ca_name]?>&s=y", "_blank", "toolbar=no,scrollbars=yes,resizable=yes,top=50,left=500,width=690,height=700");'/>
            --><img src="<?=$g4[path]?>/img/btn_xls_down2.gif" style="cursor:pointer; border:0px; "
            onClick="document.getElementById('hiddenx').src = 'http://pjt.imetis.co.kr/?rpt=<?=$listx[ca_name]?>&s=y&d=y';"/>
     </td>

     <td align="left"><div style="white-space:nowrap; overflow:hidden; font-size:12px; font-weight:bold; letter-spacing:-1px;" onClick="chkto('tr_<?=$listx[wr_id]?>', 'chk_<?=$listx[wr_id]?>', '<?=$bgx?>');"><?
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
     
     
     <td align="center" style="font-weight:bold; color:#0024FF; font-size:11px;" onClick="chkto('tr_<?=$listx[wr_id]?>', 'chk_<?=$listx[wr_id]?>', '<?=$bgx?>');"><?=$mtc_list[cnt]?></td>
     <td align="right" style="padding-right:4px; font-size:11px; color:#00467A;" onClick="chkto('tr_<?=$listx[wr_id]?>', 'chk_<?=$listx[wr_id]?>', '<?=$bgx?>');" style="font-size:11px;"><? if($listx[AX]){ echo number_format($listx[AX]);
	 	}else{ ?><span style="font-size:11px; letter-spacing:-1px; color:#D3C1A9;">납품서 열람 후 표시됨</span><? } ?></td>
     <td align="left" style="padding-left:5px;font-size:11px; color:#999;" onClick="chkto('tr_<?=$listx[wr_id]?>', 'chk_<?=$listx[wr_id]?>', '<?=$bgx?>');" style="font-size:11px;"><?
	 if($chk_in[s_d_date]){
	 	echo "<span style='font-size:11px; color:#AAAAAA;'>메티스 입고 완료</span>";
		$total_in_amount = $listx[AX] + $total_in_amount;
		$total_in_qty = $total_in_qty + 1;
	 }else
	 if($listx[AV]){ 
	 	echo "<span style='font-size:11px; color:#734000;'>메티스 입고 확인 中</span>";
	 }else
	 if($listx[AW]){
		$msgx = explode("|",$listx[AW]);
	 	echo "<span style='font-size:11px; color:#DC001B; font-weight:bold;'>재발주 요청 : ".$msgx[2]."</span>";
	 }else{
	 	echo "&nbsp;";
	 } ?>
	 </td>
     <td><?
	  if($listx[AW]){ ?>
      	<div style="width:98%; white-space:nowrap; overflow:hidden; background-color:transparent; letter-spacing:-1px; font-size:11px; color:#DC001B;"><img src="<?=$g4[path]?>/img/board_info.gif" style="width:11px; border:0px; padding-left:4px; padding-right:3px;"/><?=$msgx[3]?>
      <?
	  }else
	  if($listx[AV] and !$listx[BJ]){ ?>
      	<img src="<?=$g4[path]?>/img/btn_backit3.gif" style="cursor:pointer; border:0px;" onClick="rpt_backout('<?=$listx[ca_name]?>');"/>
      <? } ?>
     </td>
    </tr>
    <?
	$numxx = $numxx + 1;
	$sub_total_cnt = $sub_total_cnt + $numxx;
	$sub_total_amount = $sub_total_amount + $listx[AX];
	$total_amount = $listx[AX] + $total_amount;
	$now_ca_name = $listx[ca_name];
	
}
if($i > 0){
	?>
    <tr>
     <td colspan="8" align="right" height="32" style="padding-right:10px; font-size:11px; color:#888; border-top:3px double #DDD; border-right:0px;"><span style="font-size:11px; color:#888;">합계 : </span>
     <span style="font-size:16px; font-weight:bold; color:#4B608B; letter-spacing:-1px;"><?=number_format($total_cnt)?></span><span style="font-size:11px; color:#888; padding-left:2px;">건</span></td>
     <td align="right" style="padding-right:5px; font-weight:bold; letter-spacing:-1px; color:#0000FF; border-top:3px double #DDD; font-size:16px;"><?=number_format($total_amount)?><span style="font-size:11px; color:#888; padding-left:2px;">원</span></td>
     <td style=" border-top:3px double #DDD;">&nbsp;  </td>
     <td style=" border-top:3px double #DDD;">&nbsp;&bull;&nbsp;입고 완료 정보 (총 <B><?=$total_in_qty?></B>건 / <B><?=number_format($total_in_amount)?></B>원)</td>
    </tr>
    <?
}
?>
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


<br/><br/>
<div style="width:90%; display:none; visibility:hidden; z-index:0; width:0px; height:0px; border:0px;">
<iframe id="hiddenx" name="hiddenx" src="" scrolling="no" style="border:0px;"></iframe>
<!--<iframe src="//sharecad.org/cadframe/load?url=http://oms.imetis.co.kr/dwg/KMFA-506257-R006.dwg" scrolling="no" style="width:99%; height:600px; border:0px;"></iframe>-->
</div>
<?
exit;
?>
<div style="width:100%;">
<iframe src="//sharecad.org/cadframe/load?url=http://oms.imetis.co.kr/dwg/SMZ-005326A_D300-34147A_R000.dxf" scrolling="no" style="width:99%; height:600px; border:0px;"></iframe>
<!--<iframe src="//sharecad.org/cadframe/load?url=http://oms.imetis.co.kr/dwg/KMFA-506257-R006.dwg" scrolling="no" style="width:99%; height:600px; border:0px;"></iframe>-->
</div>

