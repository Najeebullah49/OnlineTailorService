<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href=
"https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css"
          integrity=
"sha512-b2QcS5SsA8tZodcDtGRELiGv5SaKSk1vDHDaQRda0htPYWZ6046lr3kJ5bAAQdpV2mmA/4v0wQF9MyU6/pDIAg=="
          crossorigin="anonymous" 
          referrerpolicy="no-referrer" />
</head>
<body>
    <div class="row">
        <div class="col">
        <h1>Welcome, {{ $user->name }}</h1>
<p>Email: {{ $user->email }}</p>
<img src="{{ asset('uploads/profiles/' . $user->picture) }}" alt="Profile Picture" class="rounded-circle" height="100">
        </div>
    </div>
    @php
    dd(session()->all());
@endphp
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script> 

</body>
</html>