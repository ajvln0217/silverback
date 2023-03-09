$(document).ready(function () {
    $('.cancel_order').click(function (e) { 
        e.preventDefault();

        var tracking_no = $(this).val();

        swal({
            title: "Are you sure?",
            text: "Once cancelled there's no turning back",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    method: "POST",
                    url: "../functions/status.php",
                    data: {
                        'track_no':tracking_no,
                        'cancel_order':true
                    },
                    success: function (response) {  
                        if(response == 200)
                        {
                            window.location.href = "./myorder.php";
                        }else if(response == 500){
                            swal("Error!", "Something Went Wrong", "error");
                            
                        }                     
                    }
                });
            }
          });
        
    });
});