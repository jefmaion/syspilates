    @props([
        'user' => null, 
        'size' => 'sm',
        'avatar' => $user->avatar ?? null,
        'genderColor' => ($user->gender) === 'F' ? 'purple' : 'blue'
    ])
    
    <span {{ $attributes->merge(['class' => ' bg-'.$genderColor.'-lt text-'.$genderColor.'-lt-fg avatar avatar-'.$size.' me-2 ']) }} @if(!empty($user->avatar)) style="background-image: url({{ asset('storage/'. $avatar) }})"  @endif>

        @if(!$user->avatar)
            {{$user->initials }}
        @endif
        
    </span>