<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengaturanController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('pengaturan.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|max:255|unique:users,email,' . $user->id,
            'deskripsi' => 'nullable|string|max:500',
            'alamat'    => 'nullable|string|max:255',
            'no_hp'     => 'nullable|string|max:20',
            'foto'      => 'nullable|image|max:2048',
        ]);

        $data = [
            'name'      => $request->name,
            'email'     => $request->email,
            'deskripsi' => $request->deskripsi,
            'alamat'    => $request->alamat,
            'no_hp'     => $request->no_hp,
        ];

        // Handle foto upload
        if ($request->hasFile('foto')) {
            // Hapus foto lama kalau ada
            if ($user->foto) {
                Storage::disk('public')->delete($user->foto);
            }
            $data['foto'] = $request->file('foto')->store('profiles', 'public');
        }

        $user->update($data);

        return redirect()
            ->route('pengaturan.index')
            ->with('success', 'Profil restoran berhasil diperbarui');
    }
}
