<div>
    <div class="card">
        <div class="card-header">
            <div class="d-flex flex-wrap justify-content-sm-start justify-content-lg-between">
                <div class="d-flex flex-wrap align-items-center">
                    <div class="form-group form-inline m-0 pr-2">
                        <label class="mr-2">Tahun Ajaran</label>
                        <select class="form-control" wire:model.lazy="idTahunAjaran">
                            @foreach ($listTahunAjaran as $item)
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group form-inline m-0">
                        <label class="mr-2">Kelas</label>
                        <select class="form-control" wire:model.lazy="idKelas">
                            @foreach ($listKelas as $item)
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <x-data-table :items="$items">
                <x-slot name="header">
                    <th>No.</th>
                    <th>No. NIS</th>
                    <th>Nama Lengkap</th>
                    <th>Dibuat Pada</th>
                    <th>Aksi</th>
                </x-slot>
                @foreach ($items as $item)
                <tr>
                    <td>{{ ($items->currentPage()-1) * $items->perPage() + $loop->iteration }}</td>
                    <td>{{ $item->nomor_nis }}</td>
                    <td>{{ $item->nama_lengkap }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Action button">
                            <button wire:click="edit({{ $item->id }}, 1)" type="button"
                                class="btn btn-warning btn-sm"><i class="fas fa-edit"></i>
                                Edit</button>
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
    </div>
    @include('livewire.raport.form')
</div>

@push('scripts')
<script>
    window.livewire.on('formModal', () => $('#modal-form').modal('toggle'));

</script>
@endpush
