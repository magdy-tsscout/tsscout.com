<a href="{{ route('calculator.index') }}" @if(Route::is("calculator.index") || Route::is("calculator") || Route::is("ebay-calculator")) class="active" @endif>
    <img src="{{ asset('public/assets/flags/usa.svg') }}" width="16" height="16" alt="USA" />
    <span>USA</span>
</a>
<a
    href="{{ route('calculator.uk') }}"
    @if(Route::is("calculator.uk") || Route::is("calculator.uk.search")) class="active" @endif
>
    <img src="{{ asset('public/assets/flags/uk.svg') }}" width="16" height="16" alt="UK" />
    <span>UK</span>
</a>
<a
    href="{{ route('calculator.au') }}"
    @if(Route::is("calculator.au") || Route::is("calculator.au.search")) class="active" @endif
>
    <img src="{{ asset('public/assets/flags/au.svg') }}" width="16" height="16" alt="au" />
    <span>AU</span>
</a>


<a
    href="{{ route('calculator.ca') }}"
    @if(Route::is("calculator.ca") || Route::is("calculator.ca.search")) class="active" @endif
>
    <img src="{{ asset('public/assets/flags/ca.svg') }}" width="16" height="16" alt="ca" />
    <span>CA</span>
</a>
<a
    href="{{ route('calculator.de') }}"
    @if(Route::is("calculator.de") || Route::is("calculator.de.search")) class="active" @endif
>
    <img src="{{ asset('public/assets/flags/de.svg') }}" width="16" height="16" alt="de" />
    <span>DE</span>
</a>
<a
    href="{{ route('calculator.fr') }}"
    @if(Route::is("calculator.fr") || Route::is("calculator.fr.search")) class="active" @endif
>
    <img src="{{ asset('public/assets/flags/fr.svg') }}" width="16" height="16" alt="fr" />
    <span>FR</span>
</a>
<a
    href="{{ route('calculator.it') }}"
    @if(Route::is("calculator.it") || Route::is("calculator.it.search")) class="active" @endif
>
    <img src="{{ asset('public/assets/flags/it.svg') }}" width="16" height="16" alt="it" />
    <span>IT</span>
</a>
