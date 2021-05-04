<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\WithAlert;
use App\Models\KategoriMapel as KategoriMapelModel;
use Livewire\Component;
use Livewire\WithPagination;

class KategoriMapel extends Component
{
    use WithAlert;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $kategoriMapel;
    public $nama;

    public $formTitle;
    public $search;
    public $perPage = 10;
    public $isUpdate = false;

    public $rules = [
        'nama' => 'required|string',
    ];

    public function render(KategoriMapelModel $kategoriMapel)
    {
        $items = $kategoriMapel->when($this->search, function($query, $value) {
            return $query->where('nama', 'ILIKE', '%'.$value.'%');
        });
        return view('livewire.kategori-mapel.index', [
            'items' => $items->paginate($this->perPage)
        ]);
    }

    public function create()
    {
        $this->formTitle = 'Buat Kategori Mapel Baru';
        $this->resetInputFields();
        $this->isUpdate = false;
        $this->emit('formModal');
    }

    public function edit(KategoriMapelModel $kategoriMapel)
    {
        $this->formTitle = 'Edit Kategori Mapel';
        $this->kategoriMapel = $kategoriMapel;
        $this->nama = $kategoriMapel->nama;
        $this->isUpdate = true;
        $this->emit('formModal');
    }

    public function store()
    {
        $data = $this->validate();
        if ($this->isUpdate) {
            $this->kategoriMapel->update($data);
            $this->showSuccess('Berhasil mengubah kategori mapel ' . $data['nama']);
        } else {
            KategoriMapelModel::create($data);
            $this->showSuccess('Berhasil menambahkan kategori mapel ' . $data['nama']);
        }
        $this->emit('formModal');
    }

    public function delete(KategoriMapelModel $kategoriMapel)
    {
        $this->kategoriMapel = $kategoriMapel;
        $this->nama = $kategoriMapel->nama;
        $this->emit('deleteModal');
    }

    public function destroy()
    {
        $this->kategoriMapel->delete();
        $this->emit('deleteModal');
        $this->showSuccess('Berhasil menghapus kategori mapel ' . $this->nama);
    }

    private function resetInputFields()
    {
        $this->nama = null;
    }
}
