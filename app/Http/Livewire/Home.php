<?php

namespace App\Http\Livewire;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use Livewire\Component;

class Home extends Component
{
    public $siswaAktif;
    public $siswaAlumni;
    public $kelas;
    public $tahunAjaran;

    public function mount(Siswa $siswa, Kelas $kelas, TahunAjaran $tahunAjaran) {
        $this->siswaAktif = $siswa->where('status', 'aktif')->count();
        $this->siswaAlumni = $siswa->where('status', 'alumni')->count();
        $this->kelas = $kelas->count();
        $this->tahunAjaran = $tahunAjaran->count();
    }

    public function render()
    {
        return view('livewire.home');
    }
}
