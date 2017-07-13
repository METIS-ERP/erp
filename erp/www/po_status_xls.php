<?
// 7-13 테스트 등록
include "_common.php";
header("Content-Type: text/html; charset=utf-8");

if($input){
	include $g4[path]."/head.subliteUTF.php";
	?><style>
	body { padding:0px; margin:0px; border:0px; font-size:12px; font-family:Malgun Gothic; color:#222; }
	</style>
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
    <!-- [S] Title -->
    <div style="position:relative; width:100%;">
    	<div style="width:100%; position:fixed; z-index:10; background:#2f0251  url(../img/top_bg_imgNG.gif) left top no-repeat; border-top:2px solid #000000; border-bottom:2px solid #BBB;">
         <div style='width:100%;  border-top:1px solid #111111; height:40px; border-bottom:2px solid #777;'>
            <table cellpadding="0" cellspacing="0">
            <tr>
             <td align="left" valign="bottom" height="34"><div style="padding-left:130px; z-index:1; padding-right:22px; font-size:24px; font-family: Apple SD Gothic Neo, Malgun Gothic, Dotum !important; color:#FFF;">PO / GR 리스트 선택 다운로드</div>
             </td>
             <td valign="bottom">
             </td>
            </tr>
            </table>
         </div>
    	</div>
    </div>
    
    <div style="width:98%; height:60px;"></div>
    
    <div id="inputx" style="width:98%; margin-left:1%; display:;">
    <form name="xls_option" method="post" enctype="multipart/form-data" action="<?=$g4[path]?>/po_status_xls.php" target="xls_download">
    <table cellpadding="0" cellspacing="0" style="width:600px; border-left:1px solid #CCC; border-top:1px solid #CCC;">
     <tr height="28">
      <td style="width:200px; background-color:#F2F2F2; text-align:center; font-weight:bold; font-size:14px; border-right:1px solid #CCC; border-bottom:1px solid #CCC; ">EW CODE</td>
      <td style="width:200px; background-color:#F2F2F2; text-align:center; font-weight:bold; font-size:14px; border-right:1px solid #CCC; border-bottom:1px solid #CCC; ">M-PJT</td>
      <td style="width:200px; background-color:#F2F2F2; text-align:center; font-weight:bold; font-size:14px; border-right:1px solid #CCC; border-bottom:1px solid #CCC; ">기타</td>
     </tr>
     <tr height="412">
      <td valign="top" style="text-align:center; font-weight:bold; padding-top:5px; font-size:14px; border-right:1px solid #CCC; border-bottom:1px solid #CCC; ">
      <textarea name="wr_option" style="width:190px; border:2px solid #980002; background-color:#FFFEF4; height:400px; overflow:auto; line-height:14px; font-family:Consolas, Malgun Gothic, 'Lucida Console', Monaco, monospace !important;"></textarea></td>
      <td valign="top" style="text-align:center; font-weight:bold; padding-top:5px; font-size:14px; border-right:1px solid #CCC; border-bottom:1px solid #CCC; ">
      <textarea name="wr_1" style="width:190px; border:2px solid #008C98; background-color:#F4FDFF; height:400px; overflow:auto; line-height:14px; font-family:Consolas, Malgun Gothic, 'Lucida Console', Monaco, monospace !important;"></textarea></td>
      <td valign="top" style="text-align:left; font-weight:bold; font-size:14px; border-right:1px solid #CCC; border-bottom:1px solid #CCC; ">
       &nbsp;&bull;&nbsp;입고 기간 (마감용) : <br/>
       <input type="text" name="gr_date_a" value="" class="datex" style="width:72px; margin-left:18px; text-align:center; border:1px solid #620000;"/> ~ <input type="text" name="gr_date_b" value="" class="datex" style="width:72px; text-align:center; border:1px solid #620000;"/>
       <br/>
       <div style="padding-left:18px;color:#BC0003; font-size:11px;">[!] EW CODE 항목과 무관하게 입고<br/>기간으로만 다운로드 됩니다.</div>
       <br/>

       &nbsp;&bull;&nbsp;발주 기간 (미입고 확인) : <br/>
       <input type="text" name="nogr_date_a" value="" class="datex" style="width:72px; margin-left:18px; text-align:center; border:1px solid #620000;"/> ~ <input type="text" name="nogr_date_b" value="" class="datex" style="width:72px; text-align:center; border:1px solid #620000;"/>
       <br/>
       <div style="padding-left:18px;color:#6500BC; font-size:11px;">
       <input type="checkbox" name="split_item" value="Y">분할 입고건 포함</div>
       <br/>
       <br/>
       <br/>
       <br/>


       
       </td>
     </tr>
     <tr height="50">
      <td colspan="3" align="center" style="border-bottom:1px solid #CCC; border-right:1px solid #CCC;">
       <input type="image" src="<?=$g4[path]?>/img/btn_down_xls2.gif" style="border:0px; cursor:0px;" onClick="document.getElementById('inputx').style.display='none';document.getElementById('loadingx').style.display='';"/>
      </td>
     </tr>
    </table>
    
    
    </form>
    </div>
    
    <div id="loadingx" style="width:98%; margin-left:1%; display:none; text-align:center;">
    <img src="<?=$g4[path]?>/img/page-loader.gif" style="border:0px;"/><br/>
    <a href="<?=$g4[path]?>/po_status_xls.php?input=y" target="_self" style="cursor:pointer; color:#0018AA">처음 화면으로 이동</a>
    </div>
    
    <iframe name="xls_download" id="xls_download" width="0" height="0" scrolling="no" frameborder="0" style="overflow:hidden; display:none; visibility:hidden; border:0px; width:0px; height:0px;"></iframe>
    
    
    
    
    
    
    <?
}else{
	
	$db_table = "g4_write_bom_list_po";
	$sql_queryx = "";
	$use_po_ea = "";
	
	if($wr_option){
		$xx = explode("\n",$wr_option);
		for($ix=0;$ix<count($xx);$ix++){
			if($sql_queryx){ $sql_queryx .= " or "; }
			$sql_queryx .= " `wr_option` = '".trim($xx[$ix])."' ";
		}
	}
	
	if($wr_1){
		$xx = explode("\n",$wr_1);
		for($ix=0;$ix<count($xx);$ix++){
			if($sql_queryx){ $sql_queryx .= " or "; }
			$sql_queryx .= " `wr_1` = '".trim($xx[$ix])."' ";
		}
	}
	
	if($gr_date_a and $gr_date_b){
		$db_table = "g4_write_bom_list_po_ea";
		$sql_queryx = " ( `s_d_date` between '".$gr_date_a." 00:00:00' and '".$gr_date_b." 23:59:59' ) and `s_d_code` like 'S1%' ";
		$use_po_ea = "Y";
	}


	if($nogr_date_a and $nogr_date_b){
		$db_table = "g4_write_bom_list_po";
		$sql_queryx = " ( `AM` between '".$nogr_date_a." 00:00:00' and '".$nogr_date_b." 23:59:59' ) and `wr_trackback` = '' and `AU` <> 'all_ok' ";
		if($split_item){
			$sql_queryx = " ( `AM` between '".$nogr_date_a." 00:00:00' and '".$nogr_date_b." 23:59:59' ) and `wr_trackback` like 'MT%' and `AU` = 'all_ok' ";
		}
	}


	if(!$sql_queryx){
		echo "입력한 데이터 값이 잘못되었습니다. 확인해 주시길 바랍니다.";
		exit;
	}

	if($gr_date_a and $gr_date_b){
	}else{
		$sql_queryx .= " and `BD` = '' ";
	}

	
include $g4[path].'/PHPExcel.php';
include $g4[path].'/PHPExcel/IOFactory.php';
$objPHPExcel = new PHPExcel();

$sqlx = " SELECT * FROM `".$db_table ."` WHERE ( {$sql_queryx} )  ";

$objWorkSheet = $objPHPExcel->createSheet(0); //Setting index when creating
$objWorkSheet->setTitle('설비_진행_현황_정보');

$result = sql_query($sqlx);
for($i=0;$rowc=sql_fetch_array($result);$i++){
	
	// Add new sheet
	//echo $row[wr_subject]."<br/>";
	$ix = $i + 1;
	$sub_total = 0;
	$sheet_title = "";
	if($i==0){
		$objWorkSheet->setCellValue('A1', 'ERP ID');
		$objWorkSheet->setCellValue('B1', 'No');
		$objWorkSheet->setCellValue('C1', 'EW CODE');
		$objWorkSheet->setCellValue('D1', 'UNIT');
		$objWorkSheet->setCellValue('E1', 'PO No');
		$objWorkSheet->setCellValue('F1', 'PR Manager');
		$objWorkSheet->setCellValue('G1', 'CIS Code');
		$objWorkSheet->setCellValue('H1', 'Part Code');
		$objWorkSheet->setCellValue('I1', 'Rev');
		$objWorkSheet->setCellValue('J1', 'Part Name');
		$objWorkSheet->setCellValue('K1', 'Spec');
		$objWorkSheet->setCellValue('L1', 'Spec2');
		$objWorkSheet->setCellValue('M1', 'Maker');
		$objWorkSheet->setCellValue('N1', 'PO Qty');
		$objWorkSheet->setCellValue('O1', 'Price');
		$objWorkSheet->setCellValue('P1', 'Amount');
		$objWorkSheet->setCellValue('Q1', 'Published');
		$objWorkSheet->setCellValue('R1', 'Vendor');
		$objWorkSheet->setCellValue('S1', 'Deli. Day');
		$objWorkSheet->setCellValue('T1', 'PO Status');
		
		$objWorkSheet->setCellValue('U1', 'GR Qty');
		if($use_po_ea){
		$objWorkSheet->setCellValue('V1', 'GR Amount');
		}else{
		$objWorkSheet->setCellValue('V1', 'Remain GR');
		}
		$objWorkSheet->setCellValue('W1', 'GR Date');
		$objWorkSheet->setCellValue('X1', 'Deli. No');
		$objWorkSheet->setCellValue('Y1', 'Complete GR');
		
		$objWorkSheet->getColumnDimension("A")->setWidth(0);
		$objWorkSheet->getColumnDimension("B")->setWidth(7);
		$objWorkSheet->getColumnDimension("C")->setWidth(17);
		$objWorkSheet->getColumnDimension("D")->setWidth(12);
		$objWorkSheet->getColumnDimension("E")->setWidth(15);
		$objWorkSheet->getColumnDimension("F")->setWidth(15);
		$objWorkSheet->getColumnDimension("G")->setWidth(14);
		$objWorkSheet->getColumnDimension("H")->setWidth(13);
		$objWorkSheet->getColumnDimension("I")->setWidth(6);
		$objWorkSheet->getColumnDimension("J")->setWidth(20);
		$objWorkSheet->getColumnDimension("K")->setWidth(15);
		$objWorkSheet->getColumnDimension("L")->setWidth(15);
		$objWorkSheet->getColumnDimension("M")->setWidth(11);
		$objWorkSheet->getColumnDimension("N")->setWidth(9);
		$objWorkSheet->getColumnDimension("O")->setWidth(11);
		$objWorkSheet->getColumnDimension("P")->setWidth(12);
		$objWorkSheet->getColumnDimension("Q")->setWidth(12);
		$objWorkSheet->getColumnDimension("R")->setWidth(15);
		$objWorkSheet->getColumnDimension("S")->setWidth(12);
		$objWorkSheet->getColumnDimension("T")->setWidth(11);
		$objWorkSheet->getColumnDimension("U")->setWidth(12);
		$objWorkSheet->getColumnDimension("V")->setWidth(11);
		$objWorkSheet->getColumnDimension("W")->setWidth(12);
		$objWorkSheet->getColumnDimension("X")->setWidth(14);
		$objWorkSheet->getColumnDimension("Y")->setWidth(18);
		
		$objWorkSheet->getStyle('A1')->applyFromArray(
			array(
				'fill' => array(
					'type' => PHPExcel_Style_Fill::FILL_SOLID,
					'color' => array('rgb' => 'C91886')
				)
			)
		);
	}
	
	
	if($use_po_ea){
		
		$objWorkSheet->setCellValue('A'.($i+2), iconv("euc-kr","utf-8",$rowc[wr_id]));
		$objWorkSheet->setCellValue('B'.($i+2), iconv("euc-kr","utf-8",($i+1)));
		$rowc_po = sql_fetch(" SELECT * FROM `g4_write_bom_list_po` WHERE `wr_id` = '".$rowc[po_id]."' ");
		$objWorkSheet->setCellValue('C'.($i+2), iconv("euc-kr","utf-8",$rowc_po[wr_option]));
		$objWorkSheet->setCellValue('D'.($i+2), iconv("euc-kr","utf-8",$rowc_po[wr_subject]));
		$objWorkSheet->setCellValue('E'.($i+2), iconv("euc-kr","utf-8",$rowc_po[wr_content]));
	
		#발주자 정보
		$mbx = ""; $mbx2 = "";
		$mbx = explode("|",iconv("euc-kr","utf-8",$rowc_po[wr_8]));
		$mbx2 = $mbx[0];
		$objWorkSheet->setCellValue('F'.($i+2), $mbx2);
		
		$amount_in = $rowc[po_qty] * $rowc_po[AD];
		
		$objWorkSheet->setCellValue('G'.($i+2), iconv("euc-kr","utf-8",$rowc_po[M]));
		$objWorkSheet->setCellValue('H'.($i+2), iconv("euc-kr","utf-8",$rowc_po[N]));
		$objWorkSheet->setCellValue('I'.($i+2), iconv("euc-kr","utf-8",$rowc_po[O]));
		$objWorkSheet->setCellValue('J'.($i+2), iconv("euc-kr","utf-8",$rowc_po[P]));	
		$objWorkSheet->setCellValue('K'.($i+2), iconv("euc-kr","utf-8",$rowc_po[Q]));	
		$objWorkSheet->setCellValue('L'.($i+2), iconv("euc-kr","utf-8",$rowc_po[U]));	
		$objWorkSheet->setCellValue('M'.($i+2), iconv("euc-kr","utf-8",$rowc_po[X]));	
		$objWorkSheet->setCellValue('N'.($i+2), iconv("euc-kr","utf-8",$rowc_po[AC]));	
		$objWorkSheet->setCellValue('O'.($i+2), iconv("euc-kr","utf-8",$rowc_po[AD]));	
		$objWorkSheet->setCellValue('P'.($i+2), iconv("euc-kr","utf-8",$rowc_po[AE]));	
		$objWorkSheet->setCellValue('Q'.($i+2), iconv("euc-kr","utf-8",substr($rowc_po[wr_last],0,10)));	
		$objWorkSheet->setCellValue('R'.($i+2), iconv("euc-kr","utf-8",$rowc_po[AI]));	
		$objWorkSheet->setCellValue('S'.($i+2), iconv("euc-kr","utf-8",$rowc_po[AG]));	
		$objWorkSheet->setCellValue('T'.($i+2), iconv("euc-kr","utf-8",$rowc_po[AL]));	
		$objWorkSheet->setCellValue('U'.($i+2), iconv("euc-kr","utf-8",$rowc[po_qty]));	
		$objWorkSheet->setCellValue('V'.($i+2), iconv("euc-kr","utf-8",$amount_in));	
		$objWorkSheet->setCellValue('W'.($i+2), iconv("euc-kr","utf-8",$rowc[s_d_date]));	
		$objWorkSheet->setCellValue('X'.($i+2), iconv("euc-kr","utf-8",$rowc[po_memo]));	
		$txtx = "입고";
		$objWorkSheet->setCellValue('Y'.($i+2), $txtx);	
		
		
		
		
		
		
	}else{
	
		#발주자 정보
		$mbx = ""; $mbx2 = "";
		$mbx = explode("|",iconv("euc-kr","utf-8",$rowc[wr_8]));
		$mbx2 = $mbx[0];

		$objWorkSheet->setCellValue('A'.($i+2), iconv("euc-kr","utf-8",$rowc[wr_id]));
		$objWorkSheet->setCellValue('B'.($i+2), iconv("euc-kr","utf-8",($i+1)));
		$objWorkSheet->setCellValue('C'.($i+2), iconv("euc-kr","utf-8",$rowc[wr_option]));
		$objWorkSheet->setCellValue('D'.($i+2), iconv("euc-kr","utf-8",$rowc[wr_subject]));
		$objWorkSheet->setCellValue('E'.($i+2), iconv("euc-kr","utf-8",$rowc[wr_content]));
		$objWorkSheet->setCellValue('F'.($i+2), $mbx2);
		$objWorkSheet->setCellValue('G'.($i+2), iconv("euc-kr","utf-8",$rowc[M]));
		$objWorkSheet->setCellValue('H'.($i+2), iconv("euc-kr","utf-8",$rowc[N]));
		$objWorkSheet->setCellValue('I'.($i+2), iconv("euc-kr","utf-8",$rowc[O]));
		$objWorkSheet->setCellValue('J'.($i+2), iconv("euc-kr","utf-8",$rowc[P]));	
		$objWorkSheet->setCellValue('K'.($i+2), iconv("euc-kr","utf-8",$rowc[Q]));	
		$objWorkSheet->setCellValue('L'.($i+2), iconv("euc-kr","utf-8",$rowc[U]));	
		$objWorkSheet->setCellValue('M'.($i+2), iconv("euc-kr","utf-8",$rowc[X]));	
		$objWorkSheet->setCellValue('N'.($i+2), iconv("euc-kr","utf-8",$rowc[AC]));	
		$objWorkSheet->setCellValue('O'.($i+2), iconv("euc-kr","utf-8",$rowc[AD]));	
		$objWorkSheet->setCellValue('P'.($i+2), iconv("euc-kr","utf-8",$rowc[AE]));	
		$objWorkSheet->setCellValue('Q'.($i+2), iconv("euc-kr","utf-8",substr($rowc[wr_last],0,10)));	
		$objWorkSheet->setCellValue('R'.($i+2), iconv("euc-kr","utf-8",$rowc[AI]));	
		$objWorkSheet->setCellValue('S'.($i+2), iconv("euc-kr","utf-8",$rowc[AG]));	
		$objWorkSheet->setCellValue('T'.($i+2), iconv("euc-kr","utf-8",$rowc[AL]));	
		
		#checkup-IN
		$in_qty = 0;
		$in_date = "";
		$invoce = "";
		$txtx = "";
	
		$sql_po_ea = sql_query(" SELECT * FROM `g4_write_bom_list_po_ea` WHERE `s_d_code` like 'S1%' and `po_code` = '".$rowc[wr_content]."' and `po_id` = '".$rowc[wr_id]."' ");
		for($iz=0;$rowz=sql_fetch_array($sql_po_ea);$iz++){
			$in_qty = $in_qty + $rowz[po_qty];
			$in_date = substr($rowz[s_d_date],0,10);
			if($invoce){ $invoce .= ","; }
			$invoce .= $rowz[po_memo];
		}
		
		if($rowc[wr_num] > 7){
			$objWorkSheet->setCellValue('U'.($i+2), iconv("euc-kr","utf-8",$rowc[AC]));	
			$objWorkSheet->setCellValue('V'.($i+2), '0');	
			$objWorkSheet->setCellValue('W'.($i+2), iconv("euc-kr","utf-8",$rowc[AW]));	
			$objWorkSheet->setCellValue('X'.($i+2), iconv("euc-kr","utf-8",$rowc[wr_trackback]));	
			if($rowc[wr_trackback]){
				$txtx = "입고 (4월 강제)";
			}
			
		}else
		if($in_qty > 0){
			$chk_all_in = $rowc[AC] - $in_qty;
			$objWorkSheet->setCellValue('U'.($i+2), iconv("euc-kr","utf-8",$in_qty));	
			$objWorkSheet->setCellValue('V'.($i+2), iconv("euc-kr","utf-8",$chk_all_in));	
			$objWorkSheet->setCellValue('W'.($i+2), iconv("euc-kr","utf-8",$in_date));	
			$objWorkSheet->setCellValue('X'.($i+2), iconv("euc-kr","utf-8",$invoce));	
			if($chk_all_in == 0 or $chk_all_in = ''){
				$txtx = "입고 완료";
			}else
			if($chk_all_in > 0 ){
				$txtx = "일부 입고";
			}
		}else{
			$objWorkSheet->setCellValue('U'.($i+2), '0');	
			$objWorkSheet->setCellValue('V'.($i+2), '0');	
			$objWorkSheet->setCellValue('W'.($i+2), '');	
			$objWorkSheet->setCellValue('X'.($i+2), '');	
			$txtx = "미입고";
		}
		if(iconv("euc-kr","utf-8",$rowc[BD]) == "NOUSE"){
			$txtx = "발주 취소";
		}
		$objWorkSheet->setCellValue('Y'.($i+2), $txtx);	
	}

}
$objPHPExcel->getActiveSheet()->freezePane('G2');



$dn_title = "PO_status_";
$file_name = "(".$part_info[cate1]."_".str_replace(" ","_",$part_info[cate2]).")__".$part_info[wr_subject]."__".$part_info[wr_content];
// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$dn_title.date("Y_m_d").'.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
}
exit; ?>