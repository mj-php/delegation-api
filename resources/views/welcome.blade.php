<div class="row">
    <div class="col-lg-6 col-md-12">
        Welcome to Delegation App
        <div>
            @foreach ($delegations as $delegation)
                Delegation of worker {{ $delegation['worker']['id'] }} to {{ $delegation['country']['name'] }} started {{ $delegation['start']['date'] }} and ended {{ $delegation['end']['date']}}.
                Worker must recieve {{ $delegation['amountDue'] }} {{ $delegation['currency'] }} compensation
            @endforeach
        </div>
    </div>
</div>
