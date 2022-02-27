@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>
  <style>
    .selectpicker option[selected]{
    background-color: black;
    }
  </style>
  <div class="content">
    <div class="container-fluid">
      <div class="container-tambah mb-4">

        @if (session('success'))
            <div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <i class="material-icons">close</i>
              </button>
              {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
          <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <i class="material-icons">close</i>
            </button>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
          </div>
        @endif

        <button class="btn btn-primary" data-toggle="modal" data-target="#signupModal">
          <i class="material-icons">add</i>
          Tambah
        </button>

        <div class="modal fade" id="signupModal" tabindex="-1" role="dialog">
          <div class="modal-dialog modal-dialog-centered modal-signup" role="document">
            <div class="modal-content">
              <!-- <div class="card card-signup card-plain w-100"> -->
                <div class="modal-header text-center">
                  <h3 class="modal-title font-weight-bold text-center ml-3">Tambah Benda</h3>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="material-icons">clear</i>
                  </button>
                </div>
                <div class="modal-body p-0 pt-3">                    
                      <form class="form" method="post" action="/home">
                        @csrf
                        <div class="mx-4">
                          <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text"><i class="material-icons">add_circle</i></div>
                              </div>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Benda">
                            </div>
                          </div>

                          <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text"><i class="material-icons">format_list_bulleted</i></div>
                              </div>
                              <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="jenis" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Masukkan Jenis Benda
                                <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="jenis">
                                  <li value="Lampu"><a class="dropdown-item" href="#">Lampu</a></li>
                                  <li value="A/C"><a class="dropdown-item" href="#">A/C</a></li>
                                  <li value="TV"><a class="dropdown-item" href="#">TV</a></li>
                                  <li value="Kunci"><a class="dropdown-item" href="#">Kunci</a></li>
                                </ul>
                              </div>
                              <input type="hidden" id="dropdownJenis" class="form-control" name="jenis">
                            </div>
                          </div>

                          <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text"><i class="material-icons">place</i></div>
                              </div>
                                <input type="text"class="form-control" id="lokasi" name="lokasi" placeholder="Masukkan Lokasi Benda" />
                            </div>
                          </div>                    
                        </div>
                        <div class="modal-footer mt-4">
                            <!-- <a href="#pablo" class="btn btn-primary btn-round">Tambah benda</a> -->
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Tambah benda</button>                
                            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                      </div>
                    </form>            
                </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
              <div class="card-icon">
                <i class="material-icons">tungsten</i>
              </div>
              <p class="card-category">Jumlah Lampu</p>
              <h3 class="card-title">{{ $countTotalLampu }}
                <small>buah</small>
              </h3>
            </div>
            <div class="card-footer">
             
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">ac_unit</i>
              </div>
              <p class="card-category">Jumlah A/C</p>
              <h3 class="card-title">{{ $countTotalAC }}
                <small>buah</small>
              </h3>
            </div>
            <div class="card-footer">
              <!-- <div class="stats">
                <i class="material-icons">date_range</i> Last 24 Hours
              </div> -->
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <div class="card-icon">
                <i class="material-icons">tv</i>
              </div>
              <p class="card-category">Jumlah TV</p>
              <h3 class="card-title">{{ $countTotalTV }}
                <small>buah</small>
              </h3>
            </div>
            <div class="card-footer">
              <!-- <div class="stats">
                <i class="material-icons">local_offer</i> Tracked from Github
              </div> -->
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
              <div class="card-icon">
                <i class="material-icons">vpn_key</i>
              </div>
              <p class="card-category">Jumlah Kunci</p>
              <h3 class="card-title">{{ $countTotalKunci }}
                <small>buah</small>
              </h3>
            </div>
            <div class="card-footer">
              <!-- <div class="stats">
                <i class="material-icons">date_range</i> Last 24 Hours
              </div> -->
            </div>
          </div>
        </div>

      </div>

      </div>
      <div class="row" data-masonry='{"percentPosition": true }'>
        

        <div class="col-md-4">
          <div class="card">
            <div class="card-header card-header-danger">
              <!-- <div class="card-text"> -->
                <h4 class="card-title">Pemutar Musik</h4>
              <!-- </div> -->
            </div>
            <div class="card-body mt-2">
              <input type="file" id="file"></input>
              <audio id="audio" controls autoplay></audio>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-12">
          <div class="card">
            <div class="card-header card-header-warning">
              <h4 class="card-title">Kontrol Lampu</h4>
              <!-- <p class="card-category">New employees on 15th September, 2016</p> -->
            </div>
            <div class="card-body table-responsive">
              <table class="table table-hover">
                <thead class="text-warning">
                  <th>Nama</th>
                  <th>Ruangan</th>
                  <th>Aksi</th>
                </thead>
                <tbody>
                @foreach( $totalLampu as $thing)
                  <tr>
                    <td>{{ $thing->thing }}</td>
                    <td>{{ $thing->room}}</td>
                    <td>
                    <div class="togglebutton">
                      <label>
                        <input 
                          type="checkbox"
                          data-id="{{ $thing->id }}" 
                          class="toggle-class" 
                          data-toggle="toggle"
                          data-onstyle="success"
                          data-offstyle="danger"
                          data-on="Hidup"
                          data-off="Mati"
                          data-size="sm"
                          {{ $thing->state ? 'checked' : '' }}
                          >
                          <span class="toggle"></span>
                      </label>
                    </div>
                        
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
     
        <div class="col-lg-4 col-md-12">
          <div class="card">
            <div class="card-header card-header-success">
              <h4 class="card-title">Kontrol AC</h4>
              <!-- <p class="card-category">New employees on 15th September, 2016</p> -->
            </div>
            <div class="card-body table-responsive">
              <table class="table table-hover">
                <thead class="text-success">
                  <th>Nama</th>
                  <th>Ruangan</th>
                  <th>Aksi</th>
                </thead>
                <tbody>
                @foreach( $totalAC as $thing)
                  <tr>
                    <td>{{ $thing->thing }}</td>
                    <td>{{ $thing->room}}</td>
                    <td>
                    <div class="togglebutton">
                      <label>
                        <input 
                          type="checkbox"
                          data-id="{{ $thing->id }}" 
                          class="toggle-class" 
                          data-toggle="toggle"
                          data-onstyle="success"
                          data-offstyle="danger"
                          data-on="Hidup"
                          data-off="Mati"
                          data-size="sm"
                          {{ $thing->state ? 'checked' : '' }}
                          >
                          <span class="toggle"></span>
                      </label>
                    </div>
                        
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-12">
          <div class="card">
            <div class="card-header card-header-danger">
              <h4 class="card-title">Kontrol TV</h4>
              <!-- <p class="card-category">New employees on 15th September, 2016</p> -->
            </div>
            <div class="card-body table-responsive">
              <table class="table table-hover">
                <thead class="text-danger">
                  <th>Nama</th>
                  <th>Ruangan</th>
                  <th>Aksi</th>
                </thead>
                <tbody>
                @foreach( $totalTV as $thing)
                  <tr>
                    <td>{{ $thing->thing }}</td>
                    <td>{{ $thing->room}}</td>
                    <td>
                    <div class="togglebutton">
                      <label>
                        <input 
                          type="checkbox"
                          data-id="{{ $thing->id }}" 
                          class="toggle-class" 
                          data-toggle="toggle"
                          data-onstyle="success"
                          data-offstyle="danger"
                          data-on="Hidup"
                          data-off="Mati"
                          data-size="sm"
                          {{ $thing->state ? 'checked' : '' }}
                          >
                          <span class="toggle"></span>
                      </label>
                    </div>
                        
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-12">
          <div class="card">
            <div class="card-header card-header-info">
              <h4 class="card-title">Kontrol Kunci</h4>
              <!-- <p class="card-category">New employees on 15th September, 2016</p> -->
            </div>
            <div class="card-body table-responsive">
              <table class="table table-hover">
                <thead class="text-info">
                  <th>Nama</th>
                  <th>Ruangan</th>
                  <th>Aksi</th>
                </thead>
                <tbody>
                @foreach( $totalKunci as $thing)
                  <tr>
                    <td>{{ $thing->thing }}</td>
                    <td>{{ $thing->room}}</td>
                    <td>
                    <div class="togglebutton">
                      <label>
                        <input 
                          type="checkbox"
                          data-id="{{ $thing->id }}" 
                          class="toggle-class" 
                          data-toggle="toggle"
                          data-onstyle="success"
                          data-offstyle="danger"
                          data-on="Hidup"
                          data-off="Mati"
                          data-size="sm"
                          {{ $thing->state ? 'checked' : '' }}
                          >
                          <span class="toggle"></span>
                      </label>
                    </div>
                        
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card">
            <div class="card-header card-header-primary">
              <!-- <div class="card-text"> -->
                <h4 class="card-title">Prakiraan Cuaca</h4>
              <!-- </div> -->
            </div>
            <div class="card-body mt-2">
              <select class="selectpicker mb-2" data-dropup-auto="false" data-style="btn-primary" data-width="auto" id="cuacaId" data-live-search="true" title="Masukkan Nama Kota..." onchange="getCuaca();">
                @foreach( $dataKota as $kota)
                  <option value="{{ $kota['id'] }}">{{ $kota['kota'] }}</option>
                @endforeach
              </select>
              <div class="current-weather flex items-center justify-between px-6 py-8">
                <div class="d-flex flex-column align-items-start weather-flex">
                </div>
              </div>
            </div>
          </div>
        </div>

    </div>
  </div>
@endsection

@push('js')
  <script>

    // Check for BlobURL support
      var blob = window.URL || window.webkitURL;

      document.getElementById('file').addEventListener('change', function(event){

              // consolePrint('change on input#file triggered');
              var file = this.files[0],
              fileURL = blob.createObjectURL(file);
              console.log(file);
              console.log('File name: '+file.name);
              console.log('File type: '+file.type);
              console.log('File BlobURL: '+ fileURL);
              document.getElementById('audio').src = fileURL;

      });


    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();
    });
    
    $(".dropdown-menu li a").click(function(){
      var selText = $(this).text();
      $(this).parents('.dropdown').find('.dropdown-toggle').html(selText+' <span class="caret"></span>');
      console.log('a1');
    });

    $('.dropdown-menu li').on('click', function(){
      $('#dropdownJenis').val($(this).attr("value"));
      // var a = document.getElementsByTagName()
      // console.log('a2');
    });

    $(function() {
      $('.toggle-class').change(function() {
        var state = $(this).prop('checked') == true ? 1 : 0;
        var id = $(this).data('id');
          $.ajax({
            type: "get",
            dataType: "json",
            url: "/updateThing",
            data: {'state': state, 'id': id},
            success: function(data){
              console.log(data.success);
            }
          });
      });
    });

    $(function() {
      $('.dropdown-menu').selectpicker();
    });

    function getCuaca(){
      var cuacaId = document.getElementById("cuacaId").value;
      // console.log(cuacaId);
      $.ajax({
            headers:{
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: "post",
            url: "/updateCuaca",
            data: {
              'id': cuacaId
            },
            // success: function(data){
            //   console.log(data.success);
            // }
            success: function(data){
              // console.log(data);
              var event_data = '';
              $.each(data, function(index, value){
                // var m = value.jamCuaca.moment().format('hh');
                var d = moment(value.jamCuaca).format('LL')
                var m = moment(value.jamCuaca).format('HH');
                // console.log(m);
                if(m === '12'){
                  // console.log(m);
                  event_data +=  '<div class="d-flex flex-row">';
                  event_data +=  '<div>';
                  
                  event_data +=     '<h1 class="font-weight-bold">' + value.tempC + '°C</h1>';
                  
                  event_data +=   '</div>';
                  event_data +=   '<div class="p-2 w-50">';
                  event_data +=     '<span>' + d + '</span>';
                  event_data +=     '<div class="font-weight-bold">' + value.cuaca + '</div>';
                  // event_data +=     '<div>Jakarta</div>';
                  event_data +=   '</div>';
                  event_data +=   '</div>';
                }
                
              });
              $('.weather-flex').html("");
              $('.weather-flex').append(event_data);
            }
          });
    }
    
  </script>
@endpush