<!doctype html>
<html>

<head>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <!-- AJAX n jQuery Library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!--    Datatables  -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css" />
</head>

<body>



    <!--=====================================================================================
    FORMULARIO Y PETICION AJAX 
    =======================================================================================-->
    <form id="loginform" method="post">
        <div>
            titulo:
            <input type="text" name="title" id="title" />
            body:
            <input type="text" name="body" id="body" />
            author:
            <input type="text" name="author" id="author" />
            <input type="submit" name="submit" id="submit" value="Login" />
        </div>
    </form>
    <script>
        $(document).ready(function() {

            $("#submit").click(function() {


                var title = $("#title").val();
                var body = $("#body").val();
                var author = $("#author").val();

                if (title == '' || body == '' || author == '') {
                    alert("Please fill all fields.");
                    return false;
                }

                $.ajax({
                    type: "POST",
                    url: "insert.php",
                    data: {
                        title: title,
                        body: body,
                        author: author
                    },
                    cache: false,
                    success: function(data) {
                        alert('inserted');
                        alert(data);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr);
                    }
                });

            });

        });
    </script>





    <!--=====================================================================================
    DATA TABLES
    =======================================================================================-->

    <div>
        <div>
            <h2 class="text-center">Datatables</h2>

            <h3 class="text-center">Consumiendo datos desde MySQL con Ajax</h3>

            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <table id="tablaUsuarios" class="table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>title</th>
                                    <th>body</th>
                                    <th>author</th>
                                    <th>created_at</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>



            <!-- Optional JavaScript -->
            <!-- jQuery first, then Popper.js, then Bootstrap JS -->
            <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


            <!--    Datatables-->
            <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>

            <style>
                table.dataTable thead {
                    color: cadetblue;
                }

                .dataTable thead .sorting_asc,
                .dataTable thead .sorting_desc,
                .dataTable thead .sorting,
                .dataTable tbody .sorting {
                    padding-left: 2.2rem !important;
                    padding-top: 0.7rem !important;
                    padding-bottom: 0.7rem !important;
                    padding-right: 0.75rem !important;
                }
            </style>
            <script>
                $(document).ready(function() {
                    $('#tablaUsuarios').DataTable({
                        "ajax": {
                            "url": "read.php",
                            "dataSrc": ""
                        },
                        "columns": [{
                                "data": "id"
                            },
                            {
                                "data": "title"
                            },
                            {
                                "data": "body"
                            },
                            {
                                "data": "author"
                            },
                            {
                                "data": "created_at"
                            }
                        ]
                    });
                });
            </script>


        </div>
    </div>


</body>

</html>