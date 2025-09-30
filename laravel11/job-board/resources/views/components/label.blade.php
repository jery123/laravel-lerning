<label class="mb-2 block text-sm font-medium text-slate-900" 
        for="{{ $for }}">
    {{ $slot }} @if($required)<span @class(['text-slate-500' => !$errors->has($for), 'text-red-500'=>$errors->has($for)])>*</span>@endif
</label>