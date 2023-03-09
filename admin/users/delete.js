$(document).ready(function () {
    $('.delete_user').click(function (e) { 
        e.preventDefault();

        var user_id = $(this).val();

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
                        'users_id':user_id,
                        'delete_user':true
                    },
                    success: function (response) {  
                        if(response == 200)
                        {
                            swal("Success!", "User Deleted Successfully!", "success");
                            $("#usersss").load(location.href + "#usersss");
                        }else if(response == 500){
                            swal("Error!", "Something Went Wrong", "error");
                            
                        }                     
                    }
                });
            }
          });
        
    });
});







