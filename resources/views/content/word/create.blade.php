@extends('template.admin')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">WORD</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Shreyu</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                    <li class="breadcrumb-item active">Datatables</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mt-0 mb-1">POST WORD</h4>
                <form action="{{ url('/post-word') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="word_text" class="form-label">Word Text</label>
                        <input type="text" class="form-control" id="word_text" name="word_text" placeholder="Enter your word here" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Post Word</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection