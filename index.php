<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <!-- Bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>


    <!-- Modal -->
    <div class="modal fade" id="completeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">New user</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="completename" class="form-label">Name</label>
                        <input type="text" class="form-control" id="completename" placeholder="Enter your name">

                    </div>
                    <div class="mb-3">
                        <label for="completeemail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="completeemail" placeholder="Enter your email">

                    </div>
                    <div class="mb-3">
                        <label for="completemobile" class="form-label">Mobile</label>
                        <input type="text" class="form-control" id="completemobile"
                            placeholder="Enter your Mobile number">

                    </div>
                    <div class="mb-3">
                        <label for="completeplace" class="form-label">Address</label>
                        <input type="text" class="form-control" id="completeplace" placeholder="Enter your address">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-dark" onclick="adduser()">Submit</button>
                </div>
            </div>
        </div>
    </div>


    <!-- update modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update Details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="updatename" class="form-label">Name</label>
                        <input type="text" class="form-control" id="updatename" placeholder="Enter your name">

                    </div>
                    <div class="mb-3">
                        <label for="updateemail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="updateemail" placeholder="Enter your email">

                    </div>
                    <div class="mb-3">
                        <label for="updatemobile" class="form-label">Mobile</label>
                        <input type="text" class="form-control" id="updatemobile"
                            placeholder="Enter your Mobile number">

                    </div>
                    <div class="mb-3">
                        <label for="updateplace" class="form-label">Address</label>
                        <input type="text" class="form-control" id="updateplace" placeholder="Enter your address">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-dark" onclick="updateDetails()">Update</button>
                    <input type="hidden" id="hiddendata">
                </div>
            </div>
        </div>
    </div>



    <div class="container my-3">
        <h1 class='text-center'>CRUD Operation </h1>
        <button type="button" class="btn btn-dark my-3" data-bs-toggle="modal" data-bs-target="#completeModal">
            Add new user
        </button>
        <div id="displayDataTable">

        </div>
    </div>






    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>


    <script>
        $(document).ready(function () {
            displayData();
        });

        // display function
        function displayData() {
            let displayData = "true";
            $.ajax({
                url: "display.php",
                type: 'post',
                data: {
                    displaySend: displayData
                },
                success: function (data, status) {
                    $('#displayDataTable').html(data);
                }
            });
        }





        function adduser() {
            let nameAdd = $('#completename').val();
            let emailAdd = $('#completeemail').val();
            let mobileAdd = $('#completemobile').val();
            let placeAdd = $('#completeplace').val();

            $.ajax({
                url: "insert.php",
                type: 'post',
                data: {
                    nameSend: nameAdd,
                    emailSend: emailAdd,
                    mobileSend: mobileAdd,
                    placeSend: placeAdd
                },
                success: function (data, status) {
                    // function to display data;
                    // console.log(status);
                    $('#completeModal').modal('hide');
                    displayData();
                }
            })

        }


        // Delete Record

        function DeleteUser(deleteid) {
            $.ajax({
                url: "delete.php",
                type: 'post',
                data: {
                    deletesend: deleteid
                },
                success: function (data, status) {
                    displayData();
                }
            });
        }


        // Update function
        function GetDetails(updateid) {
            $('#hiddendata').val(updateid);

            $.post("update.php", { updateid: updateid }, function (data, status) {
                let userid = JSON.parse(data);
                $('#updatename').val(userid.name);
                $('#updateemail').val(userid.email);
                $('#updatemobile').val(userid.mobile);
                $('#updateplace').val(userid.place);
            });


            $('#updateModal').modal("show");
        }


        // onclick update event function
        function updateDetails() {
            let updatename = $('#updatename').val();
            let updateemail = $('#updateemail').val();
            let updatemobile = $('#updatemobile').val();
            let updateplace = $('#updateplace').val();

            let hiddendata = $('#hiddendata').val();

            $.post("update.php", {
                updatename: updatename,
                updateemail: updateemail,
                updatemobile: updatemobile,
                updateplace: updateplace,
                hiddendata: hiddendata
            }, function (data, status) {
                $('#updateModal').modal('hide');
                displayData();
            });
        }


    </script>
</body>

</html>