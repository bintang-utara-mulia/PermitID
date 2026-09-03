<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->string('reference_number')->unique(); // e.g. PERMIT/2026/08/001
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
            $table->string('letter_type'); // Surat Dispensasi, Surat Rekomendasi, Surat Pernyataan Sekolah
            $table->string('event_name'); // Nama Lomba/Kegiatan
            $table->string('event_organizer')->nullable(); // Penyelenggara Lomba
            $table->date('start_date');
            $table->date('end_date');
            $table->text('reason'); // Tulis pengajuan / Alasan
            $table->string('attachment_path')->nullable(); // File bukti (Surat atlet/undangan lomba)
            
            // Status Tracking
            $table->enum('status', ['pending_admin', 'pending_walas', 'approved', 'rejected'])->default('pending_admin');
            $table->foreignId('rejected_by')->nullable()->constrained('users')->onDelete('set null');
            $table->text('rejection_reason')->nullable();
            
            $table->string('qr_token')->unique(); // Unique Hash for QR Verification
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};
