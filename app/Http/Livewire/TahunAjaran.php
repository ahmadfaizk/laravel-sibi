<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\WithAlert;
use App\Models\TahunAjaran as TahunAjaranModel;
use Livewire\Component;
use Livewire\WithPagination;

class TahunAjaran extends Component
{
    use WithAlert;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $tahunAjaran;
    public $nama;
    public $tahun_awal;
    public $tahun_akhir;

    public $formTitle;
    public $search;
    public $perPage = 10;
    public $isUpdate = false;

    public $rules = [
        'tahun_awal' => 'required|numeric',
        'tahun_akhir' => 'required|numeric',
    ];

    public function render(TahunAjaranModel $tahunAjaran)
    {
        $items = $tahunAjaran->when($this->search, function ($query, $value) {
            return $query->where('tahun_awal', 'LIKE', '%' . $value . '%')
                ->orWhere('tahun_akhir', 'LIKE', '%' . $value . '%');
        });

        return view('livewire.tahun-ajaran.index', [
            'items' => $items->paginate($this->perPage)
        ]);
    }

    public function create()
    {
        $this->formTitle = 'Buat Tahun Ajaran Baru';
        $this->resetInputFields();
        $this->isUpdate = false;
        $this->emit('formModal');
    }

    public function edit(TahunAjaranModel $tahunAjaran)
    {
        $this->formTitle = 'Edit Tahun Ajaran';
        $this->tahunAjaran = $tahunAjaran;
        $this->tahun_awal = $tahunAjaran->tahun_awal;
        $this->tahun_akhir = $tahunAjaran->tahun_akhir;
        $this->isUpdate = true;
        $this->emit('formModal');
    }

    public function store()
    {
        $data = $this->validate();
        if ($this->isUpdate) {
            $this->tahunAjaran->update($data);
            $this->showSuccess('Berhasil mengubah tahun ajaran ' . $this->tahunAjaran->nama);
        } else {
            $this->tahunAjaran = TahunAjaranModel::create($data);
            $this->showSuccess('Berhasil menambahkan tahun ajaran ' . $this->tahunAjaran->nama);
        }
        $this->emit('formModal');
    }

    public function delete(TahunAjaranModel $tahunAjaran)
    {
        $this->tahunAjaran = $tahunAjaran;
        $this->nama = $tahunAjaran->nama;
        $this->emit('deleteModal');
    }

    public function destroy()
    {
        $this->tahunAjaran->delete();
        $this->emit('deleteModal');
        $this->showSuccess('Berhasil menambahkan tahun ajaran ' . $this->tahunAjaran->nama);
    }

    private function resetInputFields()
    {
        $this->tahun_awal = null;
        $this->tahun_akhir = null;
    }
}
