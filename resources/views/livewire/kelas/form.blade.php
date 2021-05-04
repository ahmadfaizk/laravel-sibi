<div wire:ignore.self class="modal fade" id="modal-form" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form wire:submit.prevent="store">
                <div class="modal-header">
                    <h4 class="modal-title">{{ $formTitle }}</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Tahun Ajaran</label>
                                        <select class="form-control" wire:model.lazy="id_tahun_ajaran">
                                            @foreach ($listTahunAjaran as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Nama Kelas</label>
                                        <input wire:model.lazy="nama" type="text"
                                            class="form-control @error('nama') is-invalid @enderror"
                                            placeholder="Masukkan Nama Kelas">
                                        @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Tingkat</label>
                                        <select class="form-control" wire:model.lazy="tingkat">
                                            @for ($i = 1; $i <= 6; $i++) <option>{{ $i }}</option>
                                                @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Daftar Mata Pelajaran</label>
                                @foreach ($listMapel as $mapel)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $mapel->id }}"
                                        wire:model="mapel">
                                    <label class="form-check-label">{{ $mapel->nama }}</label>
                                </div>
                                @endforeach
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
