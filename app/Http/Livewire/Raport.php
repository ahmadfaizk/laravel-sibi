<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\WithAlert;
use App\Models\Ekstrakurikuler;
use App\Models\Kelas;
use App\Models\Ketidakhadiran;
use App\Models\MataPelajaran;
use App\Models\NilaiEkstrakurikuler;
use App\Models\NilaiMapel;
use App\Models\Prestasi;
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
    public $listPrestasi = [];

    public $prestasiDeleted = [];
    public $ekstrakurikulerDeleted = [];

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
            $query->where('id', $this->idKelas)->where('id_tahun_ajaran', $this->idTahunAjaran);
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

    public function edit(Siswa $siswa, $semester, Ketidakhadiran $ketidakhadiran, NilaiMapel $nilaiMapel, NilaiEkstrakurikuler $nilaiEkstrakurikuler, Prestasi $prestasi)
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
            $data = [
                'id' => $nilai->id_ekstrakurikuler,
                'nama' => $this->listEksrakurikuler->where('id', $nilai->id_ekstrakurikuler)->first()->nama,
                'predikat' => $nilai->predikat
            ];
            array_push($this->nilaiEkstrakurikuler, $data);
        }
        $this->listPrestasi = $prestasi->where('id_kelas', $this->idKelas)
            ->where('id_siswa', $siswa->id)
            ->where('id_semester', $semester)
            ->select('id', 'kegiatan', 'keterangan')
            ->get()
            ->toArray();
        $this->emit('formModal');
    }

    public function store(
        Ketidakhadiran $ketidakhadiran,
        NilaiMapel $nilaiMapel,
        NilaiEkstrakurikuler $nilaiEkstrakurikuler,
        Prestasi $prestasi
    ) {
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
        foreach ($this->nilaiEkstrakurikuler as $nilai) {
            $nilaiEkstrakurikuler->updateOrCreate(
                [
                    'id_tahun_ajaran' => $this->idTahunAjaran,
                    'id_kelas' => $this->idKelas,
                    'id_siswa' => $this->siswa->id,
                    'id_semester' => $this->semester,
                    'id_ekstrakurikuler' => $nilai['id'],
                ],
                [
                    'predikat' => $nilai['predikat'],
                ]
            );
        }
        $nilaiEkstrakurikuler->where('id_kelas', $this->idKelas)
            ->where('id_siswa', $this->siswa->id)
            ->where('id_semester', $this->semester)
            ->whereIn('id', $this->ekstrakurikulerDeleted)
            ->delete();
        $ketidakhadiran->updateOrCreate(
            [
                'id_tahun_ajaran' => $this->idTahunAjaran,
                'id_kelas' => $this->idKelas,
                'id_siswa' => $this->siswa->id,
                'id_semester' => $this->semester,
            ],
            $this->ketidakhadiran
        );
        foreach ($this->listPrestasi as $nilai) {
            $prestasi->updateOrCreate(
                [
                    'id' => $nilai['id'],
                    'id_tahun_ajaran' => $this->idTahunAjaran,
                    'id_kelas' => $this->idKelas,
                    'id_siswa' => $this->siswa->id,
                    'id_semester' => $this->semester,
                ],
                [
                    'kegiatan' => $nilai['kegiatan'],
                    'keterangan' => $nilai['keterangan'],
                ]
            );
        }
        $prestasi->whereIn('id', $this->prestasiDeleted)->delete();
        $this->showSuccess('Berhasil mengedit nilai siswa');
        $this->emit('formModal');
    }

    public function deleteEkstrakurikuler($index)
    {
        if ($this->nilaiEkstrakurikuler[$index]['id'] != null) {
            array_push($this->ekstrakurikulerDeleted, $this->nilaiEkstrakurikuler[$index]['id']);
        }
        array_splice($this->nilaiEkstrakurikuler, $index, 1);
    }

    public function addEkstrakurikuler()
    {
        $exist = false;
        foreach ($this->nilaiEkstrakurikuler as $nilai) {
            if ($nilai['id'] == $this->idEkstrakurikuler) {
                $exist = true;
                break;
            }
        }
        if ($exist) {
            $this->showError('Ekstrakurikuler telah ditambahkan');
        } else {
            $data = [
                'id' => $this->idEkstrakurikuler,
                'nama' => $this->listEksrakurikuler->where('id', $this->idEkstrakurikuler)->first()->nama,
                'predikat' => 'A'
            ];
            array_push($this->nilaiEkstrakurikuler, $data);
        }
    }

    public function addPrestasi()
    {
        $prestasi = [
            'id' => null,
            'kegiatan' => '',
            'keterangan' => '',
        ];
        array_push($this->listPrestasi, $prestasi);
    }

    public function deletePrestasi($index)
    {
        if ($this->listPrestasi[$index]['id'] != null) {
            array_push($this->prestasiDeleted, $this->listPrestasi[$index]['id']);
        }
        array_splice($this->listPrestasi, $index, 1);
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
        $this->listPrestasi = [];
        $this->prestasiDeleted = [];
        $this->ekstrakurikulerDeleted = [];
        foreach ($this->listMapel as $mapel) {
            $this->nilaiPengetahuan[$mapel->id] = 0;
            $this->nilaiKetrampilan[$mapel->id] = 0;
        }
        $this->idEkstrakurikuler = $this->listEksrakurikuler->first()->id;
    }
}
