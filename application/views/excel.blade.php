<table>
    <thead>
        <th>ID</th>
        <th>Nama</th>
        <th>Kelas</th>
    </thead>
    <tbody>
        @foreach ($rows as $value)
        <tr>
            <td>{{ $value[0] }}</td>
            <td>{{ $value[1] }}</td>
            <td>{{ $value[2] }}</td>
        </tr> 
        @endforeach
    </tbody>
</table>