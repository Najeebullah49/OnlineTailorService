@extends('admin.adminlayouts.adminLayout')
@section('admincontent')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@section('title')
    Customers Details
      @endsection</title>
   <!-- In the <head> section -->
<link href="{{asset('css/bootstrap.min.css') }}" rel="stylesheet">



    <link rel="stylesheet" href=
    "https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css"
              integrity=
    "sha512-b2QcS5SsA8tZodcDtGRELiGv5SaKSk1vDHDaQRda0htPYWZ6046lr3kJ5bAAQdpV2mmA/4v0wQF9MyU6/pDIAg=="
              crossorigin="anonymous" 
              referrerpolicy="no-referrer" />
</head>
<body>
<div id="layoutSidenav_content" class="mt-3">
                <main>
                    <div class="container-fluid px-4">
                       <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Register Customers
                            </div>

                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Picture</th>
                                            <th>Type</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Picture</th>
                                            <th>Type</th>
                                            <th>Date</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                    @forelse($customerDetails as $customerd)
                        <tr>
                            
                            <td>{{$customerd->id}}</td>
                            <td>{{ $customerd->name }}</td>
                            <td>{{ $customerd->email }}</td>
                            <td> <img src="{{ asset('uploads/profiles/'.$customerd->picture ?: 'images/adminlogo1.png') }}" alt="" class="img-fluid mb-3 bg-primary" style="width:40px; height:40px;"></td>
                            <td>{{$customerd->type}}</td>
                            <td>{{ $customerd->created_at}}</td> 
                          </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="20" class="text-center text-muted">No data available</td>
                        </tr>
                    @endforelse

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>

            
            </div>
            </div>

                 
   <!-- Before the closing </body> tag -->
   <script src="{{asset('css/js/bootstrap.bundle.min.js') }}"></script>
   {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script> --}}
</body>
</html>
@endsection