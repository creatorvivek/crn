<form action="<?= base_url() ?>test/form" method="post">
	
<!-- <select name="t">
	<option value="133,2,3">23423</option>
</select> -->
<!-- <input type="number" name="d" max=5>
<input type="submit" name="" value="s"> -->
 <select class="form-control show-tick" data-live-search="true">

  <?php 
  foreach ($item as $row ) {  ?>
    
                                        <optgroup label="<?= $row['item_name'] ?>">
                                           <?php 
                                           $this->db->select('*');
                                           $this->db->where('item_id',$row['id']);
                                          $result= $this->db->get('purchase_item')->result_array();
                                          
                                          for($i=0;$i<count($result);$i++)

                                          { ?>
                                       <option value="<?= $result[$i]['id'] ?>"><?= $result[$i]['item_company'] ?></option>
                                     <?php } ?>
                                        </optgroup>
                                        
  <?php } ?>
                                    </select>
</form>

<script type="text/javascript">

  $(document).ready(function(){  

  	test();
  });



	  function test()
  {	
  	var option=1
  $.ajax({
        type: "POST",
        data:{id:option},
         async:false,
        
        url: "<?= base_url() ?>home/line_graph_sell_purchase",

            success: function (data) {
                console.log(data);
            var obj=JSON.parse(data);
            console.log(obj);   
        },
    });







  }
</script>