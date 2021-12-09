<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sell Clothes</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Style -->

</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center"> Product list</h1>
        <!-- Add -->
        <button type="button" id="addNew" class="btb btn-success btn btn-borderless">Add clothes</button>
        <!-- The Modal -->
        <div class="modal fade" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title text-center">Add New Product</h4>
                        <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <!-- <div class="alert alert-success" style="display:none"></div> -->
                        <form id="myForm">
                            <input type="hidden" name="clothes" id="clothes_id">
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" id="name">
                            </div>
                            <div class="form-group">
                                <label for="picture">Picture:</label>
                                <input type="text" class="form-control" id="picture">
                            </div>
                            <div class="form-group">
                                <label for="price">Price:</label>
                                <input type="text" class="form-control" id="price">
                            </div>
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <input type="text" class="form-control" id="description">
                            </div>
                            <button class="btn btn-primary" id="submit">Submit</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Add -->
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Picture</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="bodyData">
                
            </tbody>
        </table>
    </div>
    <!-- form edit  -->
    <!-- The Modal -->
    <div class="modal fade" id="myEditModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title text-center">Update Product</h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <!-- <div class="alert alert-success" style="display:none"></div> -->
                    <form id="myForm">
                            <div class="form-group">
                                <input type="hidden" name="clothes" id="clothes_id" >
                            </div>
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" id="name" >
                            </div>
                            <div class="form-group">
                                <label for="picture">Picture:</label>
                                <input type="text" class="form-control" id="picture" >
                            </div>
                            <div class="form-group">
                                <label for="price">Price:</label>
                                <input type="text" class="form-control" id="price" >
                            </div>
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <input type="text" class="form-control" id="description" >
                            </div>
                            <button class="btn btn-primary" id="submit">Submit</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end form edit  -->

</body>
<script>
    var $clothes = {};
    $(document).ready(function() {
        $.ajax({
        url: "http://localhost:8000/api/clothes",
        type: 'get',
        // data: JSON.stringify(formData),
        beforeSend: function(xhr) {
            xhr.setRequestHeader("Accept", "application/json");
            xhr.setRequestHeader("Content-Type", "application/json");
            // xhr.setRequestHeader("Authorization", "Basic QVBJX1VTRVI6MTIzNDU2")
        },
        success: function(data) {
            $.each(data, function(item, el) {
                var htmls = `<tr>
                <td> + el.id +</td>`+ 
                <td> + el.name +</td> + 
                <td> + el.picture +</td>+
                <td> +"$"+ el.price +</td>+
                <td> + el.description +</td>+ '</tr>';
                $('#bodyData').append(htmls);
            })
        }
    })
    });

    ///add new
    $(document).ready(function() {
        $("#addNew").click(function() {
            $("#myModal").modal();
        });

        $("#edit_form").click(function() {
            $("#myEditModal").modal();
        });
        jQuery('#submit').click(function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
                jQuery.ajax({
                    url: "http://127.0.0.1:8000/api/add",
                    method: 'post',
                    data: {
                        name: jQuery('#name').val(),
                        picture: jQuery('#picture').val(),
                        price: jQuery('#price').val(),
                        description: jQuery('#description').val()
                    },
                    success: function(result) {
                        window.location.reload();
                    }
                });
        });
    });

    // update 
    function edit(id) {
        $.ajax({
            url: "http://127.0.0.1:8000/api/delete/" + id,
            method: 'put',
            data: id,
            dataType: 'json',

            beforeSend: function() {
                $("#createBtn").addClass("disabled");
                $("#createBtn").text("Processing..");
            },

            success: function(res) {
                $("#createBtn").removeClass("disabled");
                $("#createBtn").text("Update");

                if (res.status == "success") {
                    $(".result").html("<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert'>×</button>" + res.message + "</div>");
                } else if (res.status == "failed") {
                    $(".result").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert'>×</button>" + res.message + "</div>");
                }
            }
        });
    }

    ///Delete 
    function deleteProduct(id) {
        var status = confirm("Do you want to delete this post?");
        if (status == true) {
            $.ajax({
                url: "http://127.0.0.1:8000/api/delete/" + id,
                method: 'delete',
                dataType: 'json',

                success: function(res) {
                    window.location.reload();
                }
            });
        }
    }
</script>

</html>