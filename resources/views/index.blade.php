<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{csrf_token()}}">
    <!--Bootstrap CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!---->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
    {{-- <link rel="stylesheet" href="../ttskch/select2-bootstrap4-theme/dist/select2-bootstrap4.css">
    <link rel="stylesheet" href="/path/to/select2-bootstrap4.min.css"> --}}
    <title>Laravel Ekspedisi | Raja Ongkir</title>
</head>
<body>

    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-3">
                <div class="card shadow">
                    <div class="card-body">
                        <h2>ORIGIN</h2>
                        <hr>

                        <div class="form-group">
                            <label>Provinsi</label>
                        <select class="form-control prov-origin" name="province_origin">
                            <option value="0">-- Choose Province --</option>
                            @foreach($provinces as $province => $value)
                                <option value="{{$province}}">{{$value}}</option>
                            @endforeach
                        </select>
                        </div>
                        
                        <div class="form-group">
                            <label>Kota / kabupaten</label>
                        <select class="form-control c-origin" name="city_origin">
                            <option value="0">-- Choose City --</option>
                           
                        </select>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow">
                    <div class="card-body">
                        <h2>DESTINATION</h2>
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
                            <label>Kota / kabupaten</label>
                        <select class="form-control c-destination" name="city_destination">
                            <option value="0">-- Choose City --</option>
                           
                        </select>
                        </div>

                    </div>

                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow">
                    <div class="card-body">
                        <h2>Kurir</h2>
                        <hr>
                        <div class="form-group">
                            <label>Provinsi Tujuan</label>
                            <select class="form-control" name="courier">
                                <option value="0">-- Choose Courier --</option>
                                <option value="jne">JNE</option>
                                <option value="pos">POS</option>
                                <option value="tiki">TIKI</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Berat (Gram)</label>
                            <input type="number" class="form-control" name="weight" placeholder="input weight">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <button class="btn btn-primary btn-block btn-check shadow"> Check Ongkir</button>
            </div>

        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card d-none">
                    <div class="card-body">
                        <ul class="list-group" id="ongkir"></ul>
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
        $(document).ready(function(){
            $(".prov-origin,.c-origin, .prov-destination, .c-destination").select2(
                theme:'bootstrap4', width:'style',
            )

        });

        // select origin
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
                            $('select[name="city_origin"]').append('<option value="' + key +'">' + value + '</option>')
                        });
                    },
                });
            }else{
                $('select[name="city_origin"]').append(' <option value="">-- Choose City --</option>')
            }
        });

        // select destination
        $('select[name="province_destination"]').on('change', function(){
            let provId = $(this).val();
            if(provId){
                jQuery.ajax({
                    url: '/cities/'+provId,
                    type: "GET",
                    dataType: "json",
                    success: function(response){
                        $('select[name="city_destination"]').empty();
                        $('select[name="city_destination"]').append(' <option value="0">-- Choose City --</option>');
                        $.each(response, function(key, value){
                            $('select[name="city_destination"]').append('<option value="' + key +'">' + value + '</option>')
                        });
                    },
                });
            }else{
                $('select[name="city_destination"]').append(' <option value="0">-- Choose City --</option>')
            }
        });
    </script>

</body>
</html>