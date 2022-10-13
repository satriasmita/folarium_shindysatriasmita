@extends('layouts.app')

@section('content')
<link href="https://www.jqueryscript.net/demo/clean-simple-modal/dist/css/jquery.simple-modal.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/css/dataTables.bootstrap4.min.css" />
<div class="container-fluid">
    <!-- Page header section  -->
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-lg-4 col-md-12 col-sm-12">
                <h1>Data Jabatan</h1>
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12 text-lg-right">
                <div class="d-flex align-items-center justify-content-md-end mt-4 mt-md-0 flex-wrap vivify pullUp delay-550">
                    <div class="mb-3 mb-xl-0">
                        <a class="btn btn-primary" href="javascript:void(0)" id="createNewJabatan"> Tambah Jabatan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row clearfix">
        <div class="col-sm-12">
            <table class="table StandardTable" id="tabel_jabatan">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Kode Jabatan </th>
                        <th>Nama Jabatan </th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="AddJabatan" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myLargeModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="JabatanForm" name="JabatanForm" class="form-horizontal">
                {{ csrf_field() }}
                <input type="hidden" name="jabatan_id" id="jabatan_id">
                <div class="modal-body">
                    <div class="row clearfix">
                        <div class="col-sm-12">
                            <div class="form-group c_form_group">
                                <label>Kode Jabatan <span class="text-danger">*</span></label>
                                <input type="text" name="kode" id="kode" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group c_form_group">
                                <label>Nama Jabatan<span class="text-danger">*</span></label>
                                <input type="text" name="jabatan" id="jabatan" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="saveBtn" class="btn btn-round btn-primary">Simpan</button>
                    <button type="button" class="btn btn-round btn-default" data-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://www.jqueryscript.net/demo/clean-simple-modal/dist/js/jquery.simple-modal.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table = $('#tabel_jabatan').DataTable({
            "pageLength": 5,
            "ajax": {
                "url": "{!!action('JabatanController@index')!!}",
                "dataSrc": ""
            },
            "columns": [{
                    data: "no"
                },
                {
                    data: "kode"
                },
                {
                    data: "jabatan"
                },
                {
                    data: "menu"
                },

            ],
            "bSort": false,
            stateSave: true,
            columnDefs: [{
                className: 'text-center',
                targets: [1]
            }, ]
        });

        $('#createNewJabatan').click(function() {
            $('#saveBtn').val("create-Customer");
            $('#pegawai_id').val('');
            $('#JabatanForm').trigger("reset");
            $('#myLargeModalLabel').html("Tambah Jabatan");
            $('#AddJabatan').modal('show');
        });

        $('body').on('click', '.editJabatan', function() {
            var jabatan_id = $(this).data('id');
            console.log(jabatan_id);
            $.get("" + '/jabatans/' + jabatan_id + '/edit', function(data) {
                $('#myLargeModalLabel').html("Edit Jabatan");
                $('#saveBtn').val("edit-jabatan");
                $('#AddJabatan').modal('show');
                $('#jabatan_id').val(data.id);
                $('#kode').val(data.kode_jabatan);
                $('#jabatan').val(data.jabatan_nama);
            })
        });

        $('#saveBtn').click(function(e) {
            e.preventDefault();
            $(this).html('Sending..');

            $.ajax({
                data: $('#JabatanForm').serialize(),
                url: "{!!action('JabatanController@store')!!}",
                type: "POST",
                dataType: 'json',
                success: function(data) {

                    $('#JabatanForm').trigger("reset");
                    $('#AddJabatan').modal('hide');
                    table.ajax.reload(null, false);

                },
                error: function(data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Save Changes');
                }
            });
        });


        $(document).on('click', '.deleteJabatan', function() {
            if (confirm('Are you sure delete this data?')) {
                var id = $(this).data('id');
                $.ajax({
                    url: "jabatans/delete/" + id,
                    dataType: "JSON",
                    type: 'DELETE',
                    data: {
                        '_token': $('meta[name=csrf-token]').attr("content"),
                    },
                    success: function(data) {
                        table.ajax.reload(null, false);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error deleting data');
                    }
                });

            }
        });

    });
</script>
@endpush