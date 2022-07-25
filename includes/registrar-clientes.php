<div class="columns">
    <div class="column">
        <h1><?php esc_html_e( 'Registrar Clientes', 'textdomain' ); ?></h1>
    </div>
</div>
<div class="columns">
    <div class="column">
        <div class="card">
            <div class="card-content">
                <div class="content">
                    <form action="<?php echo admin_url('admin-ajax.php'); ?>" method="post" id="data-form">
                        <label for="nombre">Nombre(s):</label>
                        <input type="text" name="nombre" id="nombre">
                        <br>
                        <label for="apellido_materno">Apellido Materno:</label>
                        <input type="text" name="apellido_materno" id="apellido_materno">
                        <br>
                        <label for="apellido_paterno">Apellido Paterno:</label>
                        <input type="text" name="apellido_paterno" id="apellido_paterno">
                        <button type="submit">Enviar</button>
                    </form>
                    <div>
                        <p id="messages"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>