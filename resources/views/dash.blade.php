@extends('layouts.app')

@section('styles')
<style>
  textarea {
    resize: none;
  }
  a {
    float: right;
  }
</style>
@endsection

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Create a Twet</div>
          <div class="card-body">
            <form action="/twet/{id}" method="POST" id="message" name="message">
              @csrf
              <textarea class="form-control" maxLength="24" id="message" name="message" oninput="lengthCheck(this)" ></textarea>
                <p id="chars"></p>
              <input type="submit" value="Submit">
            </form>
          </div>
        </div>
    </div>
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Your Twets</div>
          @foreach($twets as $twet)
            <div class="card-body">
              <div class="ml-auto">
                {{$twet->getTwetMsg()}}
              </div>
              <div class="ml-auto">
                <a href="{{route('twet', ['id' => $twet->getTwetId()])}}">View</a>
              </div>
            </div>
          @endforeach 
        </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
  function lengthCheck(element) {
    var max = 24;
    var textArea = element.value.length;
    var charactersLeft = max - textArea;
    var count = document.getElementById('chars');
    count.innerHTML = "Characters left: " + charactersLeft;
  }
  lengthCheck(document.getElementById('newTwet'));
</script>
@endsection
