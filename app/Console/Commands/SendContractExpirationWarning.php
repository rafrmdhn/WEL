<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Pegawai;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContractExpirationMail; // Kita akan buat ini nanti

class SendContractExpirationWarning extends Command
{
    protected $signature = 'contract:send-warnings';
    protected $description = 'Kirim email notifikasi untuk kontrak yang akan segera berakhir';

    public function handle()
    {
        $this->info('Mulai memeriksa kontrak yang akan berakhir...');

        $today = now();
        // Ambil pegawai yang kontraknya habis tepat 30, 60, atau 90 hari dari sekarang
        $targets = Pegawai::whereIn('tanggal_habis_kontrak', [
            $today->copy()->addDays(90)->toDateString(),
            $today->copy()->addDays(60)->toDateString(),
            $today->copy()->addDays(30)->toDateString(),
        ])->get();

        if ($targets->isEmpty()) {
            $this->info('Tidak ada kontrak yang perlu dinotifikasikan hari ini.');
            return;
        }

        foreach ($targets as $pegawai) {
            // Ganti dengan email HR yang sebenarnya
            $recipientEmail = 'hr@perusahaan.com'; 
            Mail::to($recipientEmail)->send(new ContractExpirationMail($pegawai));
            $this->info("Notifikasi untuk {$pegawai->nama_pegawai} telah dikirim.");
        }

        $this->info('Semua notifikasi berhasil dikirim.');
    }
}