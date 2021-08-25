<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{csrf_token()}}">
     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
     <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
     <link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.3.2/dist/select2-bootstrap4.min.css" rel="stylesheet" />
    
    <title>Laravel Ekspedisi | Raja Ongkir</title>
</head>
<body>

    <div class="container mt-5">
        <div class="row">
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-white text-dark">
                      <li class="breadcrumb-item"><a href="#">Home</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Ekspedisi</li>
                    </ol>
                  </nav>
        </div>
          
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <h2>ASAL</h2>
                                <hr>

                                <div class="form-group">
                                    <label class="font-weight-bold">Provinsi</label>
                                <select class="form-control prov-origin" name="province_origin">
                                    <option value="0">-- Choose Province --</option>
                                    @foreach($provinces as $province => $value)
                                        <option value="{{$province}}">{{$value}}</option>
                                    @endforeach
                                </select>
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold">Kota / kabupaten</label>
                                <select class="form-control c-origin" name="city_origin">
                                    <option value="0">-- Choose City --</option>
                                </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <h2>TUJUAN</h2>
                                <hr>
        
                                <div class="form-group">
                                    <label class="font-weight-bold">Provinsi</label>
                                <select class="form-control prov-destination" name="province_destination">
                                    <option value="0">-- Choose Province --</option>
                                    @foreach($provinces as $province => $value)
                                        <option value="{{$province}}">{{$value}}</option>
                                    @endforeach
                                </select>
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold">Kota / kabupaten</label>
                                <select class="form-control c-destination" name="city_destination">
                                    <option value="0">-- Choose City --</option>
                                </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <h2>KURIR</h2>
                                <hr>
                                <div class="form-group">
                                    <label class="font-weight-bold">Kurir</label>
                                    <select class="form-control " name="courier">
                                        <option value="0">-- Choose Courier --</option>
                                        <option value="jne">JNE</option>
                                        <option value="pos">POS</option>
                                        <option value="tiki">TIKI</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold">Berat (Gram)</label>
                                    <input type="number" class="form-control" name="weight" id="weight" placeholder="input weight">
                                </div>
                            </div>

                        </div>

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <button class="btn btn-primary shadow btn-block btn-check"> Check Ongkir</button>
                            </div>
                        </div>

                        <div class="row mt-5">
                            <div class="col-md-12">
                                <div class="d-none ongkir">
                                        <ul class="list-group" id="ongkir"></ul>
                                </div>
                            </div>
                        </div>
                        

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--JQuery and Bootstrap Bundle include Popper.js-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" ></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

 <script>
    $(document).ready(function() {
        $(".prov-origin,.c-origin, .prov-destination, .c-destination").select2({
                theme:'bootstrap4', width:'style',
        });

        // // select origin
        $('select[name="province_origin"]').on('change', function(){
            let provId = $(this).val();
            if(provId){
                jQuery.ajax({
                    url: '/cities/'+provId,
                    type: "GET",
                    dataType: "json",
                    success: function(response){
                        $('select[name="city_origin"]').empty();
                        $('select[name="city_origin"]').append(' <option value="">-- Choose City --</option>');
                        $.each(response, function(key, value){
                            $('select[name="city_origin"]').append('<option value="' + key +'">' + value + '</option>');
                        });
                    }
                });
            }else{
                $('select[name="city_origin"]').append(' <option value="">-- Choose City --</option>');
            }
        });

        // // select destination
        $('select[name="province_destination"]').on('change', function(){
            let provId = $(this).val();
            if(provId){
                jQuery.ajax({
                    url: '/cities/'+provId,
                    type: "GET",
                    dataType: "JSON",
                    success: function(response){
                        $('select[name="city_destination"]').empty();
                        $('select[name="city_destination"]').append(' <option value="0">-- Choose City --</option>');
                        $.each(response, function(key, value){
                            $('select[name="city_destination"]').append('<option value="' + key +'">' + value + '</option>');
                        });
                    }
                });
            }else{
                $('select[name="city_destination"]').append(' <option value="0">-- Choose City --</option>');
            }
        });

        // // ajak check ongkir
        let isProcess = false;
        $('.btn-check').click(function(e){
            e.preventDefault();

            let token = $("meta[name='csrf-token']").attr("content");
            let city_origin = $('select[name="city_origin"]').val();
            let city_destination = $('select[name="city_destination"]').val();
            let courier = $('select[name="courier"]').val();
            let weight = $('#weight').val();
            if(isProcess){
                return;
            }

            isProcess = true;
            jQuery.ajax({
                url: "/",
                data: {
                    _token: token,
                    city_origin: city_origin,
                    city_destination: city_destination,
                    courier: courier,
                    weight: weight,
                },

                dataType: "JSON",
                type: "POST",
                success: function(response){
                    isProcess = false;
                    if(response){
                        $('#ongkir').empty();
                        $('.ongkir').addClass('d-block');
                        $.each(response[0]['costs'], function(key, value){
                            $('#ongkir').append('<li class="list-group-item">'+response[0].code.toUpperCase()+': <strong>'+value.service+ '</strong> - Rp. '+value.cost[0].value+' ('+value.cost[0].etd+' hari)</li>');
                        });
                    }
                }
            });

        });
    });
</script>

</body>
</html>