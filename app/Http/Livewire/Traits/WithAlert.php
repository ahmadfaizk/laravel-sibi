<?php

namespace App\Http\Livewire\Traits;

trait WithAlert {
    public function showSuccess($message) {
        $this->emit('showToast', 'success', $message);
    }

    public function showError($message) {
        $this->emit('showToast', 'error', $message);
    }
}
