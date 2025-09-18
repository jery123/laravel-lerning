@extends('layouts.app')

@section('content')
 @include('form', ['tash' => $task])
@endsection
