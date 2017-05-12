$('.sub').on('change',function(){
if ($(this).is(':checked')){
  if($(this).parents('.disp-parent').find('.quant').val()){
      //if checkbox tick first
      var quantity=$(this).parents('.disp-parent').find('.quant').val();
      var status=$(this).parents('.disp-parent').find('.sub').val();
      var id=$(this).parents('.disp-parent').find('.sub').attr('id');
      var current=$(this).parents('.disp-parent').find('.price').val();

      var sum=current*quantity;
      var c = parseFloat(current)*parseInt(quantity);
      $(this).parents('.disp-parent').find('.total').html('<div>'+c+'</div>');

      formdata={
        id:id,
        current:current,
        status:status,
        quantity:quantity,
        c:c,
      };

        $.ajax({
          url: 'insert3.php',
          type: 'POST',
          data: formdata,
          cache:true,
          success:function(){
            // console.log(current);
          }
        });
profit();
 tax();

  }else{ //if quantity is added first
    $('.quant').on('change',function(){
    var quantity=$(this).parents('.disp-parent').find('.quant').val();
    var status=$(this).parents('.disp-parent').find('.sub').val();

    var id=$(this).parents('.disp-parent').find('.sub').attr('id');
    var current=$(this).parents('.disp-parent').find('.price').val();

    var sum=current*quantity;
    var c = parseFloat(current)*parseInt(quantity);
    $(this).parents('.disp-parent').find('.total').html('<div>'+c+'</div>');

    formdata={
      id:id,
      current:current,
      status:status,
      quantity:quantity,
      c:c,
    };

      $.ajax({
        url: 'insert3.php',
        type: 'POST',
        data: formdata,
        cache:true,
        success:function(){
          // console.log(current);
        }
      });
      profit();
       tax();
    })
  }

}else if (!$(this).is(':checked')){
//for delete on uncheck
  var status='false';
  var id=$(this).parents('.disp-parent').find('.sub').attr('id');
  $(this).parents('.disp-parent').find('.total').html('<div></div>');
  formdata={
    id:id,
    status:status,
  };

    $.ajax({
      url: 'insert3.php',
      type: 'POST',
      data: formdata,
      cache:true,
      success:function(){
        // console.log(current);
      }
});
profit();
 tax();
}

})





function profit(){
  if ($('.sub2').is(':checked')){
  var status2=$('.sub2').val();
  var id2=$('.sub2').attr('id');
  var current2=$('.sub2').parents('.disp-parent2').find('.price2').val();
  var percent2 = parseFloat(current2);
// $(this).parents('.disp-parent2').find('.total2').html('<div>'+c+'</div>')
formdata={
  id2:id2,
  status2:status2,
  percent2:percent2,
};

  $.ajax({
    url: 'profit.php',
    type: 'POST',
    data: formdata,
    cache:false,
    success:function(response) {
            $('.total2').html(response);
            // console.log(response.a);
            // alert(response.a);
            //location.reload();


        }
  });
}else if(!$('.sub2').is(':checked')){
  //for delete on uncheck
    var status2='false';
    var id2=$('.sub2').attr('id');
    $('.sub2').parents('.disp-parent2').find('.total2').html('<div></div>');
    formdata={
      id2:id2,
      status2:status2,
    };

      $.ajax({
        url: 'profit.php',
        type: 'POST',
        data: formdata,
        cache:true,
        success:function(){
          // console.log(current);
        }
  });
}
}

$('.sub2').on('change',function(){
profit();
 tax();
})





function tax_total(){
  var vat=20;
  var gst=50;
  var cst=15;

  var id3=$('.bootstrap-select').val();
  var status3='true';

  if(id3==1){
    $('.price3').val('0');
  }else if(id3==2){
    $('.price3').val(vat);
  }else if(id3==3){
    $('.price3').val(gst);
  }else if(id3==4){
    $('.price3').val(cst);
  }
    var value=$('.price3').val();
    // alert(id3);
  formdata={
  id3:id3,
  value:value,
  status3:status3,
  };

  $.ajax({
  type: 'post',
  url: 'tax.php',
  data: formdata,
  dataType: "JSON",
  success: function (row) {

   $('.price3').val(row.price);
   $('.total3').html(row.total_price);

  }
  });
}





function tax(){
  if ($('.sub3').is(':checked')){
    tax_total();
    $('.bootstrap-select').on('change',function(){
      tax_total();
    })

  }else if (!$('.sub3').is(':checked')){
    //for delete on uncheck
    var status3='false';
    $('.sub3').parents('.disp-parent3').find('.total3').html('<div></div>');
    formdata={
      status3:status3,
    };

      $.ajax({
        url: 'tax.php',
        type: 'POST',
        data: formdata,
        cache:true,
        success:function(){
          // console.log(current);
          location.reload()
        }
    });
  }
}



// callback function for tax
$('.sub3').on('change',function(){
 tax();
})
