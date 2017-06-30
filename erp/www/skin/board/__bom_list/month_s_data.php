<?
include("_common.php");
include("$g4[path]/head.sub.php");
if(!$member[mb_id]){ ?>
<script>alert("[알림]\n로그인 정보가 없거나 네트워크가 문제 있습니다.\n다시 로그인 하여 주십시오.");
</script><? exit;
}?>
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
<form id='search_month_data' name='search_month_data' method="get" target="_self">
<div style="margin-left:20px;">
	<div style=" font-size:14px; font-weight:bold; margin-top:20px; margin-bottom: 10px; "> [!] 조회할 기간을 입력하세요 </div>
	<input type='text' name=s_date value='<?=$_GET['s_date']?>' class='datex'  style="width:80ox;"> ~ <input type='text' name=e_date value='<?=$_GET['e_date']?>' class='datex' style="width:80ox;"> &nbsp;
	<input type='submit' value="조회"  style="border:1px solid #833333; background-color: #C06907; color:#FFF;" />
	
	<? if($_GET['s_date'] && $_GET['e_date']){
			$month_data = sql_fetch("SELECT sum(po_qty) as sum, count(wr_id) as cnt  FROM `g4_write_bom_list_po_ea` WHERE  `s_d_code` LIKE 'S17%' and  `s_d_date` BETWEEN '2017-06-01 00:00:00' AND '2017-06-30 14:38:05'  ORDER BY `wr_id`;");

			echo "<div style='margin-top:20px; font-size:14px; color:#000;'>위 기간 동안 입고된 품목 건수는 ".$month_data[cnt]."건이며, 총 수량은 ".$month_data[sum]."입니다 <BR><BR> ";
			echo "기준 시간  ".date("Y-m-d H:i:s")."\n";
			echo "</div>";
	 } ?>
</div>
</form>