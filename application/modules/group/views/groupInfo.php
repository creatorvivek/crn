
<div class="row">
	<div class="col-md-5">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Group Information</h3>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<table class="table table-bordered table-hover">
					<?php	foreach($group as $row) 
					
					?>
					<tr>
						<th>Group Name </th>
						<td><?= $row['name'] ?></td>
					</tr>
					<tr>
						<th>Group Head </th>
						<td><?= $row['head_name'] ?></td>
					</tr>
					<tr>
						<th>Group Description </th>
						<td><?= $row['description'] ?></td>
					</tr>
					<tr>
						<th>Frenchizy detail </th>
						<td><?= $row['frenchizy_detail'] ?></td>
					</tr>
					<tr>
						<th>Related Bussiness </th>
						<td><?= $row['belong_business'] ?></td>
					</tr>
				</table>
			</div>
			<!-- /card body -->
		</div>
		<!-- /card -->
	</div>
	<!-- /col -->
	<div class="col-md-7">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Member Information</h3>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<?php	if(count($staff)==0)
				{
					echo "No Member In This group";
				}else {  ?>
					<table class="table table-bordered table-hover">
						<tr>
							<th>s no</th>
							<th>name</th>
							<th>mobile no</th>
							<th>action</th>	
						</tr>
						<?php $count=1 ?>
						<?php	

						for($i=0;$i<count($staff);$i++) {  ?>

							<tr>
								<td><?= $count ++ ?></td>
								<td><?= $staff[$i]['name'] ?></td>
								<td><?= $staff[$i]['mobile'] ?></td>
								<td><button type="button" class="btn btn-danger" onclick="delFunction(<?= $staff[$i]['id'] ?>);" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button></td>	
							</tr>
						<?php } }?>
					</table>

					<div class="form-group">
						<label>Add Member</label>
						<div class="col-md-12">
							<select class="form-control select2" multiple="multiple" data-placeholder="Select a member and group" id="member" name="member[]"
							style="width: 100%;">
							<?php for($i=0;$i<count($staff_list);$i++) {
								if($staff_list[$i]['id']!=$staff[$i]['id'])  {  ?>
									<option value="<?= $staff_list[$i]['id'] ?> "><?= $staff_list[$i]['name'] ?></option>
								<?php }} ?>
							</select>
						</div>
					</div>
					<div class="col-sm-offset-4 col-sm-5">
						<div class="form-group">
							<button type="submit" class="btn btn-success"  onclick="addMember();">ADD</button>
						</div>
					</div>
				</div>
				<!-- /card body -->
			</div>
		</div>
		<!-- /row -->	
		<script type="text/javascript">
			$(document).ready(function() {
    //Initialize Select2 Elements
    $('.select2').select2();

    //Datemask dd/mm/yyyy
    
});
</script>
<script type="text/javascript">
			function addMember()
			{
				var group_id="<?= $group[0]['group_id'] ?>";
				var member=$('#member').val();
				console.log(group_id);
				console.log(member);
				$.ajax({
					type: "POST",
					url: "<?= base_url() ?>group/mapGroupMember",
					data: {
						member:member,group_id:group_id
					},

					success: function (data) {
						console.log(data);
						location.reload();

					}
				});
			}
		function delFunction(id)
		{
			
			
			var group_id="<?= $group[0]['group_id'] ?>";
			bootbox.confirm("Are you sure want to delete ", function(result) {
				if(result)
				{	
					
				$.ajax({
					type: "POST",
					url: "<?= base_url() ?>group/deleteMember",
					data: {
						member_id:id,group_id:group_id
					},

					success: function (data) {
						console.log(data);
						location.reload();


					}
				});
				}
				
			});
		}
		</script>