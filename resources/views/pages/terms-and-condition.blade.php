@extends('layout.master')

@section('title') Terms and Condition - LabWork360 @endsection

@section('content')
    <div class="container">
        <section>


            {!! $location->terms_and_condition !!}

        </section>
    </div>

@endsection

@push('js')

@endpush


