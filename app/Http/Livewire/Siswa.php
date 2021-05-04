<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\WithAlert;
use App\Models\Kelas;
use App\Models\Siswa as SiswaModel;
use App\Models\TahunAjaran;
use Livewire\Component;
use Livewire\WithPagination;

class Siswa extends Component
{
    use WithAlert;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $siswa;
    public $form = [
        'nama_lengkap' => null,
        'nomor_nis' => null,
        'nomor_nisn' => null,
        'jenis_kelamin' => null,
        'agama' => null,
        'alamat_peserta_didik' => null,
        'tempat_lahir' => null,
        'tgl_lahir' => null,
        'pendidikan_sebelumnya' => null,
        'nama_ayah' => null,
        'nama_ibu' => null,
        'pekerjaan_ayah' => null,
        'pekerjaan_ibu' => null,
        'nama_wali' => null,
        'masuk_tingkat' => null,
        'alamat_orangtua' => null,
        'alamat_wali' => null,
        'foto_masuk' => null,
        'foto_keluar' => null,
        'status' => null,
        'id_kelas' => null,
        'id_ta_masuk' => null,
    ];

    public $formTitle;
    public $search;
    public $perPage = 10;
    public $isUpdate = false;
    public $listTahunAjaran;
    public $listKelas;

    public $filter = [
        // 'id_tahun_ajaran' => 0
    ];

    public $rules = [
        'form.nama_lengkap' => 'required|string',
        'form.masuk_tingkat' => 'required|numeric',
    ];

    public function mount(TahunAjaran $tahunAjaran, Kelas $kelas)
    {
        $this->listTahunAjaran = $tahunAjaran->all();
        //$this->listKelas = $kelas->all();
    }

    public function render(SiswaModel $siswa)
    {
        $items = $siswa->when($this->search, function ($query, $value) {
            return $query->where('nama_lenkap', 'LIKE', '%' . $value . '%');
        });

        return view('livewire.siswa.index', [
            'items' => $items->paginate($this->perPage)
        ]);
    }

    public function create()
    {
        $this->formTitle = 'Buat Siswa Baru';
        $this->resetInputFields();
        $this->isUpdate = false;
        $this->emit('formModal');
    }

    public function edit(SiswaModel $siswa)
    {
        $form = collect($siswa->getAttributes())
            ->only([
                'nama_lengkap', 'nomor_nis', 'nomor_nisn', 'jenis_kelamin',
                'agama', 'alamat_peserta_didik', 'tempat_lahir', 'tgl_lahir',
                'pendidikan_sebelumnya', 'nama_ayah', 'nama_ibu', 'pekerjaan_ayah', 'pekerjaan_ibu',
                'nama_wali', 'masuk_tingkat', 'alamat_orangtua', 'alamat_wali',
                'status', 'id_kelas', 'id_ta_masuk',
            ])->toArray();
        $this->form = array_merge($this->form, $form);
        $this->formTitle = 'Edit Siswa';
        $this->siswa = $siswa;
        $this->isUpdate = true;
        $this->emit('formModal');
    }

    public function store()
    {
        //dd($this->form);
        $this->validate();
        if ($this->isUpdate) {
            $this->siswa->update($this->form);
            $this->showSuccess('Berhasil mengubah siswa ' . $this->form['nama_lengkap']);
        } else {
            SiswaModel::create($this->form);
            $this->showSuccess('Berhasil menambahkan siswa ' . $this->form['nama_lengkap']);
        }
        $this->emit('formModal');
    }

    public function delete(SiswaModel $siswa)
    {
        $this->siswa = $siswa;
        $this->nama = $siswa->nama;
        $this->emit('deleteModal');
    }

    public function destroy()
    {
        $this->siswa->delete();
        $this->emit('deleteModal');
        $this->showSuccess('Berhasil menambahkan siswa ' . $this->form['nama_lengkap']);
    }

    private function resetInputFields()
    {
        $this->nama = null;
        $this->form = [
            'nama_lengkap' => null,
            'nomor_nis' => null,
            'nomor_nisn' => null,
            'jenis_kelamin' => 'Laki-laki',
            'agama' => 'Islam',
            'alamat_peserta_didik' => null,
            'tempat_lahir' => null,
            'tgl_lahir' => null,
            'pendidikan_sebelumnya' => null,
            'nama_ayah' => null,
            'nama_ibu' => null,
            'pekerjaan_ayah' => null,
            'pekerjaan_ibu' => null,
            'nama_wali' => null,
            'masuk_tingkat' => 1,
            'alamat_orangtua' => null,
            'alamat_wali' => null,
            'foto_masuk' => null,
            'foto_keluar' => null,
            'status' => 'aktif',
            'id_kelas' => null,
            'id_ta_masuk' => null,
        ];
        if ($this->listTahunAjaran->count() != 0) {
            $this->form['id_ta_masuk'] = $this->listTahunAjaran[0]->id;
        }
    }
}
