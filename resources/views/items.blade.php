<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{csrf_token()}}">
        <title>Items</title>

        <link href="https://fonts.googleapis.com/css?family=Raleway:300,600" rel="stylesheet">
        <link href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" rel="stylesheet">
        <link href="{{ asset('/css/app.css') }}" rel="stylesheet" type="text/css">
    </head>

    <body>
        <aside>
            <div id="counter">
                <div>
                    <p>Items count: <span>...</span></p>
                </div>
            </div>
        </aside>
        <div class="generalMessageWrapper">
            <div class="flex-center">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Yes!</strong>
                    <p></p>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="flex-center">
            <div class="content">
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-lg btn-primary" data-toggle="modal" data-target="#createModal">
                            Add item
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="list-group">
                        </div>
                    </div>

                </div>

            </div>
        </div>

        @include('modal.delete')
        @include('modal.edit')
        @include('modal.create')
        <script src="{{ asset('/js/app.js') }}"></script>
    </body>
</html>
