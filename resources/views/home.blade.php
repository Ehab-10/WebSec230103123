@extends('layouts.master')
@section('title', 'Home')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="mb-4">Welcome to Home Page</h2>

            <!-- Bootstrap Alert for JS feedback -->
            <div id="jsAlert" class="alert alert-info alert-dismissible fade show d-none" role="alert">
                <span id="jsAlertMsg"></span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <button type="button" class="btn btn-primary" onclick="showBootstrapAlert('Hello from Java Script')">Show Bootstrap Alert</button>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <button type="button" id="btn1" class="btn btn-primary me-2">Press Me</button>
                    <button type="button" id="btn2" class="btn btn-success me-2" style="display: none;">Press Me Again</button>
                    <ul id="ul1" class="list-group mt-3"></ul>
                </div>
            </div>

<script>
    function showBootstrapAlert(message) {
        const alertBox = document.getElementById('jsAlert');
        const alertMsg = document.getElementById('jsAlertMsg');
        alertMsg.textContent = message;
        alertBox.classList.remove('d-none');
        alertBox.classList.add('show');
        setTimeout(() => {
            alertBox.classList.remove('show');
            alertBox.classList.add('d-none');
        }, 2000);
    }

    $(document).ready(function(){
        $("#btn1").click(function(){
            $("#btn2").show();
        });
        $("#btn2").click(function(){
            $("#ul1").append('<li class="list-group-item">Hello</li>');
        });
    });
</script>
@endsection
