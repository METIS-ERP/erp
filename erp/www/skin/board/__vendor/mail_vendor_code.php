<?
include_once("_common.php");
include_once("$g4[path]/head.sublite.php");

 // $log = "1";
 $vd_id = $_GET['vd_id'];



// vd_id가 있는지 여부 체크 ( 없으면 업데이트 할 수 없음 )
if($vd_id){

	// 이미 업데이트 한 내역이 있으면 alert창 
	$chk_update_mtc = sql_fetch(" SELECT * FROM g4_member where mb_id = '".$vd_id."' and mb_3 = 'vendor' ");
	if($chk_update_mtc[mb_2] != ""){
		?>
		<script>
			alert(" [!] 이미 등록된 납품서 코드가 있습니다!");
			window.close();
		</script>
		<?
		exit; 
	}

	$update_vd_codex = $_POST['update_vd_codex'];
	if($update_vd_codex == 'yes'){
		// 업데이트 처리해주는 부분
		$mtc_codex = $_POST['mtc_codex'];
		echo "vd_id = ".$vd_id."<BR>";
		echo "mtc_codex = ".$mtc_codex."<BR>";

		$mtc_codex= trim($mtc_codex);
		$mtc_codex = str_replace(" ","",$mtc_codex);
		
		if($vd_id && $mtc_codex){

			$update_sqlx = " UPDATE g4_member 
							 SET mb_2 = '".$mtc_codex."' WHERE mb_id = '".$vd_id."' ";
						
		
			if($log > 0){
				echo "UPDATE SQL =".$update_sqlx."<BR>";
			}else{
				sql_query($update_sqlx);
			}
		}
		
		if($_POST['vendor_idx']){
			// vendor_idx값이 제대로 넘어 왔을 경우, vendor name 과 크로스 체크 하여서 stock_no update 
			$mtc_codex2 = $mtc_codex."-XXX";
			$update_sqlx2 = " UPDATE g4_write_vendor  
							 SET stock_no = '".$mtc_codex2."' WHERE wr_id  = '".$_POST['vendor_idx']."' and ( wr_subject = '".$chk_update_mtc[mb_name]."' or wr_content = '".$chk_update_mtc[mb_name]."')  ";
						
		
			if($log > 0){
				echo "UPDATE SQL =".$update_sqlx2."<BR>";
			}else{
				sql_query($update_sqlx2);
			}
		}
		
		?>
		<script>

		alert(" 납품서 코드가 저장되었습니다. ");
		window.close();
		</script>
		<?
		exit; 
		
	}else{
		// 업데이트 내용을 입력 할 수 있는 fORM 
		?>
		<style>
		body {
			background: #e9e9e9; 
			color:#666666;
			font-family: 'RobotoDraft', 'Roboto', sans-serif;
			font-size: 14px;
			-webkit-font-smoothing: antialiased;
			-moz-osx-font-smoothing: grayscale;
		}
		</style>	
		<link rel="stylesheet" type="text/css" href="vendor_style.css">

		<script>
			function submit_func(){
				if(confimr("<?=$chk_update_mtc[mb_name]?>의 MTC 코드를 저장 하시겠습니까?")){
					document.getElementById('form_mtc').submit();
				}else{
					return false;
				}

			}
		</script>		
		<div class="pen-title" style="text-align: center;">
		  <h1>UPDATE VENDOR MTC CODE </h1>
		</div>
		<div class="container">
		  <div class="card"></div>
		  <div class="card">
			<h1 class="title"><?=$chk_update_mtc[mb_name]?></h1>
			 <div class="pen-title" style="text-align: center; margin-bottom: 10px;"><span><a href='#'>MTC 코드를</a> 입력해주세요 <i class='fa fa-code'></i> </span></div>
			 <form target=_self id='form_mtc' name='form_mtc' method="post">
			 <input type=hidden id='update_vd_codex' name='update_vd_codex' value='yes' />
			 <input type=hidden id='vendor_idx' name='vendor_idx' value='<?=$_GET['vendor_idx']?>'   />


			  <div class="input-container">
				<input type="text" id="mtc_codex"  name="mtc_codex"required="required"/>
				<label for="#mtc_codex">MTC CODE </label>       
				<div class="bar"></div>
			  </div>
			  <div class="button-container">
				<button onClick="submit_func();"><span>SAVE</span></button>
			  </div>
			  <div class="footer"><a href="#">&nbsp;</a></div>
			</form>
		  </div>
		</div>
	<?
	} 
	
}else{
	?>
	<script>
		alert(" 업체 정보를 불러 올 수 없습니다 \n\n 전산팀에 문의해주시기 바랍니다 \n\n [ #248 손승희 주임  ]");
	</script>
	<?
}
?>