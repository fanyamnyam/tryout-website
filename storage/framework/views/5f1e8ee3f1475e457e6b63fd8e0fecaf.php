<?php if (isset($component)) { $__componentOriginal69dc84650370d1d4dc1b42d016d7226b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b = $attributes; } ?>
<?php $component = App\View\Components\GuestLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('guest-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\GuestLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="flex flex-col lg:flex-row min-h-screen bg-white">
        
        
        <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-b from-[#E9B159] via-[#8E93B0] to-[#436EB8] p-16 flex-col justify-center items-center text-white relative">
            <div class="max-w-md text-center">
                <img src="<?php echo e(asset('images/login.png')); ?>" alt="Illustration" class="w-full h-auto mb-12 drop-shadow-2xl">
                
                <h2 class="text-3xl font-extrabold mb-4 leading-tight">
                    Role yang dipilih adalah <br> 
                    <span class="text-yellow-300 font-black text-4xl">
                        
                        <?php if($role == 'orang_tua' || $role == 'ortu'): ?> 
                            Orang Tua 
                        <?php else: ?> 
                            <?php echo e(ucfirst($role)); ?> 
                        <?php endif; ?>
                    </span>
                </h2>
                <p class="text-white/90 text-lg font-medium leading-relaxed">
                    Silakan masukan 
                    
                    <?php if($role == 'siswa'): ?> 
                        NISN 
                    <?php elseif($role == 'guru'): ?> 
                        NIP 
                    <?php elseif($role == 'orang_tua' || $role == 'ortu'): ?> 
                        Username Orang Tua
                    <?php else: ?> 
                        Username Admin 
                    <?php endif; ?> 
                    dan kata sandi yang sudah disediakan
                </p>
            </div>
        </div>

        
        <div class="w-full lg:w-1/2 flex flex-col justify-center px-12 md:px-24 lg:px-32">
            <div class="max-w-md w-full mx-auto">
                
                <div class="flex items-center gap-3 mb-10">
                    <img src="<?php echo e(asset('images/logo_sdit.png')); ?>" class="w-10 h-10 object-contain">
                    <span class="text-[#0052CC] font-extrabold text-sm tracking-[0.2em] uppercase">SDIT AL-IMAN</span>
                </div>

                <h1 class="text-5xl font-[900] text-[#0052CC] mb-2 tracking-tight">Selamat Datang!</h1>
                <p class="text-gray-400 mb-12 font-medium text-lg">Masuk untuk memulai sesi Anda</p>

                
                <form method="POST" action="<?php echo e(route('login')); ?>" class="space-y-6">
                    <?php echo csrf_field(); ?>
                    
                    
                    <input type="hidden" name="role" value="<?php echo e($role); ?>">

                    
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-5 text-gray-400 group-focus-within:text-[#0052CC] transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </span>
                        <input type="text" name="username" value="<?php echo e(old('username')); ?>" required autofocus
                            
                            placeholder="<?php if($role == 'siswa'): ?>NISN Siswa <?php elseif($role == 'guru'): ?>NIP Guru <?php elseif($role == 'orang_tua' || $role == 'ortu'): ?>Username Orang Tua <?php else: ?> Username Admin <?php endif; ?>"
                            class="w-full pl-14 pr-6 py-4 border-2 border-gray-100 rounded-3xl focus:ring-0 focus:border-[#0052CC] outline-none transition-all text-gray-700 font-semibold text-lg bg-gray-50/50 <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        
                        <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['messages' => $errors->get('username'),'class' => 'mt-2']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('username')),'class' => 'mt-2']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $attributes = $__attributesOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__attributesOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $component = $__componentOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__componentOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
                    </div>

                    
                    <div class="relative group" x-data="{ showPassword: false }">
                        
                        <span class="absolute inset-y-0 left-0 flex items-center pl-5 text-gray-400 group-focus-within:text-[#0052CC] transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                            </svg>
                        </span>

                        
                        <input :type="showPassword ? 'text' : 'password'"
                            name="password"
                            required
                            placeholder="Kata Sandi"
                            class="w-full pl-14 pr-16 py-4 border-2 border-gray-100 rounded-3xl focus:ring-0 focus:border-[#0052CC] outline-none transition-all text-gray-700 font-semibold text-lg bg-gray-50/50 <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">

                        
                        <button type="button"
                            @click="showPassword = !showPassword"
                            class="absolute inset-y-0 right-0 pr-6 flex items-center hover:scale-110 transition-transform focus:outline-none">

                            <img src="<?php echo e(asset('images/show-pass.png')); ?>" class="w-6 h-6 opacity-50 group-focus-within:opacity-100" x-show="!showPassword" x-cloak>
                            <img src="<?php echo e(asset('images/hide-pass.png')); ?>" class="w-6 h-6 opacity-50 group-focus-within:opacity-100" x-show="showPassword" x-cloak>
                        </button>

                        <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['messages' => $errors->get('password'),'class' => 'mt-2']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('password')),'class' => 'mt-2']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $attributes = $__attributesOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__attributesOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $component = $__componentOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__componentOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
                    </div>

                    <button type="submit" class="w-full py-4 bg-[#0052CC] hover:bg-[#0041a3] text-white font-black text-xl rounded-3xl shadow-[0_10px_20px_rgba(0,82,204,0.3)] transition-all transform active:scale-[0.97] mt-6">
                        Masuk
                    </button>
                </form>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $attributes = $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $component = $__componentOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\tryout-website\resources\views/auth/login.blade.php ENDPATH**/ ?>