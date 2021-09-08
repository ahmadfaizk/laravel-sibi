<div>
    <div class="card">
        <div class="card-header">
            <div class="d-flex flex-wrap justify-content-sm-start justify-content-lg-between">
                <div class="form-group form-inline m-0">
                    <label class="mr-2">Tahun Ajaran</label>
                    <select class="form-control" wire:model.lazy="filter.id_tahun_ajaran">
                        @foreach ($listTahunAjaran as $item)
                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <button wire:click="create" class="btn btn-info">
                    <span class="fas fa-plus mr-2"></span>Kelas Baru
                </button>
            </div>
        </div>
        <div class="card-body">
            <x-data-table :items="$items">
                <x-slot name="header">
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Tingkat</th>
                    <th>Jumlah Siswa</th>
                    <th>Jumlah Pelajaran</th>
                    <th>Dibuat Pada</th>
                    <th>Aksi</th>
                </x-slot>
                @foreach ($items as $item)
                <tr>
                    <td>{{ ($items->currentPage()-1) * $items->perPage() + $loop->iteration }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->tingkat }}</td>
                    <td>{{ $item->siswa()->count() }}</td>
                    <td>{{ $item->mapel()->count() }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Action button">
                            <button wire:click="edit({{ $item->id }})" type="button"
                                class="btn btn-warning btn-sm"><i class="fas fa-edit"></i>
                                Edit</button>
                            <button wire:click="delete({{ $item->id }})" type="button"
                                class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>
                                Hapus</button>
                        </div>
                    </td>
                </tr>
                @endforeach
                @if (count($items) == 0)
                <tr>
                    <td class="text-center" colspan="7">Data tidak ditemukan</td>
                </tr>
                @endif
            </x-data-table>
        </div>
    </div>
    @include('livewire.kelas.form')
    <x-modal-delete model="Kelas" :name="$nama" />
</div>

@push('styles')
<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
<script>
    // $(document).ready(function () {
    //     $('#select2').select2();
    //     $('#select2').on('change', function (e) {
    //         var data = $('#select2').select2('val');
    //         @this.set('siswa', data);
    //     });
    //     $('#form-modal').on('show.bs.modal', function () {
    //         var siswa = @this.siswa;
    //         $('#select2').select2().val(siswa).trigger('change');
    //     });
    // });
    window.livewire.on('formModal', () => $('#modal-form').modal('toggle'));
    window.livewire.on('deleteModal', () => $('#modal-delete').modal('toggle'));

</script>
@endpush
