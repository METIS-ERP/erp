<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

//--------------------------------------------------------------------------
// 가변 파일
$file_script = "";
$file_length = -1;
// 수정의 경우 파일업로드 필드가 가변적으로 늘어나야 하고 삭제 표시도 해주어야 합니다.
if ($mode == "new")
{
	for ($i=0; $i<$file[count]; $i++)
	{
		$row = sql_fetch(" select bf_file, bf_content from $g4[board_file_table] where bo_table = '$bo_table' and wr_id = '$wr_id' and bf_no = '$i' ");
		if ($row[bf_file])
		{
			$file_script .= "add_file(\"<input type='checkbox' name='bf_file_del[$i]' value='1'><a href='{$file[$i][href]}'>{$file[$i][source]}({$file[$i][size]})</a> 파일 삭제";
			if ($is_file_content)
				//$file_script .= "<br><input type='text' class=ed size=50 name='bf_content[$i]' value='{$row[bf_content]}' title='업로드 이미지 파일에 해당 되는 내용을 입력하세요.'>";
				// 첨부파일설명에서 ' 또는 " 입력되면 오류나는 부분 수정
				$file_script .= "<br><input type='text' class=ed size=50 name='bf_content[$i]' value='".addslashes(get_text($row[bf_content]))."' title='업로드 이미지 파일에 해당 되는 내용을 입력하세요.'>";
			$file_script .= "\");\n";
		}
		else
			$file_script .= "add_file('');\n";
	}
	$file_length = $file[count] - 1;
}

if ($file_length < 0)
{
	$file_script .= "add_file('');\n";
	$file_length = 0;
}
//--------------------------------------------------------------------------
?>	
			

<style>
.board_top { clear:both; }

.board_list { clear:both; width:100%; table-layout:fixed; margin:0px; }
.board_list th { font-weight:bold; font-size:12px; border-top:1px solid #CCC; } 
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



	<? include("../skin/board/__bom_list/list.head.php"); ?>
    <script>
    function resize_width(th_col, fix_width, org_width, on_off){
        //alert('th_AL');
        var list_col_width = th_col + "1";
        var th_pname_btn  = th_col + "_btn";
        var th_pname_btn2 = th_col + "_btn2";
    
        if(on_off == "fix"){
            document.getElementById(th_pname_btn).style.display = "none";
            document.getElementById(th_pname_btn2).style.display = "";
            document.getElementById(th_col).style.width = fix_width + "px";
            document.getElementById(list_col_width).style.width = fix_width + "px";
        }else{
            document.getElementById(th_pname_btn).style.display = "";
            document.getElementById(th_pname_btn2).style.display = "none";
            document.getElementById(th_col).style.width = org_width + "px";
            document.getElementById(list_col_width).style.width = org_width + "px";
        }
        return false;
    }
    </script>
    
    <?
    if($cs){
    //echo $_SERVER['REQUEST_URI'];
    $get_value = explode("php?",$_SERVER['REQUEST_URI']);
    $get_datas = explode("&",$get_value[1]);
    $url_get_data = "";
    $sst_and_sod = "";
    
    for($ic=0;$ic<count($get_datas);$ic++){
        //echo $get_datas[$ic]."<br/>";
        $tmp_data = explode("=",$get_datas[$ic]);
        if($tmp_data[1]){
            if($tmp_data[0] == "sstx" or $tmp_data[0] == "sodx"){
                if($sstx and $sodx){
                    $sst_and_sod = "&sst=".$sstx."&sod=".$sodx;
                }
            }else
            if($tmp_data[0] == "sst" or $tmp_data[0] == "sod" ){
            }else
            if($tmp_data[0] == "m_id" or $tmp_data[0] == "page" ){
            }else
            if($tmp_data[0] == "sst" or $tmp_data[0] == "sod"){
                
            }else{
                if($ic > 0) $url_get_data .= "&";
                    $url_get_data .= $get_datas[$ic];
            }
        }
        
    }
    $sort_link2 = $g4[path]."/bbs/board.php?bo_table=vendor&pjt=yes&cs=yes&m_id=22&panel_view=0&search_height=46";
    $url_get_data .= "&m_id=".$m_id."&page=".$page;
    //echo $sst_and_sod;
    $sort_link = $g4[path]."/bbs/board.php?".$url_get_data.$sst_and_sod;
    ?>
    <div style="width:100%; border:0px; margin:0px; padding:0px; margin-top:-5px;">
    <!-- 게시판 목록 시작 -->
    <table width="100%" align="center" cellpadding="0" cellspacing="0"><tr><td>
    
        <!-- 제목 -->
        <form name="fboardlist" method="post" enctype="multipart/form-data">
        <input type='hidden' name='bo_table' value='<?=$bo_table?>'>
        <input type='hidden' name='sfl'  value='<?=$sfl?>'>
        <input type='hidden' name='stx'  value='<?=$stx?>'>
        <input type='hidden' name='spt'  value='<?=$spt?>'>
        <input type='hidden' name='m_id'  value='<?=$m_id?>'>
        <input type='hidden' name='page' value='<?=$page?>'>
        <input type='hidden' name='sw'   value=''>
    
        <table cellspacing="0" cellpadding="0" class="board_list">
        <col width="18">
        <col width="26">
        <col width="80">
        <col width="120">
        <col width="60">
        
        <col width="102">
        <col width="150">
        <col width="100" >
        
        <col width="75">
        
        <col width="50">    
        <col width="120">
        <col width="100">
    
        <col width="230">
        
        <col width="50">    
        <col width="120">
        <col width="100">
        
        <col width="200">    
        <col width="100">    

        <col>
        
        <tr>
            <? $qstr2 .= "&m_id=".$m_id; ?>
            <th rowspan="2" style="border-top:1px solid #DDD; font-size:10px; letter-spacing:-1px;">Ban</th>
            <th rowspan="2" style="border-top:1px solid #DDD;">No</th>
            <th rowspan="2" <? if($sstx == "wr_1x"){ ?> style="background-color:#FFF4BB !important;"<? } ?>>분류<span style="font-size:12px; font-weight:bold; cursor:pointer;" onClick="document.location.href='<?=$sort_link?>&sstx=wr_1x&sodx=<? if($sodx == "desc"){ echo "asc"; }else{ echo "desc"; } ?>';">↕</span><? if($sst == "wr_1x"){ ?><img src="<?=$g4[path]?>/img/notdel.gif" style="float:right;border:0px; cursor:pointer;" onClick="document.location.href='<?=$sort_link2?>';"/><? } ?></th>
            
            <th rowspan="2" <? if($sstx == "wr_content"){ ?> style="background-color:#FFF4BB !important;"<? } ?>>협력사명<span style="font-size:12px; font-weight:bold; cursor:pointer;" onClick="document.location.href='<?=$sort_link?>&sstx=wr_content&sodx=<? if($sodx == "desc"){ echo "asc"; }else{ echo "desc"; } ?>';">↕</span><? if($sst == "wr_content"){ ?><img src="<?=$g4[path]?>/img/notdel.gif" style="float:right;border:0px; cursor:pointer;" onClick="document.location.href='<?=$sort_link2?>';"/><? } ?></th>


            <th rowspan="2">당사 직발주</th>



            <th colspan="3">인증 현황</th>
            <th rowspan="2">사업자 번호</th>
            <th colspan="3">대표자</th>
            <th rowspan="2">주소</th>
            <th colspan="3">담당자</th>
            <th rowspan="2">첨부</th>

            <th rowspan="2">비고</th>
            <th rowspan="2">&nbsp;</th>

        </tr>
        <tr>
            <th <? if($sstx == "cri_no"){ ?> style="background-color:#FFF4BB !important;"<? } ?>>인증 번호<span style="font-size:12px; font-weight:bold; cursor:pointer;" onClick="document.location.href='<?=$sort_link?>&sstx=cri_no&sodx=<? if($sodx == "desc"){ echo "asc"; }else{ echo "desc"; } ?>';">↕</span><? if($sst == "cri_no"){ ?><img src="<?=$g4[path]?>/img/notdel.gif" style="float:right;border:0px; cursor:pointer;" onClick="document.location.href='<?=$sort_link2?>';"/><? } ?></th>

            <th <? if($sstx == "cri_cate"){ ?> style="background-color:#FFF4BB !important;"<? } ?>>인증 업태<span style="font-size:12px; font-weight:bold; cursor:pointer;" onClick="document.location.href='<?=$sort_link?>&sstx=cri_cate&sodx=<? if($sodx == "desc"){ echo "asc"; }else{ echo "desc"; } ?>';">↕</span><? if($sst == "cri_cate"){ ?><img src="<?=$g4[path]?>/img/notdel.gif" style="float:right;border:0px; cursor:pointer;" onClick="document.location.href='<?=$sort_link2?>';"/><? } ?></th>
            
            <th <? if($sstx == "cri_type"){ ?> style="background-color:#FFF4BB !important;"<? } ?>>인증 설비<span style="font-size:12px; font-weight:bold; cursor:pointer;" onClick="document.location.href='<?=$sort_link?>&sstx=cri_type&sodx=<? if($sodx == "desc"){ echo "asc"; }else{ echo "desc"; } ?>';">↕</span><? if($sst == "cri_type"){ ?><img src="<?=$g4[path]?>/img/notdel.gif" style="float:right;border:0px; cursor:pointer;" onClick="document.location.href='<?=$sort_link2?>';"/><? } ?></th>

        
            <th >성명</th>
            <th >E-Mail</th>
            <th >연락처</th>
            
            <th >담당자</th>
            <th >E-Mail</th>
            <th >연락처</th>
        </tr>
    
        <? 
        $real_sum_2015 = 0;
        $real_sum_2016 = 0;
        $real_sum_2017 = 0;
        $num = 0;
        for ($i=0; $i<count($list); $i++) { 
            
            $real_sum_2015 = $real_sum_2015 + $list[$i][amount_2015];
            $real_sum_2016 = $real_sum_2016 + $list[$i][amount_2016];
            $real_sum_2017 = $real_sum_2017 + $list[$i][amount_2017];
			
			
			$update_date = $list[$i][wr_datetime];
            
            $bg = "1";
            if(!$list[$i][wr_1x]){
                $bg = "0";
            }
            
            if(!$mode){
                $bg = $i%2 ? 0 : 1;
            }
            $num = $num + 1;
            $chk_multi = explode("#",$list[$i][cri_no]);
            ?>
            <tr class="bg<?=$bg?>" height="25" onMouseOver="this.style.backgroundColor='#FFFF99';" onMouseOut="this.style.backgroundColor='';" > 
    
                <td bgcolor="#DEDEDE" align="center" style="white-space:nowrap;"><?
                    if($mode == "new" and ( $member[mb_id] == "hbhbwang" or $member[mb_id] == "ssh881108" ) ){
                        ?><input type="checkbox" name="fix_a_<?=$list[$i][wr_id]?>" value="1" style="border:2px solid #D30003; background-color:#FFA3A4;"
                        onChange="if(this.checked == true){ alert('[알림]\n체크하면 `<?=str_replace("(주)","㈜",strip_tags($list[$i][wr_content]))?>` 업체는\nERP에서 업체 검색 및 진행이 차단 되며,\n발주 진행이 불가능 하게 됩니다.'); }"><?
                    }else{
                        ?><? if($list[$i][wr_nogood]){ ?><? }else{ ?> <? } ?><?
                    } ?></td>
                
                <td class="num" <?=$bg_color?> title="Vendor ID : <?=$list[$i][wr_id]?>"><input style="position:absolute; display:none;" type=hidden name=chk_wr_id[] value="<?=$list[$i][wr_id]?>"><?=$num?></td>
               

                <td <?=$bg_color?> style="white-space:nowrap;" align="center"><?
                    if($mode == "new"){ ?>
                        <input type='text' name="fix_2_<?=$list[$i][wr_id]?>"  style="width:56px; height:18px; border:1px solid #D39D00; background-color:#FFF7D6; font-size:11px; font-family:Malgun Gothic; z-index:1;" value="<?=$list[$i][wr_1x]?>" />
                        
                    <? }else{ ?>
                        <?=$list[$i][wr_1x]?>
                    <? } ?>
                </td>
                
                             
                <td <?=$bg_color?> style="white-space:nowrap;"><div style="width:95%; white-space:nowrap; overflow:hidden; font-weight:bold; padding-left:3px;"><?=str_replace("(주)","㈜",strip_tags($list[$i][wr_content]))?></div></td>
                
  
                  <? /* 
                <td <?=$bg_color?> style="white-space:nowrap; padding-left:2px;" align="left"><?
                    if($mode == "new"){
                        $tmp_wr_last = "";
                        if($list[$i][wr_last]){
                            $tmp_wr_last = explode("#",$list[$i][wr_last]);
                        }
                        ?>
                        <input name="fix_0_<?=$list[$i][wr_id]?>[0]" style="width:95%; height:18px; margin-bottom:1px; border:1px solid #D39D00; background-color:#FFF7D6; font-size:11px; font-family:Malgun Gothic;" value="<?=$tmp_wr_last[0]?>"/><br/>
                        <input name="fix_0_<?=$list[$i][wr_id]?>[1]" style="width:95%; height:18px; margin-bottom:1px; border:1px solid #D39D00; background-color:#FFF7D6; font-size:11px; font-family:Malgun Gothic;" value="<?=$tmp_wr_last[1]?>"/><br/>
                        <input name="fix_0_<?=$list[$i][wr_id]?>[2]" style="width:95%; height:18px; margin-bottom:1px; border:1px solid #D39D00; background-color:#FFF7D6; font-size:11px; font-family:Malgun Gothic;" value="<?=$tmp_wr_last[2]?>"/><br/>
                        <input name="fix_0_<?=$list[$i][wr_id]?>[3]" style="width:95%; height:18px; margin-bottom:1px; border:1px solid #D39D00; background-color:#FFF7D6; font-size:11px; font-family:Malgun Gothic;" value="<?=$tmp_wr_last[3]?>"/>
                        <?
                    }else{
                        $tmp_wr_last = "";
                        if($list[$i][wr_last]){
                            $tmp_wr_last = explode("#",$list[$i][wr_last]);
                        }
                        $br=0;$br0="";$br1="";$br2="";$br3="";
                        if($tmp_wr_last[0]){ echo $tmp_wr_last[0]; $br=1;$br0="<br/>"; }
                        if($tmp_wr_last[1]){ if($br){ echo "<br/>"; } echo $tmp_wr_last[1]; $br=1; $br1="<br/>"; }
                        if($tmp_wr_last[2]){ if($br){ echo "<br/>"; } echo $tmp_wr_last[2]; $br=1; $br2="<br/>"; }
                        if($tmp_wr_last[3]){ if($br){ echo "<br/>"; } echo $tmp_wr_last[3]; $br=1; $br3="<br/>"; }
                    }?>
   				 */ ?>
                 
                <td <?=$bg_color?> align="center"><?
                    if($mode == "new"){ ?>
                        <select name="fix_6_<?=$list[$i][wr_id]?>"  style="width:46px; height:18px; border:1px solid #D39D00; background-color:#FFF7D6; font-size:11px; font-family:Malgun Gothic; z-index:1;">
                         <option value="NO">NO</option>
                         <option value="YES" <? if($list[$i][outwork] == "YES"){ ?> selected <? } ?> >YES</option>
                        </select><?
                    }else{
                        echo $list[$i][outwork];
                    }?></td>
                    

                <td <?=$bg_color?> style="white-space:nowrap; padding-left:2px;"><?
                    if($mode == "new"){
                        $tmp_cri_no = "";
                        if($list[$i][cri_no]){
                            $tmp_cri_no = explode("#",$list[$i][cri_no]);
                        }
                        ?>
                        <input name="fix_4_<?=$list[$i][wr_id]?>" style="width:95%; height:18px; margin-bottom:1px; border:1px solid #D39D00; background-color:#FFF7D6; font-size:11px; font-family:Malgun Gothic;" value="<?=$tmp_cri_no[0]?>"/>
                        <?
                    }else{
                        $tmp_cri_no = "";
                        if($list[$i][cri_no]){
                            $tmp_cri_no = explode("#",$list[$i][cri_no]);
                        }
                        $br=0;$br0="";$br1="";$br2="";$br3="";
                        if($tmp_cri_no[0]){ echo $tmp_cri_no[0]; $br=1;$br0="<br/>"; }
                        if($tmp_cri_no[1]){ if($br){ echo "<br/>"; } echo $tmp_cri_no[1]; $br=1; $br1="<br/>"; }
                        if($tmp_cri_no[2]){ if($br){ echo "<br/>"; } echo $tmp_cri_no[2]; $br=1; $br2="<br/>"; }
                        if($tmp_cri_no[3]){ if($br){ echo "<br/>"; } echo $tmp_cri_no[3]; $br=1; $br3="<br/>"; }
                    }?></td>
                
                                    

                
                
                
                <? if($mode == "new"){ ?>
                <td <?=$bg_color?>><?
                        $tmp_cri_cate = "";
                        if($list[$i][cri_cate]){
                            $tmp_cri_cate = explode("#",$list[$i][cri_cate]);
                        }
                         ?>
                           <input type='text' name="fix_5_<?=$list[$i][wr_id]?>[0]"  style="width:90%; height:22px; margin-bottom:1px; padding:0px 3px; border:1px solid #D39D00; background-color:#FFF7D6; font-size:11px; font-family:Malgun Gothic;" value='<?=$tmp_cri_cate[0]?>' >
						   
				<td <?=$bg_color?>  align="left" style="padding-left:3px;"><input type='text' name="fix_5_<?=$list[$i][wr_id]?>[1]"  style="width:90%; height:22px; margin-bottom:1px; padding:0px 3px; border:1px solid #D39D00; background-color:#FFF7D6; font-size:11px; font-family:Malgun Gothic;" value='<?=$tmp_cri_cate[1]?>' >
                    </td>		   
				<?
                        
                }else{ ?>
                    <td <?=$bg_color?>  align="left" style="padding-left:3px;"><?
                    $tmp_cri = explode("#",$list[$i][cri_cate]);
					echo $tmp_cri[0];
                    
                    ?>
                    </td>
                    <td <?=$bg_color?>  align="left" style="padding-left:3px;"><?
                    $tmp_cri = explode("#",$list[$i][cri_cate]);
					echo $tmp_cri[1];
                    ?>
                    </td><?
                } ?>
    

                <td <?=$bg_color?> style="white-space:nowrap; text-align:center;"><?
                    if($mode == "new"){
                        ?><input type="text" name="fix_1_<?=$list[$i][wr_id]?>" style="width:95%; height:16px; border:1px solid #D39D00; background-color:#FFF7D6; font-size:11px; font-family:Malgun Gothic;" value="<?=$list[$i][wr_link1]?>"><?
                    }else{ 
                        echo $list[$i][wr_link1];
                    }?></td>

                    
                <td <?=$bg_color?> align="center"><?
                    if($mode == "new"){
                        ?><input type="text" name="fix_12_<?=$list[$i][wr_id]?>" style="width:95%; height:16px; border:1px solid #D39D00; background-color:#FFF7D6; font-size:11px; font-family:Malgun Gothic;" value="<?=$list[$i][wr_5]?>"><?
                    }else{
                        ?><div style="width:95%; white-space:nowrap; overflow:hidden;"><?=$list[$i][wr_5]?></div><?
                    } ?></td>
                    
                <td <?=$bg_color?> align="left"><?
                    if($mode == "new"){
                        ?><input type="text" name="fix_13_<?=$list[$i][wr_id]?>"  style="width:95%; height:16px; border:1px solid #D39D00; background-color:#FFF7D6; font-size:11px; font-family:Malgun Gothic;" value="<?=$list[$i][wr_email]?>"><?
                    }else{
                        ?><div style="width:95%; white-space:nowrap; overflow:hidden;"><?=$list[$i][wr_email]?></div><?
                    } ?></td>
    
                <td <?=$bg_color?> align="left"><?
                    if($mode == "new"){
                        ?>TEL <BR /> <input type="text" name="fix_14_<?=$list[$i][wr_id]?>"  style="width:95%; height:16px; border:1px solid #D39D00; background-color:#FFF7D6; font-size:11px; font-family:Malgun Gothic;" value="<?=$list[$i][wr_3]?>">
                        FAX <BR /> <input type="text" name="fix_15_<?=$list[$i][wr_id]?>"  style="width:95%; height:16px; border:1px solid #D39D00; background-color:#FFF7D6; font-size:11px; font-family:Malgun Gothic;" value="<?=$list[$i][wr_4]?>">
                        <?
                    }else{
                        ?><div style="width:95%; white-space:nowrap; overflow:hidden;"><?=$list[$i][wr_3]?></div><?
                    } ?></td>
    
                 
                <td <?=$bg_color?>><?
                    if($mode == "new"){
                        ?><input type="text" name="fix_11_<?=$list[$i][wr_id]?>" style="width:95%; height:16px; border:1px solid #D39D00; background-color:#FFF7D6; font-size:11px; font-family:Malgun Gothic;" value="<?=$list[$i][wr_1]?>"><?
                    }else{
                        ?><div style="width:95%; white-space:nowrap; overflow:hidden;"><?=$list[$i][wr_1]?></div><?
                    } ?></td>
 
 
                 <td <?=$bg_color?>><?
                    if($mode == "new"){
                        ?><input type="text" name="fix_17_<?=$list[$i][wr_id]?>" style="width:95%; height:16px; border:1px solid #D39D00; background-color:#FFF7D6; font-size:11px; font-family:Malgun Gothic;" value="<?=$list[$i][stock_name]?>"><?
                    }else{
                        ?><div style="width:95%; white-space:nowrap; overflow:hidden;"><?=$list[$i][stock_name]?></div><?
                    } ?></td>
 
                  <td <?=$bg_color?>><?
                    if($mode == "new"){
                        ?><input type="text" name="fix_18_<?=$list[$i][wr_id]?>" style="width:95%; height:16px; border:1px solid #D39D00; background-color:#FFF7D6; font-size:11px; font-family:Malgun Gothic;" value="<?=$list[$i][stock_mail]?>"><?
                    }else{
                        ?><div style="width:95%; white-space:nowrap; overflow:hidden;"><?=$list[$i][stock_mail]?></div><?
                    } ?></td>
                    
                              <td <?=$bg_color?>><?
                    if($mode == "new"){
                        ?><input type="text" name="fix_19_<?=$list[$i][wr_id]?>" style="width:95%; height:16px; border:1px solid #D39D00; background-color:#FFF7D6; font-size:11px; font-family:Malgun Gothic;" value="<?=$list[$i][stock_tel]?>"><?
                    }else{
                        ?><div style="width:95%; white-space:nowrap; overflow:hidden;"><?=$list[$i][stock_tel]?></div><?
                    } ?></td>   
                <td <?=$bg_color?>>
                    
                    <? if($mode == "new") { ?>
                        <table cellpadding="0" cellspacing="0">
                         <tr><td width="90" style="border:0px; padding:0px;">&nbsp;&bull;&nbsp;사업자 등록증 : </td><?
                            $chk_file_upload = sql_fetch(" SELECT * FROM `g4_board_file` WHERE `bo_table` = '".$bo_table."' and `wr_id` = '".$list[$i][wr_id]."' and `bf_no` = '0' ");
                            if($chk_file_upload[bf_source]){ ?>
                                <td style="border:0px; padding:0px;">
                                    <a href="<?=$g4[path]?>/bbs/download.php?bo_table=<?=$bo_table?>&wr_id=<?=$list[$i][wr_id]?>&no=0"
         style="text-decoration:underline; color:#0064FF;"><img src="<?=$g4[path]?>/img/ico_chat3.gif" style="width:14px; height:14px; border:0px;"/><?=$chk_file_upload[bf_source]?></a>
                                    <span style="border:1px solid #960002; color:#FFFF99; background-color:#960002;"><input name="bf_file_del_<?=$list[$i][wr_id]?>_0" type="checkbox" value="Y"/>삭제</span></td><?
                            }else{
                                ?><td style="border:0px; padding:0px;"><input type="file" class="ed" name="bf_file_<?=$list[$i][wr_id]?>[0]" title="사업자 등록증"
                                style="width:95%; height:16px; border:1px solid #D39D00; background-color:#FFF7D6; font-size:11px; font-family:Malgun Gothic;"/></td><?
                            } ?>
                         </tr>
    
                         <tr><td width="90" style="border:0px; padding:0px;">&nbsp;&bull;&nbsp;법인 등록증 : </td><?
                            $chk_file_upload = sql_fetch(" SELECT * FROM `g4_board_file` WHERE `bo_table` = '".$bo_table."' and `wr_id` = '".$list[$i][wr_id]."' and `bf_no` = '1' ");
                            if($chk_file_upload[bf_source]){ ?>
                                <td style="border:0px; padding:0px;">
                                    <a href="<?=$g4[path]?>/bbs/download.php?bo_table=<?=$bo_table?>&wr_id=<?=$list[$i][wr_id]?>&no=0"
         style="text-decoration:underline; color:#0064FF;"><img src="<?=$g4[path]?>/img/ico_chat3.gif" style="width:14px; height:14px; border:0px;"/><?=$chk_file_upload[bf_source]?></a>
                                    <span style="border:1px solid #960002; color:#FFFF99; background-color:#960002;"><input name="bf_file_del_<?=$list[$i][wr_id]?>_1" type="checkbox" value="Y"/>삭제</span></td><?
                            }else{
                                ?><td style="border:0px; padding:0px;"><input type="file" class="ed" name="bf_file_<?=$list[$i][wr_id]?>[1]" title="사업자 등록증"
                                style="width:95%; height:16px; border:1px solid #D39D00; background-color:#FFF7D6; font-size:11px; font-family:Malgun Gothic;"/></td><?
                            } ?>
                         </tr>
    
                         <tr><td width="90" style="border:0px; padding:0px;">&nbsp;&bull;&nbsp;계약서/기타 #1 : </td><?
                            $chk_file_upload = sql_fetch(" SELECT * FROM `g4_board_file` WHERE `bo_table` = '".$bo_table."' and `wr_id` = '".$list[$i][wr_id]."' and `bf_no` = '2' ");
                            if($chk_file_upload[bf_source]){ ?>
                                <td style="border:0px; padding:0px;">
                                    <a href="<?=$g4[path]?>/bbs/download.php?bo_table=<?=$bo_table?>&wr_id=<?=$list[$i][wr_id]?>&no=0"
         style="text-decoration:underline; color:#0064FF;"><img src="<?=$g4[path]?>/img/ico_chat3.gif" style="width:14px; height:14px; border:0px;"/><?=$chk_file_upload[bf_source]?></a>
                                    <span style="border:1px solid #960002; color:#FFFF99; background-color:#960002;"><input name="bf_file_del_<?=$list[$i][wr_id]?>_2" type="checkbox" value="Y"/>삭제</span></td><?
                            }else{
                                ?><td style="border:0px; padding:0px;"><input type="file" class="ed" name="bf_file_<?=$list[$i][wr_id]?>[2]" title="사업자 등록증"
                                style="width:95%; height:16px; border:1px solid #D39D00; background-color:#FFF7D6; font-size:11px; font-family:Malgun Gothic;"/></td><?
                            } ?>
                         </tr>
    
                         <tr><td width="90" style="border:0px; padding:0px;">&nbsp;&bull;&nbsp;계약서/기타 #2 : </td><?
                            $chk_file_upload = sql_fetch(" SELECT * FROM `g4_board_file` WHERE `bo_table` = '".$bo_table."' and `wr_id` = '".$list[$i][wr_id]."' and `bf_no` = '3' ");
                            if($chk_file_upload[bf_source]){ ?>
                                <td style="border:0px; padding:0px;">
                                    <a href="<?=$g4[path]?>/bbs/download.php?bo_table=<?=$bo_table?>&wr_id=<?=$list[$i][wr_id]?>&no=0"
         style="text-decoration:underline; color:#0064FF;"><img src="<?=$g4[path]?>/img/ico_chat3.gif" style="width:14px; height:14px; border:0px;"/><?=$chk_file_upload[bf_source]?></a>
                                    <span style="border:1px solid #960002; color:#FFFF99; background-color:#960002;"><input name="bf_file_del_<?=$list[$i][wr_id]?>_3" type="checkbox" value="Y"/>삭제</span></td><?
                            }else{
                                ?><td style="border:0px; padding:0px;"><input type="file" class="ed" name="bf_file_<?=$list[$i][wr_id]?>[3]" title="사업자 등록증"
                                style="width:95%; height:16px; border:1px solid #D39D00; background-color:#FFF7D6; font-size:11px; font-family:Malgun Gothic;"/></td><?
                            } ?>
                         </tr>
    
                        </table>
                        <?
                    
                    }else{ 
                    
                        $chk_file_attach = sql_query(" SELECT * FROM `g4_board_file` WHERE `bo_table` = '".$bo_table."' and `wr_id` = '".$list[$i][wr_id]."' ");
                        for($iv=0;$filex=sql_fetch_array($chk_file_attach); $iv++){ ?>
                            <div style="font-size:11px; white-space:nowrap;">
                                <img src="<?=$g4[path]?>/img/ico_chat3.gif" style="width:14px; height:14px; border:0px;"/>
                                <a href="<?=$g4[path]?>/bbs/download.php?bo_table=<?=$bo_table?>&wr_id=<?=$filex[wr_id]?>&no=<?=$iv?>" style="text-decoration:underline; color:#0064FF;"><?=$filex[bf_source]?></a>
                            </div><?
                        }
                    
                    } ?>
                    
                </td>
                <td >  &nbsp;<? if($mode == "new"){ }else{ ?><span style="padding:2px; color:#CCC; cursor:pointer; background-color:#666;" onclick='document.location.href="<?=$g4[path]?>/bbs/board.php?bo_table=vendor&sca=&sfl=&stx=&spt=&sst=wr_num%2C+wr_reply&sod=&page=1&pjt=yes&cs=yes&ea=&viewx=&po_fix=&eco=&rq=&wr_name=&wr_recommand=&m_id=21&panel_view=0&won=&back=&checkout=&pr_list=&rfq=&po=&create=&mode=new&change=&listup=&bom=&upload=&chk_bom=&m_id=21&x=&xx=&wr_8x=&modex=&mrp=&list=Array&edoc=&edocxx=&adm=&status=&status2=&prx=&display=&real_confirm_date=&out_option=&m_idx=&m_idxx=&view=&cate=&make=&stock=&stockx=&status=&check_in=&check_out=&use_table=&s_d_code=&s_d_date=&s_d_mb_id=&po_code=&po_vendor=&po_mpjt=&po_ew=&po_pcode=&po_pinfo=&po_maker=&po_depart=&pr_upload=&stock_now=&pjt_wr_1=&pjt_wr_3=&pjt_wr_3s=&pjt_wr_3x=&pjt_wr_3y=&pjt_wr_4=&pjt_wr_7=&bom_dwg_saib=&bom_lock=&stock_in_no=&stock_out_no=&po_type_in=&po_type_out=&wr_passwordx=&AP=&mode=new&MN=&out=&outlist=&finish=&updated=&log=&add_part=&po_change_part=&add_part_p_no=&manufacture_mode=&change_part=&change_id=&m_cost=&ssq=yes&wr_is_comment=0&wr_content=<?=urldecode($list[$i][wr_content])?>&wr_1x=&wr_last=&wr_link1=&cri_no=&cri_cate=&outwork=&amountx=&search_height=110"' >수정</span> <? }?> &nbsp;</td>
   			  <td>&nbsp;</td>
            </td>
            <?
        } // end for ?>
    

    
    <?  /* 신규 등록 */ ?>
     <tr class="bg<?=$bg?>" onMouseOver="this.style.backgroundColor='#FFFF99';" onMouseOut="this.style.backgroundColor='';" > 
    
                <td bgcolor="#DEDEDE" align="center" style="white-space:nowrap;"></td>
                
                <td class="num" <?=$bg_color?> title="Vendor ID : <?=$list[$i][wr_id]?>"><?=($num+1)?></td>
               

                <td <?=$bg_color?> style="white-space:nowrap;" align="center"><input type='text' name="fix_2_new"  style="width:56px; height:18px; border:1px solid #D39D00; background-color:#FFF7D6; font-size:11px; font-family:Malgun Gothic; z-index:1;" value="" /></td>
                
                             
                <td <?=$bg_color?> style="white-space:nowrap;"><div style="width:95%; white-space:nowrap; overflow:hidden; font-weight:bold; padding-left:3px;"><input type='text' name="wr_content_new"  style="width:56px; height:18px; border:1px solid #D39D00; background-color:#FFF7D6; font-size:11px; font-family:Malgun Gothic; z-index:1;" value="" /></div></td>
                
                 
                <td <?=$bg_color?> align="center">
                         <select name="fix_6_new"  style="width:46px; height:18px; border:1px solid #D39D00; background-color:#FFF7D6; font-size:11px; font-family:Malgun Gothic; z-index:1;">
                         <option value="NO">NO</option>
                         <option value="YES">YES</option>
                        </select>
                    </td>
                    

                <td <?=$bg_color?> style="white-space:nowrap; padding-left:2px;"><input name="fix_4_new" style="width:95%; height:18px; margin-bottom:1px; border:1px solid #D39D00; background-color:#FFF7D6; font-size:11px; font-family:Malgun Gothic;" value=""/></td>
                
                                    

                
                
                
                <td <?=$bg_color?>>
                           <input type='text' name="fix_5_new[0]"  style="width:90%; height:22px; margin-bottom:1px; padding:0px 3px; border:1px solid #D39D00; background-color:#FFF7D6; font-size:11px; font-family:Malgun Gothic;" value='<?=$tmp_cri_cate[0]?>' >
						   
				<td <?=$bg_color?>  align="left" style="padding-left:3px;"><input type='text' name="fix_5_new[1]"  style="width:90%; height:22px; margin-bottom:1px; padding:0px 3px; border:1px solid #D39D00; background-color:#FFF7D6; font-size:11px; font-family:Malgun Gothic;" value='<?=$tmp_cri_cate[1]?>' >
                    </td>		   

    

                <td <?=$bg_color?> style="white-space:nowrap; text-align:center;"><input type="text" name="fix_1_new" style="width:95%; height:16px; border:1px solid #D39D00; background-color:#FFF7D6; font-size:11px; font-family:Malgun Gothic;" value="<?=$list[$i][wr_link1]?>"></td>

                    
                <td <?=$bg_color?> align="center">
                 <input type="text" name="fix_12_new" style="width:95%; height:16px; border:1px solid #D39D00; background-color:#FFF7D6; font-size:11px; font-family:Malgun Gothic;" value="<?=$list[$i][wr_5]?>"></td>
                    
                <td <?=$bg_color?> align="left"><input type="text" name="fix_13_new"  style="width:95%; height:16px; border:1px solid #D39D00; background-color:#FFF7D6; font-size:11px; font-family:Malgun Gothic;" value="<?=$list[$i][wr_email]?>"></td>
    
                <td <?=$bg_color?> align="left"><input type="text" name="fix_14_new"  style="width:95%; height:16px; border:1px solid #D39D00; background-color:#FFF7D6; font-size:11px; font-family:Malgun Gothic;" value="<?=$list[$i][wr_3]?>">
                        </td>
    
                 
                <td <?=$bg_color?>><input type="text" name="fix_11_new" style="width:95%; height:16px; border:1px solid #D39D00; background-color:#FFF7D6; font-size:11px; font-family:Malgun Gothic;" value="<?=$list[$i][wr_1]?>"></td>
 
 
                 <td <?=$bg_color?>><input type="text" name="fix_17_new" style="width:95%; height:16px; border:1px solid #D39D00; background-color:#FFF7D6; font-size:11px; font-family:Malgun Gothic;" value="<?=$list[$i][stock_name]?>"></td>
 
                  <td <?=$bg_color?>><input type="text" name="fix_18_new" style="width:95%; height:16px; border:1px solid #D39D00; background-color:#FFF7D6; font-size:11px; font-family:Malgun Gothic;" value="<?=$list[$i][stock_mail]?>"></td>
                    
                    <td <?=$bg_color?>><input type="text" name="fix_19_new" style="width:95%; height:16px; border:1px solid #D39D00; background-color:#FFF7D6; font-size:11px; font-family:Malgun Gothic;" value="<?=$list[$i][stock_tel]?>"></td>   
                    
                <td <?=$bg_color?>>&nbsp;</td>
                <td>&nbsp;<input type='image' src="<?=$g4[path]?>/img/btn_addx.gif" onclick="submit_func();" /> </td>
   			  <td>&nbsp;</td>
            </td>
    
    
        <? if (count($list) == 0) { echo "<tr><td colspan='19' height=100 align=center>거래처가 없거나 정보를 찾을 수 없습니다.</td></tr>"; } ?>
    
        </table>
        
    
        <?
        if($member[mb_id] == "hbhwang"){ ?>
    
        &nbsp;<br/>
        <table cellpadding="5" cellspacing="1" bgcolor="#CCCCCC" style="margin-top:10px; margin-left:10px;">
         <tr>
          <td bgcolor="#FFD992">[엑셀] 2015년 합계 </td>
          <td bgcolor="#FFD992">[ERP] 2015년 합계 </td>
          <td bgcolor="#FFD992">차액 </td>
    
          <td bgcolor="#F9FF9C">[엑셀] 2016년 합계 </td>
          <td bgcolor="#F9FF9C">[ERP] 2016년 합계 </td>
          <td bgcolor="#F9FF9C">차액 </td>
         </tr>
         <tr bgcolor="#FFFFFF">
          <td align="right" style="padding-right:5px;"><?=number_format($total_2015_amount[amount]);?></td>
          <td align="right" style="padding-right:5px;"><?=number_format($real_sum_2015);?></td>
          <td align="right" style="padding-right:5px;"><?=number_format($total_2015_amount[amount] - $real_sum_2015);?></td>
              
          <td align="right" style="padding-right:5px;"><?=number_format($total_2016_amount[amount]);?></td>
          <td align="right" style="padding-right:5px;"><?=number_format($real_sum_2016);?></td>
          <td align="right" style="padding-right:5px;"><?=number_format($total_2016_amount[amount] - $real_sum_2016);?></td>
         </tr>
         </table>
                
    
        
        <? } ?>
    
        <table width="100%" cellpadding="0" cellspacing="0" style="margin-top:5px;">
        <tr>
         <td width="25%" style="padding-left:5px;">
            <? if($mode == "new"){ ?>
            <img src="<?=$g4[path]?>/img/btn_accept.gif" style="cursor:pointer; border:0px;" onClick="update_list();"/>
            <? } ?>
    
            <? if ($list_href) { ?>
            <a href="<?=$list_href?>"><img src="<?=$board_skin_path?>/img/btn_list.gif" align="absmiddle" border='0'></a>
            <? } ?>
            <? if ($is_checkbox) { ?>
            <a href="javascript:select_delete();"><img src="<?=$board_skin_path?>/img/btn_select_delete.gif" align="absmiddle" border='0'></a>
            <a href="javascript:select_copy('copy');"><img src="<?=$board_skin_path?>/img/btn_select_copy.gif" align="absmiddle" border='0'></a>
            <a href="javascript:select_copy('move');"><img src="<?=$board_skin_path?>/img/btn_select_move.gif" align="absmiddle" border='0'></a>
            <? } ?>
         </td>
         <td width="50%">
            <!-- 페이지 -->
            <div class="board_page">
                <? if ($prev_part_href) { echo "<a href='$prev_part_href'><img src='$board_skin_path/img/page_search_prev.gif' border='0' align=absmiddle title='이전검색'></a>"; } ?>
                <?
                // 기본으로 넘어오는 페이지를 아래와 같이 변환하여 이미지로도 출력할 수 있습니다.
                //echo $write_pages;
                $write_pages = str_replace("처음", "<img src='$board_skin_path/img/page_begin.gif' border='0' align='absmiddle' title='처음'>", $write_pages);
                $write_pages = str_replace("이전", "<img src='$board_skin_path/img/page_prev.gif' border='0' align='absmiddle' title='이전'>", $write_pages);
                $write_pages = str_replace("다음", "<img src='$board_skin_path/img/page_next.gif' border='0' align='absmiddle' title='다음'>", $write_pages);
                $write_pages = str_replace("맨끝", "<img src='$board_skin_path/img/page_end.gif' border='0' align='absmiddle' title='맨끝'>", $write_pages);
                $write_pages = preg_replace("/<span>([0-9]*)<\/span>/", "<span style=\"color:#AAA; padding-left:5px; font-weight:bold; padding-right:5px; font-size:20px;\">$1</span>", $write_pages);
                $write_pages = preg_replace("/<b>([0-9]*)<\/b>/", "<span style=\"color:#4D6185; font-size:20px; background-color:#FFFF99; padding-left:5px; font-weight:bold; padding-right:5px; text-decoration:underline;\">$1</span>", $write_pages);
                ?>
                <?=$write_pages?>
                <? if ($next_part_href) { echo "<a href='$next_part_href'><img src='$board_skin_path/img/page_search_next.gif' border='0' align=absmiddle title='다음검색'></a>"; } ?>
            </div>
         </td> 
         <td width="25%">    
            <img src="<?=$g4[path]?>/img/btn_b_new.gif" style="cursor:pointer; border:0px; display:none;" onClick="show_new();"/>
            <? /* if ($write_href) { ?><a href="<?=$write_href?>"><img src="<?=$board_skin_path?>/img/btn_write.gif" border='0'></a><? } */ ?>
         </td>
        </tr>
        </table>
        
        <div style="display:none; visibility:hidden;">
            <form name="fsearch" method="get">
            <input type="hidden" name="bo_table" value="<?=$bo_table?>">
            <input type="hidden" name="sca"      value="<?=$sca?>">
            <select name="sfl">
                <option value="wr_subject">제목</option>
                <option value="wr_content">내용</option>
                <option value="wr_subject||wr_content">제목+내용</option>
                <option value="mb_id,1">회원아이디</option>
                <option value="mb_id,0">회원아이디(코)</option>
                <option value="wr_name,1">글쓴이</option>
                <option value="wr_name,0">글쓴이(코)</option>
            </select>
            <input name="stx" class="stx" maxlength="15" itemname="검색어" required value='<?=stripslashes($stx)?>'>
            <input type="image" src="<?=$board_skin_path?>/img/btn_search.gif" border='0' align="absmiddle">
            <input type="radio" name="sop" value="and">and
            <input type="radio" name="sop" value="or">or
            </form>
        </div>
    
    </td></tr></table>
     <script>
	 document.getElementById('ssq_update_date').innerHTML = "최종 업데이트일 : <?=$update_date?>";
	 </script>    
    </div>
    <script type="text/javascript">
	
	function submit_func(){
	
		 var f = document.fboardlist;
    
        if (!confirm("신규 SSQ 업체를 등록하시겠습니까?"))
            return;
            
        f.action = "<?=$board_skin_path?>/view_update.php";
        <?
        if($member[mb_id] == "hbhwangx" or $member[mb_id] == "ssh881108"){ ?>
        f.target = 'blank';
        <? }else{ ?>
        f.target = 'hiddenx';
        <? } ?>
        f.submit();
	}
	
	
    function update_list(){
        var f = document.fboardlist;
    
        if (!confirm("현재 조회한 정보를 모두 저장 하시겠습니까?"))
            return;
            
        f.action = "<?=$board_skin_path?>/view_update.php";
        <?
        if($member[mb_id] == "hbhwangx" or $member[mb_id] == "ssh881108"){ ?>
        f.target = 'blank';
        <? }else{ ?>
        f.target = 'hiddenx';
        <? } ?>
        f.submit();
    }
    
    
    if ('<?=$sca?>') document.fcategory.sca.value = '<?=$sca?>';
    if ('<?=$stx?>') {
        document.fsearch.sfl.value = '<?=$sfl?>';
    
        if ('<?=$sop?>' == 'and') 
            document.fsearch.sop[0].checked = true;
    
        if ('<?=$sop?>' == 'or')
            document.fsearch.sop[1].checked = true;
    } else {
        document.fsearch.sop[0].checked = true;
    }
    </script>
    
    <? if ($is_checkbox) { ?>
    <script type="text/javascript">
    function all_checked(sw) {
        var f = document.fboardlist;
    
        for (var i=0; i<f.length; i++) {
            if (f.elements[i].name == "chk_wr_id[]")
                f.elements[i].checked = sw;
        }
    }
    
    function check_confirm(str) {
        var f = document.fboardlist;
        var chk_count = 0;
    
        for (var i=0; i<f.length; i++) {
            if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
                chk_count++;
        }
    
        if (!chk_count) {
            alert(str + "할 게시물을 하나 이상 선택하세요.");
            return false;
        }
        return true;
    }
    
    // 선택한 게시물 삭제
    function select_delete() {
        var f = document.fboardlist;
    
        str = "삭제";
        if (!check_confirm(str))
            return;
    
        if (!confirm("선택한 게시물을 정말 "+str+" 하시겠습니까?\n\n한번 "+str+"한 자료는 복구할 수 없습니다"))
            return;
    
        f.action = "./delete_all.php";
        f.submit();
    }
    
    // 선택한 게시물 복사 및 이동
    function select_copy(sw) {
        var f = document.fboardlist;
    
        if (sw == "copy")
            str = "복사";
        else
            str = "이동";
                           
        if (!check_confirm(str))
            return;
    
        var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");
    
        f.sw.value = sw;
        f.target = "move";
        f.action = "./move.php";
        f.submit();
    }
    </script>
    <? } ?>
    <!-- 게시판 목록 끝 -->
    <?
    }
    ?>
    <iframe name="hiddenx" id="hiddenx" width="0" height="0" scrolling="no" frameborder="0" style="display:none; visibility:hidden;"></iframe>
    <? exit; ?>
