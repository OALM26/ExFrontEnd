<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
    </head>
    <body class="m-0 vh-100 row justify-content-center align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="text-right">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAdd">Add</button>
                    </div>
                </div>
            </div>
            <br />
            <div class="row table-wrapper-scroll-y my-custom-scrollbar">
                <table class="table table-bordered table-striped mb-0">
                    <thead>
                        <tr>
                            <th class="col-1">No.Orden</th>
                            <th class="col-2">Estatus</th>
                            <th class="col-2">Total</th>
                            <th class="col-7 text-center">Ver articulos</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($Orders as $Order)
                        <tr>
                            <td class="text-center">{{$Order["OrderNumber"]}}</td>
                            <td class="text-center">{{$Order["Status"]}}</td>
                            <td class="text-center">{{$Order["Total"]}}</td>
                            <td>
                                <div class="text-center">
                                    <a class="btn btn-primary" data-toggle="collapse" href="#multiCollapseExample{{$Order['id']}}" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Ver Detalles</a>
                                </div>
                                <div class="collapse multi-collapse" id="multiCollapseExample{{$Order['id']}}">
                                    <div class="card card-body">
                                        @foreach($Order["Items"] as $Item)
                                        <b>{{$Item->name}}</b>
                                        <a>
                                            <ul>
                                                <li>Sku: {{$Item->sku}}</li>
                                                <li>Cantidad: {{$Item->quantity}}</li>
                                                <li>Precio: {{$Item->price}}</li>
                                            </ul>
                                        </a>
                                        @endforeach
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {!! $Orders->links() !!}
                </div>
            </div>
        </div>
        <!-- MODAL ADD PRODUCT -->
        <div class="modal fade" id="modalAdd" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"></button>
                        <br />
                        <h4 class="modal-title" id="myModalLabel">New Product</h4>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <p class="statusMsg"></p>
                        <form role="form">
                            <div class="form-group">
                                <label for="inputSku">Sku</label>
                                <input type="text" class="form-control" id="inputSku" placeholder="Enter sku" required />
                            </div>
                            <div class="form-group">
                                <label for="inputName">Name</label>
                                <input type="text" class="form-control" id="inputName" placeholder="Enter product name" required />
                            </div>
                            <div class="form-group">
                                <label for="inputQuantity">Quantity</label>
                                <input type="number" class="form-control" id="inputQuantity" placeholder="Enter quantity" required />
                            </div>
                            <div class="form-group">
                                <label for="inputPrice">Price</label>
                                <input type="decimal" class="form-control" id="inputPrice" placeholder="Enter price" required />
                            </div>
                        </form>
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary submitBtn" onclick="submitForm()">Pay</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL ALERT -->
        <div class="modal" tabindex="-1" role="dialog" id="modalAlert">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p id="message"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Optional JavaScript -->
        <script>
            function submitForm() {
                var Sku = $("#inputSku").val();
                var Name = $("#inputName").val();
                var Quantity = $("#inputQuantity").val();
                var Price = $("#inputPrice").val();

                if (Sku.trim() == "") {
                    $("#message").html("Please enter sku");
                    $("#modalAlert").modal("show");
                    $("#inputSku").focus();
                    return false;
                } else if (Name.trim() == "") {
                    $("#message").html("Please enter product name");
                    $("#modalAlert").modal("show");
                    $("#inputName").focus();
                    return false;
                } else if (Quantity.trim() == "") {
                    $("#message").html("Please enter quantity");
                    $("#modalAlert").modal("show");
                    $("#inputQuantity").focus();
                    return false;
                } else if (Price.trim() == "") {
                    $("#message").html("Please enter price");
                    $("#modalAlert").modal("show");
                    $("#inputPrice").focus();
                    return false;
                } else {
                    $("#modalAdd").modal("hide");

                    $("#message").html("Process completed successfully!!");
                    $("#modalAlert").modal("show");
                    return false;
                }
            }
        </script>
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>
