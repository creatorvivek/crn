<style>
.ui-id-2{
  height: 20px;
} </style>
<div class="row">
            <!-- <div class="col-md-6">
              <div class="form-group">
                  <label for="exampleInputEmail1"></label>
                  <input class="form-control auto" placeholder="Search Item" id="search" onkeyup="search_item()">
                
                <ul class="ui-autocomplete ui-front ui-menu ui-widget ui-widget-content" id="ui-id-2"  style="display: none; top: 60px; left: 15px; width: 520px;">
                <li>No Item Found!</li>
                </ul>

              </div>
            </div> -->
             <div class="col-md-12">
            <div class="form-group form-float">
              <div class="form-line">
                <input type="text" class="form-control auto" placeholder="Search Item" id="search" onkeyup="search_item()" >
                <!-- <label class="form-label">Item Name</label> -->
                 <ul class="ui-autocomplete ui-front ui-menu ui-widget ui-widget-content" id="ui-id-2"  style="display: none; top: 60px; left: 15px; width: 520px;">
                <li>No Item Found!</li>
                </ul>
              </div>
            </div>
          </div>



        </div>
 <!-- <div class="col-sm-4">
          <h2>Tags as Badges</h2>
          <div id="treeview6" class="treeview"><ul class="list-group"><li class="list-group-item node-treeview6 node-selected" data-nodeid="0" style="color:#FFFFFF;background-color:#428bca;"><span class="icon expand-icon glyphicon glyphicon-stop"></span><span class="icon node-icon glyphicon glyphicon-user"></span>Parent 1<span class="badge">4</span></li><li class="list-group-item node-treeview6" data-nodeid="5" style="color:undefined;background-color:undefined;"><span class="icon glyphicon"></span><span class="icon node-icon glyphicon glyphicon-user"></span>Parent 2<span class="badge">0</span></li><li class="list-group-item node-treeview6" data-nodeid="6" style="color:undefined;background-color:undefined;"><span class="icon glyphicon"></span><span class="icon node-icon glyphicon glyphicon-user"></span>Parent 3<span class="badge">0</span></li><li class="list-group-item node-treeview6" data-nodeid="7" style="color:undefined;background-color:undefined;"><span class="icon glyphicon"></span><span class="icon node-icon glyphicon glyphicon-user"></span>Parent 4<span class="badge">0</span></li><li class="list-group-item node-treeview6" data-nodeid="8" style="color:undefined;background-color:undefined;"><span class="icon glyphicon"></span><span class="icon node-icon glyphicon glyphicon-user"></span>Parent 5<span class="badge">0</span></li></ul></div>
        </div> -->

  <!-- <script type="text/javascript" charset="utf8" src="<?= base_url() ?>assets/admin/dist/js/bootstrap-treeview.js"></script> -->
<script>
function search_item()
{
$( "#search" ).autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "<?= base_url() ?>item/search",
                dataType: "json",
                type: "POST",
                data: {
                   
                    search: $("#search").val()
                    
                },
                success: function(data){
                  //Start
                    if(data.status_no == 1){
                    $("#val_item").html();
                  // console.log(data);
                     var data = data.items;
                     $('#ui-id-2').css('display','none');
                    response( $.map( data, function( item ) {
                      console.log(item);
                        return {
                            id: item.id,
                            item_name: item.item_name,
                           
                        }
                    }));
                  }else{
                     $('.ui-menu-item').remove();
                     $('.addedLi').remove();
                     $("#ui-id-1").append($("<li class='addedLi'>").text(data.message));
                     var searchVal = $("#search").val();
                      if(searchVal.length > 0){
                        $("#ui-id-2").css('display','block');
                      }
                    else{
                      $("#ui-id-2").css('display','none');
                    }
                  }
                  //end

                 }
            })
        },

        select: function(event, ui) {
          console.log(ui);
          var e = ui.item;

          if(e.id) {
              if(!in_array(e.id, stack))
              {
                stack.push(e.id);
                var taxAmount = (e.price*e.tax_rate)/100;
                var new_row = '<tr id="rowid'+e.id+'">'+
                          '<td class="text-center">'+ e.value +'<input type="hidden" name="stock_id[]" value="'+e.stock_id+'"><input type="hidden" name="description[]" value="'+e.value+'"></td>'+
                          '<td><input class="form-control text-center no_units" min="0" data-id="'+e.id+'" type="text" id="qty_'+e.id+'" name="item_quantity[]" value="1"><input type="hidden" name="item_id[]" value="'+e.id+'"></td>'+
                          '<td class="text-center"><input min="0"  type="text" class="form-control text-center unitprice" name="unit_price[]" data-id = "'+e.id+'" id="rate_id_'+e.id+'" value="'+ e.price +'"></td>'+
                          
                          '<td class="text-center">'+ taxOptionList +'</td>'+
                          '<td class="text-center taxAmount">'+ taxAmount +'</td>'+

                          '<td class="text-center"><input type="text" class="form-control text-center discount" name="discount[]" data-input-id="'+e.id+'" id="discount_id_'+e.id+'" max="100" min="0"></td>'+
                          '<td><input class="form-control text-center amount" type="text" amount-id = "'+e.id+'" id="amount_'+e.id+'" value="'+e.price+'" name="item_price[]" readonly></td>'+
                          '<td class="text-center"><button id="'+e.id+'" class="btn btn-xs btn-danger delete_item"><i class="material-icons">delete</i></button></td>'+
                          '</tr>';

                $(new_row).insertAfter($('table tr.dynamicRows:last'));
                // Check item Quantity
                    $.ajax({
                      method: "POST",
                      url: SITE_URL+"/sales/check-item-qty",
                      data: { "stock_id": e.stock_id,"_token":token,loc_code:$('#loc').val() }
                    })
                      .done(function( data ) {
                        var data = jQuery.parseJSON(data);
                        if(data.status_no == 1){
                            $("#quantityMessage").html("{{ trans('message.invoice.item_insufficient_message') }}");
                            $("#rowid"+e.id).addClass("insufficient");
                            $('#btnSubmit').attr('disabled', 'disabled');
                        }
                      });      
                }  
                }   
                }
                });
                }     
</script>
