<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\WithAlert;
use App\Models\Ekstrakurikuler;
use App\Models\Kelas;
use App\Models\Ketidakhadiran;
use App\Models\MataPelajaran;
use App\Models\NilaiEkstrakurikuler;
use App\Models\NilaiMapel;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use Livewire\Component;
use Livewire\WithPagination;

class Raport extends Component
{
    use WithAlert;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $siswa;
    public $semester;

    public $ketidakhadiran = [
        'sakit' => 0,
        'izin' => 0,
        'tanpa_keterangan',
    ];
    public $nilaiPengetahuan;
    public $nilaiKetrampilan;
    public $nilaiEkstrakurikuler = [];

    public $idTahunAjaran;
    public $idKelas;
    public $idEkstrakurikuler;

    public $formTitle;
    public $search;
    public $perPage = 10;
    public $isUpdate = false;
    public $listTahunAjaran;
    public $listKelas;
    public $listMapel;
    public $listEksrakurikuler;

    public function mount(TahunAjaran $tahunAjaran, Kelas $kelas, Ekstrakurikuler $ekstrakurikuler)
    {
        $this->listTahunAjaran = $tahunAjaran->all();
        $this->idTahunAjaran = $tahunAjaran->first()->id;
        $this->listKelas = $kelas->where('id_tahun_ajaran', $this->idTahunAjaran)->get();
        $this->idKelas = $this->listKelas->first()->id;
        $this->listEksrakurikuler = $ekstrakurikuler->all();
    }

    public function render(Siswa $siswa, Kelas $kelas, MataPelajaran $mataPelajaran)
    {
        $items = $siswa->when($this->search, function ($query, $value) {
            return $query->where('nama_lengkap', 'LIKE', '%' . $value . '%');
        })->whereHas('kelas', function ($query) {
            $query->where('id', $this->idKelas);
        });
        $this->listKelas = $kelas->where('id_tahun_ajaran', $this->idTahunAjaran)->get();
        $this->listMapel = $mataPelajaran->whereHas('kelas', function ($query) {
            $query->where('id', $this->idKelas);
        })->get();

        return view('livewire.raport.index', [
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

    public function edit(Siswa $siswa, $semester, Ketidakhadiran $ketidakhadiran, NilaiMapel $nilaiMapel, NilaiEkstrakurikuler $nilaiEkstrakurikuler)
    {
        $this->resetInputFields();
        $this->formTitle = 'Edit Nilai Siswa Semester ' . $semester;
        $this->semester = $semester;
        $this->siswa = $siswa;
        $dataKetidakhadiran = $ketidakhadiran->where('id_kelas', $this->idKelas)
            ->where('id_siswa', $siswa->id)
            ->where('id_semester', $semester)
            ->first();
        if ($dataKetidakhadiran != null) {
            $tempKetidakhadiran = collect($dataKetidakhadiran->getAttributes())
                ->only(['sakit', 'izin', 'tanpa_keterangan'])
                ->toArray();
            $this->ketidakhadiran = array_merge($this->ketidakhadiran, $tempKetidakhadiran);
        }
        $dataNilaiAkademik = $nilaiMapel->where('id_kelas', $this->idKelas)
            ->where('id_siswa', $siswa->id)
            ->where('id_semester', $semester)
            ->get();
        $mapelsId = array_keys($this->nilaiPengetahuan);
        foreach ($mapelsId as $id) {
            $nilai = $dataNilaiAkademik->where('id_mapel', $id)->first();
            if ($nilai != null) {
                $this->nilaiPengetahuan[$id] = $nilai->nilai_pengetahuan;
                $this->nilaiKetrampilan[$id] = $nilai->nilai_ketrampilan;
            }
        }
        $dataNilaiEkstrakurikuler = $nilaiEkstrakurikuler->where('id_kelas', $this->idKelas)
            ->where('id_siswa', $siswa->id)
            ->where('id_semester', $semester)
            ->get();
        foreach ($dataNilaiEkstrakurikuler as $nilai) {
            $this->nilaiEkstrakurikuler[$nilai->id_ekstrakurikuler] = $nilai->predikat;
        }
        $this->emit('formModal');
    }

    public function store(Ketidakhadiran $ketidakhadiran, NilaiMapel $nilaiMapel, NilaiEkstrakurikuler $nilaiEkstrakurikuler)
    {
        $mapelsId = array_keys($this->nilaiPengetahuan);
        foreach ($mapelsId as $id) {
            $nilaiMapel->updateOrCreate(
                [
                    'id_tahun_ajaran' => $this->idTahunAjaran,
                    'id_kelas' => $this->idKelas,
                    'id_siswa' => $this->siswa->id,
                    'id_semester' => $this->semester,
                    'id_mapel' => $id,
                ],
                [
                    'nilai_pengetahuan' => $this->nilaiPengetahuan[$id],
                    'nilai_ketrampilan' => $this->nilaiKetrampilan[$id],
                ]
            );
        }
        $ekstrasId = array_keys($this->nilaiEkstrakurikuler);
        foreach ($ekstrasId as $id) {
            $nilaiEkstrakurikuler->updateOrCreate(
                [
                    'id_tahun_ajaran' => $this->idTahunAjaran,
                    'id_kelas' => $this->idKelas,
                    'id_siswa' => $this->siswa->id,
                    'id_semester' => $this->semester,
                    'id_ekstrakurikuler' => $id,
                ],
                [
                    'predikat' => $this->nilaiEkstrakurikuler[$id],
                ]
            );
        }
        $ketidakhadiran->updateOrCreate(
            [
                'id_tahun_ajaran' => $this->idTahunAjaran,
                'id_kelas' => $this->idKelas,
                'id_siswa' => $this->siswa->id,
                'id_semester' => $this->semester,
            ],
            $this->ketidakhadiran
        );
        $this->showSuccess('Berhasil mengedit nilai siswa');
        $this->emit('formModal');
    }

    public function deleteEkstrakurikuler(int $id) {
        //$this->nilaiEkstrakurikuler = [];
        unset($this->nilaiEkstrakurikuler[$id]);
    }

    public function addEkstrakurikuler()
    {
        $ekskuls = array_keys($this->nilaiEkstrakurikuler);
        if (in_array($this->idEkstrakurikuler, $ekskuls)) {
            $this->showError('Ekstrakurikuler telah ditambahkan');
        } else {
            $this->nilaiEkstrakurikuler[$this->idEkstrakurikuler] = 'A';
        }
    }

    private function resetInputFields()
    {
        $this->ketidakhadiran = [
            'sakit' => 0,
            'izin' => 0,
            'tanpa_keterangan' => 0,
        ];
        $this->nilaiPengetahuan = [];
        $this->nilaiKetrampilan = [];
        $this->nilaiEkstrakurikuler = [];
        foreach ($this->listMapel as $mapel) {
            $this->nilaiPengetahuan[$mapel->id] = 0;
            $this->nilaiKetrampilan[$mapel->id] = 0;
        }
        $this->idEkstrakurikuler = $this->listEksrakurikuler->first()->id;
    }
}
