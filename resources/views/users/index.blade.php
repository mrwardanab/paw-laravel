@extends('layouts.app', ['activePage' => 'user-management', 'titlePage' => __('Kelola Pengguna')])

@section('content')

<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">Kelola Pengguna</h4>
              <p class="card-category"> Disini Anda dapat mengelola pengguna</p>
            </div>

            <div class="card-body">
              <div class="row">
                  <div class="col-12 text-right">

                    <button class="btn btn-round btn-primary text-right" data-toggle="modal" data-target="#signupModal">
                        <i class="material-icons">assignment</i>
                        Tambah Pengguna
                    </button>

                    <!-- Modal Tambah Pengguna -->
                    <div class="modal fade" id="signupModal" tabindex="-1" role="dialog">
                      <div class="modal-dialog modal-signup" role="document">
                        <div class="modal-content">
                          <div class="card card-signup card-plain">
                            <div class="modal-header">
                              <h5 class="modal-title card-title">Tambah Pengguna</h5>
                              <button type="submit" class="close" data-dismiss="modal" aria-label="Close">
                              <i class="material-icons">clear</i>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div class="row">
                                <div class="col-sm">
                                  <form id="tambahPenggunaForm" class="form" method="post" action="/user">
                                    @csrf
                                    <div class="card-body">
                                      <div class="form-group">
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="material-icons">face</i></div>
                                          </div>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Nama">
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="material-icons">email</i></div>
                                          </div>
                                            <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="material-icons">lock_outline</i></div>
                                          </div>
                                            <input type="password" placeholder="Password" id="password" name="password" class="form-control" />
                                        </div>
                                      </div>

                                      <div class="form-check text-center">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" value="" checked>
                                            <span class="form-check-sign">
                                                <span class="check"></span>
                                            </span>
                                            Saya setuju dengan <a href="#something">terms dan conditions</a>.
                                        </label>
                                      </div>
                                    </div>
                                    <div class="modal-footer justify-content-center">
                                    <button class="btn btn-primary btn-round" type="submit">Tambah</button>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>

             
              
              <div class="table-responsive">          
                <table class="table">
                  <thead class=" text-primary">
                    <tr>
                      <th>Nama</th>
                      <th>Email</th>
                      <th>Terakhir dimodifikasi</th>
                      <th class="text-right">Aksi</th>
                    </tr>
                  </thead>
                
                  <tbody>
                    @foreach ( $model as $usr )
                    <tr>
                      <td>{{ $usr->name }}</td>
                      <td>{{ $usr->email }}</td>
                      <td>{{ $usr->updated_at }}</td>
                      <td class="td-actions text-right">

                        <div class="container-fluid">
                          <div class="row">
                            <div class="col-12 text-right">
                              <form action="/user/{{ $usr->id }}" method="post">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger text-right" data-toggle="modal" data-target="#hapusModal">
                                    Hapus Pengguna
                                </button>
                              </form>
                            </div>
                          </div>
                        </div>

                        <div class="container-fluid">
                          <div class="row">
                            <div class="col-12 text-right">
                              <div class="btn-group">    
                                  <button class="btn btn-sm btn-success text-right" data-toggle="modal" data-target="#editModal{{ $usr->id }}">
                                    Edit Pengguna
                                  </button>

                                <!-- Modal Edit Pengguna -->
                                <div class="modal fade" id="editModal{{ $usr->id }}" tabindex="-1" role="dialog">
                                  <div class="modal-dialog modal-signup" role="document">
                                    <div class="modal-content">
                                      <div class="card card-signup card-plain">
                                        <div class="modal-header">
                                          <button type="submit" class="close" data-dismiss="modal" aria-label="Close">
                                            <i class="material-icons">clear</i>
                                          </button>
                                          <div class="modal-body">
                                            <div class="row">
                                              <div class="col-md-12">
                                                <form id= "editFormID" method="post" action="{{ route('profile.update') }}" autocomplete="off" class="form-horizontal">
                                                  @csrf
                                                  @method('put')

                                                  <div class="card ">
                                                    <div class="card-header card-header-primary">
                                                        <h4 class="card-title">{{ __('Edit Profile') }}</h4>
                                                        <p class="card-category">{{ __('Informasi Pengguna') }}</p>
                                                    </div>

                                                    <div class="card-body ">
                                                        @if (session('status'))
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                              <div class="alert alert-success">
                                                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                    <i class="material-icons">close</i>
                                                                  </button>
                                                                  <span>{{ session('status') }}</span>
                                                              </div>
                                                            </div>
                                                        </div>
                                                        @endif

                                                        <div class="row">
                                                        <label class="col-sm-2 col-form-label">{{ __('Nama') }}</label>
                                                          <div class="col-sm-7">
                                                              <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                                              <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="input-name" type="text" 
                                                              placeholder="{{ __('Nama') }}" value="{{ $usr->name }}" required="true" aria-reqired="true"/>
                                                              @if ($errors->has('name'))
                                                                  <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                                                              @endif
                                                              </div>
                                                          </div>
                                                        </div>

                                                        <div class="row">
                                                        <label class="col-sm-2 col-form-label">{{ __('Email') }}</label>
                                                          <div class="col-sm-7">
                                                            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                                            <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="input-email" type="email" 
                                                            placeholder="{{ __('Email') }}" value="{{ $usr->email  }}" required />
                                                            @if ($errors->has('email'))
                                                              <span id="email-error" class="error text-danger" for="input-email">{{ $errors->first('email') }}</span>
                                                            @endif
                                                            </div>
                                                          </div>
                                                        </div>
                                                    </div>

                                                    <div class="card-footer ml-auto mr-auto">
                                                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                                    </div>
                                                  </div>
                                                </form>
                                              </div>
                                            </div>
                                          </div>       
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                      </td>

                    </tr>
                    @endforeach
                  </tbody>
                </table>

              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection