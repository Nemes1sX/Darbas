@extends('cities.layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif
  <a href="{{ route('cities.create') }}"><button class="btn btn-sucess" type="submit">Create</button></a>
  <br/>
  <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>City</td>
          <td>Region</td>
          <td>Population</td>
          <td colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($cities as $city)
        <tr>
            <td>{{$city->id}}</td>
            <td>{{$city->city}}</td>
            <td>{{$city->region}}</td>
            <td>{{$city->population}}</td>
            <td><a href="{{ route('cities.edit', $city->id)}}" class="btn btn-primary">Edit</a></td>
            <td>
                <form action="{{ route('cities.destroy', $city->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
@endsection
