@extends('template.admin')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">OPERATOR</h4>
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
                    <h4 class="header-title mt-0 mb-1">POST OPERATOR</h4>
                    <form action="{{ url('/post-operator') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="operator_text" class="form-label">Operator Text</label>
                            <input type="text" class="form-control" id="operator_text" name="operator_text" placeholder="Enter your operator here" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Post Operator</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection