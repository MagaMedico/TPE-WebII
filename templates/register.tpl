{include file="header.tpl"}
    <div>
        {if empty($message)}
            {$message}
        {else}
            <h2 class="ContraseñaIncorrecta">{$message}</h2>
        {/if}
    </div>
    <div class="container">
    <h1>Login</h1>
        <form action="newUser" method="post">
            <!-- Username -->
            <label class="label" for="name">Username:</label>
            <input class="input" type="name" name="input_username" placeholder="username" value="{$user}" required>
            <!-- Password -->
            <label class="label" for="username">Password:</label>
            <input class="input" type="password" name="input_password" placeholder="password" required>
            <label class="label" for="username">Repeat Password:</label>
            <input class="input" type="password" name="repeat_password" placeholder="password" required>
            <!-- Submit Button -->
            <button class="btn" type="submit">register</button>
        </form>
    </div>
{include file="footer.tpl"}