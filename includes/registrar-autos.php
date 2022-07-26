<div id="#wpbody-content" class="wrap">
    <h1><?php esc_html_e('Registrar', 'textdomain');?></h1>
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
                                        <label class="label">Marca</label>
                                        <div class="control">
                                            <input class="input" type="text" name="marca"
                                                id="marca">
                                        </div>
                                        <p class="help">This is a help text</p>
                                    </div>
                                </div>
                                <div class="column">
                                    <div class="field">
                                        <label class="label">Modelo</label>
                                        <div class="control">
                                            <input class="input" type="text" name="modelo"
                                                id="modelo">
                                        </div>
                                        <p class="help">This is a help text</p>
                                    </div>
                                </div>
                                <div class="column">
                                    <div class="field">
                                        <label class="label">Año</label>
                                        <div class="control">
                                            <input class="input" type="text" name="año"
                                                id="año">
                                        </div>
                                        <p class="help">This is a help text</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Datos del Cliente -->

                            <!-- Datos de Contacto del Cliente -->
                            <div class="columns">
                                <div class="column">
                                    <label class="label">Placa</label>
                                    <div class="control">
                                        <input class="input" type="text" name="placa" id="placa">
                                    </div>
                                    <p class="help">This is a help text</p>
                                </div>
                                <div class="column">
                                    <label class="label">Numero de Serie</label>
                                    <div class="control">
                                        <input class="input" type="text" name="serie" id="serie">
                                    </div>
                                    <p class="help">This is a help text</p>
                                </div>
                            </div>
                            <!-- Datos de Contacto del Cliente -->

                            <button type="submit" class="button is-normal is-success">Enviar</button>
                        </form>
                        <br>
                        <article id="alerts" class="message">
                            <div class="message-header">
                                <button class="delete" aria-label="delete"></button>
                            </div>
                            <div class="message-body">
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>