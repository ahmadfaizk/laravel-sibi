<div>
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div class="form-group form-inline m-0">
                    <label class="mr-2">Tahun Ajaran</label>
                    <select class="form-control" wire:model.lazy="filter.id_tahun_ajaran">
                        @foreach ($listTahunAjaran as $item)
                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <button wire:click="create" class="btn btn-info">
                    <span class="fas fa-plus mr-2"></span>KelasBaru
                </button>
            </div>

        </div>
        <div class="card-body">
            <x-data-table :items="$items">
                <x-slot name="header">
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Tingkat</th>
                    <th>Dibuat Pada</th>
                    <th>Aksi</th>
                </x-slot>
                @foreach ($items as $item)
                <tr>
                    <td>{{ ($items->currentPage()-1) * $items->perPage() + $loop->iteration }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->tingkat }}</td>
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
            </x-data-table>
        </div>
        {{-- <div class="card-footer">
            <button wire:click="$emit('importExcel')" type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#import-excel"><i class="fa fa-file-upload"> Import</i></button>
            <button wire:click="export" type="button" class="btn btn-outline-info"><i class="fa fa-file-download"> Export</i></button>
        </div> --}}
    </div>
    @include('livewire.kelas.form')
    <x-modal-delete model="Kelas" :name="$nama" />
</div>

@push('scripts')
<script>
    window.livewire.on('formModal', () => $('#modal-form').modal('toggle'));
    window.livewire.on('deleteModal', () => $('#modal-delete').modal('toggle'));

</script>
@endpush
