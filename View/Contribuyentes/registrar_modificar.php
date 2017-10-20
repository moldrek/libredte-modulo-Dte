<?php if (isset($Contribuyente)) : ?>
<ul class="nav nav-pills pull-right">
    <li>
        <a href="<?=$_base?>/dte/contribuyentes/usuarios/<?=$Contribuyente->rut?>" title="Usuarios autorizados">
            <span class="fa fa-users"></span>
            Usuarios
        </a>
    </li>
    <li>
        <a href="<?=$_base?>/dte/contribuyentes/seleccionar/<?=$Contribuyente->rut?>" title="Seleccionar empresa">
            <span class="fa fa-check"></span>
            Seleccionar
        </a>
    </li>
</ul>
<?php endif; ?>

<h1><?=$titulo?></h1>
<p><?=$descripcion?></p>

<?php
$f = new \sowerphp\general\View_Helper_Form();
echo $f->begin(['id'=>$form_id, 'onsubmit'=>'Form.check() && Form.checkSend()']);
?>

<script type="text/javascript">
var impuestos_adicionales_tasa = <?=json_encode($impuestos_adicionales_tasa)?>;
$(function() {
    var url = document.location.toString();
    if (url.match('#')) {
        $('.nav-tabs a[href=#'+url.split('#')[1]+']').tab('show') ;
    }
});
</script>

<div role="tabpanel">
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#datos" aria-controls="datos" role="tab" data-toggle="tab">Empresa</a></li>
        <li role="presentation"><a href="#ambientes" aria-controls="ambientes" role="tab" data-toggle="tab">Ambientes</a></li>
        <li role="presentation"><a href="#correos" aria-controls="correos" role="tab" data-toggle="tab">Correos</a></li>
        <li role="presentation"><a href="#facturacion" aria-controls="facturacion" role="tab" data-toggle="tab">Facturación</a></li>
<?php if (isset($Contribuyente)) : ?>
        <li role="presentation"><a href="#api" aria-controls="api" role="tab" data-toggle="tab">API</a></li>
        <li role="presentation"><a href="#general" aria-controls="general" role="tab" data-toggle="tab">General</a></li>
<?php endif; ?>
    </ul>
    <div class="tab-content">

<!-- INICIO DATOS EMPRESA -->
<div role="tabpanel" class="tab-pane active" id="datos">
<?php
if ($form_id=='registrarContribuyente') {
    echo $f->input([
        'name' => 'rut',
        'label' => 'RUT',
        'check' => 'notempty rut',
        'attr' => 'maxlength="12" onblur="Contribuyente.setDatos(\'registrarContribuyente\')"',
    ]);
}
echo $f->input([
    'name' => 'razon_social',
    'label' => 'Razón social',
    'value' => isset($Contribuyente) ? $Contribuyente->razon_social : null,
    'check' => 'notempty',
    'attr' => 'maxlength="100"',
]);
echo $f->input([
    'name' => 'config_extra_nombre_fantasia',
    'label' => 'Nombre fantasía',
    'value' => isset($Contribuyente) ? $Contribuyente->config_extra_nombre_fantasia : null,
    'attr' => 'maxlength="100"',
]);
echo $f->input([
    'type' => 'select',
    'name' => 'actividad_economica',
    'label' => 'Actividad principal',
    'value' => isset($Contribuyente) ? $Contribuyente->actividad_economica : null,
    'help' => 'Indique la actividad económica principal de la empresa',
    'options' => [''=>'Seleccionar una actividad económica'] + $actividades_economicas,
    'check' => 'notempty',
    'attr'=>'onchange="document.getElementById(\'giroField\').value = this.options[this.selectedIndex].text.substr(this.options[this.selectedIndex].text.indexOf(\'-\')+1, 80)"',
]);
echo $f->input([
    'name' => 'giro',
    'label' => 'Giro',
    'value' => isset($Contribuyente) ? $Contribuyente->giro : null,
    'check' => 'notempty',
    'attr' => 'maxlength="80"',
    'help' => 'Indique el giro comercial principal de la empresa (sin utilizar abreviaciones)',
]);
$config_extra_otras_actividades = [];
if (isset($Contribuyente) and $Contribuyente->config_extra_otras_actividades) {
    foreach ($Contribuyente->config_extra_otras_actividades as $a) {
        $config_extra_otras_actividades[] = [
            'config_extra_otras_actividades_actividad' => is_object($a) ? $a->actividad : $a,
            'config_extra_otras_actividades_giro' => is_object($a) ? $a->giro : '',
        ];
    }
}
echo $f->input([
    'type' => 'js',
    'id' => 'otras_actividades',
    'label' => 'Otras actividades',
    'titles' => ['Actividad económica', 'Giro'],
    'inputs' => [
        [
            'type' => 'select',
            'name' => 'config_extra_otras_actividades_actividad',
            'options' => [''=>'Seleccionar una actividad económica'] + $actividades_economicas,
            'check' => 'notempty',
        ],
        [
            'name' => 'config_extra_otras_actividades_giro',
            'placeholder' => 'Mismo giro actividad principal',
            'attr' => 'maxlength="80" style="min-width:20em"',
        ]
    ],
    'values' => $config_extra_otras_actividades,
    'help' => 'Indique las actividades económicas secundarias de la empresa y los giros (si son diferentes al principal)',
]);
echo $f->input([
    'name' => 'direccion',
    'label' => 'Dirección',
    'value' => isset($Contribuyente) ? $Contribuyente->direccion : null,
    'help' => 'Dirección casa matriz',
    'check' => 'notempty',
    'attr' => 'maxlength="70"',
]);
echo $f->input([
    'type' => 'select',
    'name' => 'comuna',
    'label' => 'Comuna',
    'value' => isset($Contribuyente) ? $Contribuyente->comuna : null,
    'help' => 'Comuna casa matriz',
    'options' => [''=>'Seleccionar una comuna'] + $comunas,
    'check' => 'notempty',
]);
$config_extra_sucursales = [];
if (isset($Contribuyente) and $Contribuyente->config_extra_sucursales) {
    foreach ($Contribuyente->config_extra_sucursales as $sucursal) {
        $config_extra_sucursales[] = [
            'config_extra_sucursales_codigo' => $sucursal->codigo,
            'config_extra_sucursales_sucursal' => $sucursal->sucursal,
            'config_extra_sucursales_direccion' => $sucursal->direccion,
            'config_extra_sucursales_comuna' => $sucursal->comuna,
            'config_extra_sucursales_actividad_economica' => !empty($sucursal->actividad_economica) ? $sucursal->actividad_economica : null,
        ];
    }
}
echo $f->input([
    'type' => 'js',
    'id' => 'sucursales',
    'label' => 'Sucursales',
    'titles' => ['Código SII', 'Nombre', 'Dirección', 'Comuna', 'Act. Económ.'],
    'inputs' => [
        [
            'name' => 'config_extra_sucursales_codigo',
            'check' => 'notempty integer',
            'attr' => 'style="max-width:8em"'
        ],
        [
            'name' => 'config_extra_sucursales_sucursal',
            'check' => 'notempty',
            'attr' => 'maxlength="20" style="max-width:12em"',
        ],
        [
            'name' => 'config_extra_sucursales_direccion',
            'check' => 'notempty',
            'attr' => 'maxlength="70"',
        ],
        [
            'type' => 'select',
            'name' => 'config_extra_sucursales_comuna',
            'options' => [''=>'Seleccionar una comuna'] + $comunas,
            'check' => 'notempty',
        ],
        [
            'type' => 'select',
            'name' => 'config_extra_sucursales_actividad_economica',
            'options' => [''=>'Misma casa matriz'] + (isset($Contribuyente)?$Contribuyente->getListActividades():[]),
            'attr' => 'style="max-width:14em"'
        ]
    ],
    'values' => $config_extra_sucursales,
    'help' => 'Sucursales de la empresa con código asignado por el SII',
]);
echo $f->input([
    'name' => 'telefono',
    'label' => 'Teléfono',
    'value' => isset($Contribuyente) ? $Contribuyente->telefono : null,
    'placeholder' => '+56 9 88776655',
    'help' => 'Ejemplos: celular +56 9 88776655 / Santiago +56 2 22334455 / Santa Cruz +56 72 2821122',
    'check' => 'telephone',
    'attr' => 'maxlength="20"',
]);
echo $f->input([
    'name' => 'email',
    'label' => 'Email',
    'value' => isset($Contribuyente) ? $Contribuyente->email : null,
    'check' => 'email',
    'attr' => 'maxlength="80"',
]);
echo $f->input([
    'name' => 'config_extra_representante_rut',
    'label' => 'RUT representante',
    'value' => isset($Contribuyente) ? $Contribuyente->config_extra_representante_rut : null,
    'check' => 'rut',
]);
echo $f->input([
    'name' => 'config_extra_web',
    'label' => 'Web',
    'value' => isset($Contribuyente) ? $Contribuyente->config_extra_web : null,
    'attr' => 'maxlength="80"',
]);
echo $f->input([
    'type' => 'file',
    'name' => 'logo',
    'label' => 'Logo',
    'help' => 'Imagen en formato PNG con el logo de la empresa',
    'attr' => 'accept="image/png"',
]);
?>
<?php if (isset($Contribuyente)) : ?>
    <img src="../logo/<?=$Contribuyente->rut?>.png" alt="Logo <?=$Contribuyente->razon_social?>" class="img-responsive thumbnail center" />
    <br/>
<?php endif; ?>
<?php if (\sowerphp\core\Configure::read('proveedores.api.libredte')) : ?>
<?php
echo $f->input([
    'type' => 'text',
    'name' => 'config_sii_pass',
    'label' => 'Contraseña SII',
    'value' => isset($Contribuyente) ? $Contribuyente->config_sii_pass : null,
    'attr' => 'onmouseover="this.type=\'text\'" onmouseout="this.type=\'password\'"',
]);
?>
<?php endif; ?>
</div>
<!-- FIN DATOS EMPRESA -->

<!-- INICIO AMBIENTES -->
<div role="tabpanel" class="tab-pane" id="ambientes">
<?php
echo $f->input([
    'type' => 'select',
    'name' => 'config_ambiente_en_certificacion',
    'label' => 'Ambiente',
    'options' => ['Producción (documentos válidos)', 'Certificación / Pruebas (documentos no válidos)'],
    'value' => isset($Contribuyente) ? $Contribuyente->config_ambiente_en_certificacion : 1,
    'help' => 'Permite elegir entre un ambiente de pruebas o uno real para la emisión de los DTE',
    'check' => 'notempty',
    'attr' => 'onchange="ambiente_set(this.value)"',
]);
echo $f->input([
    'type' => 'date',
    'name' => 'config_ambiente_produccion_fecha',
    'label' => 'Fecha resolución',
    'value' => isset($Contribuyente) ? $Contribuyente->config_ambiente_produccion_fecha : null,
    'help' => 'Fecha de la resolución que autoriza la emisión de DTE en ambiente de producción. Se obtiene <a href="https://palena.sii.cl/cvc/dte/ee_empresas_dte.html" target="_blank">aquí</a>.',
    'check' => 'notempty date',
    'attr' => isset($Contribuyente) ? ($Contribuyente->config_ambiente_en_certificacion?'disabled="disabled"':'') : 'disabled="disabled"',
]);
echo $f->input([
    'name' => 'config_ambiente_produccion_numero',
    'label' => 'Número resolución',
    'value' => isset($Contribuyente) ? $Contribuyente->config_ambiente_produccion_numero : null,
    'help' => 'Número de la resolución que autoriza la emisión de DTE en ambiente de producción. Se obtiene en mismo lugar que fecha resolución producción.',
    'check' => 'notempty integer',
    'attr' => isset($Contribuyente) ? ($Contribuyente->config_ambiente_en_certificacion?'disabled="disabled"':'') : 'disabled="disabled"',
]);
echo $f->input([
    'type' => 'date',
    'name' => 'config_ambiente_certificacion_fecha',
    'label' => 'Fecha certificación',
    'value' => isset($Contribuyente) ? $Contribuyente->config_ambiente_certificacion_fecha : null,
    'help' => 'Fecha de la autorización para emisión de DTE en ambiente de certificación. Se obtiene <a href="https://maullin.sii.cl/cvc/dte/ee_empresas_dte.html" target="_blank">aquí</a>.',
    'check' => 'notempty date',
    'attr' => isset($Contribuyente) ? ($Contribuyente->config_ambiente_en_certificacion?'':'disabled="disabled"') : '',
]);
?>
</div>
<!-- FIN AMBIENTES -->

<!-- INICIO EMAILS -->
<div role="tabpanel" class="tab-pane" id="correos">
    <p>Aquí debe configurar las dos casillas de correo para operar con facturación electrónica. Puede revisar la <a href="http://wiki.libredte.cl/doku.php/faq/libredte/sowerphp/config/email">documentación de las casillas de correo</a> para obtener detalles de qué opciones debe usar.</p>
<?php if (isset($Contribuyente) and $Contribuyente->getFirma()) : ?>
    <p>Los correos deben coincidir con los registrados en el SII, los debe verificar en <a href="#" onclick="__.popup('<?=$_base?>/dte/sii/contribuyente_datos/<?=$Contribuyente->rut?>-<?=$Contribuyente->dv?>', 750, 550); return false" title="Ver datos del contribuyente en el SII">el sitio del web de impuestos internos</a>.</p>
<?php endif; ?>
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-envelope"></i>
                    Correo contacto SII
                </div>
                <div class="panel-body">
<?php
$f->setColsLabel(3);
echo $f->input([
    'name' => 'config_email_sii_user',
    'label' => 'Correo',
    'value' => isset($Contribuyente) ? $Contribuyente->config_email_sii_user : null,
    'attr' => 'maxlength="50" onblur="config_email_set(this, \'sii\')"',
    'check' => 'notempty email',
]);
echo $f->input([
    'name' => 'config_email_sii_pass',
    'value' => isset($Contribuyente) ? $Contribuyente->config_email_sii_pass : null,
    'label' => 'Contraseña',
    'check' => 'notempty',
    'attr' => 'onmouseover="this.type=\'text\'" onmouseout="this.type=\'password\'"',
]);
echo $f->input([
    'name' => 'config_email_sii_smtp',
    'label' => 'Servidor SMTP',
    'value' => isset($Contribuyente) ? $Contribuyente->config_email_sii_smtp : null,
    'help' => 'Ejemplo: ssl://smtp.gmail.com:465',
    'attr' => 'maxlength="50"',
    'check' => 'notempty',
]);
echo $f->input([
    'name' => 'config_email_sii_imap',
    'label' => 'Mailbox IMAP',
    'value' => isset($Contribuyente) ? $Contribuyente->config_email_sii_imap : null,
    'help' => 'Ejemplo: {imap.gmail.com:993/imap/ssl}INBOX',
    'attr' => 'maxlength="100"',
    'check' => 'notempty',
]);
?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-envelope-o"></i>
                    Correo contacto empresas (intercambio)
                </div>
                <div class="panel-body">
<?php
echo $f->input([
    'name' => 'config_email_intercambio_user',
    'label' => 'Correo',
    'value' => isset($Contribuyente) ? $Contribuyente->config_email_intercambio_user : null,
    'attr' => 'maxlength="50" onblur="config_email_set(this, \'intercambio\')"',
    'check' => 'notempty email',
]);
echo $f->input([
    'name' => 'config_email_intercambio_pass',
    'value' => isset($Contribuyente) ? $Contribuyente->config_email_intercambio_pass : null,
    'label' => 'Contraseña',
    'check' => 'notempty',
    'attr' => 'onmouseover="this.type=\'text\'" onmouseout="this.type=\'password\'"',
]);
echo $f->input([
    'name' => 'config_email_intercambio_smtp',
    'label' => 'Servidor SMTP',
    'value' => isset($Contribuyente) ? $Contribuyente->config_email_intercambio_smtp : null,
    'help' => 'Ejemplo: ssl://smtp.gmail.com:465',
    'attr' => 'maxlength="50"',
    'check' => 'notempty',
]);
echo $f->input([
    'name' => 'config_email_intercambio_imap',
    'label' => 'Mailbox IMAP',
    'value' => isset($Contribuyente) ? $Contribuyente->config_email_intercambio_imap : null,
    'help' => 'Ejemplo: {imap.gmail.com:993/imap/ssl}INBOX',
    'attr' => 'maxlength="100"',
    'check' => 'notempty',
]);
$f->setColsLabel();
?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- FIN EMAILS -->

<!-- INICIO CONFIGURACIÓN FACTURACIÓN -->
<div role="tabpanel" class="tab-pane" id="facturacion">
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-send-o"></i>
            Emisión documentos
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
<?php
$f->setColsLabel(4);
if (!empty($tipos_dte)) {
    echo $f->input([
        'type' => 'select',
        'name' => 'config_emision_dte_defecto',
        'label' => 'DTE defecto',
        'options' => $tipos_dte,
        'value' => isset($Contribuyente) ? $Contribuyente->config_emision_dte_defecto : 33,
        'help' => '¿Qué documento debe estar seleccionado por defecto al emitir?',
    ]);
}
echo $f->input([
    'type' => 'select',
    'name' => 'config_emision_solo_items_codificados',
    'label' => 'Sólo items codificados',
    'options' => ['No', 'Si'],
    'value' => isset($Contribuyente) ? $Contribuyente->config_emision_solo_items_codificados : 0,
    'help' => '¿Restringir la creación de documentos sólo a items de productos o servicios que estén codificados?',
]);
echo $f->input([
    'type' => 'select',
    'name' => 'config_extra_exenta',
    'label' => 'Empresa exenta',
    'options' => ['No', 'Si'],
    'value' => isset($Contribuyente) ? $Contribuyente->config_extra_exenta : 0,
    'help' => '¿El contribuyente es exento de IVA en todas sus actividades económicas?',
]);
$IndServicio = [
    1 => 'Factura o boleta de servicios períodicos domiciliarios', // boleta es periodico no domiciliario (se ajusta)
    2 => 'Factura o boleta de otros servicios períodicos (no domiciliarios)',  // boleta es periodico domiciliario (se ajusta)
    3 => 'Factura de servicios o boleta de ventas y servicios',
    4 => 'Factura exportación de servicios de hotelería o boleta de espectáculos emitida por cuenta de terceros',
    5 => 'Factura exportación de servicios de transporte internacional',
];
echo $f->input([
    'type' => 'select',
    'name' => 'config_extra_indicador_servicio',
    'label' => 'Indicador servicio',
    'options' => [''=>'No'] + $IndServicio,
    'value' => isset($Contribuyente) ? $Contribuyente->config_extra_indicador_servicio : 0,
    'help' => '¿Se debe usar un indicador de servicio por defecto?',
]);
echo $f->input([
    'type' => 'select',
    'name' => 'config_emision_asignar_folio',
    'label' => '¿Folio manual?',
    'options' => [
        'Ningún usuario puede asignar manualmente el folio',
        'Sólo administradores pueden asignar manualmente el folio',
        'Cualquier usuario con rol \'dte\' puede asignar manualmente el folio',
    ],
    'value' => isset($Contribuyente) ? $Contribuyente->config_emision_asignar_folio : 0,
    'help' => '¿Es posible elegir manualmente qué folio se desea utilizar en un documento que se emitirá?',
]);
echo $f->input([
    'type' => 'select',
    'name' => 'config_emision_forma_pago',
    'label' => 'Forma de pago',
    'options' => [''=>'Sin forma de pago', 1=>'Contado'],
    'value' => isset($Contribuyente) ? $Contribuyente->config_emision_forma_pago : 0,
    'help' => '¿Forma de pago por defecto?',
]);
?>
                </div>
                <div class="col-md-6">
<?php
echo $f->input([
    'type' => 'select',
    'name' => 'config_extra_constructora',
    'label' => 'Empresa constructora',
    'options' => ['No', 'Si'],
    'value' => isset($Contribuyente) ? $Contribuyente->config_extra_constructora : 0,
    'help' => '¿El contribuyente es una empresa constructora (para crédito del 65%)?',
]);
echo $f->input([
    'type' => 'select',
    'name' => 'config_extra_agente_retenedor',
    'label' => 'Agente retenedor',
    'options' => ['No', 'Si'],
    'value' => isset($Contribuyente) ? $Contribuyente->config_extra_agente_retenedor : 0,
    'help' => '¿El contribuyente actúa como agente retenedor de algún producto?',
]);
echo $f->input([
    'type' => 'select',
    'name' => 'config_sii_envio_automatico',
    'label' => 'Envío automático',
    'options' => ['No', 'Si'],
    'value' => isset($Contribuyente) ? $Contribuyente->config_sii_envio_automatico : 0,
    'help' => '¿Se deben enviar automáticamente los DTE al SII sin pasar por previsualización?',
]);
echo $f->input([
    'type' => 'select',
    'name' => 'config_emision_previsualizacion_automatica',
    'label' => 'Previsualización PDF',
    'options' => ['No', 'Si'],
    'value' => isset($Contribuyente) ? $Contribuyente->config_emision_previsualizacion_automatica : 0,
    'help' => '¿Se debe mostrar automáticamente la previsualización del PDF en la pantalla de previsualización?',
]);
echo $f->input([
    'type' => 'select',
    'name' => 'config_emision_intercambio_automatico',
    'label' => 'Intercambio automático',
    'options' => ['No', 'Si'],
    'value' => isset($Contribuyente) ? $Contribuyente->config_emision_intercambio_automatico : 0,
    'help' => '¿Se debe enviar automáticamente el DTE que está aceptado por el SII y no tiene recepción registrada?',
]);
?>
                </div>
            </div>
<?php
$f->setColsLabel();
$config_extra_impuestos_adicionales = [];
if (isset($Contribuyente) and $Contribuyente->config_extra_impuestos_adicionales) {
    foreach ($Contribuyente->config_extra_impuestos_adicionales as $impuesto) {
        $config_extra_impuestos_adicionales[] = [
            'config_extra_impuestos_adicionales_codigo' => $impuesto->codigo,
            'config_extra_impuestos_adicionales_tasa' => $impuesto->tasa,
        ];
    }
}
echo $f->input([
    'type' => 'js',
    'id' => 'impuestos_adicionales',
    'label' => 'Impuestos adicionales',
    'titles' => ['Impuesto adicional', 'Tasa por defecto'],
    'inputs' => [
        [
            'type' => 'select',
            'name' => 'config_extra_impuestos_adicionales_codigo',
            'options' => [''=>'Seleccionar un impuesto adicional'] + $impuestos_adicionales,
            'check' => 'notempty',
            'attr' => 'onblur="impuesto_adicional_sugerir_tasa(this, impuestos_adicionales_tasa)"'
        ],
        [
            'name' => 'config_extra_impuestos_adicionales_tasa',
            'check' => 'notempty',
        ]
    ],
    'values' => $config_extra_impuestos_adicionales,
    'help' => 'Indique los impuestos adicionales o retenciones que desea utilizar en la emisión de documentos',
]);
if (!empty($tipos_dte)) {
    $config_emision_observaciones = [];
    if (isset($Contribuyente) and $Contribuyente->config_emision_observaciones) {
        foreach ($Contribuyente->config_emision_observaciones as $dte => $glosa) {
            $config_emision_observaciones[] = [
                'config_emision_observaciones_dte' => $dte,
                'config_emision_observaciones_glosa' => $glosa,
            ];
        }
    }
    echo $f->input([
        'type' => 'js',
        'id' => 'config_emision_observaciones',
        'label' => 'Observación emisión',
        'titles' => ['Documento', 'Observación'],
        'inputs' => [
            [
                'type' => 'select',
                'name' => 'config_emision_observaciones_dte',
                'options' => [''=>'Seleccionar un tipo de documento'] + $tipos_dte,
                'check' => 'notempty',
            ],
            [
                'name' => 'config_emision_observaciones_glosa',
                'check' => 'notempty',
                'attr' => 'maxlength="100"',
            ]
        ],
        'values' => $config_emision_observaciones,
        'help' => 'Observación por defecto según tipo de DTE emitido',
    ]);
}
$config_extra_impuestos_sin_credito = [];
if (isset($Contribuyente) and $Contribuyente->config_extra_impuestos_sin_credito) {
    foreach ($Contribuyente->config_extra_impuestos_sin_credito as $impuesto) {
        $config_extra_impuestos_sin_credito[] = [
            'config_extra_impuestos_sin_credito_codigo' => $impuesto,
        ];
    }
}
echo $f->input([
    'type' => 'js',
    'id' => 'impuestos_sin_credito',
    'label' => 'Impuestos sin crédito',
    'titles' => ['Impuesto sin crédito'],
    'inputs' => [
        [
            'type' => 'select',
            'name' => 'config_extra_impuestos_sin_credito_codigo',
            'options' => [''=>'Seleccionar un impuesto'] + $impuestos_adicionales_todos,
            'check' => 'notempty',
        ],
    ],
    'values' => $config_extra_impuestos_sin_credito,
    'help' => 'Indique los impuestos que no dan derecho a ser usados como crédito (no son recuperables)',
]);
?>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-file-pdf-o"></i>
            PDF
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
<?php
$f->setColsLabel(4);
echo $f->input([
    'type' => 'select',
    'name' => 'config_pdf_dte_papel',
    'label' => 'Formato',
    'options' => \sasco\LibreDTE\Sii\PDF\Dte::$papel,
    'value' => isset($Contribuyente) ? $Contribuyente->config_pdf_dte_papel : 0,
    'help' => 'Permite indicar si se usará hoja carta en las versiones en PDF del DTE o bien papel contínuo',
]);
?>
                </div>
                <div class="col-md-6">
<?php
echo $f->input([
    'type' => 'select',
    'name' => 'config_pdf_dte_cedible',
    'label' => 'Incluir cedible',
    'options' => ['No', 'Si'],
    'value' => isset($Contribuyente) ? $Contribuyente->config_pdf_dte_cedible : 0,
    'help' => '¿Se debe incluir la copia cedible por defecto en los PDF?',
]);
?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
<?php
echo $f->input([
    'name' => 'config_pdf_copias_tributarias',
    'label' => 'Copias tributarias',
    'value' => isset($Contribuyente) ? $Contribuyente->config_pdf_copias_tributarias : 1,
    'help' => '¿Copias tributarias que saldrán por defecto en la pestaña PDF?',
    'check' => 'notempty integer',
]);
?>
                </div>
                <div class="col-md-6">
<?php
echo $f->input([
    'name' => 'config_pdf_copias_cedibles',
    'label' => 'Copias cedibles',
    'value' => isset($Contribuyente) ? $Contribuyente->config_pdf_copias_cedibles : 1,
    'help' => '¿Copias cedibles que saldrán por defecto en la pestaña PDF?',
    'check' => 'notempty integer',
]);
?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
<?php
echo $f->input([
    'type' => 'select',
    'name' => 'config_pdf_logo_posicion',
    'label' => 'Posición logo',
    'options' => ['Izquierda', 'Arriba'],
    'value' => isset($Contribuyente) ? $Contribuyente->config_pdf_logo_posicion : 0,
    'help' => '¿El logo va a la izquierda o arriba de los datos del contribuyente?',
]);
?>
                </div>
                <div class="col-md-6">
<?php
echo $f->input([
    'type' => 'select',
    'name' => 'config_pdf_detalle_fuente',
    'label' => 'Fuente detalle',
    'options' => [11=>11, 10=>10, 9=>9, 8=>8],
    'value' => (isset($Contribuyente) and $Contribuyente->config_pdf_detalle_fuente)? $Contribuyente->config_pdf_detalle_fuente : 10,
    'help' => 'Tamaño de la fuente a utilizar en el detalle del PDF ',
]);
?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
<?php
echo $f->input([
    'type' => 'select',
    'name' => 'config_pdf_item_detalle_posicion',
    'label' => 'Posición detalle',
    'options' => ['Abajo', 'Derecha'],
    'value' => isset($Contribuyente) ? $Contribuyente->config_pdf_item_detalle_posicion : 0,
    'help' => '¿El detalle del item va a abajo o a la derecha del nombre del item?',
]);
?>
                </div>
                <div class="col-md-6">
<?php
echo $f->input([
    'type' => 'select',
    'name' => 'config_pdf_timbre_posicion',
    'label' => 'Posición timbre',
    'options' => ['Al pie de la página', 'Inmediatamente bajo el detalle'],
    'value' => isset($Contribuyente) ? $Contribuyente->config_pdf_timbre_posicion : 0,
    'help' => '¿Dónde debe ir el timbre, acuse y totales?',
]);
?>
                </div>
            </div>
<?php
$f->setColsLabel();
$f->setStyle(false);
?>
            <div class="form-group required">
                <label class="col-sm-2 control-label">Ancho columnas</label>
                <div class="col-sm-10">
                <?php new \sowerphp\general\View_Helper_Table([
                    ['Código', 'Cantidad', 'Precio', 'Descuento', 'Recargo', 'Subtotal'],
                    [
                        $f->input([
                            'name'=>'config_pdf_detalle_ancho_CdgItem',
                            'placeholder' => 20,
                            'value'=>((isset($Contribuyente) and $Contribuyente->config_pdf_detalle_ancho)? $Contribuyente->config_pdf_detalle_ancho->CdgItem : 20),
                            'check'=>'notempty integer',
                        ]),
                        $f->input([
                            'name'=>'config_pdf_detalle_ancho_QtyItem',
                            'placeholder' => 15,
                            'value'=>((isset($Contribuyente) and $Contribuyente->config_pdf_detalle_ancho)? $Contribuyente->config_pdf_detalle_ancho->QtyItem : 15),
                            'check'=>'notempty integer',
                        ]),
                        $f->input([
                            'name'=>'config_pdf_detalle_ancho_PrcItem',
                            'placeholder' => 22,
                            'value'=>((isset($Contribuyente) and $Contribuyente->config_pdf_detalle_ancho)? $Contribuyente->config_pdf_detalle_ancho->PrcItem : 22),
                            'check'=>'notempty integer',
                        ]),
                        $f->input([
                            'name'=>'config_pdf_detalle_ancho_DescuentoMonto',
                            'placeholder' => 22,
                            'value'=>((isset($Contribuyente) and $Contribuyente->config_pdf_detalle_ancho)? $Contribuyente->config_pdf_detalle_ancho->DescuentoMonto : 22),
                            'check'=>'notempty integer',
                        ]),
                        $f->input([
                            'name'=>'config_pdf_detalle_ancho_RecargoMonto',
                            'placeholder' => 22,
                            'value'=>((isset($Contribuyente) and $Contribuyente->config_pdf_detalle_ancho)? $Contribuyente->config_pdf_detalle_ancho->RecargoMonto : 22),
                            'check'=>'notempty integer',
                        ]),
                        $f->input([
                            'name'=>'config_pdf_detalle_ancho_MontoItem',
                            'placeholder' => 22,
                            'value'=>((isset($Contribuyente) and $Contribuyente->config_pdf_detalle_ancho)? $Contribuyente->config_pdf_detalle_ancho->MontoItem : 22),
                            'check'=>'notempty integer',
                        ]),
                    ]
                ]); ?>
                <p class="help-block">Ancho de las columnas del detalle del PDF en hoja carta</p>
                </div>
            </div>
<?php $f->setStyle('horizontal'); ?>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-file-o"></i>
            Recepción documentos
        </div>
        <div class="panel-body">
<?php
echo $f->input([
    'type' => 'select',
    'name' => 'config_recepcion_omitir_verificacion_sii',
    'label' => 'Verificar DTE',
    'options' => ['Verificar documento recibido contra el SII (recomendado)', 'Permitir ingresar documentos sin verificar (no recomendado)'],
    'value' => isset($Contribuyente) ? $Contribuyente->config_recepcion_omitir_verificacion_sii : 0,
    'help' => 'Permite omitir la verificación de un DTE contra el SII al ser agregado manualmente. Se recomienda nunca activar esta opción, ya que de acuerdo a la legislación sólo se deben incluir en los documentos recibidos aquellos que el SII tiene aceptados.',
]);
?>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-eye"></i>
            SII
        </div>
        <div class="panel-body">
<?php if (\sowerphp\core\Configure::read('proveedores.api.libredte')) : ?>
<?php
echo $f->input([
    'type' => 'select',
    'name' => 'config_sii_timbraje_automatico',
    'label' => '¿Timbraje automático?',
    'options' => ['Nunca timbrar automáticamente', 'Timbrar automáticamente cuando se llegue a la alerta de folios'],
    'value' => isset($Contribuyente) ? $Contribuyente->config_sii_timbraje_automatico : 0,
    'help' => '¿Se debe timbrar automáticamente folios cuando se alcance la alerta? Si se activa, debe asignar multiplicador (abajo)',
]);
echo $f->input([
    'name' => 'config_sii_timbraje_multiplicador',
    'label' => 'Multiplicador de timbraje',
    'value' => isset($Contribuyente) ? $Contribuyente->config_sii_timbraje_multiplicador : 5,
    'help' => 'Se solicitará como cantidad de timbraje automático máximo: [alerta folio] x [multiplicador]',
]);
?>
<?php endif; ?>
<?php
echo $f->input([
    'type' => 'select',
    'name' => 'config_sii_estado_dte_webservice',
    'label' => 'Estado DTE',
    'options' => ['Correo electrónico (más lento pero con detalles)', 'Servicio web (más rápido pero sin detalles)'],
    'value' => isset($Contribuyente) ? $Contribuyente->config_sii_estado_dte_webservice : 0,
    'help' => 'Permite definir cómo se consultará el estado de los DTE emitidos por defecto en la aplicación web',
]);
?>
        </div>
    </div>
</div>
<!-- FIN CONFIGURACIÓN FACTURACIÓN -->

<?php if (isset($Contribuyente)) : ?>

<!-- INICIO API -->
<div role="tabpanel" class="tab-pane" id="api">
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-exchange"></i>
            Servicios web del contribuyente
        </div>
        <div class="panel-body">
            <p>LibreDTE puede comunicarse con la aplicación de su empresa u otros sitios a través de servicios web. A continuación puede ingresar las URL para consultas que se podrían hacer a su aplicación. Puede revisar la <a href="http://wiki.libredte.cl/doku.php/sowerphp/integracion">documentación de la integración</a> para obtener detalles de las entradas y salidas esperadas para cada consulta.</p>
<?php
$api_servicios_disponibles = (array)\sowerphp\core\Configure::read('api_contribuyentes');
$api = [];
foreach ($api_servicios_disponibles as $api_codigo => $api_servicio) {
    if (!empty($api_servicio['uses']) and !\sowerphp\core\Module::loaded($api_servicio['uses'])) {
        continue;
    }
    $api[] = [
        'config_api_codigo' => $api_codigo,
        'config_api_servicio' => $api_servicio['name'].'<span>'.$api_servicio['desc'].(!empty($api_servicio['link'])?(' (<a href="'.$api_servicio['link'].'">más info</a>)'):'').'</span>',
        'config_api_url' => isset($Contribuyente->config_api_servicios->$api_codigo->url) ? $Contribuyente->config_api_servicios->$api_codigo->url : null,
        'config_api_auth' => isset($Contribuyente->config_api_servicios->$api_codigo->auth) ? $Contribuyente->config_api_servicios->$api_codigo->auth : null,
        'config_api_credenciales' => isset($Contribuyente->config_api_servicios->$api_codigo->credenciales) ? $Contribuyente->config_api_servicios->$api_codigo->credenciales : null,
    ];
}
$f->setStyle(false);
echo $f->input([
    'type' => 'table',
    'id' => 'config_api',
    'label' => 'API',
    'titles' => ['Servicio', 'URL', 'Auth', 'Credenciales'],
    'inputs' => [
        ['name' => 'config_api_codigo', 'type'=>'hidden'],
        ['name' => 'config_api_servicio', 'type'=>'div', 'attr'=>'style="max-width:10em"'],
        ['name' => 'config_api_url', 'placeholder'=>'https://example.com/api/recurso'],
        ['name' => 'config_api_auth', 'type'=>'select', 'options'=>['http_auth_basic'=>'HTTP Auth Basic']],
        ['name' => 'config_api_credenciales', 'placeholder'=>'usuario:contraseña', 'attr' => 'maxlength="255" onmouseover="this.type=\'text\'" onmouseout="this.type=\'password\'"'],
    ],
    'values' => $api,
    'help' => 'Datos para contacto comercial (ej: envío de cobros del servicio)',
]);
$f->setStyle('horizontal');
?>
        </div>
    </div>
</div>
<!-- FIN API -->

<!-- INICIO CONFIGURACIÓN GENERAL -->
<div role="tabpanel" class="tab-pane" id="general">
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-cogs"></i>
            Configuración LibreDTE
        </div>
        <div class="panel-body">
<?php
echo $f->input([
    'type' => 'div',
    'label' => 'Administrador',
    'value' => $Contribuyente->getUsuario()->nombre.' ('.$Contribuyente->getUsuario()->usuario.')',
]);
if ($Contribuyente->getCuota()) {
    echo $f->input([
        'type' => 'div',
        'label' => 'Cuota',
        'value' => num($Contribuyente->getCuota()),
    ]);
}
echo $f->input([
    'type' => 'div',
    'label' => 'Modificado',
    'value' => $Contribuyente->modificado,
]);
?>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-envelope-o"></i>
            Datos de contacto
        </div>
        <div class="panel-body">
<?php
$config_app_contacto_comercial = [];
foreach ((array)$Contribuyente->config_app_contacto_comercial as $c) {
    $config_app_contacto_comercial[] = [
        'config_app_contacto_comercial_nombre' => $c->nombre,
        'config_app_contacto_comercial_email' => $c->email,
        'config_app_contacto_comercial_telefono' => $c->telefono,
    ];
}
echo $f->input([
    'type' => 'js',
    'id' => 'config_app_contacto_comercial',
    'label' => 'Comercial',
    'titles' => ['Nombre', 'Email', 'Teléfono'],
    'inputs' => [
        ['name' => 'config_app_contacto_comercial_nombre'],
        ['name' => 'config_app_contacto_comercial_email', 'check' => 'notempty email'],
        ['name' => 'config_app_contacto_comercial_telefono', 'check' => 'telephone'],
    ],
    'values' => $config_app_contacto_comercial,
    'help' => 'Datos para contacto comercial (ej: envío de cobros del servicio)',
]);
?>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-support"></i>
            Soporte
        </div>
        <div class="panel-body">
<?php
echo $f->input([
    'type' => 'select',
    'name' => 'config_app_soporte',
    'label' => 'Permitir soporte',
    'options' => ['No', 'Si'],
    'value' => $Contribuyente->config_app_soporte,
    'help' => 'Se permite al equipo de soporte de LibreDTE trabajar con el contribuyente',
]);
?>
        </div>
    </div>
</div>
<!-- FIN CONFIGURACIÓN GENERAL -->

<?php endif; ?>

    </div>
</div>

<?php
echo $f->end($boton);
?>
<script>
$(function() {
<?php if (\sowerphp\core\Configure::read('proveedores.api.libredte')) : ?>
    $('#config_sii_passField').attr('type', 'password');
<?php endif; ?>
    $('#config_email_sii_passField').attr('type', 'password');
    $('#config_email_intercambio_passField').attr('type', 'password');
    $('input[name="config_api_credenciales[]"]').attr('type', 'password');
});
</script>
