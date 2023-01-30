<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="card" style="width: 18rem;">
    <div class="card-body">
        <h5 class="card-title">{{$feedback->title}}</h5>
        <p class="card-text">{{$feedback->text}}</p>
        <a>{{$feedback->file}}</a>
    </div>
    </div>
</body>