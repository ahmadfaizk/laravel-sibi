<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\WithAlert;
use App\Models\KategoriMapel;
use App\Models\MataPelajaran as MataPelajaranModel;
use Livewire\Component;
use Livewire\WithPagination;

class MataPelajaran extends Component
{
    use WithAlert;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $mataPelajaran;
    public $nama;
    public $id_kategori_mapel;

    public $formTitle;
    public $search;
    public $perPage = 10;
    public $isUpdate = false;
    public $listKategoriMapel;

    public $filter = [
        'id_kategori_mapel' => 0
    ];

    public $rules = [
        'nama' => 'required|string',
        'id_kategori_mapel' => 'required|numeric'
    ];

    public function mount(KategoriMapel $kategoriMapel)
    {
        $this->listKategoriMapel = $kategoriMapel->all();
    }

    public function render(MataPelajaranModel $mataPelajaran)
    {
        $items = $mataPelajaran->when($this->search, function ($query, $value) {
            return $query->where('nama', 'LIKE', '%' . $value . '%');
        })->when($this->filter['id_kategori_mapel'], function ($query, $value) {
            return $query->where('id_kategori_mapel', $value);
        });

        return view('livewire.mata-pelajaran.index', [
            'items' => $items->paginate($this->perPage)
        ]);
    }

    public function create()
    {
        $this->formTitle = 'Buat Mata Pelajaran Baru';
        $this->resetInputFields();
        $this->isUpdate = false;
        $this->emit('formModal');
    }

    public function edit(MataPelajaranModel $mataPelajaran)
    {
        $this->formTitle = 'Edit Mata Pelajaran';
        $this->mataPelajaran = $mataPelajaran;
        $this->nama = $mataPelajaran->nama;
        $this->id_kategori_mapel = $mataPelajaran->id_kategori_mapel;
        $this->isUpdate = true;
        $this->emit('formModal');
    }

    public function store()
    {
        $data = $this->validate();
        if ($this->isUpdate) {
            $this->mataPelajaran->update($data);
            $this->showSuccess('Berhasil mengubah mata pelajaran ' . $data['nama']);
        } else {
            MataPelajaranModel::create($data);
            $this->showSuccess('Berhasil menambahkan mata pelajaran ' . $data['nama']);
        }
        $this->emit('formModal');
    }

    public function delete(MataPelajaranModel $mataPelajaran)
    {
        $this->mataPelajaran = $mataPelajaran;
        $this->nama = $mataPelajaran->nama;
        $this->emit('deleteModal');
    }

    public function destroy()
    {
        $this->mataPelajaran->delete();
        $this->emit('deleteModal');
        $this->showSuccess('Berhasil menambahkan mata pelajaran ' . $this->nama);
    }

    private function resetInputFields()
    {
        $this->nama = null;
        if ($this->listKategoriMapel->count() != 0) {
            $this->id_kategori_mapel = $this->listKategoriMapel[0]->id;
        }
    }
}
