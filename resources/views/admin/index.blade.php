@extends('admin.layout.master')
@push('css')
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.11.5/b-2.2.2/b-colvis-2.2.2/b-html5-2.2.2/b-print-2.2.2/date-1.1.2/fc-4.0.2/fh-3.2.2/r-2.2.9/rg-1.1.4/sc-2.0.5/sb-1.3.2/sl-1.3.4/datatables.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
    <div class='card'>
        @if ($errors->any())
            <div class="card-header">
                <div class="col-12">
                    <div class="page-title-box">
                        <h1 class="page-title"></h1>
                    </div>
                </div>
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
        <div class='card-body'>
            <a class="btn btn-success" href="{{ route('courses.create') }}" style="margin-bottom: 10px; padding: 10px 20px; float: right">
                Add Product
            </a>
            <table class="table table-striped" id="table-index">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Detail</th>
                    <th>Price</th>
                    <th>Edit</th>
                    @if(checkSuperAdmin())
                    <th>Delete</th>
                    @endif
                </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.11.5/b-2.2.2/b-colvis-2.2.2/b-html5-2.2.2/b-print-2.2.2/date-1.1.2/fc-4.0.2/fh-3.2.2/r-2.2.9/rg-1.1.4/sc-2.0.5/sb-1.3.2/sl-1.3.4/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(function() {
                $("#select-name").select2({
                    ajax: {
                        url: "{{ route('courses.api.name') }}",
                        dataType: 'json',
                        data: function (params) {
                            return {
                                t: params.term
                            };
                        },
                        processResults: function (data, params) {
                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        text: item.name,
                                    }
                                })
                            };
                        }
                    },
                    placeholder: 'Search for a name'
                });

            var buttonCommon = {
                exportOptions: {
                columns: ':visible :not(.not-export)'
        }
        };
            let table = $('#table-index').DataTable({
                serverSide: true,
                ajax: '/data-source',
                type: 'post',
            dom: 'Blfrtip',
            select: true,
            buttons: [
            $.extend( true, {}, buttonCommon, {
            extend: 'copyHtml5'
        } ),
            $.extend( true, {}, buttonCommon, {
            extend: 'excelHtml5'
        } ),
            $.extend( true, {}, buttonCommon, {
            extend: 'pdfHtml5'
        } ),
            $.extend( true, {}, buttonCommon, {
            extend: 'print'
        } ),
            'colvis'
            ],
            processing: true,
            serverSide: true,
            ajax: '{!! route('courses.api') !!}',
            columnDefs: [
            {className: "not-export", "targets": [ 3 ] }
            ],
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'detail', name: 'detail' },
                { data: 'price', name: 'price' },

        {
            data: 'edit',
            targets: 4,
            orderable: false,
            searchable: false,
            render: function ( data, type, row, meta ) {
            return `<a class="btn btn-primary" href="${data}">
             Edit
            </a>`;
        }
        },

        @if(checkSuperAdmin())
        {
            data: 'destroy',
            targets: 5,
            orderable: false,
            searchable: false,
            render: function ( data, type, row, meta ) {
                console.log(data, type, row, meta);
            return `<form action="${data}" method="post">
            @csrf
            @method('DELETE')
            <button type='button' class="btn-delete btn btn-danger">Delete</button>
        </form>`;
        }
        },
        @endif
            ]
        });
                $('#select-name').change(function () {
                    table.column(0).search( this.value ).draw();
                } );
            $(document).on('click','.btn-delete',function(){
                let form = $(this).parents('form');
                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    dataType: 'json',
                    data: form.serialize(),
                    success: function() {
                        console.log("success");
                        table.draw();
                    },
                    error: function() {
                        console.log("error");
                    }
                });
            });
        });

    </script>

@endpush
