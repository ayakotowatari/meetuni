@extends('layouts.app')

@section('content')

<div class="row"> 

    <form action="{{ route('inst.search') }}" method="post" class="col s12">
    @csrf
        <div class="row">
            <div class="input-field col s12">
                <p class="heading">Enter university name</p>
                <input type="text" name="inst_name" class="validate">
            </div>
        </div>
        <input type="submit" value="Submit" class="btn-submit_i btn-filter">
    </form>

</div>


@endsection