{include file="header.tpl"}
    <div class="container">
    <h1>Login</h1>
        <form action="username" method="get">
            <!-- Username -->
            <label class="label" for="name">Username:</label>
            <input class="input" type="name" name="input_username" placeholder="username" required>
            <!-- Password -->
            <label class="label" for="username">Password:</label>       
            <input class="input" type="password" name="input_password" placeholder="password" required>
            <p class="label"><a href="#">Forgot your password?</a></p>
            <!-- Submit Button -->
            <button class="btn" type="submit">Login</button>
        </form>       
    </div>
{include file="footer.tpl"}