<div>
    <div class="card">
        <div class="card-header text-right">
            <button wire:click="create" class="btn btn-info"><span class="fas fa-plus mr-2"></span>Kelas
                Baru</button>
        </div>
        <div class="card-body">
            <x-data-table :items="$items">
                <x-slot name="header">
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Tingkat</th>
                    <th>Aksi</th>
                </x-slot>
                @foreach ($items as $item)
                <tr>
                    <td>{{ ($items->currentPage()-1) * $items->perPage() + $loop->iteration }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->tingkat }}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Action button">
                            <button type="button"
                                class="btn btn-primary btn-sm"><i class="fas fa-eye"></i>
                                Lihat</button>
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
