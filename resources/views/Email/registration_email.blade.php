<!DOCTYPE html>
<html>
<head>
    <title>New User Registration CALL LABS</title>
</head>
<body>
    <h2>New User Registration</h2>
    <p>A new user has registered with the following details:</p>
    <table border="1">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
        </tr>
        <tr>
            <td>{{ $emaildata['name'] }}</td>
            <td>{{ $emaildata['email'] }}</td>
            <td>{{ $emaildata['phone'] }}</td>
        </tr>
    </table>
</body>
</html>