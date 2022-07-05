<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
<title>CRUD APP using PHP OOP PDO MySQL and Ajax</title>
		
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		
</head>

	<body>
	
	<nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="">Sithub</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="">Hello EveryOne</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
	
	<div class="wrapper">
	<div class="container">
		<div class="col-lg-12">
		  
			<center><h2>Add Record</h2></center>
			
			<form id="insert_form" method="post" class="form-horizontal">
					
				<div class="form-group">
				<label class="col-sm-3 control-label">Firstname</label>
				<div class="col-sm-6">
				<input type="text" class="form-control" id="txt_firstname" placeholder="enter firstname" />
				</div>
				</div>
				
				<div class="form-group">
				<label class="col-sm-3 control-label">Lastname</label>
				<div class="col-sm-6">
				<input type="text" class="form-control" id="txt_lastname" placeholder="enter lastname" />
				</div>
				</div>
				
				<div class="form-group">
				<div class="col-sm-offset-3 col-sm-6 m-t-15">
				<button type="submit" id="btn_create" class="btn btn-success">Insert</button>
				</div>
				</div>
			
			</form>
			
			<br />
			
			<div class="col-lg-12">
				<div id="message"></div>
				<div id="fetch"></div>
			</div>
			
		</div>
	</div>	
	</div>
	
	<!-- Update Modal Start-->
	
	<div class="modal fade" id="updateModal">
	  <div class="modal-dialog">
		<div class="modal-content">

		  <!-- Modal Header -->
		  <div class="modal-header">
			<h4 class="modal-title">Update Record</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
		  </div>

		  <!-- Modal body -->
		  <div class="modal-body">
			<div id="update_data"></div>
		  </div>

		  <!-- Modal footer -->
		  <div class="modal-footer">
			<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			<button type="button" id="btn_update" class="btn btn-primary">Update</button>
		  </div>

		</div>
	  </div>
	</div>
	
	<!-- Update Modal End-->
	
	<script src="js/jquery-1.12.4-jquery.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	
	<script>
	
		//Create New Record
		
		$(document).on('click','#btn_create',function(e){
			
			e.preventDefault();
			
			var firstname = $('#txt_firstname').val();
			var lastname = $('#txt_lastname').val();
			var create = $('#btn_create').val();
			
			$.ajax({
				url: 'create.php',
				type: 'post',
				data: 
					{studentfirstname:firstname, 
					 studentlastname:lastname, 
					 insertbutton:create
					},
				success: function(response){
					fetch();
					$('#message').html(response);
				}
			});
			
			$('#insert_form')[0].reset();
			
		});
		
		//Fetch All Records
		
		function fetch(){
			
			$.ajax({
				url: 'read.php',
				type: 'post',
				success: function(response){
					$('#fetch').html(response);
				}
			});
		}
		
		fetch();
		
		//Delete Record
		
		$(document).on('click','#delete',function(e){
			
			e.preventDefault();
			
			if(window.confirm('are you sure to delete data'))
			{
				var delete_id = $(this).attr('value'); 
			
				$.ajax({
					url: 'delete.php',
					type: 'post',
					data:{studentdelete_id:delete_id},
					success: function(response){
						fetch();
						$('#message').html(response);
					}
				});				
			}
			else
			{
				return false;
			}
		});
		
		//Get Specific Id record or Edit Record 
		
		$(document).on('click','#edit', function(e){
			
			e.preventDefault();
			
			var update_id = $(this).attr('value');
			
			$.ajax({
				url: 'edit.php',
				type: 'post',
				data: {studentupdate_id:update_id},
				success: function(response){
					$('#update_data').html(response);
				}
			});
			
		});
		
		//Update Record
		
		$(document).on('click','#btn_update',function(e){
			
			e.preventDefault();
			
			var firstname = $('#edit_firstname').val();
			var lastname = $('#edit_lastname').val();
			var edit_id = $('#edit_id').val();
			var update_btn = $('#btn_update').val();
			
			$.ajax({
				url: 'update.php',
				type: 'post',
				data: 
					{update_firstname:firstname, 
					 update_lastname:lastname, 
					 update_id:edit_id,
					 update_button:update_btn
					},
				success: function(response){
					fetch();
					$('#message').html(response);
				}
			});
			
		});
		
	</script>
	
	</body>
</html>

