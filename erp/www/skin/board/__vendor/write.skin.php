<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

if ($is_dhtml_editor) {
    include_once("$g4[path]/lib/cheditor4.lib.php");
    echo "<script src='$g4[cheditor4_path]/cheditor.js'></script>";
    echo cheditor1('wr_content', '100%', '250');
}
?>
<style type="text/css">
.write_head { height:30px; text-align:center; color:#8492A0; }
.field { border:1px solid #ccc; }

.board_top { clear:both; }

.board_list { clear:both; width:100%; table-layout:fixed; margin:0px; }
.board_list th { font-weight:bold; font-size:12px; border-bottom:1px solid #CCC; border-right:1px solid #CCC;} 
.board_list th { background-color:#E2E2E2; } 
.board_list th { white-space:nowrap; height:16px; overflow:hidden; text-align:center; } 

.board_list tr.bg0 { background-color:#fafafa; } 
.board_list tr.bg1 { background-color:#ffffff; } 

.board_list td { border-bottom:1px solid #ddd; } 
.board_list td.num { color:#999999; text-align:center; }

.board_button { clear:both; margin:10px 0 0 0; }

.board_page { clear:both; text-align:center; margin:3px 0 0 0; }
.board_page a:link { color:#777; }

.board_search { text-align:center; margin:10px 0 0 0; }
.board_search .stx { height:21px; border:1px solid #9A9A9A; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8; }

</style>

<script type="text/javascript">
// 글자수 제한
var char_min = parseInt(<?=$write_min?>); // 최소
var char_max = parseInt(<?=$write_max?>); // 최대
</script>




<form name="fwrite" method="post" action="<?=$g4[path]?>/bbs/write_update.php"  enctype="multipart/form-data" style="margin:0px;">
<input type=hidden name=null> 
<input type=hidden name=w        value="<?=$w?>">
<input type=hidden name=bo_table value="<?=$bo_table?>">
<input type=hidden name=sca      value="<?=$sca?>">
<input type=hidden name=sfl      value="<?=$sfl?>">
<input type=hidden name=stx      value="<?=$stx?>">
<input type=hidden name=spt      value="<?=$spt?>">
<input type=hidden name=sst      value="<?=$sst?>">
<input type=hidden name=sod      value="<?=$sod?>">
<input type=hidden name=page     value="<?=$page?>">


<div style="width:100%; background:#de3e17 url(../img/top_bg_imgN9.gif) left top no-repeat; border-top:2px solid #000000; border-bottom:1px solid #AAA;">
     <div style='width:100%;  border-top:1px solid #111111; height:40px; border-bottom:1px solid #666;'>
     	<table cellpadding="0" cellspacing="0">
        <tr>
         <td align="left" valign="bottom" height="34">
         <div style="padding-left:260px; z-index:1; padding-right:22px; font-size:24px; font-family: Apple SD Gothic Neo, Malgun Gothic, Dotum !important; color:#FFF;"><?
         if($m_id == "65"){ ?>고객사 신규 등록 <span style="font-size:12px; color:#EEE; padding-left:12px;">(영업/구매 공통)</span><?
		 }else{ ?>신규 협력사 등록 <span style="font-size:12px; color:#EEE; padding-left:12px;">(영업/구매 공통)</span><? } ?></div>
         </td>
        </tr>
        </table>
     </div>
</div>


    <table cellspacing="0" cellpadding="0" class="board_list">
    <col width="120">
    <col width="200">
    <col width="100">
    <col width="72">
    
    <col width="60">
    <col  width="135">
    <col width="70">
    <col width="120">

    <col width="60">
	
    <col width="200">
    <col width="70">
    <col width="140">
    <col width="90">

    <col width="250">

    <col>
    
    <tr height="30">
        <th rowspan="2" >업체명</th>
        <th rowspan="2" >취급 Maker</th>
        <th rowspan="2">사업자 번호</th>
        <th rowspan="2" >거래 유형</th>
        <th colspan="4">인증 현황</th>
        <th rowspan="2">하도급</th>
        <th rowspan="2">주소</th>
        <th rowspan="2">대표자</th>
        <th rowspan="2">E-Mail</th>
        <th rowspan="2">연락처</th>
        <th rowspan="2">첨부</th>
        <th rowspan="2">비고</th>
    </tr>
    <tr>
        <th>인증 유형</th>
        <th>인증 번호</th>
        <th>인증 업태</th>
        <th>인증 상세</th>
    </tr>

    <tr class="bg1" height="135"> 

			
			            
            <td  style="white-space:nowrap;"><div style="width:95%; white-space:nowrap; overflow:hidden; font-weight:bold; padding-left:3px;">
            	<input type="radio" name="ca_name" id="ca_name2" value="구 매" <? if(!$write[ca_name] or $m_id == "337"){ ?> checked <? } ?>
                onClick="if(this.checked == true){ document.getElementById('wr_subject').style.display='none';document.getElementById('wr_content').style.display='block'; }"/><label
                for="ca_name2" style="cursor:pointer;">구 매</label>
                
     			<input type="radio" name="ca_name" id="ca_name1" value="영 업" <? if($write[ca_name] == "영 업" or $m_id == "65"){ ?> checked <? } ?>
                onClick="if(this.checked == true){ document.getElementById('wr_subject').style.display='block';document.getElementById('wr_content').style.display='none'; }"/><label
                for="ca_name1" style="cursor:pointer;">영 업</label>
                
				<? /*<BR />
				<input type="radio" name="ca_name" id="ca_name3" value="SSQ" <? if($write[ca_name] == "SSQ"){ ?> checked <? } ?>
				onClick="if(this.checked == true){ document.getElementById('wr_subject').style.display='block';document.getElementById('wr_content').style.display='none'; }"/><label
				for="ca_name3" style="cursor:pointer;">SSQ</label>*/ ?>
        		
                <br/>
                <input style="position:absolute; display:none;" type=hidden name=chk_wr_id[] value="new"><input name="vendor_name" style="width:95%; height:18px; margin-bottom:1px; border:1px solid #D39D00; background-color:#FFF7D6; font-size:11px; font-family:Malgun Gothic;" required value=""/></div>
            </td>

            <td  style="white-space:nowrap; padding-left:2px;" align="left">                    <input name="fix_0_new[0]" style="width:95%; height:18px; margin-bottom:1px; border:1px solid #D39D00; background-color:#FFF7D6; font-size:11px; font-family:Malgun Gothic;" value=""/><br/>
                    <input name="fix_0_new[1]" style="width:95%; height:18px; margin-bottom:1px; border:1px solid #D39D00; background-color:#FFF7D6; font-size:11px; font-family:Malgun Gothic;" value=""/><br/>
                    <input name="fix_0_new[2]" style="width:95%; height:18px; margin-bottom:1px; border:1px solid #D39D00; background-color:#FFF7D6; font-size:11px; font-family:Malgun Gothic;" value=""/><br/>
                    <input name="fix_0_new[3]" style="width:95%; height:18px; margin-bottom:1px; border:1px solid #D39D00; background-color:#FFF7D6; font-size:11px; font-family:Malgun Gothic;" value=""/>
					
            <td  style="white-space:nowrap; text-align:center;"><input type="text" name="fix_1_new" style="width:95%; height:16px; border:1px solid #D39D00; background-color:#FFF7D6; font-size:11px; font-family:Malgun Gothic;" value=""></td>
            <td  style="white-space:nowrap;" align="center">                	<select name="fix_2_new"  style="width:56px; height:18px; border:1px solid #D39D00; background-color:#FFF7D6; font-size:11px; font-family:Malgun Gothic; z-index:1;">
                     <option value="" ::선택::</option>
                     <option value="가공품"  >가공품</option>
                     <option value="사입품"  >사입품</option>
                     <option value="전장품"    >전장품</option>
                     <option value="잡자재"  >잡자재</option>
                     <option value="외주일식"  >외주일식</option>
                     <option value="UNIT"  >UNIT</option>
                     <option value="기타"  >기타</option>
                    </select>
                            </td>

            <td  align="center">
            <select name="fix_3_new"  style="width:56px; height:18px; border:1px solid #D39D00; background-color:#FFF7D6; font-size:11px; font-family:Malgun Gothic; z-index:1;">
                     <option value=""  selected >::선택::</option>
                     <option value="SSQ"  >SSQ</option>
                    </select>
                    </td>
            <td  style="white-space:nowrap; padding-left:2px;"><input name="fix_4_new[0]" style="width:95%; height:18px; margin-bottom:1px; border:1px solid #D39D00; background-color:#FFF7D6; font-size:11px; font-family:Malgun Gothic;" value=""/><br/>
                    <input name="fix_4_new[1]" style="width:95%; height:18px; margin-bottom:1px; border:1px solid #D39D00; background-color:#FFF7D6; font-size:11px; font-family:Malgun Gothic;" value=""/><br/>
                    <input name="fix_4_new[2]" style="width:95%; height:18px; margin-bottom:1px; border:1px solid #D39D00; background-color:#FFF7D6; font-size:11px; font-family:Malgun Gothic;" value=""/><br/>
                    <input name="fix_4_new[3]" style="width:95%; height:18px; margin-bottom:1px; border:1px solid #D39D00; background-color:#FFF7D6; font-size:11px; font-family:Malgun Gothic;" value=""/>
					</td>
            
			            <td  colspan="2">                       <select name="fix_5_new[0]"  style="width:185px; height:22px; margin-bottom:1px; padding:0px 3px; border:1px solid #D39D00; background-color:#FFF7D6; font-size:11px; font-family:Malgun Gothic;">
                        <option value="">::선택::</option>
                        <option value="HARNESS" >HARNESS</option>
                        <option value="제어기 : HARNESS" >제어기 : HARNESS</option>
                        <option value="BOARD설계" >BOARD설계</option>
                        <option value="C-BOX" >C-BOX</option>
                        <option value="SMT" >SMT</option>
                        <option value="제어기" >제어기</option>
                        <option value="판금/제관" >판금/제관</option>
                        <option value="후처리-도금 : 아노다이징, 금속도금(무전해니켈,경질크롬), 전해연마" >후처리-도금 : 아노다이징, 금속도금(무전해니켈,경질크롬), 전해연마</option>
                        <option value="후처리-도장 : 분체,액체" >후처리-도장 : 분체,액체</option>
                        <option value="후처리-도장 : 분체" >후처리-도장 : 분체</option>
                        <option value="금속가공 : 금속가공(CNC, MCT)" >금속가공 : 금속가공(CNC, MCT)</option>
                        <option value="금속가공 : 금속가공(MCT)" >금속가공 : 금속가공(MCT)</option>
                        <option value="판금/제관" >판금/제관</option>
                       </select><br/>                       <select name="fix_5_new[1]"  style="width:185px; height:22px; margin-bottom:1px; padding:0px 3px; border:1px solid #D39D00; background-color:#FFF7D6; font-size:11px; font-family:Malgun Gothic;">
                        <option value="">::선택::</option>
                        <option value="HARNESS" >HARNESS</option>
                        <option value="제어기 : HARNESS" >제어기 : HARNESS</option>
                        <option value="BOARD설계" >BOARD설계</option>
                        <option value="C-BOX" >C-BOX</option>
                        <option value="SMT" >SMT</option>
                        <option value="제어기" >제어기</option>
                        <option value="판금/제관" >판금/제관</option>
                        <option value="후처리-도금 : 아노다이징, 금속도금(무전해니켈,경질크롬), 전해연마" >후처리-도금 : 아노다이징, 금속도금(무전해니켈,경질크롬), 전해연마</option>
                        <option value="후처리-도장 : 분체,액체" >후처리-도장 : 분체,액체</option>
                        <option value="후처리-도장 : 분체" >후처리-도장 : 분체</option>
                        <option value="금속가공 : 금속가공(CNC, MCT)" >금속가공 : 금속가공(CNC, MCT)</option>
                        <option value="금속가공 : 금속가공(MCT)" >금속가공 : 금속가공(MCT)</option>
                        <option value="판금/제관" >판금/제관</option>
                       </select><br/>                       <select name="fix_5_new[2]"  style="width:185px; height:22px; margin-bottom:1px; padding:0px 3px; border:1px solid #D39D00; background-color:#FFF7D6; font-size:11px; font-family:Malgun Gothic;">
                        <option value="">::선택::</option>
                        <option value="HARNESS" >HARNESS</option>
                        <option value="제어기 : HARNESS" >제어기 : HARNESS</option>
                        <option value="BOARD설계" >BOARD설계</option>
                        <option value="C-BOX" >C-BOX</option>
                        <option value="SMT" >SMT</option>
                        <option value="제어기" >제어기</option>
                        <option value="판금/제관" >판금/제관</option>
                        <option value="후처리-도금 : 아노다이징, 금속도금(무전해니켈,경질크롬), 전해연마" >후처리-도금 : 아노다이징, 금속도금(무전해니켈,경질크롬), 전해연마</option>
                        <option value="후처리-도장 : 분체,액체" >후처리-도장 : 분체,액체</option>
                        <option value="후처리-도장 : 분체" >후처리-도장 : 분체</option>
                        <option value="금속가공 : 금속가공(CNC, MCT)" >금속가공 : 금속가공(CNC, MCT)</option>
                        <option value="금속가공 : 금속가공(MCT)" >금속가공 : 금속가공(MCT)</option>
                        <option value="판금/제관" >판금/제관</option>
                       </select><br/>                       <select name="fix_5_new[3]"  style="width:185px; height:22px; margin-bottom:1px; padding:0px 3px; border:1px solid #D39D00; background-color:#FFF7D6; font-size:11px; font-family:Malgun Gothic;">
                        <option value="">::선택::</option>
                        <option value="HARNESS" >HARNESS</option>
                        <option value="제어기 : HARNESS" >제어기 : HARNESS</option>
                        <option value="BOARD설계" >BOARD설계</option>
                        <option value="C-BOX" >C-BOX</option>
                        <option value="SMT" >SMT</option>
                        <option value="제어기" >제어기</option>
                        <option value="판금/제관" >판금/제관</option>
                        <option value="후처리-도금 : 아노다이징, 금속도금(무전해니켈,경질크롬), 전해연마" >후처리-도금 : 아노다이징, 금속도금(무전해니켈,경질크롬), 전해연마</option>
                        <option value="후처리-도장 : 분체,액체" >후처리-도장 : 분체,액체</option>
                        <option value="후처리-도장 : 분체" >후처리-도장 : 분체</option>
                        <option value="금속가공 : 금속가공(CNC, MCT)" >금속가공 : 금속가공(CNC, MCT)</option>
                        <option value="금속가공 : 금속가공(MCT)" >금속가공 : 금속가공(MCT)</option>
                        <option value="판금/제관" >판금/제관</option>
                       </select>
            </td>
            
            
            <td align="center">
            	<select name="fix_6_new"  style="width:46px; height:18px; border:1px solid #D39D00; background-color:#FFF7D6; font-size:11px; font-family:Malgun Gothic; z-index:1;">
                     <option value="NO">NO</option>
                     <option value="YES"  >YES</option>
                </select>
            </td>
						
            <td ><input type="text" name="fix_11_new" style="width:95%; height:40px; border:1px solid #D39D00; background-color:#FFF7D6; font-size:11px; font-family:Malgun Gothic;" value=""></td>
                
            <td  align="center"><input type="text" name="fix_12_new" style="width:95%; height:16px; border:1px solid #D39D00; background-color:#FFF7D6; font-size:11px; font-family:Malgun Gothic;" value=""></td>
                
            <td  align="left"><input type="text" name="fix_13_new"  style="width:95%; height:16px; border:1px solid #D39D00; background-color:#FFF7D6; font-size:11px; font-family:Malgun Gothic;" value=""></td>

            <td  align="left"><input type="text" name="fix_14_new"  style="width:95%; height:16px; border:1px solid #D39D00; background-color:#FFF7D6; font-size:11px; font-family:Malgun Gothic;" value=""></td>

            

            <td >
                
            	    <table cellpadding="0" cellspacing="0">
                     <tr><td width="110" style="border:0px; padding:0px;">&nbsp;&bull;&nbsp;사업자 등록증 : </td><td style="border:0px; padding:0px;"><input type="file" class="ed" name="bf_file_new[0]" title="사업자 등록증"
                            style="width:95%; height:16px; border:1px solid #D39D00; background-color:#FFF7D6; font-size:11px; font-family:Malgun Gothic;"/></td>                     </tr>

                     <tr><td width="110" style="border:0px; padding:0px;">&nbsp;&bull;&nbsp;법인 등록증 : </td><td style="border:0px; padding:0px;"><input type="file" class="ed" name="bf_file_new[1]" title="사업자 등록증"
                            style="width:95%; height:16px; border:1px solid #D39D00; background-color:#FFF7D6; font-size:11px; font-family:Malgun Gothic;"/></td>                     </tr>

                     <tr><td width="110" style="border:0px; padding:0px;">&nbsp;&bull;&nbsp;계약서/기타 #1 : </td><td style="border:0px; padding:0px;"><input type="file" class="ed" name="bf_file_new[2]" title="사업자 등록증"
                            style="width:95%; height:16px; border:1px solid #D39D00; background-color:#FFF7D6; font-size:11px; font-family:Malgun Gothic;"/></td>                     </tr>

                     <tr><td width="110" style="border:0px; padding:0px;">&nbsp;&bull;&nbsp;계약서/기타 #2 : </td><td style="border:0px; padding:0px;"><input type="file" class="ed" name="bf_file_new[3]" title="사업자 등록증"
                            style="width:95%; height:16px; border:1px solid #D39D00; background-color:#FFF7D6; font-size:11px; font-family:Malgun Gothic;"/></td>                     </tr>

                    </table>
					                
            </td>
            
            <td>&nbsp;</td>

        </td>
		
    
    </table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="100%" align="center" valign="top" style="padding-top:30px;">
        <input type=image id="btn_submit" src="<?=$g4[path]?>/img/btn_write.gif" border=0 accesskey='s'>&nbsp;
       </td>
</tr>
</table>
    </form>
    

<? /*
<form name="fwrite" method="post" onsubmit="return fwrite_submit(this);" enctype="multipart/form-data" style="margin:0px;">
<input type=hidden name=null> 
<input type=hidden name=w        value="<?=$w?>">
<input type=hidden name=bo_table value="<?=$bo_table?>">
<input type=hidden name=wr_id    value="<?=$wr_id?>">
<input type=hidden name=sca      value="<?=$sca?>">
<input type=hidden name=sfl      value="<?=$sfl?>">
<input type=hidden name=stx      value="<?=$stx?>">
<input type=hidden name=spt      value="<?=$spt?>">
<input type=hidden name=sst      value="<?=$sst?>">
<input type=hidden name=sod      value="<?=$sod?>">
<input type=hidden name=page     value="<?=$page?>">


<div style="width:100%; background:#de3e17 url(../img/top_bg_imgN9.gif) left top no-repeat; border-top:2px solid #000000; border-bottom:1px solid #AAA;">
     <div style='width:100%;  border-top:1px solid #111111; height:40px; border-bottom:1px solid #666;'>
     	<table cellpadding="0" cellspacing="0">
        <tr>
         <td align="left" valign="bottom" height="34"><div style="padding-left:118px; z-index:1; padding-right:22px; font-size:24px; font-family: Apple SD Gothic Neo, Malgun Gothic, Dotum !important; color:#FFF;">신규 협력사 등록</div>
         </td>
         <td valign="bottom">
         	            
         </td>
        </tr>
        </table>
     </div>
</div>



<table width="<?=$width?>" align=center cellpadding=0 cellspacing=0 style="margin-top:5px;"><tr><td>
<div style="border:1px solid #ddd; height:26px; background:url(<?=$board_skin_path?>/img/title_bg.gif) repeat-x;">
<div style="font-weight:bold; font-size:14px; margin:3px 0px 0px 10px;">협력사 기본 정보</div>
</div>
<div style="height:3px; background:url(<?=$board_skin_path?>/img/title_shadow.gif) repeat-x; line-height:1px; font-size:1px;"></div>

  <table width="100%" cellpadding="2" cellspacing="2">
   <tr>
    <td width="50%">
    
	<table cellpadding="0" cellspacing="0" width="100%" style="border-top:1px solid #F2F2F2; border-left:1px solid #F2F2F2; border-right:1px solid #F2F2F2;  ">

    <tr height="28">
     <td bgcolor="#F9F9F9" style="border-bottom:1px solid #F2F2F2; padding-left:10px;">거래처 분류</td>
     <td style="border-bottom:1px solid #F2F2F2;">
     	<input type="radio" name="ca_name" id="ca_name2" value="구 매" <? if(!$write[ca_name]){ ?> checked <? } ?>
        onClick="if(this.checked == true){ document.getElementById('wr_subject').style.display='none';document.getElementById('wr_content').style.display='block'; }"/><label for="ca_name2" style="cursor:pointer;">구 매</label>
     	<input type="radio" name="ca_name" id="ca_name1" value="영 업" <? if($write[ca_name] == "영 업"){ ?> checked <? } ?>
        onClick="if(this.checked == true){ document.getElementById('wr_subject').style.display='block';document.getElementById('wr_content').style.display='none'; }"/><label for="ca_name1" style="cursor:pointer;">영 업</label>
     </td>
     <td bgcolor="#F9F9F9" style="border-bottom:1px solid #F2F2F2; padding-left:10px;">거래처 명</td>
     <td style="border-bottom:1px solid #F2F2F2;">
     	<input type="text" name="wr_subject" id="wr_subject" style="border:1px solid #FFAB6B; width:98%; margin-left:1%; height:18px; display:none;"/>
     	<input type="text" name="wr_content" id="wr_content" style="border:1px solid #E10085; width:98%; margin-left:1%; height:18px; display:block;"/>
     </td>
    </tr>
    
    <tr><td colspan="4" height="1" bgcolor="#FFFFFF"></td></tr>
    <tr height="28">
     <td bgcolor="#F9F9F9" style="border-bottom:1px solid #F2F2F2; padding-left:10px;">사업자 번호</td>
     <td style="border-bottom:1px solid #F2F2F2;">
     	<input type="text" name="wr_link1" style="border:1px solid #FFAB6B; width:98%; margin-left:1%; height:18px;" value="<?=$write[wr_link1]?>"/>
     </td>
     <td bgcolor="#F9F9F9" style="border-bottom:1px solid #F2F2F2; padding-left:10px;">대표자 명</td>
     <td style="border-bottom:1px solid #F2F2F2;">
     	<input type="text" name="wr_5" style="border:1px solid #FFAB6B; width:98%; margin-left:1%; height:18px;" value="<?=$write[wr_5]?>"/>
     </td>
    </tr>

    <tr><td colspan="4" height="1" bgcolor="#FFFFFF"></td></tr>
    <tr height="28">
     <td bgcolor="#F9F9F9" style="border-bottom:1px solid #F2F2F2; padding-left:10px;">주소</td>
     <td style="border-bottom:1px solid #F2F2F2;">
     	<input type="text" name="wr_1" style="border:1px solid #FFAB6B; width:98%; margin-left:1%; height:18px;" value="<?=$write[wr_1]?>"/>
     </td>
     <td bgcolor="#F9F9F9" style="border-bottom:1px solid #F2F2F2; padding-left:10px;">E-mail</td>
     <td style="border-bottom:1px solid #F2F2F2;">
     	<input type="text" name="wr_email" style="border:1px solid #FFAB6B; width:98%; margin-left:1%; height:18px;" value="<?=$write[wr_email]?>"/>
     </td>
    </tr>

    <tr><td colspan="4" height="1" bgcolor="#FFFFFF"></td></tr>
    <tr height="28">
     <td bgcolor="#F9F9F9" style="border-bottom:1px solid #F2F2F2; padding-left:10px;">주소</td>
     <td style="border-bottom:1px solid #F2F2F2;">
     	<input type="text" name="wr_1" style="border:1px solid #FFAB6B; width:98%; margin-left:1%; height:18px;" value="<?=$write[wr_1]?>"/>
     </td>
     <td bgcolor="#F9F9F9" style="border-bottom:1px solid #F2F2F2; padding-left:10px;">E-mail</td>
     <td style="border-bottom:1px solid #F2F2F2;">
     	<input type="text" name="wr_email" style="border:1px solid #FFAB6B; width:98%; margin-left:1%; height:18px;" value="<?=$write[wr_email]?>"/>
     </td>
    </tr>



    </table>
    
   </td>
   <td width="50%">
   
   	right
   
   </td>
  </tr>
 </table>
 
 
</td></tr></table>


<table width="100%" border="0" cellspacing="0" cellpadding="0">
<colgroup width=90>
<colgroup width=''>
<tr><td colspan="2" style="background:url(<?=$board_skin_path?>/img/title_bg.gif) repeat-x; height:3px;"></td></tr>
<? if ($is_name) { ?>
<tr>
    <td class=write_head>이 름</td>
    <td><input class='ed' maxlength=20 size=15 name=wr_name itemname="이름" required value="<?=$name?>"></td></tr>
<tr><td colspan=2 height=1 bgcolor=#e7e7e7></td></tr>
<? } ?>

<? if ($is_password) { ?>
<tr>
    <td class=write_head>패스워드</td>
    <td><input class='ed' type=password maxlength=20 size=15 name=wr_password itemname="패스워드" <?=$password_required?>></td></tr>
<tr><td colspan=2 height=1 bgcolor=#e7e7e7></td></tr>
<? } ?>

<? if ($is_email) { ?>
<tr>
    <td class=write_head>이메일</td>
    <td><input class='ed' maxlength=100 size=50 name=wr_email email itemname="이메일" value="<?=$email?>"></td></tr>
<tr><td colspan=2 height=1 bgcolor=#e7e7e7></td></tr>
<? } ?>

<? if ($is_homepage) { ?>
<tr>
    <td class=write_head>홈페이지</td>
    <td><input class='ed' size=50 name=wr_homepage itemname="홈페이지" value="<?=$homepage?>"></td></tr>
<tr><td colspan=2 height=1 bgcolor=#e7e7e7></td></tr>
<? } ?>

<? if ($is_category) { ?>
<tr>
    <td class=write_head>분 류</td>
    <td><select name=ca_name required itemname="분류"><option value="">선택하세요<?=$category_option?></select></td></tr>
<tr><td colspan=2 height=1 bgcolor=#e7e7e7></td></tr>
<? } ?>

<tr>
    <td class=write_head>제 목</td>
    <td><input class='ed' style="width:100%;" name=wr_subject id="wr_subject" itemname="제목" required value="<?=$subject?>"></td></tr>
<tr><td colspan=2 height=1 bgcolor=#e7e7e7></td></tr>
<tr>
    <td class='write_head' style='padding:5 0 5 10;' colspan='2'>
        <? if ($is_dhtml_editor) { ?>
            <?=cheditor2('wr_content', $content);?>
        <? } else { ?>
        <table width=100% cellpadding=0 cellspacing=0>
        <tr>
            <td width=50% align=left valign=bottom>
                <span style="cursor: pointer;" onclick="textarea_decrease('wr_content', 10);"><img src="<?=$board_skin_path?>/img/up.gif"></span>
                <span style="cursor: pointer;" onclick="textarea_original('wr_content', 10);"><img src="<?=$board_skin_path?>/img/start.gif"></span>
                <span style="cursor: pointer;" onclick="textarea_increase('wr_content', 10);"><img src="<?=$board_skin_path?>/img/down.gif"></span></td>
            <td width=50% align=right><? if ($write_min || $write_max) { ?><span id=char_count></span>글자<?}?></td>
        </tr>
        </table>
        <textarea id="wr_content" name="wr_content" class=tx style='width:100%; word-break:break-all;' rows=10 itemname="내용" required 
        <? if ($write_min || $write_max) { ?>onkeyup="check_byte('wr_content', 'char_count');"<?}?>><?=$content?></textarea>
        <? if ($write_min || $write_max) { ?><script type="text/javascript"> check_byte('wr_content', 'char_count'); </script><?}?>
        <? } ?>
    </td>
</tr>
<tr><td colspan=2 height=1 bgcolor=#dddddd></td></tr>

<? if ($is_link) { ?>
<? for ($i=1; $i<=$g4[link_count]; $i++) { ?>
<tr>
    <td class=write_head>링크 #<?=$i?></td>
    <td><input type='text' class='ed' size=50 name='wr_link<?=$i?>' itemname='링크 #<?=$i?>' value='<?=$write["wr_link{$i}"]?>'></td>
</tr>
<tr><td colspan=2 height=1 bgcolor=#e7e7e7></td></tr>
<? } ?>
<? } ?>

<? if ($is_file) { ?>
<tr>
    <td class=write_head>
        <table cellpadding=0 cellspacing=0>
        <tr>
            <td class=write_head style="padding-top:10px; line-height:20px;">
                파일첨부<br> 
                <span onclick="add_file();" style="cursor:pointer;"><img src="<?=$board_skin_path?>/img/btn_file_add.gif"></span> 
                <span onclick="del_file();" style="cursor:pointer;"><img src="<?=$board_skin_path?>/img/btn_file_minus.gif"></span>
            </td>
        </tr>
        </table>
    </td>
    <td style='padding:5 0 5 0;'><table id="variableFiles" cellpadding=0 cellspacing=0></table><?// print_r2($file); ?>
        <script type="text/javascript">
        var flen = 0;
        function add_file(delete_code)
        {
            var upload_count = <?=(int)$board[bo_upload_count]?>;
            if (upload_count && flen >= upload_count)
            {
                alert("이 게시판은 "+upload_count+"개 까지만 파일 업로드가 가능합니다.");
                return;
            }

            var objTbl;
            var objRow;
            var objCell;
            if (document.getElementById)
                objTbl = document.getElementById("variableFiles");
            else
                objTbl = document.all["variableFiles"];

            objRow = objTbl.insertRow(objTbl.rows.length);
            objCell = objRow.insertCell(0);

            objCell.innerHTML = "<input type='file' class='ed' name='bf_file[]' title='파일 용량 <?=$upload_max_filesize?> 이하만 업로드 가능'>";
            if (delete_code)
                objCell.innerHTML += delete_code;
            else
            {
                <? if ($is_file_content) { ?>
                objCell.innerHTML += "<br><input type='text' class='ed' size=50 name='bf_content[]' title='업로드 이미지 파일에 해당 되는 내용을 입력하세요.'>";
                <? } ?>
                ;
            }

            flen++;
        }

        <?=$file_script; //수정시에 필요한 스크립트?>

        function del_file()
        {
            // file_length 이하로는 필드가 삭제되지 않아야 합니다.
            var file_length = <?=(int)$file_length?>;
            var objTbl = document.getElementById("variableFiles");
            if (objTbl.rows.length - 1 > file_length)
            {
                objTbl.deleteRow(objTbl.rows.length - 1);
                flen--;
            }
        }
        </script></td>
</tr>
<tr><td colspan=2 height=1 bgcolor=#e7e7e7></td></tr>
<? } ?>

<? if ($is_trackback) { ?>
<tr>
    <td class=write_head>트랙백주소</td>
    <td><input class='ed' size=50 name=wr_trackback itemname="트랙백" value="<?=$trackback?>">
        <? if ($w=="u") { ?><input type=checkbox name="re_trackback" value="1">핑 보냄<? } ?></td>
</tr>
<tr><td colspan=2 height=1 bgcolor=#e7e7e7></td></tr>
<? } ?>

<? if ($is_guest) { ?>
<tr>
    <td class=write_head><img id='kcaptcha_image' /></td>
    <td><input class='ed' type=input size=10 name=wr_key itemname="자동등록방지" required>&nbsp;&nbsp;왼쪽의 글자를 입력하세요.</td>
</tr>
<tr><td colspan=2 height=1 bgcolor=#e7e7e7></td></tr>
<? } ?>

</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="100%" align="center" valign="top" style="padding-top:30px;">
        <input type=image id="btn_submit" src="<?=$board_skin_path?>/img/btn_write.gif" border=0 accesskey='s'>&nbsp;
        <a href="./board.php?bo_table=<?=$bo_table?>"><img id="btn_list" src="<?=$board_skin_path?>/img/btn_list.gif" border=0></a></td>
</tr>
</table>

</td></tr></table>
*/ ?>




</form>

<script type="text/javascript" src="<?="$g4[path]/js/jquery.kcaptcha.js"?>"></script>
<script type="text/javascript">
<?
// 관리자라면 분류 선택에 '공지' 옵션을 추가함
if ($is_admin) 
{
    echo "
    if (typeof(document.fwrite.ca_name) != 'undefined')
    {
        document.fwrite.ca_name.options.length += 1;
        document.fwrite.ca_name.options[document.fwrite.ca_name.options.length-1].value = '공지';
        document.fwrite.ca_name.options[document.fwrite.ca_name.options.length-1].text = '공지';
    }";
} 
?>

with (document.fwrite) 
{
    if (typeof(wr_name) != "undefined")
        wr_name.focus();
    else if (typeof(wr_subject) != "undefined")
        wr_subject.focus();
    else if (typeof(wr_content) != "undefined")
        wr_content.focus();

    if (typeof(ca_name) != "undefined")
        if (w.value == "u")
            ca_name.value = "<?=$write[ca_name]?>";
}

function html_auto_br(obj) 
{
    if (obj.checked) {
        result = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
        if (result)
            obj.value = "html2";
        else
            obj.value = "html1";
    }
    else
        obj.value = "";
}

function fwrite_submit(f) 
{


    document.getElementById('btn_submit').disabled = true;
    document.getElementById('btn_list').disabled = true;

    <?
    if ($g4[https_url])
        echo "f.action = '$g4[https_url]/$g4[bbs]/write_update.php';";
    else
        echo "f.action = './write_update.php';";
    ?>
    
    return true;
}
</script>

<script type="text/javascript" src="<?="$g4[path]/js/board.js"?>"></script>
<script type="text/javascript"> window.onload=function() { drawFont(); } </script>
