<html>
<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<style>
  .form-group{
    line-height: 30px;
    margin: 10px;
  }
</style>
<div style="margin: 50px;height: 100px;"></div>
<div class="container">
  <form class="form" method="post" onsubmit="return savepayment();">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="amount">Pay Amount</label>
      <input type="text" class="form-control" id="amount" name="payed_amount" placeholder="Amount">
      <span id="error_amt" style="color: red;"></span>
    </div>
    <div class="form-group col-md-6">
      <label for="class">class</label>
      <select name="class" id="class" onChange="onclasschange(this);">
        <option value="">Choose...</option>
        <?php 
        $string_class =json_encode($class);
        foreach($class as $k=>$v){ ?>
          <option value="<?php echo $k; ?>"><?php echo $k; ?></option>
      <?php } ?>
      </select>
    </div>

    <div class="form-group col-md-6">
      <label for="class">Types</label>
      <div id="ftypes"></div>
    </div>



    <div class="form-group col-md-6">
      <label for="balance">balance</label>
      <input type="text" class="form-control" name="balance" id="balance" placeholder="balance">
    </div>
  </div>
  
  
  
  <button type="submit" class="btn btn-primary">Pay</button>
</form>
</div>
<script>
  function onclasschange(v){

    alert(v.value);
    var amt = $('#amount').val();
    var cls ='<?php echo $string_class;?>';
    if(amt){
      
   $('#error_amt').html('');
    var clsarr =JSON.parse(cls);
    balance = amt;
    var str = '<div class="row">';
    $.each(clsarr[v.value], function( index, value ) {
      alert( amt +" : "+index+ ": " + value["fee_amount"]);
      var feeamt = value["fee_amount"];
      alert((parseInt(amt) +'>'+parseInt(feeamt)));
      if(parseInt(amt) >= parseInt(feeamt)){
        alert(feeamt);
        var typval = value['fee_amount'];
        balance = amt-value['fee_amount'];
      }else{
        alert('else'+feeamt);
        var typval = balance;
      }
      str +='<div class="form-group col-md-6"><label for="class">'+value["fee_type"]+'</label><input name="'+value["id"]+'" value="'+typval+'" id="'+value["id"]+'" rel1="'+value["fee_amount"]+'" rel="'+value["fee_type"]+'" onblur="checkmax(this,'+value["fee_amount"]+');" class="calamt"><span id="span'+value["id"]+'" ></span></div>';
    });
    str +='</div>';
    $('#ftypes').html(str);
    $('#balance').val(balance);

    console.log(clsarr[v.value]);
    //alert(cls);
  }else{
    $('#error_amt').html('please fill the payed amount');
    alert('please fill the payed amount');
    $('#class').val('');
  }

  }
function checkmax(v,maxamt){

  //alert(v.id)
  if($('#'+v.id).val() > maxamt){
    $('#span'+v.id).html('max amount payable of  '+$('#'+v.id).attr('rel') +' is : '+ maxamt);
    return false;
  }
 

}

function savepayment(){

  
  $('.calamt').each(function(){
    //alert(this.id);
    var maxamt =$('#'+v.id).attr('rel1');
    checkmax(this,maxamt);
})
//return false;
}

</script>
</body>
</html>