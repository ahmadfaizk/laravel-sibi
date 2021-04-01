<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\WithAlert;
use App\Models\Kelas as KelasModel;
use App\Models\TahunAjaran;
use Livewire\Component;

class Kelas extends Component
{
    use WithAlert;

    public $kelas;
    public $nama;
    public $tingkat;
    public $id_tahun_ajaran;

    public $formTitle;
    public $search;
    public $perPage = 10;
    public $isUpdate = false;
    public $listTahunAjaran;

    public $filter = [
        'id_tahun_ajaran' => 0
    ];

    public $rules = [
        'nama' => 'required|string',
        'tingkat' => 'required|numeric',
        'id_tahun_ajaran' => 'required|numeric'
    ];

    public function mount(TahunAjaran $tahunAjaran)
    {
        $this->listTahunAjaran = $tahunAjaran->all();
        if ($this->listTahunAjaran->count() != 0) {
            $this->filter['id_tahun_ajaran'] = $this->listTahunAjaran[0]->id;
        }
    }

    public function render(KelasModel $kelas)
    {
        $items = $kelas->when($this->search, function ($query, $value) {
            return $query->where('nama', 'LIKE', '%' . $value . '%');
        })->when($this->filter['id_tahun_ajaran'], function ($query, $value) {
            return $query->where('id_tahun_ajaran', $value);
        })->orderBy('tingkat');

        return view('livewire.kelas.index', [
            'items' => $items->paginate($this->perPage)
        ]);
    }

    public function create()
    {
        $this->formTitle = 'Buat Kelas Baru';
        $this->resetInputFields();
        $this->isUpdate = false;
        $this->emit('formModal');
    }

    public function edit(KelasModel $kelas)
    {
        $this->formTitle = 'Edit Kelas';
        $this->kelas = $kelas;
        $this->nama = $kelas->nama;
        $this->tingkat = $kelas->tingkat;
        $this->isUpdate = true;
        $this->emit('formModal');
    }

    public function store()
    {
        $data = $this->validate();
        if ($this->isUpdate) {
            $this->kelas->update($data);
            $this->showSuccess('Berhasil mengubah kelas ' . $data['nama']);
        } else {
            KelasModel::create($data);
            $this->showSuccess('Berhasil menambahkan kelas ' . $data['nama']);
        }
        $this->emit('formModal');
    }

    public function delete(KelasModel $kelas)
    {
        $this->kelas = $kelas;
        $this->nama = $kelas->nama;
        $this->emit('deleteModal');
    }

    public function destroy()
    {
        $this->kelas->delete();
        $this->emit('deleteModal');
        $this->showSuccess('Berhasil menambahkan kelas ' . $this->nama);
    }

    private function resetInputFields()
    {
        $this->nama = null;
        $this->tingkat = 1;
        if ($this->listTahunAjaran->count() != 0) {
            $this->id_tahun_ajaran = $this->listTahunAjaran[0]->id;
        }
    }
}
