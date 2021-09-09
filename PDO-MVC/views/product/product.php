
    <div class="mb-5">
        Bienvenido <strong><?php echo $_SESSION['email']; ?></strong>
        <a href="<?php echo BASE_URL ?>login/exit" class="btn btn-danger float-end"> Salir </a> 
    </div>

    <a href="<?php echo BASE_URL ?>product/add" class="btn btn-primary m-2">Agregar producto</a>

    <table class="table">
       <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">product</th>    
                <th scope="col"></th>        
            </tr>
       </thead>
       <tbody>
           <?php foreach ($products as $prod): ?>
                <tr>                    
                    <td scope='row'><?php echo $prod['id']; ?></td>
                    <td><?php echo $prod['product']; ?></td>
                    <td></td>
                </tr>
            <?php endforeach; ?>
            
       </tbody>
    </table>
