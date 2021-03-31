<div>
    <div class="d-flex flex-wrap justify-content-between align-items-center">
        <div class="form-group form-inline">
            <span class="font-weight-normal">Menampilkan</span>
            <select wire:model="perPage" class="custom-select custom-select-sm ml-2 mr-2">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
            <span class="font-weight-normal">data</span>
        </div>
        <div class="input-group" style="width: 250px;">
            <input wire:model="search" type="text" class="form-control form-control-sm float-right"
                placeholder="Search">
            <div class="input-group-append">
                <button type="submit" class="btn btn-default btn-sm"><i class="fas fa-search"></i></button>
            </div>
        </div>
    </div>
    <div class="table-responsive mt-2">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    {{ $header }}
                </tr>
            </thead>
            <tbody>
               {{ $slot }}
            </tbody>
        </table>
    </div>
    <div class="d-flex flex-wrap justify-content-between align-items-center">
        <div class="font-weight-normal">Menampilkan
            <b>{{ $items->count() }}</b> dari <b>{{ $items->total() }}</b> data</div>
        {{ $items->links() }}
    </div>
</div>
