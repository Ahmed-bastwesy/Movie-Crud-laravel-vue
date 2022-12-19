    <form class="d-inline p-0" id="dood" action="{{ $route }}" method="POST">
        @csrf
        @method('delete')
        <button class="btn btn-icon btn-active-color-danger btn-sm me-1 show-alert-delete-box" type="submit"
            data-toggle="tooltip" title=@lang('Remove')><i class="fa-solid fa-trash fs-2x"></i> </button>
    </form>

    @push('scripts')
        <script type="text/javascript">
            $('.show-alert-delete-box').click(function(event) {
                var form = $(this).closest("form");
                var name = $(this).data("name");
                event.preventDefault();
                Swal.fire({
                    title: @json(__('Are you sure?')),
                    text: @json(__("You won't be able to revert this!")),
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: @json(__('Yes, delete it!')),
                    cancelButtonText: @json(__('Cancel'))
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire(
                            @json(__('Deleted!')),
                            @json(__('deleted process...')),
                            'success'
                        )
                        form.submit();
                    }
                })
            });
        </script>
    @endpush
