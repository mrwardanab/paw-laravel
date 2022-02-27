@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'home', 'title' => __('Smart Home')])

@section('content')
<div class="container d-flex align-items-center" style="height: auto;">
  <div class="row justify-content-center">
      <div class="col-lg-7 col-md-8">
          <h1 class="text-white text-center">{{ __('Welcome to Smart Home website, your all in one house system.') }}</h1>
      </div>
  </div>
</div>
@endsection
