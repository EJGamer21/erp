<div class="container">
    <h1>Usuarios</h1>
    <table class="table striped highlight centered">
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Nombre</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td>
                    <a href="<?= base_url('home/view/').$user->id.'/'.strtolower($user->nombre.'-'.$user->apellido) ?>">
                        <?= $user->username ?>
                    </a>
                </td>
                <td>
                    <a href="<?= base_url('home/view/').$user->id.'/'.strtolower($user->nombre.'-'.$user->apellido) ?>">
                        <?= $user->nombre.' '.$user->apellido ?>
                    </a>
                </td>
                <td>
                    <a href="<?= base_url('home/view/').$user->id.'/'.strtolower($user->nombre.'-'.$user->apellido) ?>">
                        <?= $user->email_id ?>
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>