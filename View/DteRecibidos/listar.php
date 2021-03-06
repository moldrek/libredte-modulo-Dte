<ul class="nav nav-pills float-right">
    <li class="nav-item" class="dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-university"></i> Recibidos en SII
        </a>
        <div class="dropdown-menu">
            <a href="<?=$_base?>/dte/dte_compras/registro_compras" title="Ir al registro de compra del SII" class="dropdown-item">
                Registro de compras
            </a>
            <a href="<?=$_base?>/dte/dte_recibidos/sii" title="Buscar los documentos recibidos en el SII" class="dropdown-item">
                    DTE recibidos en SII (previo a RC)
            </a>
        </div>
    </li>
    <li class="nav-item">
        <a href="<?=$_base?>/dte/dte_compras/importar" title="Importar libro IEC desde archivo CSV" class="nav-link">
            <i class="fa fa-upload"></i> Importar CSV
        </a>
    </li>
    <li class="nav-item">
        <a href="<?=$_base?>/dte/dte_recibidos/agregar" class="nav-link">
            <i class="fa fa-plus"></i> Agregar documento
        </a>
    </li>
    <li class="nav-item">
        <a href="<?=$_base?>/dte/dte_recibidos/buscar" title="Búsqueda avanzada de documentos recibidos" class="nav-link">
            <i class="fa fa-search"></i> Buscar
        </a>
    </li>
</ul>

<div class="page-header"><h1>Documentos recibidos</h1></div>
<p>Aquí podrá consultar todos los documentos recibidos por la empresa <?=$Emisor->razon_social?>.</p>

<?php
foreach ($documentos as &$d) {
    $acciones = '<a href="'.$_base.'/dte/dte_intercambios/ver/'.$d['intercambio'].'" title="Ver detalles del intercambio" class="btn btn-primary mb-2'.(!$d['intercambio']?' disabled':'').'" role="button"><i class="fa fa-search fa-fw"></i></a>';
    $acciones .= ' <a href="'.$_base.'/dte/dte_recibidos/pdf/'.$d['emisor'].'/'.$d['dte'].'/'.$d['folio'].'" title="Descargar PDF del documento" class="btn btn-primary mb-2'.(!$d['intercambio']?' disabled':'').'" role="button"><i class="far fa-file-pdf fa-fw"></i></a>';
    $acciones .= ' <a href="'.$_base.'/dte/dte_recibidos/modificar/'.$d['emisor'].'/'.$d['dte'].'/'.$d['folio'].'" title="Modificar documento" class="btn btn-primary mb-2"><i class="fa fa-edit fa-fw"></i></a>';
    $d[] = $acciones;
    $d['fecha'] = \sowerphp\general\Utility_Date::format($d['fecha']);
    $d['total'] = num($d['total']);
    unset($d['emisor'], $d['dte'], $d['intercambio']);
}
$f = new \sowerphp\general\View_Helper_Form(false);
array_unshift($documentos, [
    $f->input(['type'=>'select', 'name'=>'dte', 'options'=>[''=>'Todos'] + $tipos_dte, 'value'=>(isset($search['dte'])?$search['dte']:'')]),
    $f->input(['name'=>'folio', 'value'=>(isset($search['folio'])?$search['folio']:''), 'check'=>'integer']),
    $f->input(['name'=>'emisor', 'value'=>(isset($search['emisor'])?$search['emisor']:''), 'check'=>'integer', 'placeholder'=>'RUT sin dv']),
    $f->input(['type'=>'date', 'name'=>'fecha', 'value'=>(isset($search['fecha'])?$search['fecha']:''), 'check'=>'date']),
    $f->input(['name'=>'total', 'value'=>(isset($search['total'])?$search['total']:''), 'check'=>'integer']),
    $f->input(['type'=>'select', 'name'=>'usuario', 'options'=>[''=>'Todos'] + $usuarios, 'value'=>(isset($search['usuario'])?$search['usuario']:'')]),
    '<button type="submit" class="btn btn-primary"><i class="fa fa-search fa-fw" aria-hidden="true"></i></button>',
]);
array_unshift($documentos, ['Documento', 'Folio', 'Emisor', 'Fecha', 'Total', 'Usuario', 'Acciones']);

// renderizar el mantenedor
$maintainer = new \sowerphp\app\View_Helper_Maintainer([
    'link' => $_base.'/dte/dte_recibidos',
    'linkEnd' => $searchUrl,
]);
$maintainer->setId('dte_recibidos_'.$Emisor->rut);
$maintainer->setColsWidth([null, null, null, null, null, null, 160]);
echo $maintainer->listar ($documentos, $paginas, $pagina, false);
