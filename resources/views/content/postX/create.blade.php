@extends('template.admin')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">TWITTER</h4>
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
                    <h4 class="header-title mt-0 mb-1">POST TWITTER</h4>
                    <form action="{{ url('/post-tweet') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="tweet_text" class="form-label">Tweet Text</label>
                            <input type="text" class="form-control" id="tweet_text" name="tweet_text" placeholder="Enter your tweet here" required>
                        </div>

                        <div class="mb-3">
                            <label for="media" class="form-label">Upload Media (photo/video)</label>
                            <input type="file" class="form-control" id="media" name="media" accept="image/*,video/*">
                        </div>

                        <button type="submit" class="btn btn-primary">Post Tweet</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endSection
