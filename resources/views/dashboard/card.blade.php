<div class="card-columns mt-4">

@foreach($cards as $card)
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                <span class="text-lg font-medium">
                    {{ $card->title }}
                </span>
                @if (Auth::user()->hasTeamRole(Auth::user()->currentTeam, 'admin'))
                <button type="button" class="close" aria-label="Zamknij" wire:click="$emit('removeCard', {{ $card->id }})">
                  <span aria-hidden="true">&times;</span>
                </button>
                @endif
            </h5>
            <p class="card-text">
                {{ $card->text }}
            </p>
            <p class="card-text">
                <small class="text-muted">
                    Kartkę dodano {{ $card->created_at }} przez {{ $card->name }}
                </small>
            </p>
            
        </div>
    </div>
@endforeach
</div>
