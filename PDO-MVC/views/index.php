
        <?php if(isset($_GET['error']) and $_GET['error'] == 101): ?>
            <div class="alert alert-danger">
                Clave Incorrecta
            </div>
        <?php endif; ?>
        <?php if(isset($_GET['error']) and $_GET['error'] == 200): ?>
            <div class="alert alert-danger">
                Usuario No Autorizado
            </div>
        <?php endif; ?>

        <a href="<?php echo BASE_URL ?>register/index" class="btn btn-success float-end ">registrar</a>

        <form action="<?php echo BASE_URL ?>login/index" class="pt-5" method="POST">
            <h3>LOGIN</h3>

            <label for="email">Email
                <input type="email" name="email" class="form-control" placeholder="@">
            </label>
            <label for="password">Password
                <input type="password" name="password" class="form-control" placeholder="****">
            </label>
            <input type="submit" class="btn btn-primary" value="Ingresar">
        </form>

