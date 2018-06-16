<table class="table" id="medRatings-table">
    <thead>
        <tr>
        <th>Usuário</th>
        <th>Médico</th>
        <th>Avaliação</th>
        <th>Texto</th>
        </tr>
    </thead>
    <tbody>
    @foreach($medRatings as $medRating)
        <tr>
            <td>{!! $medRating->user->first_name !!} {!! $medRating->user->last_name !!}</td>
            <td>{!! $medRating->staff->name !!}</td>
            <td>{!! $medRating->rating !!}</td>
            <td>{!! $medRating->text !!}</td>
        </tr>
    @endforeach
    </tbody>
</table>