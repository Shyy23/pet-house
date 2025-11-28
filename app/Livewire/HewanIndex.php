<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Hewan;
use App\Models\JenisHewan;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On; // Untuk listener event

class HewanIndex extends Component
{
    use WithPagination, WithFileUploads;

    // --- State Variables ---
    public $search = '';
    public $jenisFilter = '';
    
    // Variabel Form
    public $id_hewan, $nama, $jenis_hewan_id, $jenis_kelamin, $umur_bulan, $keterangan, $foto, $foto_lama;

    // Modal Control
    public $showModal = false;
    public $isEditMode = false;

    // Reset pagination saat filter berubah
    public function updatedSearch() { $this->resetPage(); }
    public function updatedJenisFilter() { $this->resetPage(); }

    public function render()
    {
        $query = Hewan::with('jenis')->latest();

        if ($this->search) {
            $query->where(function($q) {
                $q->where('nama', 'like', '%'.$this->search.'%')
                  ->orWhere('keterangan', 'like', '%'.$this->search.'%');
            });
        }

        if ($this->jenisFilter) {
            $query->where('jenis_hewan_id', $this->jenisFilter);
        }

        return view('livewire.hewan-index', [
            'hewans' => $query->paginate(10),
            'list_jenis' => JenisHewan::all()
        ]);
    }

    // --- Modal Logic ---
    public function openModal()
    {
        $this->resetValidation();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->reset(['nama', 'jenis_hewan_id', 'jenis_kelamin', 'umur_bulan', 'keterangan', 'foto', 'foto_lama', 'id_hewan', 'isEditMode']);
    }

    public function create()
    {
        $this->closeModal();
        $this->openModal();
        $this->isEditMode = false;
    }

    public function edit($id)
    {
        $hewan = Hewan::find($id);
        $this->id_hewan = $hewan->id;
        $this->nama = $hewan->nama;
        $this->jenis_hewan_id = $hewan->jenis_hewan_id;
        $this->jenis_kelamin = $hewan->jenis_kelamin;
        $this->umur_bulan = $hewan->umur_bulan;
        $this->keterangan = $hewan->keterangan;
        $this->foto_lama = $hewan->foto;
        
        $this->openModal();
        $this->isEditMode = true;
    }

    public function save()
    {
        $rules = [
            'nama' => 'required',
            'jenis_hewan_id' => 'required',
            'jenis_kelamin' => 'required',
            'umur_bulan' => 'required|numeric',
            'keterangan' => 'nullable',
            'foto' => 'nullable|image|max:2048',
        ];
        $this->validate($rules);

        $pathFoto = $this->foto_lama;
        if ($this->foto) {
            if ($this->isEditMode && $this->foto_lama) {
                Storage::delete('public/'.$this->foto_lama);
            }
            $pathFoto = $this->foto->store('hewan-photos', 'public');
        }

        $data = [
            'nama' => $this->nama,
            'jenis_hewan_id' => $this->jenis_hewan_id,
            'jenis_kelamin' => $this->jenis_kelamin,
            'umur_bulan' => $this->umur_bulan,
            'keterangan' => $this->keterangan,
            'foto' => $pathFoto,
        ];

        if ($this->isEditMode) {
            Hewan::where('id', $this->id_hewan)->update($data);
            $message = 'Data berhasil diperbarui!';
        } else {
            Hewan::create($data);
            $message = 'Data hewan baru ditambahkan!';
        }

        $this->closeModal();
        $this->dispatch('swal:success', title: 'Berhasil!', text: $message);
    }

    public function confirmDelete($id)
    {
        $this->dispatch('swal:confirm', id: $id);
    }

    #[On('deleteConfirmed')] 
    public function deleteConfirmed($id)
    {
        $hewan = Hewan::find($id);
        if ($hewan) {
            if ($hewan->foto) Storage::delete('public/'.$hewan->foto);
            $hewan->delete();
            $this->dispatch('swal:success', title: 'Terhapus!', text: 'Data hewan telah dihapus.');
        }
    }
}