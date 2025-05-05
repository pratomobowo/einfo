<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Constructor to add role check
     */
    public function __construct()
    {
        // Laravel 10+ doesn't support middleware registration in Controller constructor
        // Will implement checks in individual methods
    }

    /**
     * Display a listing of the users.
     */
    public function index()
    {
        // Log authentication info for debugging
        Log::info('User access to index', [
            'user_id' => auth()->id(),
            'user_email' => auth()->user()->email,
            'is_super_admin' => auth()->user()->isSuperAdmin(),
            'is_admin_secretariat' => auth()->user()->isAdminSekretariat(),
            'role' => auth()->user()->role
        ]);
        
        // Check if user is a super admin or admin secretariat
        if (!auth()->user()->isSuperAdmin() && !auth()->user()->isAdminSekretariat()) {
            Log::warning('Access denied to users.index: Not super admin or admin secretariat');
            return redirect()->route('admin.dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }
        
        $query = User::latest();
        
        // If admin secretariat, only show non-super admin users
        if (auth()->user()->isAdminSekretariat()) {
            $query->where('role', '!=', User::ROLE_SUPER_ADMIN);
        }
        
        $users = $query->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        // Check if user is a super admin or admin secretariat
        if (!auth()->user()->isSuperAdmin() && !auth()->user()->isAdminSekretariat()) {
            return redirect()->route('admin.dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }
        
        return view('admin.users.create');
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        // Check if user is a super admin or admin secretariat
        if (!auth()->user()->isSuperAdmin() && !auth()->user()->isAdminSekretariat()) {
            return redirect()->route('admin.dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }
        
        // Define available roles based on current user role
        $availableRoles = ['admin_sekretariat'];
        
        // Super admin can create any role
        if (auth()->user()->isSuperAdmin()) {
            $availableRoles[] = 'super_admin';
        }
        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', Password::defaults()],
            'role' => ['required', 'in:' . implode(',', $availableRoles)],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => true,  // Semua pengguna yang dibuat adalah admin
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users')
            ->with('success', 'Pengguna berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        // Check if user is a super admin or admin secretariat
        if (!auth()->user()->isSuperAdmin() && !auth()->user()->isAdminSekretariat()) {
            return redirect()->route('admin.dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }
        
        // Admin secretariat cannot edit super admin users
        if (auth()->user()->isAdminSekretariat() && $user->isSuperAdmin()) {
            return redirect()->route('admin.users')
                ->with('error', 'Anda tidak memiliki akses untuk mengubah pengguna Super Admin.');
        }
        
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        // Check if user is a super admin or admin secretariat
        if (!auth()->user()->isSuperAdmin() && !auth()->user()->isAdminSekretariat()) {
            return redirect()->route('admin.dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }
        
        // Admin secretariat cannot update super admin users
        if (auth()->user()->isAdminSekretariat() && $user->isSuperAdmin()) {
            return redirect()->route('admin.users')
                ->with('error', 'Anda tidak memiliki akses untuk mengubah pengguna Super Admin.');
        }
        
        // Define available roles based on current user role
        $availableRoles = ['admin_sekretariat'];
        
        // Super admin can create any role and preserve the current role if it's super_admin
        if (auth()->user()->isSuperAdmin()) {
            $availableRoles[] = 'super_admin';
        }
        
        // If user being edited is already a super admin, allow preserving that role
        if ($user->isSuperAdmin() && auth()->user()->isSuperAdmin()) {
            $roleValidation = ['required', 'in:super_admin,admin_sekretariat'];
        } else {
            $roleValidation = ['required', 'in:' . implode(',', $availableRoles)];
        }
        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'role' => $roleValidation,
        ]);

        // Update password hanya jika diisi
        if ($request->filled('password')) {
            $request->validate([
                'password' => ['required', Password::defaults()],
            ]);
            
            $user->password = Hash::make($request->password);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        
        // Only update role if we have permission to do so
        if (auth()->user()->isSuperAdmin() || !$user->isSuperAdmin()) {
            $user->role = $request->role;
        }
        
        $user->save();

        return redirect()->route('admin.users')
            ->with('success', 'Pengguna berhasil diperbarui.');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        // Check if user is a super admin or admin secretariat
        if (!auth()->user()->isSuperAdmin() && !auth()->user()->isAdminSekretariat()) {
            return redirect()->route('admin.dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }
        
        // Admin secretariat cannot delete super admin users
        if (auth()->user()->isAdminSekretariat() && $user->isSuperAdmin()) {
            return redirect()->route('admin.users')
                ->with('error', 'Anda tidak memiliki akses untuk menghapus pengguna Super Admin.');
        }
        
        // Mencegah menghapus diri sendiri
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users')
                ->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $user->delete();

        return redirect()->route('admin.users')
            ->with('success', 'Pengguna berhasil dihapus.');
    }
}
