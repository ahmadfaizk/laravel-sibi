<?php

namespace App\Http\Livewire;

use App\Models\Kelas as KelasModel;
use Livewire\Component;

class Kelas extends Component
{
    public $kelas;
    public $nama;
    public $tingkat;

    public $formTitle;
    public $search;
    public $perPage = 10;
    public $isUpdate = false;

    public $rules = [
        'nama' => 'required|string',
        'tingkat' => 'required|numeric',
    ];

    public function render(KelasModel $kelas)
    {
        return view('livewire.kelas.index', [
            'items' => $kelas->paginate($this->perPage)
        ]);
    }

    public function create() {
        $this->formTitle = 'Buat Kelas Baru';
        $this->resetInputFields();
        $this->isUpdate = false;
        $this->emit('formModal');
    }

    public function edit(KelasModel $kelas) {
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
        } else {
            KelasModel::create($data);
        }
        $this->emit('formModal');
    }

    public function delete(KelasModel $kelas) {
        $this->kelas = $kelas;
        $this->nama = $kelas->nama;
        $this->emit('deleteModal');
    }

    public function destroy() {
        $this->kelas->delete();
        $this->emit('deleteModal');
    }

    private function resetInputFields() {
        $this->nama = null;
        $this->tingkat = 1;
    }
}
