<div wire:ignore.self class="modal fade" id="modal-form" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form wire:submit.prevent="store">
                <div class="modal-header">
                    <h4 class="modal-title">{{ $formTitle }}</h4>
                </div>
                <div class="modal-body">
                    <h5>Nilai Akademik</h5>
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Mata Pelajaran</th>
                                <th>Nilai Ketrampilan</th>
                                <th>Nilai Pengetahuan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($listMapel as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>
                                    <input wire:model="nilaiKetrampilan.{{$item->id}}" type="number" class="form-control">
                                </td>
                                <td>
                                    <input wire:model="nilaiPengetahuan.{{$item->id}}" type="number" class="form-control">
                                </td>
                            </tr>
                            @endforeach
                            @if (count($listMapel) == 0)
                            <tr>
                                <td class="text-center" colspan="3">Mapel masih kosong</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    <h5>Nilai Ekstrakurikuler</h5>
                    <div class="input-group">
                        <select wire:model.lazy="idEkstrakurikuler" class="form-control" data-placeholder="Pilih ekstrakurikuler">
                            @foreach ($listEksrakurikuler as $item)
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                        <div class="input-group-append">
                            <button wire:click="addEkstrakurikuler" type="button" class="btn btn-primary">Tambahkan</button>
                        </div>
                    </div>
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Ekstrakurikuler</th>
                                <th>Nilai</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($nilaiEkstrakurikuler as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item['nama'] }}</td>
                                <td>
                                    <div class="form-group">
                                        <select class="form-control" wire:model.lazy="nilaiEkstrakurikuler.{{ $loop->index }}.predikat">
                                            <option>A</option>
                                            <option>B</option>
                                            <option>C</option>
                                            <option>D</option>
                                            <option>E</option>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <button wire:click="deleteEkstrakurikuler({{$loop->index}})" type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>
                                        Hapus</button>
                                </td>
                            </tr>
                            @endforeach
                            @if (count($nilaiEkstrakurikuler) == 0)
                            <tr>
                                <td class="text-center" colspan="4">Ekstrakurikuler masih kosong</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    <h5>Prestasi</h5>
                    <table class="table table-hover text-nowrap mb-2">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kegiatan</th>
                                <th>Keterangan</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($listPrestasi as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <input wire:model="listPrestasi.{{$loop->index}}.kegiatan" type="text" class="form-control">
                                </td>
                                <td>
                                    <input wire:model="listPrestasi.{{$loop->index}}.keterangan" type="text" class="form-control">
                                </td>
                                <td>
                                    <button wire:click="deletePrestasi({{ $loop->index }})" type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>
                                        Hapus</button>
                                </td>
                            </tr>
                            @endforeach
                            @if (count($listPrestasi) == 0)
                            <tr>
                                <td class="text-center" colspan="4">Prestasi masih kosong</td>
                            </tr>
                            @endif
                            <tr>
                                <td class="text-right" colspan="4">
                                    <button wire:click="addPrestasi" type="button" class="btn btn-primary">Tambah Prestasi</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <h5>Ketidakhadiran</h5>
                    <table>
                        <tbody>
                            <tr>
                                <td>Sakit</td>
                                <td>
                                    <input wire:model.lazy="ketidakhadiran.sakit" type="number" class="form-control">
                                </td>
                            </tr>
                            <tr>
                                <td>Izin</td>
                                <td>
                                    <input wire:model.lazy="ketidakhadiran.izin" type="number" class="form-control">
                                </td>
                            </tr>
                            <tr>
                                <td>Tanpa Keterangan</td>
                                <td>
                                    <input wire:model.lazy="ketidakhadiran.tanpa_keterangan" type="number" class="form-control">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
