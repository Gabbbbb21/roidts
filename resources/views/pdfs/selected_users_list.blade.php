<!DOCTYPE html>
<html>
<head>
    <title>Selected User Report</title>
    <style>
        /* ... (Your CSS from the first example) ... */
    </style>
</head>
<body>
    <h1>Report for Selected Users (Total: {{ count($users) }})</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            {{-- Loop through the collection of selected users --}}
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>