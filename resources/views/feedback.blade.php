@extends('main')
@section('content')

    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h3 class="card-header text-center">Send A Feedback</h3>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                            {{ session('status') }}
                            </div>
                        @endif
                        @if (session('failed'))
                            <div class="alert alert-success">
                            {{ session('failed') }}
                            </div>
                        @endif
                        <form action="{{ route('send-feedback') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Title" id="title" class="form-control" name="title"
                                    required autofocus>
                                
                            </div>
                            <div class="form-group mb-3">
                                <label for="text" class="form-label">Feedback Text</label>
                                <textarea placeholder="Text" id="text" class="form-control"
                                    name="text" required autofocus>
                                
                                </textarea>
                            </div>
                            <div class="input-group mb-3 ">
                                <input type="file" class="form-control " id="file" name="file" required>
                                <label class="input-group-text" for="file">Upload</label>
                            </div>
                            
                            <div class="d-grid mx-auto">
                                <button type="submit" class="btn btn-dark btn-block">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection