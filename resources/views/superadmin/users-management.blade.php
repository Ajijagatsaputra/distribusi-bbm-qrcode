@extends('layouts.superadmin')

@section('title', 'User Management')

@section('content')
<div class="animate-slide-in">

    {{-- HEADER --}}
    <div class="flex flex-col justify-between gap-4 mb-8 md:flex-row md:items-center">
        <div>
            <h2 class="mb-2 text-3xl font-black tracking-tight text-slate-900 dark:text-white">
                Manajemen <span class="text-pertamina-blue">Pengguna</span>
            </h2>
            <p class="text-sm text-slate-600 dark:text-slate-400">
                Kelola hak akses administrator dan operator sistem BBM
            </p>
        </div>

        <div class="flex items-center gap-3">
            {{-- FILTER ROLE --}}
            <div class="relative">
                <select id="roleFilter" onchange="filterByRole(this.value)"
                    class="px-4 py-2.5 pr-10 text-sm font-semibold bg-white border rounded-xl outline-none appearance-none cursor-pointer border-slate-300 dark:border-slate-700 dark:bg-slate-800 text-slate-700 dark:text-slate-300 focus:ring-4 focus:ring-pertamina-blue/20 focus:border-pertamina-blue transition-all shadow-sm">
                    <option value="">Semua Role</option>
                    <option value="admin_pusat">Super Admin</option>
                    <option value="admin_depo">Admin</option>
                    <option value="driver">Operator</option>
                    <option value="admin_spbu">Admin SPBU</option>
                </select>
                <span class="absolute w-4 h-4 -translate-y-1/2 pointer-events-none material-symbols-outlined text-[16px] text-slate-400 right-3 top-1/2">expand_more</span>
            </div>

            {{-- BUTTON ADD USER --}}
            <button onclick="openUserModal('add')"
                class="flex items-center gap-2 px-5 py-2.5 text-sm font-bold text-white transition-all shadow-lg rounded-xl bg-gradient-to-r from-pertamina-blue to-blue-600 hover:shadow-xl hover:scale-105 shadow-glow-blue">
                <span class="text-[18px] material-symbols-outlined">person_add</span>
                Tambah Pengguna
            </button>
        </div>
    </div>

    {{-- NOTIFICATION TOAST --}}
    <div id="toastNotification" class="fixed top-24 right-8 z-50 flex items-center gap-3 px-4 py-3 text-sm font-semibold text-white transition-all transform translate-x-full bg-slate-900 dark:bg-slate-800 rounded-xl shadow-2xl opacity-0">
        <span class="material-symbols-outlined text-pertamina-green">check_circle</span>
        <span id="toastMessage">Action successful!</span>
    </div>

    @if(session('success'))
        <div class="mb-6 flex items-center gap-3 px-4 py-3 bg-pertamina-green/10 border border-pertamina-green/30 rounded-xl text-pertamina-green font-semibold text-sm">
            <span class="material-symbols-outlined">check_circle</span>
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="mb-6 flex items-center gap-3 px-4 py-3 bg-pertamina-red/10 border border-pertamina-red/30 rounded-xl text-pertamina-red font-semibold text-sm">
            <span class="material-symbols-outlined">error</span>
            {{ session('error') }}
        </div>
    @endif

    {{-- ROLE EXPLANATION (Moved up for better UX flow) --}}
    <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-4">
        <div class="p-6 transition-all duration-300 bg-white border shadow-sm border-slate-200/60 rounded-2xl dark:bg-slate-800 dark:border-slate-700/50 hover:shadow-md">
            <div class="flex items-center gap-3 mb-3">
                <div class="p-2.5 rounded-xl bg-purple-100 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400">
                    <span class="material-symbols-outlined">shield_person</span>
                </div>
                <h4 class="font-bold text-slate-900 dark:text-white">Super Admin (<span id="count-sa">{{ $stats['admin_pusat'] }}</span>)</h4>
            </div>
            <p class="text-xs text-slate-500 dark:text-slate-400">Akses tak terbatas. Sistem konfigurasi, Master Data, Audit Log, Manajemen User.</p>
        </div>

        <div class="p-6 transition-all duration-300 bg-white border shadow-sm border-slate-200/60 rounded-2xl dark:bg-slate-800 dark:border-slate-700/50 hover:shadow-md">
            <div class="flex items-center gap-3 mb-3">
                <div class="p-2.5 rounded-xl bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400">
                    <span class="material-symbols-outlined">manage_accounts</span>
                </div>
                <h4 class="font-bold text-slate-900 dark:text-white">Admin Depo (<span id="count-a">{{ $stats['admin_depo'] }}</span>)</h4>
            </div>
            <p class="text-xs text-slate-500 dark:text-slate-400">Verifikasi surat jalan, input data plat nomor kendaraan, dan cetak barcode.</p>
        </div>

        <div class="p-6 transition-all duration-300 bg-white border shadow-sm border-slate-200/60 rounded-2xl dark:bg-slate-800 dark:border-slate-700/50 hover:shadow-md">
            <div class="flex items-center gap-3 mb-3">
                <div class="p-2.5 rounded-xl bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400">
                    <span class="material-symbols-outlined">engineering</span>
                </div>
                <h4 class="font-bold text-slate-900 dark:text-white">Driver (<span id="count-o">{{ $stats['driver'] }}</span>)</h4>
            </div>
            <p class="text-xs text-slate-500 dark:text-slate-400">Lihat penugasan Surat Jalan, ambil barcode pengiriman, dan jalankan distribusi.</p>
        </div>

        <div class="p-6 transition-all duration-300 bg-white border shadow-sm border-slate-200/60 rounded-2xl dark:bg-slate-800 dark:border-slate-700/50 hover:shadow-md">
            <div class="flex items-center gap-3 mb-3">
                <div class="p-2.5 rounded-xl bg-amber-100 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400">
                    <span class="material-symbols-outlined">storefront</span>
                </div>
                <h4 class="font-bold text-slate-900 dark:text-white">Admin SPBU (<span id="count-spbu">{{ $stats['admin_spbu'] }}</span>)</h4>
            </div>
            <p class="text-xs text-slate-500 dark:text-slate-400">Melakukan input pemesanan BBM dan scan barcode driver untuk verifikasi selesai.</p>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="overflow-hidden transition-all duration-300 bg-white border shadow-glass backdrop-blur-md border-slate-200/50 rounded-2xl dark:bg-slate-900/70 dark:border-slate-800">

        <div class="p-6 border-b border-slate-200/50 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/20">
            <div class="flex items-center justify-between">
                <h4 class="font-bold text-slate-900 dark:text-white">Daftar Akun Sistem</h4>
                <div class="flex gap-2 text-xs font-semibold text-slate-500">
                    Total: <span id="displayCount" class="text-pertamina-blue">{{ $stats['total'] }}</span> Users
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left" id="userTable">
                <thead>
                    <tr class="text-xs font-bold tracking-wider uppercase bg-slate-50/50 dark:bg-slate-800/50 text-slate-500">
                        <th class="px-6 py-4">Nama Lengkap</th>
                        <th class="px-6 py-4">Informasi Kontak</th>
                        <th class="px-6 py-4">Role Akses</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    @forelse($users as $u)
                        @php
                            $roleName = 'Operator';
                            $roleClass = 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800/50';
                            $avatarBg = 'bg-pertamina-green';
                            $roleData = 'driver';
                            if ($u->role === 'admin_pusat') {
                                $roleName = 'Super Admin';
                                $roleClass = 'bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-400 border border-purple-200 dark:border-purple-800/50';
                                $avatarBg = 'bg-purple-600';
                                $roleData = 'admin_pusat';
                            } elseif ($u->role === 'admin_depo') {
                                $roleName = 'Admin Depo';
                                $roleClass = 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400 border border-blue-200 dark:border-blue-800/50';
                                $avatarBg = 'bg-pertamina-blue';
                                $roleData = 'admin_depo';
                            } elseif ($u->role === 'admin_spbu') {
                                $roleName = 'Admin SPBU';
                                $roleClass = 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400 border border-amber-200 dark:border-amber-800/50';
                                $avatarBg = 'bg-amber-600';
                                $roleData = 'admin_spbu';
                            }
                            
                            $initials = collect(explode(' ', $u->name))->map(fn($n) => mb_substr($n, 0, 1))->take(2)->join('');
                        @endphp
                        <tr class="transition-colors table-row hover:bg-slate-50 dark:hover:bg-slate-800/30" data-role="{{ $roleData }}" id="row-{{ $u->id }}">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="relative">
                                        <div class="flex items-center justify-center w-10 h-10 text-sm font-bold text-white rounded-full {{ $avatarBg }}">
                                            {{ strtoupper($initials) }}
                                        </div>
                                        <div class="absolute bottom-0 right-0 w-3 h-3 border-2 border-white rounded-full {{ $u->is_active ? 'bg-emerald-500' : 'bg-slate-300' }} dark:border-slate-800"></div>
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-900 dark:text-white name-cell">{{ $u->name }}</p>
                                        <p class="text-[11px] font-semibold tracking-wider text-slate-500 uppercase">#{{ strtoupper(substr($u->role, 0, 2)) . str_pad($u->id, 3, '0', STR_PAD_LEFT) }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-medium text-slate-600 dark:text-slate-400 email-cell">{{ $u->email }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-1 text-xs font-bold uppercase rounded-full {{ $roleClass }} role-cell" data-spbu-id="{{ $u->spbu_id }}">
                                    {{ $roleName }}
                                </span>
                                @if($u->role === 'admin_spbu' && $u->spbu)
                                    <p class="text-xs text-slate-500 mt-1 font-semibold dark:text-slate-400">{{ $u->spbu->name }}</p>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" {{ $u->is_active ? 'checked' : '' }} onchange="toggleUserActiveStatus({{ $u->id }})" class="sr-only peer status-toggle">
                                    <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer dark:bg-slate-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-pertamina-green"></div>
                                </label>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button onclick="openUserModal('edit', '{{ $u->id }}')" class="p-2 transition rounded-lg text-orange-500 hover:bg-orange-500/10 dark:hover:bg-orange-900/20 group hover:scale-110">
                                        <span class="text-lg material-symbols-outlined">edit</span>
                                    </button>
                                    @if($u->id !== auth()->id())
                                        <button onclick="openDeleteUserModal('{{ $u->id }}')" class="p-2 transition rounded-lg text-pertamina-red hover:bg-pertamina-red/10 dark:hover:bg-red-900/20 group hover:scale-110">
                                            <span class="text-lg material-symbols-outlined">delete</span>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-slate-500 font-medium">
                                Belum ada data pengguna.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

{{-- MODAL USER (ADD/EDIT) --}}
<div id="userModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-slate-900/75 backdrop-blur-sm" onclick="closeUserModal()"></div>
        <div class="relative w-full max-w-lg overflow-hidden text-left align-bottom transition-all transform border shadow-2xl border-white/50 dark:border-slate-700 bg-white/90 backdrop-blur-xl dark:bg-slate-900/90 rounded-2xl sm:my-8 sm:align-middle">
            <div class="px-6 py-5 border-b border-slate-200/50 dark:border-slate-800 bg-gradient-to-r from-pertamina-blue/10 to-transparent">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-gradient-to-br from-pertamina-blue to-blue-600 shadow-glow-blue">
                            <span class="text-2xl text-white material-symbols-outlined" id="modal-icon">person_add</span>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-slate-900 dark:text-white" id="modal-title">Tambah Pengguna</h3>
                            <p class="text-sm font-medium text-slate-500 dark:text-slate-400" id="modal-subtitle">Buat akun baru untuk sistem</p>
                        </div>
                    </div>
                    <button type="button" onclick="closeUserModal()" class="p-2 transition rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800">
                        <span class="material-symbols-outlined text-slate-500">close</span>
                    </button>
                </div>
            </div>

            <div class="px-6 py-6">
                <form id="userForm" method="POST" action="{{ route('superadmin.users.store') }}" class="space-y-4">
                    @csrf
                    <input type="hidden" id="form-method" name="_method" value="POST">
                    <input type="hidden" id="form-userid" value="">
                    <div>
                        <label class="block mb-2 text-sm font-bold text-slate-700 dark:text-slate-300">Nama Lengkap</label>
                        <input type="text" id="userName" name="name" placeholder="Masukkan nama lengkap..." class="w-full px-4 py-3 text-sm transition-all border outline-none rounded-xl border-slate-300 dark:border-slate-700 dark:bg-slate-800 text-slate-900 dark:text-white focus:border-pertamina-blue focus:ring-2 focus:ring-pertamina-blue/20" required>
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-bold text-slate-700 dark:text-slate-300">Alamat Email</label>
                        <input type="email" id="userEmail" name="email" placeholder="contoh: nama@domain.com" class="w-full px-4 py-3 text-sm transition-all border outline-none rounded-xl border-slate-300 dark:border-slate-700 dark:bg-slate-800 text-slate-900 dark:text-white focus:border-pertamina-blue focus:ring-2 focus:ring-pertamina-blue/20" required>
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-bold text-slate-700 dark:text-slate-300">Level Akses (Role)</label>
                        <select id="userRole" name="role" class="w-full px-4 py-3 text-sm transition-all border outline-none rounded-xl border-slate-300 dark:border-slate-700 dark:bg-slate-800 text-slate-900 dark:text-white focus:border-pertamina-blue focus:ring-2 focus:ring-pertamina-blue/20" required>
                            <option value="admin_depo">Admin Depo</option>
                            <option value="driver">Driver (Operator Lapangan)</option>
                            <option value="admin_spbu">Admin SPBU</option>
                        </select>
                    </div>

                    <div id="spbuSelectArea" class="hidden">
                        <label class="block mb-2 text-sm font-bold text-slate-700 dark:text-slate-300">SPBU Asosiasi</label>
                        <select id="userSpbu" name="spbu_id" class="w-full px-4 py-3 text-sm transition-all border outline-none rounded-xl border-slate-300 dark:border-slate-700 dark:bg-slate-800 text-slate-900 dark:text-white focus:border-pertamina-blue focus:ring-2 focus:ring-pertamina-blue/20">
                            <option value="">-- Pilih SPBU --</option>
                            @foreach($spbus as $spbu)
                                <option value="{{ $spbu->id }}">{{ $spbu->name }} ({{ $spbu->code }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div id="passwordArea">
                        <label id="passwordLabel" class="block mb-2 text-sm font-bold text-slate-700 dark:text-slate-300">Password</label>
                        <div class="relative">
                            <input type="password" id="userPassword" name="password" placeholder="••••••••" class="w-full px-4 py-3 text-sm transition-all border outline-none rounded-xl border-slate-300 dark:border-slate-700 dark:bg-slate-800 text-slate-900 dark:text-white focus:border-pertamina-blue focus:ring-2 focus:ring-pertamina-blue/20">
                            <button type="button" onclick="togglePassword()" class="absolute -translate-y-1/2 text-slate-400 right-3 top-1/2 hover:text-slate-600">
                                <span class="text-[20px] material-symbols-outlined">visibility</span>
                            </button>
                        </div>
                    </div>

                    <div id="passwordHelpText" class="flex items-center gap-2 p-3 mt-2 rounded-lg bg-pertamina-blue/10">
                        <span class="text-pertamina-blue material-symbols-outlined text-[18px]">info</span>
                        <p class="text-xs font-semibold text-pertamina-blue dark:text-blue-400">Pengguna akan menerima link aktivasi via email.</p>
                    </div>

                    <div class="flex gap-3 pt-6 border-t border-slate-200/50 dark:border-slate-800">
                        <button type="button" onclick="closeUserModal()" class="flex-1 px-4 py-3 text-sm font-semibold transition-all bg-white border outline-none text-slate-700 border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-700">
                            Batal
                        </button>
                        <button type="submit" class="flex items-center justify-center flex-1 gap-2 px-4 py-3 text-sm font-bold text-white transition-all shadow-lg rounded-xl bg-gradient-to-r from-pertamina-blue to-blue-700 hover:scale-105 shadow-glow-blue outline-none">
                            <span class="material-symbols-outlined text-[18px]">save</span>
                            Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- MODAL DELETE --}}
<div id="deleteUserModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-slate-900/75 backdrop-blur-sm" onclick="closeDeleteUserModal()"></div>
        <div class="relative w-full max-w-sm overflow-hidden text-left align-bottom transition-all transform border shadow-2xl border-white/50 dark:border-slate-700 bg-white/90 backdrop-blur-xl dark:bg-slate-900/90 rounded-2xl sm:my-8 sm:align-middle">
            <div class="p-6 text-center">
                <div class="flex items-center justify-center mx-auto mb-4 rounded-full size-16 bg-pertamina-red/10 animate-pulse">
                    <span class="text-3xl material-symbols-outlined text-pertamina-red">person_remove</span>
                </div>
                <h3 class="mb-2 text-xl font-bold text-slate-900 dark:text-white">Cabut Akses Pengguna?</h3>
                <p class="text-sm text-slate-500 dark:text-slate-400">Anda akan menonaktifkan dan menghapus pengguna <strong id="delete-user-name" class="text-pertamina-red"></strong> dari sistem secara permanen.</p>
            </div>
            <div class="flex justify-center gap-3 px-6 py-4 border-t bg-slate-50/50 dark:bg-slate-800/50 border-slate-200/50 dark:border-slate-800">
                <button type="button" onclick="closeDeleteUserModal()" class="px-5 py-2.5 text-sm font-semibold text-slate-700 bg-white border border-slate-200 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300 rounded-xl hover:bg-slate-50">Batal</button>
                <button type="button" id="confirmDeleteUserBtn" class="px-5 py-2.5 text-sm font-bold text-white bg-pertamina-red rounded-xl hover:shadow-lg hover:scale-105 transition-all">Ya, Hapus</button>
            </div>
        </div>
    </div>
</div>

<form id="deleteUserForm" method="POST" action="" class="hidden">
    @csrf
    @method('DELETE')
</form>

<script>
    function showToast(message) {
        const toast = document.getElementById('toastNotification');
        document.getElementById('toastMessage').textContent = message;
        toast.classList.remove('translate-x-full', 'opacity-0');
        setTimeout(() => toast.classList.add('translate-x-full', 'opacity-0'), 3000);
    }
    function toggleModal(id, show) {
        const el = document.getElementById(id);
        if (show) { el.classList.remove('hidden'); document.body.style.overflow = 'hidden'; } 
        else { el.classList.add('hidden'); document.body.style.overflow = 'auto'; }
    }

    function openUserModal(mode, id = null) {
        const form = document.getElementById('userForm');
        const roleSelect = document.getElementById('userRole');
        const spbuArea = document.getElementById('spbuSelectArea');
        const spbuSelect = document.getElementById('userSpbu');
        
        // Remove admin_pusat option if it exists from previous edit
        const adminPusatOpt = roleSelect.querySelector('option[value="admin_pusat"]');
        if (adminPusatOpt) {
            adminPusatOpt.remove();
        }
        
        // Hide SPBU select by default
        spbuArea.classList.add('hidden');
        spbuSelect.required = false;
        spbuSelect.value = '';
        
        if (mode === 'add') {
            form.reset();
            form.action = "{{ route('superadmin.users.store') }}";
            document.getElementById('form-method').value = "POST";
            document.getElementById('modal-title').textContent = 'Tambah Pengguna';
            document.getElementById('modal-subtitle').textContent = 'Buat akun baru untuk sistem';
            document.getElementById('modal-icon').textContent = 'person_add';
            document.getElementById('passwordLabel').textContent = 'Password';
            document.getElementById('userPassword').required = true;
            document.getElementById('passwordHelpText').classList.remove('hidden');
        } else {
            // Edit Mode
            const row = document.getElementById('row-' + id);
            document.getElementById('form-userid').value = id;
            form.action = "/superadmin/users/" + id;
            document.getElementById('form-method').value = "PUT";
            document.getElementById('modal-title').textContent = 'Edit Pengguna';
            document.getElementById('modal-subtitle').textContent = 'Perbarui data akun';
            document.getElementById('modal-icon').textContent = 'manage_accounts';
            document.getElementById('passwordLabel').textContent = 'Password (Kosongkan jika tidak ingin mengubah)';
            document.getElementById('userPassword').required = false;
            document.getElementById('passwordHelpText').classList.add('hidden');
            
            document.getElementById('userName').value = row.querySelector('.name-cell').textContent.trim();
            document.getElementById('userEmail').value = row.querySelector('.email-cell').textContent.trim();
            
            const rText = row.querySelector('.role-cell').textContent.trim();
            const spbuId = row.querySelector('.role-cell').dataset.spbuId;
            
            if (rText === 'Super Admin') {
                // If editing a Super Admin, temporarily add the option back so it shows correctly
                const opt = document.createElement('option');
                opt.value = 'admin_pusat';
                opt.textContent = 'Super Admin';
                roleSelect.insertBefore(opt, roleSelect.firstChild);
                roleSelect.value = 'admin_pusat';
            } else if (rText === 'Admin Depo') {
                roleSelect.value = 'admin_depo';
            } else if (rText === 'Driver' || rText === 'Operator') {
                roleSelect.value = 'driver';
            } else if (rText === 'Admin SPBU') {
                roleSelect.value = 'admin_spbu';
                spbuArea.classList.remove('hidden');
                spbuSelect.required = true;
                spbuSelect.value = spbuId || '';
            }
        }
        toggleModal('userModal', true);
    }
    
    function closeUserModal() { toggleModal('userModal', false); }

    document.getElementById('userRole').addEventListener('change', function() {
        const spbuArea = document.getElementById('spbuSelectArea');
        const spbuSelect = document.getElementById('userSpbu');
        if (this.value === 'admin_spbu') {
            spbuArea.classList.remove('hidden');
            spbuSelect.required = true;
        } else {
            spbuArea.classList.add('hidden');
            spbuSelect.required = false;
            spbuSelect.value = '';
        }
    });

    function togglePassword() {
        const p = document.getElementById('userPassword');
        p.type = p.type === 'password' ? 'text' : 'password';
    }

    let delUserId = null;
    function openDeleteUserModal(id) {
        delUserId = id;
        document.getElementById('delete-user-name').textContent = document.getElementById('row-' + id).querySelector('.name-cell').textContent;
        document.getElementById('deleteUserForm').action = "/superadmin/users/" + id;
        toggleModal('deleteUserModal', true);
    }
    function closeDeleteUserModal() { toggleModal('deleteUserModal', false); delUserId = null; }
    
    document.getElementById('confirmDeleteUserBtn').addEventListener('click', () => {
        if(delUserId) {
            document.getElementById('deleteUserForm').submit();
        }
    });

    function toggleUserActiveStatus(id) {
        fetch(`/superadmin/users/${id}/toggle-status`, {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            showToast(data.is_active ? 'Pengguna diaktifkan' : 'Pengguna dinonaktifkan');
            const row = document.getElementById('row-' + id);
            const statusDot = row.querySelector('.absolute.bottom-0.right-0');
            if (data.is_active) {
                statusDot.className = 'absolute bottom-0 right-0 w-3 h-3 border-2 border-white rounded-full bg-emerald-500 dark:border-slate-800';
            } else {
                statusDot.className = 'absolute bottom-0 right-0 w-3 h-3 border-2 border-white rounded-full bg-slate-300 dark:border-slate-800';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('Gagal mengubah status pengguna.');
        });
    }

    function filterByRole(role) {
        let visibleCount = 0;
        document.querySelectorAll('.table-row').forEach(row => {
            if (role === '' || row.dataset.role === role) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });
        document.getElementById('displayCount').textContent = visibleCount;
    }
</script>
@endsection
