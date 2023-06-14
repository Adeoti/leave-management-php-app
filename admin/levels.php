<?php
session_start();
	if(!isset($_SESSION['adm_ref'])){
		header("Location: index.php");
		exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
		<title>Leave Manager - Admin Dashboard</title>
		<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="stylesheet" href="../boot/css/bootstrap.min.css" media="all"/>
			<link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css"/>
</head>

	

<body>
	<div class="container-fluid">
		<div class="row">
		<?php require("header.php"); ?>
				<?php require('myleft.php'); ?>
			<div class="modal fade leave_type">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h3 class="modal-title">Add new Conraiss</h3>
								<a href="javascript:void(0)" class="close" data-dismiss="modal">&times;</a>
						</div>
						<div class="modal-body">
							<form action="" method="post" autocomplete="no">
								<label for="name">Conraiss Name</label><br/>
									<input type="text" id="name" name="iname" required style="text-indent:10px; height:35px; border:1px solid #eee; border-radius:5px; width:100%;"/><br/><br/>
									
								<div style="float:right;"><br/><br/>
									<button name="add_dept" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> add</button>
								</div>
								<div style="clear:both;"></div>
							</form>
						</div>
					</div>
				</div>
			</div>
		
				
				<div class="col-sm-10 col-md-10">
					<div style="padding-top:20px;">
						<a href="javascript:void(null)" class="btn leave_type btn-sm btn-secondary " title="click to add leave type"><i class="fa fa-user-plus"></i> add new</a>
					
						<?php
							if(isset($_POST['add_dept'])){
								$name = htmlspecialchars(trim($_POST['iname']));
									$create = new Admin();
										$create -> addDeptLevel($name,"level");
							}
						
						?>
					</div>
					<hr/>
					
					
					
						<?php
							require('../config/config.php');
							$fetch_deparment = $con -> prepare("SELECT * FROM level ORDER BY name DESC");
							if($fetch_deparment -> execute()){
								if($fetch_deparment -> rowCount() > 0 ){
									echo '
											<table class="table table-light table-bordered">
												<tr>
													<th>SN</th>
													<th>Conraiss name</th>
													<th>Date created</th>
													<th><i class="fa fa-cog"></i> Action</th>
												</tr>
									'; $sn = 0;
									$fetch_deparment -> setFetchMode(PDO::FETCH_ASSOC);
										while($row = $fetch_deparment -> fetch()){
											
												$sn ++;
												$ref_level = $row['ref'];
												$name_level = $row['name'];
												$date_level = $row['date'];
													echo '<tr>
													
														<td>'.$sn.'</td>
														<td>Conraiss/<span contenteditable class="editable" data-ref="'.$ref_level.'">'.$name_level.'</span></td>
														<td>'.$date_level.'</td>
														<td>
															<a href="javascript:void(null)" class="btn btn-sm editbull btn-info"><i class="fa fa-pencil"></i> edit</a>
															<a href="trash.php?ref='.$ref_level.'&tab=level&path=levels" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> trash</a>
														</td>
													</tr>';
										}
										echo '</table>';
								} else{
										echo "No level added";
									}
							}else{
								Print "Something went wrong!";
								}
						?>
					
					
					
				</div>
			<?php require("footer.php"); ?>
			
	</div>
	</div>




<script src="../js/qwrs.js"></script>
	<script src="../boot/js/bootstrap.min.js"></script>
	<script>
		$(document).ready(function(){
			let oldCrew = "";
			$('.editbull').click(function(){
				$(this).parent('td').siblings('td').find('span.editable').focus();
				
				
			});
			$('.editable').focus(function(){
			$(this).css({
					backgroundColor:'#2e9fff',
					color:'#fff',
					fontWeight:'800'
			});
			oldCrew = $(this).text();
			});
			$('.editable').blur(function(){
			$(this).css({
					backgroundColor:'transparent',
					color:'inherit',
					fontWeight:'normal'
			});
			
				let newVal = $(this).text();
				let theRef = $(this).data('ref');
					$.get('savechanges.php',{agent:theRef, newinput:newVal, whereTo:'level',oldVal:oldCrew},function(data){
						if(data != ""){
							window.alert(data);
						}
					});
					
			
			});
			
			
			$('a.btn.leave_type').on('click', function(){
				$('div.modal.leave_type').modal("show");
			});
			
		});
	</script>
</body>
</html>