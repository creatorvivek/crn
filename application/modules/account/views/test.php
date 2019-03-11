<!-- <br><br><br><br><br><br><br><br><br><br><br><img alt="testing" src="barcode.php?text=testing"  /> -->
<img src="<?= base_url() ?>/barcode.php?text=12312312">
  $.ajax({
        type: "GET",
        url: "<?= base_url() ?>home/line_graph_sell_purchase",

            success: function (data) {
            var obj=JSON.parse(data);
            console.log(obj);
            // var purchase_amount=[];
            // var month=[];
            // for(var i=0;i<obj.length;i++)
            // {
            //     month.push(obj[i].month);
            //     purchase_amount.push(obj[i].purchase_price);
            // }



            // console.log(month);
            // console.log(purchase_amount);