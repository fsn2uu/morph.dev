<table>
    <thead>
        <th>Title</th>
    </thead>
    <tbody>
        @foreach($rate_tables as $table)
            <tr>
                <td><a href="{{ route('admin.rates.edit', $table->id) }}" class="text-blue-400 underline">{{ $table->name }}</a></td>
            </tr>
        @endforeach
    </tbody>
</table>