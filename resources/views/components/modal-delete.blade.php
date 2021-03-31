<div>
    <div wire:ignore.self class="modal fade" id="modal-delete" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Peringatan!</h4>
                </div>
                <div class="modal-body">
                    <h5>Apakah anda yakin akan menghapus {{ $model }} {{ $name }} ?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button wire:click="destroy" type="button" class="btn btn-danger">Hapus</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    window.livewire.on('deleteModal', () => $('#modal-delete').modal('toggle'));
</script>
@endpush
