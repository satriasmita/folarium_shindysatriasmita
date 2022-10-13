@extends('layouts.app')

@section('content')
<link href="https://www.jqueryscript.net/demo/clean-simple-modal/dist/css/jquery.simple-modal.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/css/dataTables.bootstrap4.min.css" />
<div class="container-fluid">
    <!-- Page header section  -->
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-lg-4 col-md-12 col-sm-12">
                <h1>Data Pegawai</h1>
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12 text-lg-right">
                <div class="d-flex align-items-center justify-content-md-end mt-4 mt-md-0 flex-wrap vivify pullUp delay-550">
                    <div class="mb-3 mb-xl-0">
                        <a class="btn btn-primary" href="javascript:void(0)" id="createNewpegawai"> Tambah Pegawai</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row clearfix">
        <div class="col-sm-12">
            <table class="table StandardTable" id="tabel_pegawai">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nip Pegawai </th>
                        <th>Nama Pegawai </th>
                        <th>Tempat/Tanggal Lahir</th>
                        <th>Pendidikan</th>
                        <th>Jenis Kelmain</th>
                        <th>Agama</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="AddPegawai" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myLargeModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="PegawaiForm" name="PegawaiForm" class="form-horizontal">
                <input type="hidden" name="pegawai_id" id="pegawai_id">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="row clearfix">
                        <div class="col-sm-12">
                            <div class="form-group c_form_group">
                                <label>Nip Pegawai <span class="text-danger">*</span></label>
                                <input type="text" name="nip" id="nip" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group c_form_group">
                                <label>Nama Lengkap<span class="text-danger">*</span></label>
                                <input type="text" name="nama" id="nama" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group c_form_group">
                                <label>Tempat Lahir <span class="text-danger">*</span></label>
                                <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group c_form_group">
                                <label>Tanggal Lahir <span class="text-danger">*</span></label>
                                <input type="text" data-provide="datepicker" data-date-autoclose="true" name="tanggal_lahir" id="tanggal_lahir" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group c_form_group">
                                <label>Jenis Kelamin <span class="text-danger">*</span></label>
                                <select class="form-control show-tick" name="jk" id="jk">
                                    <option value="">- Select -</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group c_form_group">
                                <label>Agama <span class="text-danger">*</span></label>
                                <select class="form-control show-tick" name="agama" id="agama">
                                    <option value="">- Select -</option>
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Budha">Budha</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group c_form_group">
                                <label>Pendidikan <span class="text-danger">*</span></label>
                                <input type="text" name="pendidikan" id="pendidikan" class="form-control">
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

        var table = $('#tabel_pegawai').DataTable({
            "pageLength": 5,
            "ajax": {
                "url": "{!!action('PegawaiController@index')!!}",
                "dataSrc": ""
            },
            "columns": [{
                    data: "no"
                },
                {
                    data: "nip"
                },
                {
                    data: "nama"
                },
                {
                    data: "lahir"
                },
                {
                    data: "pddk"
                },
                {
                    data: "jk"
                },
                {
                    data: "agama"
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
            }, ],
            "fnDrawCallback": function(oSettings) {
                $('.edit').on('click', function() {

                    $().simpleModal({
                        size: 'large',
                        content: '<form method="post" autocomplete="off"></form>'
                    });
                })
            }
        });

        $('#createNewpegawai').click(function() {
            $('#saveBtn').val("create-Customer");
            $('#pegawai_id').val('');
            $('#PegawaiForm').trigger("reset");
            $('#myLargeModalLabel').html("Tambah Peagawai");
            $('#AddPegawai').modal('show');
        });

        $('body').on('click', '.editPegawai', function() {
            var pegawai_id = $(this).data('id');
            console.log(pegawai_id);
            $.get("" + '/pegawais/' + pegawai_id + '/edit', function(data) {
                $('#myLargeModalLabel').html("Edit Pegawai");
                $('#saveBtn').val("edit-user");
                $('#AddPegawai').modal('show');
                $('#pegawai_id').val(data.id);
                $('#nip').val(data.peg_nik);
                $('#nama').val(data.peg_nama);
                $('#tempat_lahir').val(data.peg_tempatlahir);
                $('#tanggal_lahir').val(data.peg_tanggallahir);
                $('#jk').val(data.peg_jk);
                $('#agama').val(data.peg_agama);
                $('#pendidikan').val(data.peg_pendidikan);
            })
        });

        $('#saveBtn').click(function(e) {
            e.preventDefault();
            $(this).html('Sending..');

            $.ajax({
                data: $('#PegawaiForm').serialize(),
                url: "{!!action('PegawaiController@store')!!}",
                type: "POST",
                dataType: 'json',
                success: function(data) {

                    $('#PegawaiForm').trigger("reset");
                    $('#AddPegawai').modal('hide');
                    table.ajax.reload(null, false);

                },
                error: function(data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Save Changes');
                }
            });
        });


        $(document).on('click', '.deletePegawai', function() {
            if (confirm('Are you sure delete this data?')) {
                var id = $(this).data('id');
                $.ajax({
                    url: "pegawai/delete/" + id,
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