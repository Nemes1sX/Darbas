@extends('cities.layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Redaguoti miestą
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('cities.update', $city->id) }}">
        @method('PATCH')
        @csrf
        <div class="form-group">
          <label for="city">City:</label>
          <input type="text" class="form-control" name="city" value={{ $city->city }} />
        </div>
        <div class="form-group">
          <label for="region">Region :</label>
          <input type="text" class="form-control" name="region" value={{ $city->region }} />
        </div>
        <div class="form-group">
          <label for="population">Share Quantity:</label>
          <input type="text" class="form-control" name="population" value={{ $city->population }} />
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
  </div>
</div>
@endsection
