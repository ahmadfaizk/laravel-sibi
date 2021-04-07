<div wire:ignore.self class="modal fade" id="modal-form" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <form wire:submit.prevent="store">
                <div class="modal-header">
                    <h4 class="modal-title">{{ $formTitle }}</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Nama Kategori Mapel</label>
                                <input wire:model.lazy="nama" type="text" class="form-control @error('nama') is-invalid @enderror">
                                @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
