@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-tixtogo-border focus:border-sage-dark focus:ring-sage-dark rounded-tix shadow-sm']) }}>
