
$(document).ready(function () {
  
    $('.increment-btn').click(function (e) { 
        e.preventDefault();

        var qty = $(this).parent().find('.qty-input').val();
        var value = parseInt(qty);
        

        value = isNaN(value) ? 0 : value;


        if(value > 7){
            alert('Limit reached');
        }else{
            value++;
            $(this).parent().find('.qty-input').val(value);
        }
    });
    
    $('.decrement-btn').click(function (e) { 
        e.preventDefault();

        var qty = $(this).parent().find('.qty-input').val();

        var value = parseInt(qty);
        value = isNaN(value) ? 0 : value;
        
        if(value > 1){
            value--;
            $(this).parent().find('.qty-input').val(value);
        }
    });

    $('.addToCart').click(function (e) { 
        e.preventDefault();
        var qty = $(this).closest('.product_data').find('.qty-input').val();
        var prod_id = $(this).val();

        swal({
            title: "Item Added to your Cart",
            icon: "success",
            buttons: true,
          })
        $.ajax({
            method: "POST",
            url: "../functions/cart.php",
            data: {
                "prod_id": prod_id,
                "cart_qty": qty,
                "scope": "add",
            },
            success: function (response) {

                if(response == 201){
                   swal("Item Added to your Cart","Product successfully added to your cart","success");
                   $("#prods").load("#prods");
                }
                else if(response == "existed"){
                    swal("That item has already existed to your cart");
 
                 }
                else if(response == 401){
                    swal("Log-in First!","You need to register first before you purchase that item","warning");
                }
                else if(response == 500){
                    swal("Error!","Something went wrong","error");
                }
            }
        });
    });

    $(document).on('click','.updateqty', function () {
        var qty = $(this).closest('.product_data').find('.qty-input').val();
        var prodid = $(this).closest('.product_data').find('.prodid').val();

        $.ajax({
            method: "POST",
            url: "../functions/cart.php",
            data: {
                "prod_id": prodid,
                "cart_qty": qty,
                "scope": "update",
            },
            success: function (response) {
                if(response == 200){
                    //$("#usercart").load(location.href + "#usercart");
 
                } else if(response == 500){
                    swal("Error!","Something went wrong","error");
                }
            }
        });

    });
    
    $(document).on('click','.removeitem', function () {
        var c_id = $(this).val();
        $.ajax({
            method: "POST",
            url: "../functions/cart.php",
            data: {
                "c_id": c_id,
                "scope": "delete",
            },
            success: function (response) {
                if(response == 201){
                    swal("Item Removed!",{
                        buttons: false,
                        timer: 2000,
                    });
                    $('#usercart').load(location.href + "#usercart");
 
                } else if(response == 500){
                    swal("Error!","Something went wrong","error");
                }
            }
        });
    });
});