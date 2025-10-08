<!DOCTYPE html>
<html>
<head>
    <title>Create User</title>
</head>
<body>

<h1>Create User</h1>

@if(session('success'))
    <div style="color:green">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div style="color:red">{{ session('error') }}</div>
@endif

@if($errors->any())
    <div style="color:red">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('user.store') }}">
    @csrf
    <label>Email:</label>
    <input type="email" name="email" value="{{ old('email') }}"><br><br>

    <label>Password:</label>
    <input type="password" name="password"><br><br>

    <label>Role:</label>
    <input type="text" name="User_Role" value="{{ old('User_Role') }}"><br><br>

    <button type="submit">Create User</button>
</form>

</body>
</html>
