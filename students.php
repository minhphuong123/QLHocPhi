<?php include('db_connect.php');?>
<style>
	input[type=checkbox]
{
  /* Double-sized Checkboxes */
  -ms-transform: scale(1.3); /* IE */
  -moz-transform: scale(1.3); /* FF */
  -webkit-transform: scale(1.3); /* Safari and Chrome */
  -o-transform: scale(1.3); /* Opera */
  transform: scale(1.3);
  padding: 10px;
  cursor:pointer;
}
</style>
<div class="container-fluid">
	
	<div class="col-lg-12">
		<div class="row mb-4 mt-4">
			<div class="col-md-12">
				
			</div>
		</div>
		<div class="row">
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<b>Danh sách sinh viên</b>
						<span class="float:right"><a class="btn btn-primary btn-block btn-sm col-sm-2 float-right" href="javascript:void(0)" id="new_student">
					<i class="fa fa-plus"></i> Thêm mới 
				</a></span>
					</div>
					<div class="card-body">
						<table class="table table-condensed table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="">Mã sinh viên</th>
									<th class="">Họ và tên</th>
									<th class="">Thông tin</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$i = 1;
								$student = $conn->query("SELECT * FROM student order by name asc ");
								while($row=$student->fetch_assoc()):
								?>
								<tr>
									<td class="text-center"><?php echo $i++ ?></td>
									<td>
										<p> <b><?php echo $row['id_no'] ?></b></p>
									</td>
									<td>
										<p> <b><?php echo ucwords($row['name']) ?></b></p>
									</td>
									<td class="">
										 <p><small>Email: <i><b><?php echo $row['email'] ?></i></small></p>
										 <p><small>Liên hệ #: <i><b><?php echo $row['contact'] ?></i></small></p>
										 <p><small>Địa chỉ: <i><b><?php echo $row['address'] ?></i></small></p>
									</td>
									<td class="text-center">
										<button class="btn btn-sm btn-outline-primary edit_student" type="button" data-id="<?php echo $row['id'] ?>" >Sửa</button>
										<button class="btn btn-sm btn-outline-danger delete_student" type="button" data-id="<?php echo $row['id'] ?>">Xóa</button>
									</td>
								</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- Table Panel -->
		</div>
	</div>	

</div>
<style>
	
	td{
		vertical-align: middle !important;
	}
	td p{
		margin: unset
	}
	img{
		max-width:100px;
		max-height: :150px;
	}
</style>
<script>
	$(document).ready(function(){
		$('table').dataTable()
	})
	$('#new_student').click(function(){
		uni_modal("Sinh viên mới","manage_student.php","mid-large")
		
	})
	$('.edit_student').click(function(){
		uni_modal("Quản lý chi tiết sinh viên","manage_student.php?id="+$(this).attr('data-id'),"mid-large")
		
	})
	$('.delete_student').click(function(){
		_conf("Bạn có chắc chắn xóa sinh viên này không?","delete_student",[$(this).attr('data-id')])
	})
	function delete_student($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_student',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Đã xóa dữ liệu thành công!",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>