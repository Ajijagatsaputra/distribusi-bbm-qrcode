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
                    <option value="superadmin">Super Admin</option>
                    <option value="admin">Admin</option>
                    <option value="operator">Operator</option>
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

    {{-- ROLE EXPLANATION (Moved up for better UX flow) --}}
    <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-3">
        <div class="p-6 transition-all duration-300 bg-white border shadow-sm border-slate-200/60 rounded-2xl dark:bg-slate-800 dark:border-slate-700/50 hover:shadow-md">
            <div class="flex items-center gap-3 mb-3">
                <div class="p-2.5 rounded-xl bg-purple-100 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400">
                    <span class="material-symbols-outlined">shield_person</span>
                </div>
                <h4 class="font-bold text-slate-900 dark:text-white">Super Admin (<span id="count-sa">1</span>)</h4>
            </div>
            <p class="text-xs text-slate-500 dark:text-slate-400">Akses tak terbatas. Sistem konfigurasi, Master Data, Audit Log, Manajemen User.</p>
        </div>

        <div class="p-6 transition-all duration-300 bg-white border shadow-sm border-slate-200/60 rounded-2xl dark:bg-slate-800 dark:border-slate-700/50 hover:shadow-md">
            <div class="flex items-center gap-3 mb-3">
                <div class="p-2.5 rounded-xl bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400">
                    <span class="material-symbols-outlined">manage_accounts</span>
                </div>
                <h4 class="font-bold text-slate-900 dark:text-white">Admin (<span id="count-a">1</span>)</h4>
            </div>
            <p class="text-xs text-slate-500 dark:text-slate-400">Kontrol wilayah manajemen. Kelola QR Code operasional, Reports wilayah.</p>
        </div>

        <div class="p-6 transition-all duration-300 bg-white border shadow-sm border-slate-200/60 rounded-2xl dark:bg-slate-800 dark:border-slate-700/50 hover:shadow-md">
            <div class="flex items-center gap-3 mb-3">
                <div class="p-2.5 rounded-xl bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400">
                    <span class="material-symbols-outlined">engineering</span>
                </div>
                <h4 class="font-bold text-slate-900 dark:text-white">Operator (<span id="count-o">1</span>)</h4>
            </div>
            <p class="text-xs text-slate-500 dark:text-slate-400">Akses khusus lapangan (SPBU/Terminal). Pemindaian QR, validasi & riwayat.</p>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="overflow-hidden transition-all duration-300 bg-white border shadow-glass backdrop-blur-md border-slate-200/50 rounded-2xl dark:bg-slate-900/70 dark:border-slate-800">

        <div class="p-6 border-b border-slate-200/50 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/20">
            <div class="flex items-center justify-between">
                <h4 class="font-bold text-slate-900 dark:text-white">Daftar Akun Sistem</h4>
                <div class="flex gap-2 text-xs font-semibold text-slate-500">
                    Total: <span id="displayCount" class="text-pertamina-blue">3</span> Users
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

                    {{-- SUPER ADMIN --}}
                    <tr class="transition-colors table-row hover:bg-slate-50 dark:hover:bg-slate-800/30" data-role="superadmin" id="row-u1">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="relative">
                                    <div class="flex items-center justify-center w-10 h-10 text-sm font-bold text-white bg-purple-600 rounded-full">
                                        AJ
                                    </div>
                                    <div class="absolute bottom-0 right-0 w-3 h-3 border-2 border-white rounded-full bg-emerald-500 dark:border-slate-800"></div>
                                </div>
                                <div>
                                    <p class="font-bold text-slate-900 dark:text-white name-cell">Alex Johnson</p>
                                    <p class="text-[11px] font-semibold tracking-wider text-slate-500 uppercase">#SA001</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-medium text-slate-600 dark:text-slate-400 email-cell">alex.j@pertamina.com</p>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-1 text-xs font-bold uppercase rounded-full bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-400 border border-purple-200 dark:border-purple-800/50 role-cell">
                                Super Admin
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" checked class="sr-only peer status-toggle">
                                <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer dark:bg-slate-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-pertamina-green"></div>
                            </label>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <button onclick="openUserModal('edit', 'u1')" class="p-2 transition rounded-lg text-orange-500 hover:bg-orange-500/10 dark:hover:bg-orange-900/20 group hover:scale-110">
                                    <span class="text-lg material-symbols-outlined">edit</span>
                                </button>
                                <button onclick="openDeleteUserModal('u1')" class="p-2 transition rounded-lg text-pertamina-red hover:bg-pertamina-red/10 dark:hover:bg-red-900/20 group hover:scale-110">
                                    <span class="text-lg material-symbols-outlined">delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>

                    {{-- ADMIN --}}
                    <tr class="transition-colors table-row hover:bg-slate-50 dark:hover:bg-slate-800/30" data-role="admin" id="row-u2">
                         <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="relative">
                                    <div class="flex items-center justify-center w-10 h-10 text-sm font-bold text-white rounded-full bg-pertamina-blue">
                                        DP
                                    </div>
                                    <div class="absolute bottom-0 right-0 w-3 h-3 border-2 border-white rounded-full bg-emerald-500 dark:border-slate-800"></div>
                                </div>
                                <div>
                                    <p class="font-bold text-slate-900 dark:text-white name-cell">Daniel Pratama</p>
                                    <p class="text-[11px] font-semibold tracking-wider text-slate-500 uppercase">#AD015</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-medium text-slate-600 dark:text-slate-400 email-cell">daniel.p@pertamina.com</p>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-1 text-xs font-bold uppercase rounded-full bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400 border border-blue-200 dark:border-blue-800/50 role-cell">
                                Admin
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" checked class="sr-only peer status-toggle">
                                <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer dark:bg-slate-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-pertamina-green"></div>
                            </label>
                        </td>
                        <td class="px-6 py-4 text-right">
                           <div class="flex items-center justify-end gap-2">
                                <button onclick="openUserModal('edit', 'u2')" class="p-2 transition rounded-lg text-orange-500 hover:bg-orange-500/10 dark:hover:bg-orange-900/20 group hover:scale-110">
                                    <span class="text-lg material-symbols-outlined">edit</span>
                                </button>
                                <button onclick="openDeleteUserModal('u2')" class="p-2 transition rounded-lg text-pertamina-red hover:bg-pertamina-red/10 dark:hover:bg-red-900/20 group hover:scale-110">
                                    <span class="text-lg material-symbols-outlined">delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>

                    {{-- OPERATOR --}}
                    <tr class="transition-colors table-row hover:bg-slate-50 dark:hover:bg-slate-800/30" data-role="operator" id="row-u3">
                         <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="relative">
                                    <div class="flex items-center justify-center w-10 h-10 text-sm font-bold text-white rounded-full bg-pertamina-green">
                                        BK
                                    </div>
                                    <div class="absolute bottom-0 right-0 w-3 h-3 bg-slate-300 border-2 border-white rounded-full dark:border-slate-800"></div>
                                </div>
                                <div>
                                    <p class="font-bold text-slate-900 dark:text-white name-cell">Budi Kusuma</p>
                                    <p class="text-[11px] font-semibold tracking-wider text-slate-500 uppercase">#OP082</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                           <p class="font-medium text-slate-600 dark:text-slate-400 email-cell">budi.k@field.pertamina.com</p>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-1 text-xs font-bold uppercase rounded-full bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800/50 role-cell">
                                Operator
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer status-toggle">
                                <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer dark:bg-slate-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-pertamina-green"></div>
                            </label>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <button onclick="openUserModal('edit', 'u3')" class="p-2 transition rounded-lg text-orange-500 hover:bg-orange-500/10 dark:hover:bg-orange-900/20 group hover:scale-110">
                                    <span class="text-lg material-symbols-outlined">edit</span>
                                </button>
                                <button onclick="openDeleteUserModal('u3')" class="p-2 transition rounded-lg text-pertamina-red hover:bg-pertamina-red/10 dark:hover:bg-red-900/20 group hover:scale-110">
                                    <span class="text-lg material-symbols-outlined">delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>

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
                <form id="userForm" class="space-y-4" onsubmit="event.preventDefault(); submitUser();">
                    <input type="hidden" id="form-mode" value="add">
                    <input type="hidden" id="form-userid" value="">
                    <div>
                        <label class="block mb-2 text-sm font-bold text-slate-700 dark:text-slate-300">Nama Lengkap</label>
                        <input type="text" id="userName" class="w-full px-4 py-3 text-sm transition-all border outline-none rounded-xl border-slate-300 dark:border-slate-700 dark:bg-slate-800 text-slate-900 dark:text-white focus:border-pertamina-blue focus:ring-2 focus:ring-pertamina-blue/20" required>
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-bold text-slate-700 dark:text-slate-300">Alamat Email</label>
                        <input type="email" id="userEmail" class="w-full px-4 py-3 text-sm transition-all border outline-none rounded-xl border-slate-300 dark:border-slate-700 dark:bg-slate-800 text-slate-900 dark:text-white focus:border-pertamina-blue focus:ring-2 focus:ring-pertamina-blue/20" required>
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-bold text-slate-700 dark:text-slate-300">Level Akses (Role)</label>
                        <select id="userRole" class="w-full px-4 py-3 text-sm transition-all border outline-none rounded-xl border-slate-300 dark:border-slate-700 dark:bg-slate-800 text-slate-900 dark:text-white focus:border-pertamina-blue focus:ring-2 focus:ring-pertamina-blue/20" required>
                            <option value="superadmin">Super Admin</option>
                            <option value="admin">Admin Wilayah</option>
                            <option value="operator">Operator Lapangan</option>
                        </select>
                    </div>

                    <div id="passwordArea">
                        <label class="block mb-2 text-sm font-bold text-slate-700 dark:text-slate-300">Password</label>
                        <div class="relative">
                            <input type="password" id="userPassword" class="w-full px-4 py-3 text-sm transition-all border outline-none rounded-xl border-slate-300 dark:border-slate-700 dark:bg-slate-800 text-slate-900 dark:text-white focus:border-pertamina-blue focus:ring-2 focus:ring-pertamina-blue/20">
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
        document.getElementById('form-mode').value = mode;
        const form = document.getElementById('userForm');
        
        if (mode === 'add') {
            form.reset();
            document.getElementById('modal-title').textContent = 'Tambah Pengguna';
            document.getElementById('modal-subtitle').textContent = 'Buat akun baru untuk sistem';
            document.getElementById('modal-icon').textContent = 'person_add';
            document.getElementById('passwordArea').classList.remove('hidden');
            document.getElementById('passwordHelpText').classList.remove('hidden');
        } else {
            // Edit Mode
            const row = document.getElementById('row-' + id);
            document.getElementById('form-userid').value = id;
            document.getElementById('modal-title').textContent = 'Edit Pengguna';
            document.getElementById('modal-subtitle').textContent = 'Perbarui data akun';
            document.getElementById('modal-icon').textContent = 'manage_accounts';
            document.getElementById('passwordArea').classList.add('hidden');
            document.getElementById('passwordHelpText').classList.add('hidden');
            
            document.getElementById('userName').value = row.querySelector('.name-cell').textContent;
            document.getElementById('userEmail').value = row.querySelector('.email-cell').textContent;
            
            const rText = row.querySelector('.role-cell').textContent.trim();
            if(rText === 'Super Admin') document.getElementById('userRole').value = 'superadmin';
            if(rText === 'Admin') document.getElementById('userRole').value = 'admin';
            if(rText === 'Operator') document.getElementById('userRole').value = 'operator';
        }
        toggleModal('userModal', true);
    }
    
    function closeUserModal() { toggleModal('userModal', false); }
    
    function togglePassword() {
        const p = document.getElementById('userPassword');
        p.type = p.type === 'password' ? 'text' : 'password';
    }

    function submitUser() {
        const mode = document.getElementById('form-mode').value;
        const name = document.getElementById('userName').value;
        const roleSel = document.getElementById('userRole');
        const roleText = roleSel.options[roleSel.selectedIndex].text;
        
        if (mode === 'edit') {
            const id = document.getElementById('form-userid').value;
            const r = document.getElementById('row-' + id);
            r.querySelector('.name-cell').textContent = name;
            r.querySelector('.email-cell').textContent = document.getElementById('userEmail').value;
            
            const roleSpan = r.querySelector('.role-cell');
            roleSpan.textContent = roleText;
            
            const roleVal = document.getElementById('userRole').value;
            r.dataset.role = roleVal;
            if(roleVal === 'superadmin') roleSpan.className = "inline-flex items-center px-2.5 py-1 text-xs font-bold uppercase rounded-full bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-400 border border-purple-200 dark:border-purple-800/50 role-cell";
            if(roleVal === 'admin') roleSpan.className = "inline-flex items-center px-2.5 py-1 text-xs font-bold uppercase rounded-full bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400 border border-blue-200 dark:border-blue-800/50 role-cell";
            if(roleVal === 'operator') roleSpan.className = "inline-flex items-center px-2.5 py-1 text-xs font-bold uppercase rounded-full bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800/50 role-cell";
            
            showToast('User berhasil diperbarui!');
        } else {
            showToast('Sistem: Penambahan User Baru Sukses!');
        }
        closeUserModal();
        recalcCounts();
    }

    let delUserId = null;
    function openDeleteUserModal(id) {
        delUserId = id;
        document.getElementById('delete-user-name').textContent = document.getElementById('row-' + id).querySelector('.name-cell').textContent;
        toggleModal('deleteUserModal', true);
    }
    function closeDeleteUserModal() { toggleModal('deleteUserModal', false); delUserId = null; }
    
    document.getElementById('confirmDeleteUserBtn').addEventListener('click', () => {
        if(delUserId) {
            document.getElementById('row-' + delUserId).remove();
            showToast('Pengguna dihapus.');
            recalcCounts();
        }
        closeDeleteUserModal();
    });

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

    function recalcCounts() {
        let sa=0, ad=0, op=0;
        document.querySelectorAll('.table-row').forEach(r => {
            if(r.dataset.role === 'superadmin') sa++;
            if(r.dataset.role === 'admin') ad++;
            if(r.dataset.role === 'operator') op++;
        });
        document.getElementById('count-sa').textContent = sa;
        document.getElementById('count-a').textContent = ad;
        document.getElementById('count-o').textContent = op;
        document.getElementById('displayCount').textContent = sa+ad+op;
    }
</script>
@endsection
