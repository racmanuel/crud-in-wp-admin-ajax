<div id="#wpbody-content" class="wrap">
    <h1><?php esc_html_e('Registrar Clientes', 'textdomain');?></h1>
    <div class="columns">
        <div class="column">
            <div class="card p-0">
                <div class="card-content">
                    <div class="content">
                        <form action="<?php echo admin_url('admin-ajax.php'); ?>" method="post" id="data-form">

                            <!-- Datos del Cliente -->
                            <div class="columns">
                                <div class="column">
                                    <div class="field">
                                        <label class="label">Nombre(s)</label>
                                        <div class="control">
                                            <input class="input" type="text" name="nombre" id="nombre">
                                        </div>
                                        <p class="help">This is a help text</p>
                                    </div>
                                </div>
                                <div class="column">
                                    <div class="field">
                                        <label class="label">Apellido Materno</label>
                                        <div class="control">
                                            <input class="input" type="text" name="apellido_materno"
                                                id="apellido_materno">
                                        </div>
                                        <p class="help">This is a help text</p>
                                    </div>

                                </div>
                                <div class="column">
                                    <div class="field">
                                        <label class="label">Apellido Paterno</label>
                                        <div class="control">
                                            <input class="input" type="text" name="apellido_paterno"
                                                id="apellido_paterno">
                                        </div>
                                        <p class="help">This is a help text</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Datos del Cliente -->

                            <!-- Datos de Contacto del Cliente -->
                            <div class="columns">
                                <div class="column">
                                    <label class="label">Teléfono 1:</label>
                                    <div class="control">
                                        <input class="input" type="text" name="telefono_1" id="telefono_1">
                                    </div>
                                    <p class="help">This is a help text</p>
                                </div>
                                <div class="column">
                                    <label class="label">Teléfono 2:</label>
                                    <div class="control">
                                        <input class="input" type="text" name="telefono_2" id="telefono_2">
                                    </div>
                                    <p class="help">This is a help text</p>
                                </div>
                            </div>
                            <div class="columns">
                                <div class="column">
                                    <label class="label">Dirección:</label>
                                    <div class="control">
                                        <input class="input" type="text" name="direccion" id="direccion">
                                    </div>
                                    <p class="help">This is a help text</p>
                                </div>
                            </div>
                            <!-- Datos de Contacto del Cliente -->



                            <button type="submit" class="button is-normal is-success">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>