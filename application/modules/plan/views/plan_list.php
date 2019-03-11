<style type="text/css">
.bg-danger
{
	background-color: red;
}
</style>


<div class="card">
	<div class="card-header">
		<h3 class="card-title">Plan List</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">


		<!-- <div id="overlay">loading...</div> -->
		<table id="plan_table" class="table table-bordered table-hover">
			
			<thead>
				<tr>
					
					<th>Plan name</th>
					<th>Description</th>
					<th>Amount</th>
					<th>Validity</th>
					<th>(Upload | download) data limit</th>
					<!-- <th>Download data limit</th> -->
					<th>Total data limit</th>

					
					<th>(Upload/Download) Speed</th>
					<!-- <th>Download Speed</th> -->
					<th>Transfer Speed</th>
					<th>Time Limit</th>
					<!-- <th>Post Usage</th> -->
					
					
					<!-- <th>DATE</th> -->
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				
				<?php foreach($plan_lists as $row){ ?>
					<tr id="<?= $row['plan_id'] ?>">
						<td><?= $row['name']; ?></td>
						
						<td><?= $row['description']; ?></td>
						
						
						<td><?= $row['amount']; ?></td>
						<!-- for conversion of second in user friendly format -->
						<?php switch($row['validity_type'])
						{
							case 1:
							$row['validity']=$row['validity']/86400 .' &nbsp days';
							break;
							case 2:
							$row['validity']=$row['validity']/604800 .'&nbsp week';
							break;
							case 3:
							$row['validity']=$row['validity']/2592000 .'&nbsp month';
							break;
							$row['validity']=$row['validity']/31536000 .'&nbsp year';
						} ?>	

						<td><?= $row['validity']; ?></td>
						<!-- for speed -->
						<?php switch($row['speed_unit'])
						{
							case 1:
							@$row['transfer_speed']=$row['transfer_speed'] .'&nbsp kb/s';
							@$row['download_speed']=$row['download_speed'] .'&nbsp kb/s';
							@$row['upload_speed']=$row['upload_speed'] .'&nbsp kb/s';
							break;
							case 2:
							@$row['transfer_speed']=$row['transfer_speed']/1024 .'&nbsp Mb/s';
							@$row['download_speed']=$row['download_speed']/1024 .'&nbsp Mb/s';
							@$row['upload_speed']=$row['upload_speed']/1024 .'&nbsp Mb/s';
							break;
							case 3:
							@$row['transfer_speed']=$row['transfer_speed']/1048576 .'&nbsp Gb/s';
							@$row['download_speed']=$row['download_speed']/1048576 .'&nbsp Gb/s';
							@$row['upload_speed']=$row['upload_speed']/1048576 .'&nbsp Gb/s';
							break;
					// $row['transfer_speed']=$row['transfer_speed']/31536000 .'&nbsp year';
						} 
						?>
						









						
						

						<?php  switch($row['data_unit'])
						{
							case 1:
							@$row['data_transfer_limit']= $row['data_transfer_limit']*1024 ;
							@$row['upload_data_limit']= $row['upload_data_limit']*1024 ;
							@$row['download_data_limit']= $row['download_data_limit']*1024 ;
							$unit='&nbsp  Kb';
							break;
							case 2:
							@$row['data_transfer_limit']= $row['data_transfer_limit'] ;
							@$row['upload_data_limit']= $row['upload_data_limit'] ;
							@$row['download_data_limit']= $row['download_data_limit'] ;
							$unit='&nbsp  Mb';
							break;
							case 3:
							@$row['data_transfer_limit']= $row['data_transfer_limit']/1024 ;
							@$row['upload_data_limit']= $row['upload_data_limit']/1024 ;
							@$row['download_data_limit']= $row['download_data_limit']/1024 ;
							$unit='&nbsp  Gb';
							break;
					// $row['transfer_speed']=$row['transfer_speed']/31536000 .'&nbsp year';
						} ?>	
						<?php if($row['upload_data_limit']==0) { $row['upload_data_limit']=='unlimited' ;  }   ?>
						<td data-toggle="tooltip" title="0 means unlimited here"><?= $row['upload_data_limit']; ?> &nbsp/ <?= $row['download_data_limit']; ?></td> 
						
						
						<?php if($row['data_transfer_limit']==0) { $row['data_transfer_limit']='Unlimited';$unit=''; } ?>
						<td><?= $row['data_transfer_limit'].' '.$unit ;?></td>
						

						<td><?= $row['upload_speed']; ?> &nbsp/ <?= $row['download_speed']; ?></td>
						

						<td><?= $row['transfer_speed']; ?></td>
						<?php if($row['start_time'] ||  $row['end_time']) { ?>
							<td ><a href="<?= base_url() ?>("><?= $row['start_time']; ?> &nbsp/ <?= $row['end_time']; ?> </a></td>
						<?php } else { ?>
							<td>No Time limit</td> 
						<?php } ?>
						
						
						
						
						
						<!--  -->
						<td>
							<div class="btn-group" >
								<button type="button" class="btn btn-success " data-toggle="tooltip" data-placement="top" title="Edit"><a href="<?= base_url() ?>plan/edit/<?= $row['plan_id'] ?>" ><i class="fa fa-pencil"></i></a></button>
								<button type="button" class="btn btn-danger" onclick="delFunction(<?= $row['plan_id'] ?>);" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>
								<!-- <button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="View"><a href="#" id="<?= $row['id']?>" class="view_data"><i class="fa fa-eye"></i></a></button> -->
								
								
							</div>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<script>
	$(document).ready( function () {
		$('#plan_table').DataTable(
		{
			"processing": true
		});
	});
</script>
<script type="text/javascript">
	var url="<?= base_url();?>";
	function delFunction(id)
	{
		
		bootbox.confirm("Are you sure want to delete? ", function(result) {
			if(result)
			{	
				$('#'+id+'').closest('tr').addClass('bg-danger');
				
				$.ajax({
					type: "POST",
					url: "<?= base_url() ?>plan/delete_plan",
					data: {
						plan_id:id
					},

					success: function (data) {
						console.log(data);
						
						$('#'+id+'').fadeOut(100);
						// location.reload();


					},
					error:function()
					{
						console.log("error");
					}
				});
			}
			
		});
	}

</script>