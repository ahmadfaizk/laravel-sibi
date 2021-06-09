<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\WithAlert;
use App\Models\Kelas as KelasModel;
use App\Models\MataPelajaran;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use Livewire\Component;
use Livewire\WithPagination;

class Kelas extends Component
{
    use WithAlert;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $kelas;
    public $nama;
    public $tingkat;
    public $id_tahun_ajaran;
    public $mapel;
    public $siswa;

    public $idSiswa;

    public $formTitle;
    public $search;
    public $perPage = 10;
    public $isUpdate = false;
    public $listTahunAjaran;
    public $listMapel;
    public $listSiswa;

    public $filter = [
        'id_tahun_ajaran' => 0
    ];

    public $rules = [
        'nama' => 'required|string',
        'tingkat' => 'required|numeric',
        'id_tahun_ajaran' => 'required|numeric'
    ];

    public function mount(TahunAjaran $tahunAjaran, MataPelajaran $mataPelajaran, Siswa $siswa)
    {
        $this->listTahunAjaran = $tahunAjaran->all();
        if ($this->listTahunAjaran->count() != 0) {
            $this->filter['id_tahun_ajaran'] = $this->listTahunAjaran[0]->id;
        }
        $this->listMapel = $mataPelajaran->all();
        $this->listSiswa = $siswa->all();
        $this->mapel = [];
        $this->siswa = collect([]);
    }

    public function render(KelasModel $kelas)
    {
        $items = $kelas->when($this->search, function ($query, $value) {
            return $query->where('nama', 'LIKE', '%' . $value . '%');
        })->when($this->filter['id_tahun_ajaran'], function ($query, $value) {
            return $query->where('id_tahun_ajaran', $value);
        })->with('mapel')->orderBy('tingkat');

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
        $this->resetInputFields();
        $this->formTitle = 'Edit Kelas';
        $this->kelas = $kelas;
        $this->nama = $kelas->nama;
        $this->tingkat = $kelas->tingkat;
        $this->isUpdate = true;
        foreach ($kelas->mapel->pluck('id')->toArray() as $kls) {
            array_push($this->mapel, (string)$kls);
        }
        $this->siswa = $kelas->siswa->pluck('id')->toArray();
        $this->siswa = $kelas->siswa;
        $this->emit('formModal');
    }

    public function store()
    {
        $data = $this->validate();
        $siswa = $this->siswa->pluck('id')->toArray();
        if ($this->isUpdate) {
            $this->kelas->update($data);
            $this->kelas->mapel()->sync($this->mapel);
            $this->kelas->siswa()->sync($siswa);
            $this->showSuccess('Berhasil mengubah kelas ' . $data['nama']);
        } else {
            $kelas = KelasModel::create($data);
            $kelas->mapel()->sync($this->mapel);
            $kelas->siswa()->sync($siswa);
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
        try {
            $this->kelas->mapel()->sync([]);
            $this->kelas->delete();
            $this->emit('deleteModal');
            $this->showSuccess('Berhasil menghapus kelas ' . $this->nama);
        } catch (\Throwable $th) {
            $this->showError('Gagal menghapus kelas');
        }
    }

    public function addSiswa()
    {
        $inClass = false;
        foreach ($this->siswa as $siswa) {
            if ($siswa['id'] == $this->idSiswa) {
                $this->showError('Siswa tersebut telah dimasukkan kedalam kelas');
                $inClass = true;
                break;
            }
        }
        if (!$inClass) {
            foreach ($this->listSiswa as $siswa) {
                if ($siswa->id == $this->idSiswa) {
                    $this->siswa->push($siswa);
                    //array_push($this->siswa, $siswa);
                    $this->showSuccess('Siswa berhasil dimasukkan ke dalam kelas');
                    break;
                }
            }
        }
    }

    public function deleteSiswa($id)
    {
        $index = 0;
        foreach ($this->siswa as $siswa) {
            if ($siswa['id'] == $id) {
                $this->siswa->splice($index, 1);
                //array_splice($this->siswa, $index, 1);
                $this->showSuccess('Siswa berhasil dihapus dari kelas');
                break;
            }
            $index++;
        }
    }

    private function resetInputFields()
    {
        $this->nama = null;
        $this->tingkat = 1;
        $this->mapel = [];
        $this->siswa = collect([]);
        if ($this->listTahunAjaran->count() != 0) {
            $this->id_tahun_ajaran = $this->listTahunAjaran[0]->id;
        }
        if ($this->listSiswa->count() != 0) {
            $this->idSiswa = $this->listSiswa->first()->id;
        }
    }
}
