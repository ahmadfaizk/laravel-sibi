<div wire:ignore.self class="modal fade" id="modal-form" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form wire:submit.prevent="store">
                <div class="modal-header">
                    <h4 class="modal-title">{{ $formTitle }}</h4>
                </div>
                <div class="modal-body">
                    <h5>Biografi Siswa</h5>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input wire:model.lazy="form.nama_lengkap" type="text"
                                    class="form-control @error('form.nama_lengkap') is-invalid @enderror">
                                @error('form.nama_lengkap')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select class="form-control" wire:model.lazy="form.jenis_kelamin">
                                    <option>Laki-laki</option>
                                    <option>Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>No. NIS</label>
                                <input wire:model.lazy="form.nomor_nis" type="number"
                                    class="form-control @error('form.nomor_nis') is-invalid @enderror">
                                @error('form.nomor_nis')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>No. NISN</label>
                                <input wire:model.lazy="form.nomor_nisn" type="number"
                                    class="form-control @error('form.nomor_nisn') is-invalid @enderror">
                                @error('form.nomor_nisn')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Tempat Lahir</label>
                                <input wire:model.lazy="form.tempat_lahir" type="text"
                                    class="form-control @error('form.tempat_lahir') is-invalid @enderror">
                                @error('form.tempat_lahir')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <input wire:model.lazy="form.tgl_lahir" type="date"
                                    class="form-control @error('form.tgl_lahir') is-invalid @enderror">
                                @error('form.tgl_lahir')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Agama</label>
                                <select class="form-control" wire:model.lazy="form.agama">
                                    <option>Islam</option>
                                    <option>Kristen</option>
                                    <option>Budha</option>
                                    <option>Hindu</option>
                                </select>
                            </div>
                        </div>
                        {{-- <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Kelas</label>
                                <select class="form-control" wire:model.lazy="form.masuk_tingkat">
                                    @for ($i = 1; $i <= 6; $i++) <option>{{ $i }}</option>
                                        @endfor
                                </select>
                            </div>
                        </div> --}}
                        <div class="col-12">
                            <div class="form-group">
                                <label>Alamat Siswa</label>
                                <input wire:model.lazy="form.alamat_peserta_didik" type="text"
                                    class="form-control @error('form.alamat_peserta_didik') is-invalid @enderror">
                                @error('form.alamat_peserta_didik')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h5>Data Orangtua Siswa</h5>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Nama Ayah</label>
                                <input wire:model.lazy="form.nama_ayah" type="text"
                                    class="form-control @error('form.nama_ayah') is-invalid @enderror">
                                @error('form.nama_ayah')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Pekerjaan Ayah</label>
                                <input wire:model.lazy="form.pekerjaan_ayah" type="text"
                                    class="form-control @error('form.pekerjaan_ayah') is-invalid @enderror">
                                @error('form.pekerjaan_ayah')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Nama Ibu</label>
                                <input wire:model.lazy="form.nama_ibu" type="text"
                                    class="form-control @error('form.nama_ibu') is-invalid @enderror">
                                @error('form.nama_ibu')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Pekerjaan Ibu</label>
                                <input wire:model.lazy="form.pekerjaan_ibu" type="text"
                                    class="form-control @error('form.pekerjaan_ibu') is-invalid @enderror">
                                @error('form.pekerjaan_ibu')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Alamat Orangtua</label>
                                <input wire:model.lazy="form.alamat_orangtua" type="text"
                                    class="form-control @error('form.alamat_orangtua') is-invalid @enderror">
                                @error('form.alamat_orangtua')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Nama Wali</label>
                                <input wire:model.lazy="form.nama_wali" type="text"
                                    class="form-control @error('form.nama_wali') is-invalid @enderror">
                                @error('form.nama_wali')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Alamat Wali</label>
                                <input wire:model.lazy="form.alamat_wali" type="text"
                                    class="form-control @error('form.alamat_wali') is-invalid @enderror">
                                @error('form.alamat_wali')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Masuk Tahun Ajaran</label>
                                <select class="form-control" wire:model.lazy="form.id_ta_masuk">
                                    @foreach ($listTahunAjaran as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Pendidikan Sebelumnya</label>
                                <input wire:model.lazy="form.pendidikan_sebelumnya" type="text"
                                    class="form-control @error('form.pendidikan_sebelumnya') is-invalid @enderror">
                                @error('form.pendidikan_sebelumnya')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Masuk Tingkat</label>
                                <select class="form-control" wire:model.lazy="form.masuk_tingkat">
                                    @for ($i = 1; $i <= 6; $i++) <option>{{ $i }}</option>
                                        @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Status siswa</label>
                                <select class="form-control" wire:model.lazy="form.status">
                                    <option value="aktif">Aktif</option>
                                    <option value="alumni">Alumni</option>
                                    <option value="keluar">Keluar</option>
                                </select>
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
