<div>
    <div class="card">
        <div class="card-header">
            <div class="d-flex flex-wrap justify-content-sm-start justify-content-lg-between">
                <div class="form-group form-inline m-0">
                    <label class="mr-2">Kategori Mapel</label>
                    <select class="form-control" wire:model.lazy="filter.id_kategori_mapel">
                        <option value="0">Semua</option>
                        @foreach ($listKategoriMapel as $item)
                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <button wire:click="create" class="btn btn-info">
                    <span class="fas fa-plus mr-2"></span>Mata Pelajaran Baru
                </button>
            </div>

        </div>
        <div class="card-body">
            <x-data-table :items="$items">
                <x-slot name="header">
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Dibuat Pada</th>
                    <th>Aksi</th>
                </x-slot>
                @foreach ($items as $item)
                <tr>
                    <td>{{ ($items->currentPage()-1) * $items->perPage() + $loop->iteration }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->kategori->nama }}</td>
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
                    <td class="text-center" colspan="5">Data tidak ditemukan</td>
                </tr>
                @endif
            </x-data-table>
        </div>
        {{-- <div class="card-footer">
            <button wire:click="$emit('importExcel')" type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#import-excel"><i class="fa fa-file-upload"> Import</i></button>
            <button wire:click="export" type="button" class="btn btn-outline-info"><i class="fa fa-file-download"> Export</i></button>
        </div> --}}
    </div>
    @include('livewire.mata-pelajaran.form')
    <x-modal-delete model="Mata Pelajaran" :name="$nama" />
</div>

@push('scripts')
<script>
    window.livewire.on('formModal', () => $('#modal-form').modal('toggle'));
    window.livewire.on('deleteModal', () => $('#modal-delete').modal('toggle'));

</script>
@endpush
