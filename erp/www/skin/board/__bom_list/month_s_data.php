<?
include("_common.php");
include("$g4[path]/head.sub.php");
if(!$member[mb_id]){ ?>
<script>alert("[�˸�]\n�α��� ������ ���ų� ��Ʈ��ũ�� ���� �ֽ��ϴ�.\n�ٽ� �α��� �Ͽ� �ֽʽÿ�.");
</script><? exit;
}?>
	<script>
    $(function() { 
        $(".datex").datepicker({
             showButtonPanel: true,
             currentText: '���� ��¥', 
             closeText: '�ݱ�', 
             dateFormat: 'yy-mm-dd',
             changeMonth: true,
             dayNames: ['�Ͽ���', '������', 'ȭ����', '������', '�����', '�ݿ���', '�����'],
             dayNamesMin: ['��', '��', 'ȭ', '��', '��', '��', '��'], 
             monthNamesShort: ['1','2','3','4','5','6','7','8','9','10','11','12'],
             monthNames: ['1��','2��','3��','4��','5��','6��','7��','8��','9��','10��','11��','12��']
      });
    });
    $(function() {
        $(".datex").datepicker({
        });
    });
    </script>		
<form id='search_month_data' name='search_month_data' method="get" target="_self">
<div style="margin-left:20px;">
	<div style=" font-size:14px; font-weight:bold; margin-top:20px; margin-bottom: 10px; "> [!] ��ȸ�� �Ⱓ�� �Է��ϼ��� </div>
	<input type='text' name=s_date value='<?=$_GET['s_date']?>' class='datex'  style="width:80ox;"> ~ <input type='text' name=e_date value='<?=$_GET['e_date']?>' class='datex' style="width:80ox;"> &nbsp;
	<input type='submit' value="��ȸ"  style="border:1px solid #833333; background-color: #C06907; color:#FFF;" />
	
	<? if($_GET['s_date'] && $_GET['e_date']){
			$month_data = sql_fetch("SELECT sum(po_qty) as sum, count(wr_id) as cnt  FROM `g4_write_bom_list_po_ea` WHERE  `s_d_code` LIKE 'S17%' and  `s_d_date` BETWEEN '2017-06-01 00:00:00' AND '2017-06-30 14:38:05'  ORDER BY `wr_id`;");

			echo "<div style='margin-top:20px; font-size:14px; color:#000;'>�� �Ⱓ ���� �԰�� ǰ�� �Ǽ��� ".$month_data[cnt]."���̸�, �� ������ ".$month_data[sum]."�Դϴ� <BR><BR> ";
			echo "���� �ð�  ".date("Y-m-d H:i:s")."\n";
			echo "</div>";
	 } ?>
</div>
</form>