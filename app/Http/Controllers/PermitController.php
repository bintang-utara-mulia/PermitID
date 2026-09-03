<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PermitController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        if ($user->role === 'student') {
            $submissions = Submission::where('student_id', $user->id)
                                    ->with('rejector')
                                    ->latest()
                                    ->get();
            return view('dashboard.student', compact('submissions'));
        } elseif ($user->role === 'admin') {
            $pendingSubmissions = Submission::where('status', 'pending_admin')->with('student')->latest()->get();
            $processedSubmissions = Submission::where('status', '!=', 'pending_admin')->with(['student', 'rejector'])->latest()->get();
            
            // Group students neatly by Class Name
            $studentsByClass = User::where('role', 'student')
                                   ->orderBy('class_name', 'asc')
                                   ->orderBy('nis_nip', 'asc')
                                   ->get()
                                   ->groupBy('class_name');

            $teachers = User::where('role', 'homeroom_teacher')->latest()->get();
            return view('dashboard.admin', compact('pendingSubmissions', 'processedSubmissions', 'studentsByClass', 'teachers'));
        } else { // homeroom_teacher
            $pendingSubmissions = Submission::where('status', 'pending_walas')->with('student')->latest()->get();
            $processedSubmissions = Submission::whereIn('status', ['approved', 'rejected'])->with(['student', 'rejector'])->latest()->get();
            return view('dashboard.walas', compact('pendingSubmissions', 'processedSubmissions'));
        }
    }

    public function addStudent(Request $request)
    {
        $request->validate([
            'nis' => 'required|unique:users,nis_nip',
            'name' => 'required|string|max:255',
            'password' => 'required|min:4',
        ], [
            'nis.required' => 'NIS siswa wajib diisi.',
            'nis.unique' => 'NIS ini sudah terdaftar dalam sistem.',
            'name.required' => 'Nama lengkap siswa wajib diisi.',
            'password.required' => 'Kata sandi siswa wajib diisi.',
        ]);

        User::create([
            'nis_nip' => trim($request->nis),
            'name' => trim($request->name),
            'role' => 'student',
            'class_name' => trim($request->class_name ?? '-'),
            'major' => trim($request->major ?? '-'),
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('dashboard')->with('success', 'Data siswa baru berhasil ditambahkan!');
    }

    public function addTeacher(Request $request)
    {
        $request->validate([
            'nip' => 'required|unique:users,nis_nip',
            'name' => 'required|string|max:255',
            'class_name' => 'required|string',
            'major' => 'required|string',
            'password' => 'required|min:4',
        ], [
            'nip.required' => 'NIP/ID Guru wajib diisi.',
            'nip.unique' => 'NIP ini sudah terdaftar dalam sistem.',
            'name.required' => 'Nama lengkap guru wajib diisi.',
            'class_name.required' => 'Kelas yang diampu wajib diisi.',
            'major.required' => 'Jurusan wajib diisi.',
            'password.required' => 'Kata sandi wajib diisi.',
        ]);

        User::create([
            'nis_nip' => trim($request->nip),
            'name' => trim($request->name),
            'role' => 'homeroom_teacher',
            'class_name' => trim($request->class_name),
            'major' => trim($request->major),
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('dashboard')->with('success', 'Data Guru/Wali Kelas baru berhasil ditambahkan!');
    }

    public function create()
    {
        return view('permit.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_name' => 'required|string|max:100',
            'major' => 'required|string|max:100',
            'letter_type' => 'required',
            'event_name' => 'required|string|max:255',
            'event_organizer' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string',
            'attachment' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5048',
        ], [
            'class_name.required' => 'Kelas saat ini wajib diisi.',
            'major.required' => 'Jurusan wajib diisi.',
            'letter_type.required' => 'Pilih jenis surat yang diajukan.',
            'event_name.required' => 'Nama kegiatan/lomba wajib diisi.',
            'start_date.required' => 'Tanggal mulai wajib diisi.',
            'end_date.required' => 'Tanggal selesai wajib diisi.',
            'reason.required' => 'Penjelasan pengajuan wajib diisi.',
            'attachment.required' => 'Surat bukti (surat atlet / penyelenggara) wajib diunggah.',
            'attachment.mimes' => 'Format file bukti harus berupa PDF, JPG, JPEG, atau PNG.',
            'attachment.max' => 'Ukuran file maksimal 5MB.',
        ]);

        $user = Auth::user();
        $user->update([
            'class_name' => trim($request->class_name),
            'major' => trim($request->major),
        ]);

        $filePath = null;
        if ($request->hasFile('attachment')) {
            $filePath = $request->file('attachment')->store('attachments', 'public');
        }

        // Auto-increment letter number based on total approved/issued letters
        $romanMonths = ['I','II','III','IV','V','VI','VII','VIII','IX','X','XI','XII'];
        $currentMonth = $romanMonths[(int)date('n') - 1];
        $currentYear = date('Y');
        $lastNumber = Submission::max('id') ?? 0;
        $nextNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        $refNo = $nextNumber . '/SMK/ANT-2/PP/' . $currentMonth . '/' . $currentYear;
        $qrToken = Str::random(40);

        Submission::create([
            'reference_number' => $refNo,
            'student_id' => $user->id,
            'letter_type' => $request->letter_type,
            'event_name' => $request->event_name,
            'event_organizer' => $request->event_organizer,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'reason' => $request->reason,
            'attachment_path' => $filePath,
            'status' => 'pending_admin',
            'qr_token' => $qrToken,
        ]);

        return redirect()->route('dashboard')->with('success', 'Pengajuan surat berhasil dikirim! Menunggu verifikasi Admin.');
    }

    public function show($id)
    {
        $submission = Submission::with(['student', 'rejector'])->findOrFail($id);
        
        $user = Auth::user();
        if ($user->role === 'student' && $submission->student_id !== $user->id) {
            abort(403);
        }

        return view('permit.show', compact('submission'));
    }

    public function verifyAdmin(Request $request, $id)
    {
        $submission = Submission::findOrFail($id);
        
        if ($request->action === 'approve') {
            $submission->update(['status' => 'pending_walas']);
            return redirect()->route('dashboard')->with('success', 'Pengajuan telah diverifikasi Admin & diteruskan ke Wali Kelas/Dosen.');
        } else {
            $request->validate(['rejection_reason' => 'required']);
            $submission->update([
                'status' => 'rejected',
                'rejected_by' => Auth::id(),
                'rejection_reason' => $request->rejection_reason,
            ]);
            return redirect()->route('dashboard')->with('success', 'Pengajuan surat telah ditolak.');
        }
    }

    public function approveWalas(Request $request, $id)
    {
        $submission = Submission::findOrFail($id);

        if ($request->action === 'approve') {
            $submission->update(['status' => 'approved']);
            return redirect()->route('dashboard')->with('success', 'Surat berhasil disetujui! Surat digital resmi terbit.');
        } else {
            $request->validate(['rejection_reason' => 'required']);
            $submission->update([
                'status' => 'rejected',
                'rejected_by' => Auth::id(),
                'rejection_reason' => $request->rejection_reason,
            ]);
            return redirect()->route('dashboard')->with('success', 'Pengajuan surat ditolak oleh Wali Kelas/Dosen.');
        }
    }

    public function printDigital($id)
    {
        $submission = Submission::with(['student'])->where('status', 'approved')->findOrFail($id);

        // Security Check: If current user is a student, ensure they only access their OWN submission!
        $user = Auth::user();
        if ($user->role === 'student' && $submission->student_id !== $user->id) {
            abort(403, 'Akses Ditolak: Anda tidak memiliki izin untuk melihat surat milik siswa lain.');
        }

        $verifyUrl = route('verify.qr', $submission->qr_token);
        $qrCode = QrCode::size(120)->generate($verifyUrl);

        return view('permit.print', compact('submission', 'qrCode', 'verifyUrl'));
    }

    public function verifyQr($token)
    {
        $submission = Submission::with(['student'])->where('qr_token', $token)->firstOrFail();
        return view('permit.verify', compact('submission'));
    }
}
