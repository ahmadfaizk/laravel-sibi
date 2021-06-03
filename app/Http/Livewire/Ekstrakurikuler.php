<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\WithAlert;
use App\Models\Ekstrakurikuler as EkstrakurikulerModel;
use Livewire\Component;
use Livewire\WithPagination;

class Ekstrakurikuler extends Component
{
    use WithAlert;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $ekstrakurikuler;
    public $nama;

    public $formTitle;
    public $search;
    public $perPage = 10;
    public $isUpdate = false;

    public $rules = [
        'nama' => 'required|string',
    ];

    public function render(EkstrakurikulerModel $ekstrakurikuler)
    {
        $items = $ekstrakurikuler->when($this->search, function($query, $value) {
            return $query->where('nama', 'LIKE', '%'.$value.'%');
        });
        return view('livewire.ekstrakurikuler.index', [
            'items' => $items->paginate($this->perPage)
        ]);
    }

    public function create()
    {
        $this->formTitle = 'Buat Ekstrakurikuler Baru';
        $this->resetInputFields();
        $this->isUpdate = false;
        $this->emit('formModal');
    }

    public function edit(EkstrakurikulerModel $ekstrakurikuler)
    {
        $this->formTitle = 'Edit Ekstrakurikuler';
        $this->ekstrakurikuler = $ekstrakurikuler;
        $this->nama = $ekstrakurikuler->nama;
        $this->isUpdate = true;
        $this->emit('formModal');
    }

    public function store()
    {
        $data = $this->validate();
        if ($this->isUpdate) {
            $this->ekstrakurikuler->update($data);
            $this->showSuccess('Berhasil mengubah ekstrakurikuler ' . $data['nama']);
        } else {
            EkstrakurikulerModel::create($data);
            $this->showSuccess('Berhasil menambahkan ekstrakurikuler ' . $data['nama']);
        }
        $this->emit('formModal');
    }

    public function delete(EkstrakurikulerModel $ekstrakurikuler)
    {
        $this->ekstrakurikuler = $ekstrakurikuler;
        $this->nama = $ekstrakurikuler->nama;
        $this->emit('deleteModal');
    }

    public function destroy()
    {
        $this->ekstrakurikuler->delete();
        $this->emit('deleteModal');
        $this->showSuccess('Berhasil menghapus ekstrakurikuler ' . $this->nama);
    }

    private function resetInputFields()
    {
        $this->nama = null;
    }
}
