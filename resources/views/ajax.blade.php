<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <form action="#" method="post">
        <div class="container">
            <div class="form-group">
                <label for="">Name</label>
                <input type="text" class="form-control" name="name" id="name">
            </div>
            <div class="form-group">
                <label for="">email</label>
                <input type="text" class="form-control" name="email" id="email">
            </div>
            <div class="form-group">
                <label for="">phone</label>
                <input type="text" class="form-control" name="phone" id="phone">
            </div>
            <div class="form-group">
                <label for="">address</label>
                <input type="text" class="form-control" name="address" id="address">
            </div>
            <div>
                <button type="button" id="nut">GỬi</button>
            </div>
        </div>
    </form>
    <div class="container">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody id="result">

            </tbody>
        </table>
    </div>
    </table>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        loadAll();
        function loadAll(){
            $.ajax({
                url: "{{route('f.ajax')}}",
                method:"GET",
                success:function(d){
                    var result='';
                    d.forEach(response=>{
                        //console.log(response);
                         result+=`<tr>
                                    <td>`+response.id+`</td>
                                    <td>`+response.name+`</td>
                                    <td>`+response.email+`</td>
                                    <td>`+response.phone+`</td>
                                    <td>
                                        <button type='button' id="del_btnaa">Xóa</button>
                                    </td>
                                 </tr>`;

                    });
                    $('#result').html(result);
                }

            });
        }
                $('#nut').click(function(){
                var name=$('#name').val();
                var email=$('#email').val();
                var phone=$('#phone').val();
                var address=$('#address').val();
                if(name!='' && email!='' && phone!='' && address !=''){
                    $.ajax({
                        method: "POST",
                        url: "{{route('f.post_demo')}}",
                        data:{
                            _token:'{{csrf_token()}}',
                            name:name,
                            email:email,
                            phone:phone,
                            address:address
                        },

                        success: function (d) {
                            console.log(d)
                            loadAll();
                            $('#name').val('');
                            $('#email').val('');
                            $('#phone').val('');
                            $('#address').val('');


                        },
                        error: function(d){
                        alert(d.responseJSON.message);
                    },
                    });
                }else{
                    alert('Dữ liệu chưa nhập đủ')
                 }
                });
            $('#del_btnaa').click(function(){
                alert('xóa')
            })
    });
</script>
