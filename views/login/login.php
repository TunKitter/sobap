<h1>Login page</h1>
<style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }
    form {
        display: flex;
        flex-direction: column;
        gap: 10px;
        width: 40%;
    }
    form :is(input,button) {
        height: 2em;
    }
</style>
<form method="post">
    <input type="text" name="username">
    <input type="password" name="password">
    <button>Login</button>
</form>