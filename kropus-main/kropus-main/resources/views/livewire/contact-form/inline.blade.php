<div>
    <form class="relative grid grid-cols-2 gap-4 lg:gap-5" wire:submit="submit">
        @if (session()->has('success'))
            <div class="alert alert-success col-span-2">{{ session('success') }}</div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-success col-span-2">{{ session('error') }}</div>
        @endif

        <div class="form-control-wrap col-span-2 lg:col-span-1">
            <input class="form-control-input" placeholder="{{ __('contact_form::attribute.name') }}" type="text"
                   wire:model="data.name">
            @error('data.name')
            <span class="form-control-error">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <div class="form-control-wrap col-span-2 lg:col-span-1">
            <input class="form-control-input" placeholder="{{ __('contact_form::attribute.email_or_phone') }}"
                   type="text" wire:model="data.email_or_phone">
            @error('data.email_or_phone')
            <span class="form-control-error">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <div class="form-control-wrap col-span-2">
            <textarea class="form-control-input h-[7rem]" placeholder="{{ __('contact_form::attribute.message') }}"
                      wire:model="data.message"></textarea>
            @error('data.message')
            <span class="form-control-error">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <div class="col-span-2 grid lg:grid-cols-2 gap-4 lg:gap-5 items-center">
            <div class="order-1 md:order-2">
                <div class="flex">
                    <input class="mr-4 accent-primary w-[1.625rem] h-[1.625rem]" required type="checkbox" id="contact-form-inline-accept" name="accept" />
                    <label class="text-3 text-[#7C7C7C]" for="contact-form-inline-accept">Я согласен на обработку моих персональных данных в соответствии с <a target="_blank" class="underline hover:text-primary" href="{{ frontend_url('privacy') }}">политикой конфиденциальности</a></label>
                </div>
            </div>
            <div class="order-2 md:order-1">
                <input type="submit" class="btn btn-primary w-full cursor-pointer" value="Отправить">
            </div>
        </div>
    </form>
</div>
