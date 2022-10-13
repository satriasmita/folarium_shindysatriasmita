@extends('layouts.app')

@section('content')
<link href="https://www.jqueryscript.net/demo/clean-simple-modal/dist/css/jquery.simple-modal.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/css/dataTables.bootstrap4.min.css" />
<div class="container-fluid">
    <!-- Page header section  -->
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-lg-4 col-md-12 col-sm-12">
                <h1>Data Kontrak</h1>
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12 text-lg-right">
                <div class="d-flex align-items-center justify-content-md-end mt-4 mt-md-0 flex-wrap vivify pullUp delay-550">
                    <div class="mb-3 mb-xl-0">
                        <a class="btn btn-primary" href="javascript:void(0)" id="createNewKontrak"> Tambah Kontrak</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row clearfix">
        <div class="col-sm-12">
            <table class="table StandardTable" id="tabel_kontrak">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Kode Pegawai </th>
                        <th>Pegawai </th>
                        <th>Jabatan</th>
                        <th>Waktu Kontrak</th>
                        <th>Status Kontrak</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="AddKontrak" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myLargeModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="KontrakForm" name="KontrakForm" class="form-horizontal">
                <input type="hidden" name="kontrak_id" id="kontrak_id">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="row clearfix">
                        <div class="col-sm-12">
                            <div class="form-group c_form_group">
                                <label>Pegawai <span class="text-danger">*</span></label>
                                <select class="form-control show-tick" name="pegawai" id="pegawai">
                                    <option value="">- Select -</option>
                                    @foreach($pegawai as $pg)
                                    <option value="{{$pg->id}}">{{$pg->peg_nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group c_form_group">
                                <label>Jabatan <span class="text-danger">*</span></label>
                                <select class="form-control show-tick" name="jabatan" id="jabatan">
                                    <option value="">- Select -</option>
                                    @foreach($jabatan as $jbt)
                                    <option value="{{$jbt->jabatan_id}}">{{$jbt->jabatan_nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group c_form_group">
                                <label>Awal Kontrak<span class="text-danger">*</span></label>
                                <input type="text" data-provide="datepicker" data-date-autoclose="true" name="awal" id="awal" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group c_form_group">
                                <label>Akhir Kontrak <span class="text-danger">*</span></label>
                                <input type="text" data-provide="datepicker" data-date-autoclose="true" name="akhir" id="akhir" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group c_form_group">
                                <label>Status <span class="text-danger">*</span></label>
                                <select class="form-control show-tick" name="status" id="status">
                                    <option value="">- Select -</option>
                                    <option value="Tidak Aktif">Tidak Aktif</option>
                                    <option value="Aktif">Aktif</option>
                                </select>
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

        var table = $('#tabel_kontrak').DataTable({
            "pageLength": 5,
            "ajax": {
                "url": "{!!action('KontrakController@index')!!}",
                "dataSrc": ""
            },
            "columns": [{
                    data: "no"
                },
                {
                    data: "kode"
                },
                {
                    data: "nama"
                },
                {
                    data: "jabatan"
                },
                {
                    data: "waktu"
                },
                {
                    data: "status"
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

        $('#createNewKontrak').click(function() {
            $('#saveBtn').val("create-Kontrak");
            $('#kontrak_id').val('');
            $('#KontrakForm').trigger("reset");
            $('#myLargeModalLabel').html("Tambah Kontrak");
            $('#AddKontrak').modal('show');
        });

        $('body').on('click', '.editKontrak', function() {
            var Kontrak_id = $(this).data('id');
            $.get("" + '/kontraks/' + Kontrak_id + '/edit', function(data) {
                $('#myLargeModalLabel').html("Edit Kontrak");
                $('#saveBtn').val("edit-kontrak");
                $('#AddKontrak').modal('show');
                $('#kontrak_id').val(data.id);
                $('#pegawai').val(data.pegawai_id);
                $('#jabatan').val(data.id_jabatan);
                $('#awal').val(data.kontrak_awal);
                $('#akhir').val(data.kontrak_akhir);
                $('#status').val(data.kontrak_status);
            })
        });

        $('#saveBtn').click(function(e) {
            e.preventDefault();
            $(this).html('Sending..');

            $.ajax({
                data: $('#KontrakForm').serialize(),
                url: "{!!action('KontrakController@store')!!}",
                type: "POST",
                dataType: 'json',
                success: function(data) {

                    $('#KontrakForm').trigger("reset");
                    $('#AddKontrak').modal('hide');
                    table.ajax.reload(null, false);

                },
                error: function(data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Save Changes');
                }
            });
        });


        $(document).on('click', '.deleteKontrak', function() {
            if (confirm('Are you sure delete this data?')) {
                var id = $(this).data('id');
                $.ajax({
                    url: "kontak/delete/" + id,
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