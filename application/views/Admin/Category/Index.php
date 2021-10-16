<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-md-12">
            <span class="pull-right"><button class="btn btn-secondary btn-sm" id="TambahCategory">
                    <li class="fa fa-plus"></li> Tambah Category
                </button></span>
        </div>
    </div>
    <div class="row mb-4">
        <table id="example1" class="table table-striped table-hover" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Keterangan</th>
                    <th>Option</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    var table
    var url = window.location.href
    $(() => {
        let csrfHash = $('#txt_csrfname').val(); // CSRF hash
        table = $('#example1').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "searching": true,
            "ajax": {
                "url": url + '/Listdatakategori',
                "type": "POST",
                "data": function(data) {
                    data.csrf_test_name = csrfHash
                    // console.log(data.data)
                }
            },
            "columnDefs": [{
                "targets": [0],
                "orderable": false,
            }]
        })
        table.on('xhr.dt', function(e, settings, json, xhr) {
            csrfHash = json.<?= $this->security->get_csrf_token_name(); ?>;
        });
    })
</script>
<!-- JS Modal -->
<script type="text/javascript">
$('#TambahCategory').click(function(){
    $('#exampleModal').modal('show')
})
</script>
<!-- Modal Add -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>  