$(document).ready(function () {
    $('.delete_prod').click(function (e) { 
        e.preventDefault();

        var prod_id = $(this).val();

        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to retrieve the data, else, your going to create another one!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    method: "POST",
                    url: "../code.php",
                    data: {
                        'product_id':prod_id,
                        'delete_prod':true
                    },
                    success: function (response) {  
                        if(response == 200)
                        {
                            swal("Success!", "Product Deleted Successfully!", "success");
                            $("#product_table").load("#product_table");

                        }else if(response == 500){
                            swal("Error!", "Something Went Wrong", "error");
                            
                        }                     
                    }
                });
            }
          });
        
    });
});







