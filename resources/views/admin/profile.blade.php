@extends('layouts.admin')

@section('title', 'User Profile Settings')

@section('content')
    <div class="animate-slide-in">
        <h3 class="text-3xl font-black tracking-tight text-slate-900 dark:text-white">Profile Settings</h3>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Manage your account information and security preferences.</p>
    </div>
    
    <div class="overflow-hidden transition-all border shadow-glass backdrop-blur-md bg-white/70 dark:bg-slate-900/70 border-white/50 dark:border-slate-800 rounded-2xl animate-slide-in">
        <form class="divide-y divide-slate-200/50">
            <div class="p-8">
                <div class="flex items-center gap-3 mb-8">
                    <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-pertamina-blue/10">
                        <span class="text-xl material-symbols-outlined text-pertamina-blue">person_outline</span>
                    </div>
                    <h4 class="text-lg font-bold text-slate-900 dark:text-white">Personal Information</h4>
                </div>
                <div class="space-y-8">
                    <div class="flex items-center gap-8">
                        <div class="relative group">
                            <div class="bg-center bg-cover border-4 rounded-full shadow-sm size-24 border-white dark:border-slate-800 ring-1 ring-slate-200 dark:ring-slate-700"
                                style="background-image: url('https://ui-avatars.com/api/?name=Admin+User&background=005eb8&color=fff');">
                            </div>
                            <button class="absolute bottom-0 right-0 flex items-center justify-center text-white transition-all border-2 border-white rounded-full shadow-lg size-8 bg-pertamina-blue hover:bg-blue-700 dark:border-slate-900 shadow-pertamina-blue/30" type="button">
                                <span class="text-sm material-symbols-outlined">photo_camera</span>
                            </button>
                        </div>
                        <div>
                            <div class="flex items-center gap-3">
                                <p class="text-sm font-bold text-slate-900 dark:text-white">Profile Photo</p>
                                <span class="px-2.5 py-0.5 text-[10px] font-black uppercase tracking-wider bg-pertamina-blue/10 text-pertamina-blue rounded-full border border-pertamina-blue/20">Admin Logistik</span>
                            </div>
                            <p class="mt-1 text-xs text-slate-500">Update your profile picture for the system.</p>
                            <button class="mt-3 text-sm font-bold transition-all text-pertamina-blue hover:text-blue-700 hover:underline" type="button">Update Profile</button>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Full Name</label>
                            <input class="w-full px-4 text-sm transition-all bg-white border rounded-lg h-11 dark:bg-slate-800 border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-pertamina-blue/20 focus:border-pertamina-blue input-glass" type="text" value="Budi Santoso" />
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Email Address</label>
                            <input class="w-full px-4 text-sm transition-all bg-white border rounded-lg h-11 dark:bg-slate-800 border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-pertamina-blue/20 focus:border-pertamina-blue input-glass" type="email" value="budi.santoso@pertamina.com" />
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Employee ID</label>
                            <input class="w-full px-4 text-sm font-mono rounded-lg cursor-not-allowed h-11 bg-slate-100/50 dark:bg-slate-800/50 border-slate-200 dark:border-slate-800 text-slate-500" readonly="" type="text" value="ADM-12993-LOG" />
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Department</label>
                            <input class="w-full px-4 text-sm rounded-lg cursor-not-allowed h-11 bg-slate-100/50 dark:bg-slate-800/50 border-slate-200 dark:border-slate-800 text-slate-500" readonly="" type="text" value="Logistics Operations" />
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="p-8">
                <div class="flex items-center gap-3 mb-8">
                    <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-orange-500/10">
                        <span class="text-xl material-symbols-outlined text-orange-500">lock_reset</span>
                    </div>
                    <h4 class="text-lg font-bold text-slate-900 dark:text-white">Security</h4>
                </div>
                <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Current Password</label>
                        <input class="w-full px-4 text-sm transition-all bg-white border rounded-lg h-11 dark:bg-slate-800 border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-pertamina-blue/20 focus:border-pertamina-blue input-glass" placeholder="••••••••" type="password" />
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">New Password</label>
                        <input class="w-full px-4 text-sm transition-all bg-white border rounded-lg h-11 dark:bg-slate-800 border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-pertamina-blue/20 focus:border-pertamina-blue input-glass" placeholder="••••••••" type="password" />
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Confirm New Password</label>
                        <input class="w-full px-4 text-sm transition-all bg-white border rounded-lg h-11 dark:bg-slate-800 border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-pertamina-blue/20 focus:border-pertamina-blue input-glass" placeholder="••••••••" type="password" />
                    </div>
                </div>
                <div class="flex items-start gap-3 p-4 mt-6 border rounded-xl bg-orange-500/10 border-orange-500/20">
                    <span class="mt-0.5 material-symbols-outlined text-orange-600">info</span>
                    <p class="text-sm text-orange-800 dark:text-orange-400">Password must be at least 8 characters long and include a mix of uppercase letters, numbers, and symbols.</p>
                </div>
            </div>
            
            <div class="flex items-center justify-end gap-3 p-8 bg-slate-50/50 dark:bg-slate-800/30">
                <button class="px-6 py-2.5 text-sm font-bold transition-all bg-white border shadow-sm rounded-xl dark:bg-slate-800 border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700" type="button">Discard Changes</button>
                <button class="px-8 py-2.5 text-sm font-bold text-white transition-all shadow-lg rounded-xl bg-gradient-to-r from-pertamina-blue to-blue-600 hover:to-blue-500 shadow-glow-blue hover:scale-105" type="submit">Save Changes</button>
            </div>
        </form>
    </div>
    
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
        <div class="p-6 transition-all border shadow-glass backdrop-blur-md bg-white/70 dark:bg-slate-900/70 border-white/50 dark:border-slate-800 rounded-2xl">
            <h5 class="flex items-center gap-3 font-bold text-slate-900 dark:text-white">
                <div class="flex items-center justify-center rounded-lg size-10 bg-pertamina-blue/10">
                    <span class="text-xl material-symbols-outlined text-pertamina-blue">notifications_active</span>
                </div>
                Notification Settings
            </h5>
            <p class="mt-4 mb-6 text-sm text-slate-500 dark:text-slate-400">Choose which distribution updates, alerts, and system notifications you want to receive across the portal.</p>
            <button class="text-sm font-bold transition-colors text-pertamina-blue hover:text-blue-700 hover:underline">Manage Notifications</button>
        </div>
        
        <div class="p-6 transition-all border shadow-glass backdrop-blur-md bg-white/70 dark:bg-slate-900/70 border-white/50 dark:border-slate-800 rounded-2xl">
            <h5 class="flex items-center gap-3 font-bold text-slate-900 dark:text-white">
                <div class="flex items-center justify-center rounded-lg size-10 bg-pertamina-red/10">
                    <span class="text-xl material-symbols-outlined text-pertamina-red">admin_panel_settings</span>
                </div>
                Account Status
            </h5>
            <p class="mt-4 mb-6 text-sm text-slate-500 dark:text-slate-400">Your account is currently active. For roles and permissions management, contact a Super Admin.</p>
            <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-bold border rounded-full text-pertamina-green bg-pertamina-green/10 border-pertamina-green/20">
                <span class="w-1.5 h-1.5 bg-pertamina-green rounded-full"></span>
                Account Active
            </span>
        </div>
    </div>
@endsection
