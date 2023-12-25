<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Select2 for multiple select & live search</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
        integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
        integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container pt-2 mt-3 pb-2 bg-white">
        <div class="card p-5 bg-secondary">

            <h1 class="text-center text-dark pb-3">Select2 for multiple select</h1>

            @if (session()->has('success'))
            <div class="col-md-6 offset-md-3 alert alert-success">
                {{ session()->get('success') }}
            </div>
            @endif
            <form action="post" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="justify-content-center">
                    <div class="col-md-6 offset-md-3 form-group">
                        <h6>Title:</h6>
                        <input type="text" name="title" id="title" class="form-control">
                        @error('title')
                        <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="col-md-6 offset-md-3 form-group">
                        <h6 class="pt-2">Description:</h6>
                        <textarea name="description" id="description" class="form-control" rows="4"></textarea>
                        @error('description')
                        <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>


                    <div class="col-md-6 offset-md-3 form-group">
                        <h6 class="pt-2">Tags:</h6>
                        <select class="tags form-control" id="tags" name="tags[]" multiple="multiple"></select>
                        @error('tags')
                        <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>

                    <div class="col-md-6 offset-md-3 py-3">
                        <button type="submit" class="btn btn-primary">submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
    $(document).ready(function() {

        $('.tags').select2({
            placeholder: 'select',
            allowClear: true,
        });

        $("#tags").select2({
            ajax: {
                url: "{{ route('get-category')}}",
                type: "post",
                delay: 50,
                data: tags,
                dataType: 'json',
                data: function(params) {
                    return {
                        name: params.term,
                        "_token": "{{ csrf_token()}}",
                    };
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                id: item.id,
                                text: item.title
                                
                            }
                        })
                    };
                },

            },

        });

    });
    </script>
</body>

</html>
@extends('app')
@section('content')
<div class="row mt-5">
    <table class="table table-bordered data-table text-dark">
        <thead>
            <tr>
                <th>Id</th>
                <th>title</th>
                <th>Discription </th>
                <th>Tags</th>

            </tr>
        </thead>

        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{$user->title}}</td>
                <td>{{$user->description}}</td>
                <td>{{$user->tags}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection