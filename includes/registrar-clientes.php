<div id="#wpbody-content" class="wrap">
    <div class="columns">
        <div class="column">
            <h1><?php esc_html_e( 'Registrar Clientes', 'textdomain' ); ?></h1>
        </div>
    </div>
    <div class="columns">
        <div class="column">
            <div class="card p-0">
                <div class="card-content">
                    <div class="content">
                        <form action="<?php echo admin_url('admin-ajax.php'); ?>" method="post" id="data-form">
                            <div class="field">
                                <label class="label">Nombre(s)</label>
                                <div class="control">
                                    <input class="input" type="text" name="nombre" id="nombre">
                                </div>
                                <p class="help">This is a help text</p>
                            </div>
                            <div class="field">
                                <label class="label">Apellido Materno</label>
                                <div class="control">
                                    <input class="input" type="text" name="apellido_materno" id="apellido_materno">
                                </div>
                                <p class="help">This is a help text</p>
                            </div>
                            <div class="field">
                                <label class="label">Apellido Paterno</label>
                                <div class="control">
                                    <input class="input" type="text" name="apellido_paterno" id="apellido_paterno">
                                </div>
                                <p class="help">This is a help text</p>
                            </div>
                           
                            <button type="submit" class="button is-success">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>