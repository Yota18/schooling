
@if (request()->routeIs('jabatan.add'))
    <?php 
    $text = "Menghapus kategori ini akan juga menghapus Berita yang berkaitan!";
    ?>
@else
    <?php 
    $text = "Anda tidak akan dapat mengembalikan data ini!";
    ?>
@endif

<script>
    {{ \Request::url() }}
    function delete_data(id,url1) {
        var url = "{{url('/'. \Request::segment(1) .'/')}}/"+url1;
        var _token = "{{ csrf_token() }}";
        Swal.fire({
            title: 'Apakah kamu yakin?',
            text: "{{ $text }}",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url+"/"+id,
                    type:'DELETE',
                    data: {_token:_token},
                    dataType: 'JSON',
                    success: function(data) {
                        table.ajax.reload();
                        if (data.status == 'success') {
                            Swal.fire(
                                'Terhapus!',
                                data.message,
                                'success'
                            )
                        } else {
                            Swal.fire(
                                'Gagal!',
                                data.message,
                                'error'
                            )
                        }
                    },
                    error: function (ajaxContext) {
                        Swal.fire(
                            'Oops...',
                            'Tindakan yang anda minta tidak diizinkan.',
                            'error',
                        )
                    }
                });
            }
        })
    };
</script>
