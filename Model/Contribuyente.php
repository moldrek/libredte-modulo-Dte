<?php

/**
 * LibreDTE
 * Copyright (C) SASCO SpA (https://sasco.cl)
 *
 * Este programa es software libre: usted puede redistribuirlo y/o
 * modificarlo bajo los términos de la Licencia Pública General Affero de GNU
 * publicada por la Fundación para el Software Libre, ya sea la versión
 * 3 de la Licencia, o (a su elección) cualquier versión posterior de la
 * misma.
 *
 * Este programa se distribuye con la esperanza de que sea útil, pero
 * SIN GARANTÍA ALGUNA; ni siquiera la garantía implícita
 * MERCANTIL o de APTITUD PARA UN PROPÓSITO DETERMINADO.
 * Consulte los detalles de la Licencia Pública General Affero de GNU para
 * obtener una información más detallada.
 *
 * Debería haber recibido una copia de la Licencia Pública General Affero de GNU
 * junto a este programa.
 * En caso contrario, consulte <http://www.gnu.org/licenses/agpl.html>.
 */

// namespace del modelo
namespace website\Dte;

/**
 * Clase para mapear la tabla contribuyente de la base de datos
 * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
 * @version 2019-02-18
 */
class Model_Contribuyente extends \Model_App
{

    // Datos para la conexión a la base de datos
    protected $_database = 'default'; ///< Base de datos del modelo
    protected $_table = 'contribuyente'; ///< Tabla del modelo

    // Atributos de la clase (columnas en la base de datos)
    public $rut; ///< integer(32) NOT NULL DEFAULT '' PK
    public $dv; ///< character(1) NOT NULL DEFAULT ''
    public $razon_social; ///< character varying(100) NOT NULL DEFAULT ''
    public $giro; ///< character varying(80) NOT NULL DEFAULT ''
    public $actividad_economica; ///< integer(32) NULL DEFAULT '' FK:actividad_economica.codigo
    public $telefono; ///< character varying(20) NULL DEFAULT ''
    public $email; ///< character varying(80) NULL DEFAULT ''
    public $direccion; ///< character varying(70) NOT NULL DEFAULT ''
    public $comuna; ///< character(5) NOT NULL DEFAULT '' FK:comuna.codigo
    public $usuario; ///< integer(32) NULL DEFAULT '' FK:usuario.id
    public $modificado; ///< timestamp without time zone() NOT NULL DEFAULT 'now()'

    // Información de las columnas de la tabla en la base de datos
    public static $columnsInfo = array(
        'rut' => array(
            'name'      => 'Rut',
            'comment'   => '',
            'type'      => 'integer',
            'length'    => 32,
            'null'      => false,
            'default'   => '',
            'auto'      => false,
            'pk'        => true,
            'fk'        => null
        ),
        'dv' => array(
            'name'      => 'Dv',
            'comment'   => '',
            'type'      => 'character',
            'length'    => 1,
            'null'      => false,
            'default'   => '',
            'auto'      => false,
            'pk'        => false,
            'fk'        => null
        ),
        'razon_social' => array(
            'name'      => 'Razon Social',
            'comment'   => '',
            'type'      => 'character varying',
            'length'    => 100,
            'null'      => false,
            'default'   => '',
            'auto'      => false,
            'pk'        => false,
            'fk'        => null
        ),
        'giro' => array(
            'name'      => 'Giro',
            'comment'   => '',
            'type'      => 'character varying',
            'length'    => 80,
            'null'      => false,
            'default'   => '',
            'auto'      => false,
            'pk'        => false,
            'fk'        => null
        ),
        'actividad_economica' => array(
            'name'      => 'Actividad Economica',
            'comment'   => '',
            'type'      => 'integer',
            'length'    => 32,
            'null'      => true,
            'default'   => '',
            'auto'      => false,
            'pk'        => false,
            'fk'        => array('table' => 'actividad_economica', 'column' => 'codigo')
        ),
        'telefono' => array(
            'name'      => 'Telefono',
            'comment'   => '',
            'type'      => 'character varying',
            'length'    => 20,
            'null'      => true,
            'default'   => '',
            'auto'      => false,
            'pk'        => false,
            'fk'        => null
        ),
        'email' => array(
            'name'      => 'Email',
            'comment'   => '',
            'type'      => 'character varying',
            'length'    => 80,
            'null'      => true,
            'default'   => '',
            'auto'      => false,
            'pk'        => false,
            'fk'        => null
        ),
        'direccion' => array(
            'name'      => 'Direccion',
            'comment'   => '',
            'type'      => 'character varying',
            'length'    => 70,
            'null'      => false,
            'default'   => '',
            'auto'      => false,
            'pk'        => false,
            'fk'        => null
        ),
        'comuna' => array(
            'name'      => 'Comuna',
            'comment'   => '',
            'type'      => 'character',
            'length'    => 5,
            'null'      => false,
            'default'   => '',
            'auto'      => false,
            'pk'        => false,
            'fk'        => array('table' => 'comuna', 'column' => 'codigo')
        ),
        'usuario' => array(
            'name'      => 'Usuario',
            'comment'   => '',
            'type'      => 'integer',
            'length'    => 32,
            'null'      => true,
            'default'   => '',
            'auto'      => false,
            'pk'        => false,
            'fk'        => array('table' => 'usuario', 'column' => 'id')
        ),
        'modificado' => array(
            'name'      => 'Modificado',
            'comment'   => '',
            'type'      => 'timestamp without time zone',
            'length'    => null,
            'null'      => false,
            'default'   => 'now()',
            'auto'      => false,
            'pk'        => false,
            'fk'        => null
        ),

    );

    // Comentario de la tabla en la base de datos
    public static $tableComment = '';

    public static $fkNamespace = array(
        'Model_ActividadEconomica' => '\website\Sistema\General',
        'Model_Comuna' => '\sowerphp\app\Sistema\General\DivisionGeopolitica',
        'Model_Usuario' => '\sowerphp\app\Sistema\Usuarios'
    ); ///< Namespaces que utiliza esta clase

    public static $encriptar = [
        'sii_pass',
        'email_sii_pass',
        'email_intercambio_pass',
    ]; ///< columnas de la configuración que se deben encriptar para guardar en la base de datos

    public static $defaultConfig = [
        'extra_otras_actividades' => [],
    ]; ///< valores por defecto para columnas de la configuración en caso que no estén especificadas

    private static $reservados = [
        0,
        55555555,
        66666666,
        88888888,
    ]; ///< RUTs que están reservados y no serán modificados al guardar el contribuyente

    public $contribuyente; ///< Copia de razon_social
    private $config = null; ///< Caché para configuraciones

    /**
     * Constructor del contribuyente
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2019-11-28
     */
    public function __construct($rut = null)
    {
        if (is_array($rut)) {
            $rut = $rut[0];
        }
        if (!is_numeric($rut) and strpos($rut, '-')) {
            $rut = explode('-', str_replace('.', '', $rut))[0];
        }
        parent::__construct((int)$rut);
        if ($this->rut and !$this->exists()) {
            $this->dv = \sowerphp\app\Utility_Rut::dv($this->rut);
            try {
                $response = libredte_consume('/sii/contribuyente_situacion_tributaria/'.$this->getRUT());
                if ($response['status']['code']==200) {
                    $info = $response['body'];
                    if (!empty($info['razon_social'])) {
                        $this->razon_social = mb_substr($info['razon_social'], 0, 100);
                    }
                    if (!empty($info['actividades'][0]['codigo'])) {
                        $ActividadEconomica = new \website\Sistema\General\Model_ActividadEconomica($info['actividades'][0]['codigo']);
                        if ($ActividadEconomica->actividad_economica) {
                            $this->actividad_economica = $info['actividades'][0]['codigo'];
                        }
                    }
                    if (!empty($info['actividades'][0]['glosa'])) {
                        $this->giro = mb_substr($info['actividades'][0]['glosa'], 0, 80);
                    }
                    $this->save();
                }
                foreach (['telefono', 'email', 'direccion'] as $attr) {
                    if (!$this->$attr) {
                        $this->$attr = null;
                    }
                }
            }
            catch (\sowerphp\core\Exception_Model_Datasource_Database $e) {
            }
            catch (\Exception $e) {
            }
        }
        $this->contribuyente = &$this->razon_social;
        $this->getConfig();
    }

    /**
     * Método que entrega las configuraciones y parámetros extras para el
     * contribuyente
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2016-03-27
     */
    public function getConfig()
    {
        if ($this->config===false or !$this->rut)
            return null;
        if ($this->config===null) {
            $config = $this->db->getAssociativeArray('
                SELECT configuracion, variable, valor, json
                FROM contribuyente_config
                WHERE contribuyente = :contribuyente
            ', [':contribuyente' => $this->rut]);
            if (!$config) {
                $this->config = false;
                return null;
            }
            foreach ($config as $configuracion => $datos) {
                if (!isset($datos[0]))
                    $datos = [$datos];
                $this->config[$configuracion] = [];
                foreach ($datos as $dato) {
                    $class = get_called_class();
                    if (in_array($configuracion.'_'.$dato['variable'], $class::$encriptar)) {
                        $dato['valor'] = Utility_Data::decrypt($dato['valor']);
                    }
                    $this->config[$configuracion][$dato['variable']] =
                        $dato['json'] ? json_decode($dato['valor']) : $dato['valor']
                    ;
                }
            }
        }
        return $this->config;
    }

    /**
     * Método mágico para obtener configuraciones del contribuyente
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2016-01-31
     */
    public function __get($name)
    {
        if (strpos($name, 'config_')===0) {
            $this->getConfig();
            $key = str_replace('config_', '', $name);
            $c = substr($key, 0, strpos($key, '_'));
            $v = substr($key, strpos($key, '_')+1);
            if (!isset($this->config[$c][$v])) {
                $class = get_called_class();
                return isset($class::$defaultConfig[$c.'_'.$v]) ? $class::$defaultConfig[$c.'_'.$v] : null;
            }
            $this->$name = $this->config[$c][$v];
            return $this->$name;
        } else {
            throw new \Exception(
                'Atributo '.$name.' del contribuyente no existe (no se puede obtener)'
            );
        }
    }

    /**
     * Método mágico asignar una configuración del contribuyente
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2016-02-04
     */
    public function __set($name, $value)
    {
        if (strpos($name, 'config_')===0) {
            $key = str_replace('config_', '', $name);
            $c = substr($key, 0, strpos($key, '_'));
            $v = substr($key, strpos($key, '_')+1);
            $value = ($value===false or $value===0) ? '0' : ((!is_array($value) and !is_object($value)) ? (string)$value : ((is_array($value) and empty($value))?null:$value));
            $this->config[$c][$v] = (!is_string($value) or isset($value[0])) ? $value : null;
            $this->$name = $this->config[$c][$v];
        } else {
            throw new \Exception(
                'Atributo '.$name.' del contribuyente no existe (no se puede asignar)'
            );
        }
    }

    /**
     * Método para setear los atributos del contribuyente
     * @param array Arreglo con los datos que se deben asignar
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2016-01-29
     */
    public function set($array)
    {
        parent::set($array);
        foreach($array as $name => $value) {
            if (strpos($name, 'config_')===0) {
                $this->__set($name, $value);
            }
        }
    }

    /**
     * Método que guarda los datos del contribuyente, incluyendo su
     * configuración y parámetros adicionales
     * @param registrado Se usa para indicar que el contribuyente que se esta guardando es uno registrado por un usuario (se validan otros datos)
     * @param no_modificar =true Evita que se modifiquen ciertos contribuyentes reservados
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2019-11-27
     */
    public function save($registrado = false, $no_modificar = true)
    {
        // si no se debe guardar se entrega true (se hace creer que se guardó)
        if ($no_modificar and in_array($this->rut, self::$reservados)) {
            return true;
        }
        // si es contribuyente registrado se hacen algunas verificaciones
        if ($registrado) {
            // verificar campos mínimos
            foreach (['razon_social', 'giro', 'actividad_economica', 'direccion', 'comuna'] as $attr) {
                if (empty($this->$attr)) {
                    throw new \Exception('Debe especificar: '.$attr);
                }
            }
            // verificar que si se está en producción se haya pasado la fecha y número de resolución
            /*if (!$this->config_ambiente_en_certificacion and (empty($this->config_ambiente_produccion_fecha) or empty($this->config_ambiente_produccion_numero))) {
                throw new \Exception('Para usar la empresa en producción debe indicar la fecha y número de resolución que la autoriza');
            }*/
            // si se pasó un logo se guarda
            if (isset($_FILES['logo']) and !$_FILES['logo']['error']) {
                if (\sowerphp\general\Utility_File::mimetype($_FILES['logo']['tmp_name'])!='image/png') {
                    throw new \Exception('Formato del logo debe ser PNG');
                }
                $config = \sowerphp\core\Configure::read('dte.logos');
                \sowerphp\general\Utility_Image::resizeOnFile($_FILES['logo']['tmp_name'], $config['width'], $config['height']);
                if (!is_dir(DIR_STATIC.'/contribuyentes/'.$this->rut)) {
                    mkdir(DIR_STATIC.'/contribuyentes/'.$this->rut, 0777, true);
                }
                move_uploaded_file($_FILES['logo']['tmp_name'], DIR_STATIC.'/contribuyentes/'.$this->rut.'/logo.png');
            }
        }
        // corregir datos
        $this->dv = strtoupper($this->dv);
        $this->razon_social = mb_substr($this->razon_social, 0, 100);
        $this->giro = mb_substr($this->giro, 0, 80);
        $this->telefono = mb_substr($this->telefono, 0, 20);
        $this->email = mb_substr($this->email, 0, 80);
        $this->direccion = mb_substr($this->direccion, 0, 70);
        $this->modificado = date('Y-m-d H:i:s');
        // guardar contribuyente
        if (!parent::save()) {
            return false;
        }
        // guardar configuración
        if ($this->config) {
            foreach ($this->config as $configuracion => $datos) {
                foreach ($datos as $variable => $valor) {
                    $Config = new Model_ContribuyenteConfig($this->rut, $configuracion, $variable);
                    if (!is_array($valor) and !is_object($valor)) {
                        $Config->json = 0;
                    } else {
                        $valor = json_encode($valor);
                        $Config->json = 1;
                    }
                    $class = get_called_class();
                    if (in_array($configuracion.'_'.$variable, $class::$encriptar) and $valor!==null) {
                        $valor = Utility_Data::encrypt($valor);
                    }
                    $Config->valor = $valor;
                    if ($valor!==null)
                        $Config->save();
                    else
                        $Config->delete();
                }
            }
        }
        return true;
    }

    /**
     * Método que 'elimina' al contribuyente. En realidad los contribuyentes
     * nunca se eliminan. Lo que se hace es desasociar al contribuyente de su
     * usuario administrador y se elimina la configuración del contribuyente.
     * Los datos del contribuyente de documentos emitidos, recibidos, etc no se
     * eliminan por defecto, se debe solicitar específicamente.
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2019-11-22
     */
    public function delete($all = false)
    {
        $this->db->beginTransaction();
        // mantener correo de intercambio
        $this->config = [
            'email' => ['intercambio_user' => $this->config_email_intercambio_user],
        ];
        // si el usuario tiene un contador asociado, se verifica que el contador
        // exista como contribuyente y sea del grupo contadores, de esta forma
        // se mantendrá la configuración básica para que el contador pueda operar
        if ($this->config_contabilidad_contador_run) {
            $Contador = (new Model_Contribuyentes())->get($this->config_contabilidad_contador_run);
            if ($Contador->usuario and $Contador->getUsuario()->inGroup('contadores')) {
                $this->config['sii']['pass'] = $this->config_sii_pass;
                $this->config['ambiente']['en_certificacion'] = $this->config_ambiente_en_certificacion;
                $this->config['contabilidad']['contador_run'] = $this->config_contabilidad_contador_run;
                $mantener_datos_contador = true;
            }
        }
        // desasociar contribuyente del usuario y eliminar su configuración extra
        $this->usuario = null;
        $this->db->query('DELETE FROM contribuyente_config WHERE contribuyente = :rut', [':rut'=>$this->rut]);
        // guardar el contribuyente para mantener la configuración que se desea guardar
        if (!$this->save()) {
            $this->db->rollback();
            return false;
        }
        // eliminar todos los registros de la empresa de la base de datos
        if ($all) {
            // módulo Dte
            $this->db->query('DELETE FROM contribuyente_dte WHERE contribuyente = :rut', [':rut'=>$this->rut]);
            $this->db->query('DELETE FROM contribuyente_usuario WHERE contribuyente = :rut', [':rut'=>$this->rut]);
            $this->db->query('DELETE FROM contribuyente_usuario_dte WHERE contribuyente = :rut', [':rut'=>$this->rut]);
            $this->db->query('DELETE FROM dte_boleta_consumo WHERE emisor = :rut', [':rut'=>$this->rut]);
            $this->db->query('DELETE FROM dte_compra WHERE receptor = :rut', [':rut'=>$this->rut]);
            $this->db->query('DELETE FROM dte_emitido WHERE emisor = :rut', [':rut'=>$this->rut]);
            $this->db->query('DELETE FROM dte_folio WHERE emisor = :rut', [':rut'=>$this->rut]);
            $this->db->query('DELETE FROM dte_guia WHERE emisor = :rut', [':rut'=>$this->rut]);
            $this->db->query('DELETE FROM dte_recibido WHERE receptor = :rut', [':rut'=>$this->rut]);
            $this->db->query('DELETE FROM dte_intercambio WHERE receptor = :rut', [':rut'=>$this->rut]);
            $this->db->query('DELETE FROM dte_intercambio_recepcion WHERE recibe = :rut', [':rut'=>$this->rut]);
            $this->db->query('DELETE FROM dte_intercambio_recibo WHERE recibe = :rut', [':rut'=>$this->rut]);
            $this->db->query('DELETE FROM dte_intercambio_resultado WHERE recibe = :rut', [':rut'=>$this->rut]);
            $this->db->query('DELETE FROM dte_referencia WHERE emisor = :rut', [':rut'=>$this->rut]);
            $this->db->query('DELETE FROM dte_tmp WHERE emisor = :rut', [':rut'=>$this->rut]);
            $this->db->query('DELETE FROM dte_venta WHERE emisor = :rut', [':rut'=>$this->rut]);
            $this->db->query('DELETE FROM item_clasificacion WHERE contribuyente = :rut', [':rut'=>$this->rut]);
            if (empty($mantener_datos_contador)) {
                $this->db->query('DELETE FROM registro_compra WHERE receptor = :rut', [':rut'=>$this->rut]);
                $this->db->query('DELETE FROM boleta_honorario WHERE receptor = :rut', [':rut'=>$this->rut]);
                $this->db->query('DELETE FROM boleta_tercero WHERE emisor = :rut', [':rut'=>$this->rut]);
            }
        }
        // aplicar cambios
        return $this->db->commit();
    }

    /**
     * Método que entrega el nombre del contribuyente: nombre de fantasía si existe o razón social
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2017-04-24
     */
    public function getNombre()
    {
        return $this->config_extra_nombre_fantasia ? $this->config_extra_nombre_fantasia : $this->razon_social;
    }

    /**
     * Método que envía un correo electrónico al contribuyente
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2018-04-26
     */
    public function notificar($asunto, $mensaje, $para = null, $responder_a = null, $attach = null)
    {
        $email = new \sowerphp\core\Network_Email();
        $email->to($para ? $para : $this->getUsuariosEmail());
        if ($responder_a) {
            $email->replyTo($responder_a);
        }
        if ($attach) {
            $email->attach($attach);
        }
        $email->subject('['.\sowerphp\core\Configure::read('page.body.title').'] '.$this->getRUT().': '.$asunto);
        $msg = $mensaje."\n\n".'-- '."\n".\sowerphp\core\Configure::read('page.body.title');
        return $email->send($msg) === true ? true : false;
    }

    /**
     * Método que entrega el RUT formateado del contribuyente
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2015-09-20
     */
    public function getRUT()
    {
        return num($this->rut).'-'.$this->dv;
    }

    /**
     * Método que entrega la glosa del ambiente en el que se encuentra el
     * contribuyente
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2015-09-23
     */
    public function getAmbiente()
    {
        return $this->config_ambiente_en_certificacion ? 'certificación' : 'producción';
    }

    /**
     * Método que entrega las actividades económicas del contribuyente
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2016-08-08
     */
    public function getListActividades()
    {
        $actividades = [$this->actividad_economica];
        if ($this->config_extra_otras_actividades) {
            foreach ($this->config_extra_otras_actividades as $a) {
                $actividades[] = is_object($a) ? $a->actividad : $a;
            }
        }
        $where = [];
        $vars = [];
        foreach ($actividades as $key => $a) {
            $where[] = ':a'.$key;
            $vars[':a'.$key] = $a;
        }
        return $this->db->getAssociativeArray('
            SELECT codigo, actividad_economica
            FROM actividad_economica
            WHERE codigo IN ('.implode(',', $where).')
            ORDER BY actividad_economica
        ', $vars);
    }

    /**
     * Método que entrega el listado de giros del contribuyente por cada
     * actividad económmica que tiene registrada
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2016-08-08
     */
    public function getListGiros()
    {
        $giros = [$this->actividad_economica => $this->giro];
        if ($this->config_extra_otras_actividades) {
            foreach ($this->config_extra_otras_actividades as $a) {
                $giros[is_object($a) ? $a->actividad : $a] = is_object($a) ? ($a->giro?$a->giro:$this->giro) : $this->giro;
            }
        }
        return $giros;
    }

    /**
     * Método que asigna los usuarios autorizados a operar con el contribuyente
     * @param usuarios Arreglo con índice nombre de usuario y valores un arreglo con los permisos a asignar
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2017-06-11
     */
    public function setUsuarios(array $usuarios) {
        $this->db->beginTransaction();
        $this->db->query(
            'DELETE FROM contribuyente_usuario WHERE contribuyente = :rut',
            [':rut'=>$this->rut]
        );
        foreach ($usuarios as $usuario => $permisos) {
            if (!$permisos)
                continue;
            $Usuario = new \sowerphp\app\Sistema\Usuarios\Model_Usuario($usuario);
            if (!$Usuario->exists()) {
                $this->db->rollback();
                throw new \Exception('Usuario '.$usuario.' no existe');
                return false;
            }
            foreach ($permisos as $permiso) {
                $ContribuyenteUsuario = new Model_ContribuyenteUsuario($this->rut, $Usuario->id, $permiso);
                $ContribuyenteUsuario->save();
            }
        }
        $this->db->commit();
        return true;
    }

    /**
     * Método que entrega los correos electrónicos asociados a cierto permiso
     * Por defecto se entregan los correos de los usuarios administradores
     * @return Arreglo con los correos electrónicos solicitados
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2018-12-09
     */
    public function getUsuariosEmail($permiso = 'admin')
    {
        $emails = $this->db->getCol('
            (
                SELECT u.email
                FROM contribuyente AS c JOIN usuario AS u ON u.id = c.usuario
                WHERE c.rut = :rut AND u.activo = true
            ) UNION (
                SELECT u.email
                FROM contribuyente_usuario AS c JOIN usuario AS u ON u.id = c.usuario
                WHERE c.contribuyente = :rut AND c.permiso = :permiso AND u.activo = true
            )
        ', [':rut'=>$this->rut, ':permiso'=>$permiso]);
        return $emails;
    }

    /**
     * Método que entrega el listado de usuarios autorizados y sus permisos
     * @return Tabla con los usuarios y sus permisos
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2017-06-11
     */
    public function getUsuarios()
    {
        $usuarios = $this->db->getAssociativeArray('
            SELECT u.usuario, c.permiso
            FROM usuario AS u, contribuyente_usuario AS c
            WHERE u.id = c.usuario AND c.contribuyente = :rut
        ', [':rut'=>$this->rut]);
        foreach ($usuarios as &$permisos) {
            if (!is_array($permisos)) {
                $permisos = [$permisos];
            }
        }
        return $usuarios;
    }

    /**
     * Método que entrega el listado de usuarios para los campos select
     * @return Listado de usuarios
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2017-10-20
     */
    public function getListUsuarios()
    {
        return $this->db->getTable('
            (
                SELECT DISTINCT u.id, u.usuario
                FROM usuario AS u JOIN contribuyente_usuario AS c ON u.id = c.usuario
                WHERE c.contribuyente = :rut
            ) UNION (
                SELECT DISTINCT u.id, u.usuario
                FROM usuario AS u JOIN contribuyente AS c ON u.id = c.usuario
                WHERE c.rut = :rut
            )
            ORDER BY usuario
        ', [':rut'=>$this->rut]);
    }

    /**
     * Método que determina si el usuario está o no autorizado a trabajar con el
     * contribuyente
     * @param Usuario Objeto \sowerphp\app\Sistema\Usuarios\Model_Usuario con el usuario a verificar
     * @param permisos Permisos que se desean verificar que tenga el usuario
     * @return =true si está autorizado
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2018-02-16
     */
    public function usuarioAutorizado($Usuario, $permisos = [])
    {
        // si es el usuario que registró la empresa se le autoriza
        if ($this->usuario == $Usuario->id) {
            return true;
        }
        // normalizar permisos
        if (!is_array($permisos)) {
            $permisos = [$permisos];
        }
        // si la aplicación sólo tiene configurada una empresa se verifican los
        // permisos normales (basados en grupos) de sowerphp
        if (\sowerphp\core\Configure::read('dte.empresa')) {
            foreach ($permisos as $permiso) {
                if ($Usuario->auth($permiso)) {
                    return true;
                }
            }
            return false;
        }
        // ver si el usuario es del grupo de soporte
        if ($this->config_app_soporte and $Usuario->inGroup(['soporte'])) {
            return true;
        }
        // ver si el usuario tiene acceso a la empresa
        $usuario_permisos = $this->db->getCol('
            SELECT permiso
            FROM contribuyente_usuario
            WHERE contribuyente = :rut AND usuario = :usuario
        ', [':rut'=>$this->rut, ':usuario'=>$Usuario->id]);
        if (!$usuario_permisos) {
            return false;
        }
        // si se está buscando por un recurso en particular entonces se
        // valida contra los permisos del sistema
        if (isset($permisos[0]) and $permisos[0][0]=='/') {
            // actualizar permisos del usuario (útil cuando la llamada es vía API)
            $this->setPermisos($Usuario);
            // verificar permisos
            foreach ($permisos as $permiso) {
                if ($Usuario->auth($permiso)) {
                    return true;
                }
            }
        }
        // se está pidiendo un permiso por tipo de permiso (agrupación, se verifica si pertenece)
        else {
            // si no se está pidiendo ningún permiso en particular, sólo se
            // quiere saber si el usuario tiene acceso a la empresa
            if (!$permisos) {
                if ($usuario_permisos) {
                    return true;
                }
            }
            // si se está pidiendo algún permiso en particular se verifica si existe
            else {
                foreach ($permisos as $p) {
                    if (in_array($p, $usuario_permisos)) {
                        return true;
                    }
                }
            }
        }
        // si no se logró determinar el permiso no se autoriza
        return false;
    }

    /**
     * Método que asigna los permisos al usuario
     * @param Usuario Objeto \sowerphp\app\Sistema\Usuarios\Model_Usuario al que se asignarán permisos
     * @return =true si está autorizado
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2019-10-21
     */
    public function setPermisos(&$Usuario)
    {
        $grupos_usuario = $Usuario->groups(true);
        // si el usuario es el administrador de la empresa se colocan sus permisos estándares
        if ($this->usuario == $Usuario->id) {
            $grupos = $grupos_usuario;
        }
        // si el usuario es de soporte se colocan los permisos completos del usuario principal de la empresa
        else if ($this->config_app_soporte and $Usuario->inGroup(['soporte'])) {
            $grupos = $this->getUsuario()->groups(true);
        }
        // si es un usuario autorizado, entonces se copian los permisos asignados de los disponibles en el
        // administrador
        else {
            // asignar permisos copiados del administrador
            $permisos = \sowerphp\core\Configure::read('empresa.permisos');
            $usuario_permisos = $this->db->getCol('
                SELECT permiso
                FROM contribuyente_usuario
                WHERE contribuyente = :rut AND usuario = :usuario
            ', [':rut'=>$this->rut, ':usuario'=>$Usuario->id]);
            $grupos = [];
            foreach ($usuario_permisos as $p) {
                foreach ($permisos[$p]['grupos'] as $g) {
                    if (!in_array($g, $grupos)) {
                        $grupos[] = $g;
                    }
                }
            }
            // parche para asignar grupo 'distribuidor' a usuarios autorizados de un contribuyente
            // que es distribuidor
            if (in_array('distribuidor', $this->getUsuario()->getGroups())) {
                $grupos[] = 'distribuidor';
            }
            // siempre asignar el grupo 'usuarios' para mantener permisos básicos
            $grupos[] = 'usuarios';
        }
        // buscar permisos y grupos del usuario principal administrador
        $auths = $this->getUsuario()->getAuths($grupos);
        $grupos = $this->getUsuario()->getGroups($grupos);
        // corregir permisos con soporte si corresponde
        if (in_array('soporte', $grupos_usuario)) {
            foreach (['appadmin', 'passwd', 'soporte', 'sysadmin'] as $grupo) {
                if (!in_array($grupo, $grupos)) {
                    $auths = array_merge($auths, $Usuario->getAuths([$grupo]));
                    $grupos[] = $grupo;
                }
            }
        }
        $Usuario->setAuths($auths);
        $Usuario->setGroups($grupos);
    }

    /**
     * Método que determina si el usuario está o no autorizado a asignar manualmente el Folio de un DTE
     * @param Usuario Objeto \sowerphp\app\Sistema\Usuarios\Model_Usuario con el usuario a verificar
     * @return =true si está autorizado a cambiar el folio
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2017-11-07
     */
    public function puedeAsignarFolio($Usuario)
    {
        if (!$this->config_emision_asignar_folio) {
            return false;
        }
        if ($this->config_emision_asignar_folio==1) {
            return $this->usuarioAutorizado($Usuario, 'admin');
        }
        if ($this->config_emision_asignar_folio==2) {
            return $this->usuarioAutorizado($Usuario, ['admin', 'dte']);
        }
        return false;
    }

    /**
     * Método que entrega los documentos que el contribuyente tiene autorizados
     * a emitir en la aplicación
     * @return Listado de documentos autorizados
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2018-05-19
     */
    public function getDocumentosAutorizados($onlyPK = false, $User = null)
    {
        // invertir parámetros recibidos si User es objeto (se pasó el objeto del usuario)
        if (is_object($onlyPK)) {
            $aux = $onlyPK;
            $onlyPK = (boolean)$User;
            $User = $aux;
        }
        // buscar documentos
        if ($onlyPK) {
            $documentos = $this->db->getCol('
                SELECT t.codigo
                FROM dte_tipo AS t, contribuyente_dte AS c
                WHERE t.codigo = c.dte AND c.contribuyente = :rut AND c.activo = :activo
            ', [':rut'=>$this->rut, ':activo'=>1]);
        } else {
            $documentos = $this->db->getTable('
                SELECT t.codigo, t.tipo
                FROM dte_tipo AS t, contribuyente_dte AS c
                WHERE t.codigo = c.dte AND c.contribuyente = :rut AND c.activo = :activo
            ', [':rut'=>$this->rut, ':activo'=>1]);
        }
        // entregar todos los documentos si no se pidió filtrar por usuario o el usuario es administrador o el usuario es de soporte
        if (!$User or $User->id == $this->usuario or $User->inGroup(['soporte'])) {
            return $documentos;
        }
        // obtener sólo los documentos autorizados si se pidió por usuario
        $documentos_autorizados = [];
        foreach ($documentos as $d) {
            if (is_array($d)) {
                if ($this->documentoAutorizado($d['codigo'], $User)) {
                    $documentos_autorizados[] = $d;
                }
            } else {
                if ($this->documentoAutorizado($d, $User)) {
                    $documentos_autorizados[] = $d;
                }
            }
        }
        return $documentos_autorizados;
    }

    /**
     * Método que entrega los documentos que el contribuyente tiene autorizados
     * a emitir en la aplicación por cada usuario autorizado que tiene
     * @return Listado de documentos autorizados por usuario
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2017-06-25
     */
    public function getDocumentosAutorizadosPorUsuario()
    {
        $autorizados = $this->db->getAssociativeArray('
            SELECT u.usuario, d.dte
            FROM usuario AS u JOIN contribuyente_usuario_dte AS d ON d.usuario = u.id
            WHERE d.contribuyente = :contribuyente
        ', [':contribuyente' => $this->rut]);
        foreach ($autorizados as &$a) {
            if (!isset($a[0])) {
                $a = [$a];
            }
        }
        return $autorizados;
    }

    /**
     * Método que asigna los documentos autorizados por cada usuario del contribuyente
     * @param usuarios Arreglo con índice nombre de usuario y valores un arreglo con los documentos
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2017-06-25
     */
    public function setDocumentosAutorizadosPorUsuario(array $usuarios) {
        $this->db->beginTransaction();
        $this->db->query(
            'DELETE FROM contribuyente_usuario_dte WHERE contribuyente = :rut',
            [':rut'=>$this->rut]
        );
        foreach ($usuarios as $usuario => $documentos) {
            if (!$documentos)
                continue;
            $Usuario = new \sowerphp\app\Sistema\Usuarios\Model_Usuario($usuario);
            if (!$Usuario->exists()) {
                $this->db->rollback();
                throw new \Exception('Usuario '.$usuario.' no existe');
                return false;
            }
            foreach ($documentos as $dte) {
                $ContribuyenteUsuarioDte = new Model_ContribuyenteUsuarioDte($this->rut, $Usuario->id, $dte);
                $ContribuyenteUsuarioDte->save();
            }
        }
        $this->db->commit();
        return true;
    }

    /**
     * Método que determina si el documento puede o no ser emitido por el
     * contribuyente a través de la aplicación
     * @param dte Código del DTE que se quiere saber si está autorizado
     * @param Usuario Permite determinar el permiso para un usuario autorizado
     * @return =true si está autorizado
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2018-05-19
     */
    public function documentoAutorizado($dte, $Usuario = null)
    {
        $dte_autorizado = (bool)$this->db->getValue('
            SELECT COUNT(*)
            FROM contribuyente_dte
            WHERE contribuyente = :rut AND dte = :dte AND activo = :activo
        ', [':rut'=>$this->rut, ':dte'=>$dte, ':activo'=>1]);
        if (!$dte_autorizado) {
            return false;
        }
        if ($Usuario) {
            if ($Usuario->id == $this->usuario or $Usuario->inGroup(['soporte'])) {
                return true;
            }
            $dtes = $this->db->getCol(
                'SELECT dte FROM contribuyente_usuario_dte WHERE contribuyente = :contribuyente AND usuario = :usuario',
                [':contribuyente'=>$this->rut, ':usuario'=>$Usuario->id]
            );
            if (!$dtes) {
                return false; // si nada está autorizado se rechaza el DTE (=true si nada está autorizado se acepta cualquier DTE)
            }
            if (!in_array($dte, $dtes)) {
                return false;
            }
        }
        return true;
    }

    /**
     * Método que entrega el listado de folios que el Contribuyente dispone
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2015-09-25
     */
    public function getFolios()
    {
        return $this->db->getTable('
            SELECT f.dte, t.tipo, f.siguiente, f.disponibles, f.alerta
            FROM dte_folio AS f, dte_tipo AS t
            WHERE f.dte = t.codigo AND emisor = :rut AND f.certificacion = :certificacion
            ORDER BY f.dte
        ', [':rut'=>$this->rut, ':certificacion'=>(int)$this->config_ambiente_en_certificacion]);
    }

    /**
     * Método que entrega los datos del folio del documento solicitado
     * @param dte Tipo de documento para el cual se quiere su folio
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2017-08-07
     */
    public function getFolio($dte, $folio_manual = 0)
    {
        if (!$this->db->beginTransaction(true))
            return false;
        $DteFolio = new \website\Dte\Admin\Model_DteFolio($this->rut, $dte, (int)$this->config_ambiente_en_certificacion);
        if (!$DteFolio->disponibles and $this->config_sii_timbraje_automatico) {
            try {
                $DteFolio->timbrar($DteFolio->alerta*$this->config_sii_timbraje_multiplicador);
                $DteFolio = new \website\Dte\Admin\Model_DteFolio($this->rut, $dte, (int)$this->config_ambiente_en_certificacion); // actualiza info del mantenedor de folios
            } catch (\Exception $e) {
                //file_put_contents(TMP.'/contribuyentes.log', $this->rut.' TIMBRAJE '.$e->getMessage()."\n", FILE_APPEND);
            }
        }
        if (!$DteFolio->exists() or !$DteFolio->disponibles) {
            $this->db->rollback();
            return false;
        }
        if ($folio_manual==$DteFolio->siguiente) {
            $folio_manual = 0;
        }
        if (!$folio_manual) {
            $folio = $DteFolio->siguiente;
            $DteFolio->siguiente++;
            $DteFolio->disponibles--;
            try {
                if (!$DteFolio->save(false)) {
                    $this->db->rollback();
                    return false;
                }
            } catch (\sowerphp\core\Exception_Model_Datasource_Database $e) {
                $this->db->rollback();
                return false;
            }
        } else {
            $folio = $folio_manual;
        }
        $Caf = $this->getCaf($dte, $folio);
        if (!$Caf) {
            $this->db->rollback();
            return false;
        }
        $this->db->commit();
        return (object)[
            'folio' => $folio,
            'Caf' => $Caf,
            'DteFolio' => $DteFolio,
        ];
    }

    /**
     * Método que entrega el CAF de un folio de cierto DTE
     * @param dte Tipo de documento para el cual se quiere su CAF
     * @param folio Folio del CAF del DTE que se busca
     * @return \sasco\LibreDTE\Sii\Folios
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2015-09-22
     */
    public function getCaf($dte, $folio)
    {
        $caf = $this->db->getValue('
            SELECT xml
            FROM dte_caf
            WHERE
                emisor = :rut
                AND dte = :dte
                AND certificacion = :certificacion
                AND :folio BETWEEN desde AND hasta
        ', [
            ':rut' => $this->rut,
            ':dte' => $dte,
            ':certificacion' => (int)$this->config_ambiente_en_certificacion,
            ':folio' => $folio,
        ]);
        if (!$caf)
            return false;
        $caf = Utility_Data::decrypt($caf);
        if (!$caf)
            return false;
        $Caf = new \sasco\LibreDTE\Sii\Folios($caf);
        return $Caf->getTipo() ? $Caf : false;
    }

    /**
     * Método que entrega una tabla con los datos de las firmas electrónicas de
     * los usuarios que están autorizados a trabajar con el contribuyente
     * @param dte Tipo de documento para el cual se quiere su folio
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2018-12-21
     */
    public function getFirmas()
    {
        return $this->db->getTable('
            (
                SELECT f.run, f.nombre, f.email, f.desde, f.hasta, f.emisor, u.usuario, true AS administrador
                FROM firma_electronica AS f, usuario AS u, contribuyente AS c
                WHERE f.usuario = u.id AND f.usuario = c.usuario AND c.rut = :rut
            ) UNION (
                SELECT DISTINCT f.run, f.nombre, f.email, f.desde, f.hasta, f.emisor, u.usuario, false AS administrador
                FROM firma_electronica AS f, usuario AS u, contribuyente_usuario AS c
                WHERE f.usuario = u.id AND f.usuario = c.usuario AND c.contribuyente = :rut AND u.id NOT IN (
                    SELECT c.usuario FROM contribuyente AS c WHERE c.rut = :rut
                )
            )
            ORDER BY administrador DESC, nombre ASC
        ', [':rut'=>$this->rut]);
    }

    /**
     * Método que entrega el objeto de la firma electronica asociada al usuario
     * que la está solicitando o bien aquella firma del usuario que es el
     * administrador del contribuyente.
     * @param user ID del usuario que desea obtener la firma
     * @return \sasco\LibreDTE\FirmaElectronica
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2016-05-12
     */
    public function getFirma($user = null)
    {
        // buscar firma del usuario administrador de la empresa
        $datos = $this->db->getRow('
            SELECT f.archivo, f.contrasenia
            FROM firma_electronica AS f, contribuyente AS c
            WHERE f.usuario = c.usuario AND c.rut = :rut
        ', [':rut'=>$this->rut]);
        // buscar firma del usuario que está haciendo la solicitud
        if (empty($datos) and $user and $user!=$this->usuario) {
            $datos = $this->db->getRow('
                SELECT archivo, contrasenia
                FROM firma_electronica
                WHERE usuario = :usuario
            ', [':usuario'=>$user]);
        }
        if (empty($datos))
            return false;
        // si se obtuvo una firma se trata de usar
        $pass = Utility_Data::decrypt($datos['contrasenia']);
        if (!$pass)
            return false;
        try {
            $Firma = new \sasco\LibreDTE\FirmaElectronica([
                'data' => base64_decode($datos['archivo']),
                'pass' => $pass,
            ]);
            return $Firma;
        } catch (\sowerphp\core\Exception $e) {
            return false;
        }
        return false;
    }

    /**
     * Método que entrega el listado de documentos temporales por el contribuyente
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2018-05-03
     */
    public function getDocumentosTemporales($filtros = [])
    {
        // armar filtros
        $where = ['d.emisor = :rut'];
        $vars = [':rut'=>$this->rut];
        foreach (['receptor', 'codigo', 'fecha', 'total'] as $c) {
            if (!empty($filtros[$c])) {
                $where[] = 'd.'.$c.' = :'.$c;
                $vars[':'.$c] = $filtros[$c];
            }
        }
        // filtrar por DTE
        if (!empty($filtros['dte'])) {
            if (is_array($filtros['dte'])) {
                $i = 0;
                $where_dte = [];
                foreach ($filtros['dte'] as $filtro_dte) {
                    $where_dte[] = ':dte'.$i;
                    $vars[':dte'.$i] = $filtro_dte;
                    $i++;
                }
                $where[] = 'd.dte IN ('.implode(', ', $where_dte).')';
            } else {
                $where[] = 'd.dte = :dte';
                $vars[':dte'] = $filtros['dte'];
            }
        }
        // otros filtros
        if (!empty($filtros['fecha_desde'])) {
            $where[] = 'd.fecha >= :fecha_desde';
            $vars[':fecha_desde'] = $filtros['fecha_desde'];
        }
        if (!empty($filtros['fecha_hasta'])) {
            $where[] = 'd.fecha <= :fecha_hasta';
            $vars[':fecha_hasta'] = $filtros['fecha_hasta'];
        }
        if (!empty($filtros['total_desde'])) {
            $where[] = 'd.total >= :total_desde';
            $vars[':total_desde'] = $filtros['total_desde'];
        }
        if (!empty($filtros['total_hasta'])) {
            $where[] = 'd.total <= :total_hasta';
            $vars[':total_hasta'] = $filtros['total_hasta'];
        }
        if (!empty($filtros['folio'])) {
            $aux = explode('-', $filtros['folio']);
            if (!isset($aux[1])) {
                throw new \Exception('Folio del DTE temporal debe ser en formato DTE-CODIGO_7');
            }
            list($dte, $codigo) = $aux;
            $where[] = 'd.dte = :dte AND SUBSTR(d.codigo,1,7) = :codigo';
            $vars[':dte'] = (int)$dte;
            $vars[':codigo'] = strtolower($codigo);
        }
        // armar consulta interna (no obtiene razón social verdadera en DTE exportación por que requiere acceder al JSON)
        $query = '
            SELECT
                d.emisor,
                d.dte,
                t.tipo,
                d.codigo,
                (d.dte || \'-\' || SUBSTR(d.codigo,1,7)) AS folio,
                d.receptor,
                r.razon_social,
                d.fecha,
                d.total
            FROM
                dte_tmp AS d
                JOIN dte_tipo AS t ON d.dte = t.codigo
                JOIN contribuyente AS r ON d.receptor = r.rut
            WHERE '.implode(' AND ', $where).'
            ORDER BY d.fecha DESC, t.tipo, d.codigo DESC
        ';
        // armar límite consulta
        if (isset($filtros['limit'])) {
            $query = $this->db->setLimit($query, $filtros['limit'], $filtros['offset']);
        }
        // entregar consulta TODO: abrir JSON para consultar razón social verdadera
        return $this->db->getTable($query, $vars);
    }

    /**
     * Método que entrega el listado de documentos emitidos por el contribuyente
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2019-07-06
     */
    public function getDocumentosEmitidos($filtros = [])
    {
        // armar filtros
        $where = ['d.emisor = :rut', 'd.certificacion = :certificacion'];
        $vars = [':rut'=>$this->rut, ':certificacion'=>(int)$this->config_ambiente_en_certificacion];
        foreach (['folio', 'fecha', 'total', 'usuario'] as $c) {
            if (!empty($filtros[$c])) {
                $where[] = 'd.'.$c.' = :'.$c;
                $vars[':'.$c] = $filtros[$c];
            }
        }
        // filtrar por DTE
        if (!empty($filtros['dte'])) {
            if (is_array($filtros['dte'])) {
                $i = 0;
                $where_dte = [];
                foreach ($filtros['dte'] as $filtro_dte) {
                    $where_dte[] = ':dte'.$i;
                    $vars[':dte'.$i] = $filtro_dte;
                    $i++;
                }
                $where[] = 'd.dte IN ('.implode(', ', $where_dte).')';
            }
            else if ($filtros['dte'][0]=='!') {
                $where[] = 'd.dte != :dte';
                $vars[':dte'] = substr($filtros['dte'],1);
            }
            else {
                $where[] = 'd.dte = :dte';
                $vars[':dte'] = $filtros['dte'];
            }
        }
        // receptor
        if (!empty($filtros['receptor'])) {
            if ($filtros['receptor'][0]=='!') {
                $where[] = 'd.receptor != :receptor';
                $vars[':receptor'] = substr($filtros['receptor'],1);
            }
            else {
                $where[] = 'd.receptor = :receptor';
                $vars[':receptor'] = $filtros['receptor'];
            }
        }
        if (!empty($filtros['razon_social'])) {
            $where[] = 'r.razon_social ILIKE :razon_social';
            $vars[':razon_social'] = '%'.$filtros['razon_social'].'%';
        }
        // otros filtros
        if (!empty($filtros['fecha_desde'])) {
            $where[] = 'd.fecha >= :fecha_desde';
            $vars[':fecha_desde'] = $filtros['fecha_desde'];
        }
        if (!empty($filtros['fecha_hasta'])) {
            $where[] = 'd.fecha <= :fecha_hasta';
            $vars[':fecha_hasta'] = $filtros['fecha_hasta'];
        }
        if (!empty($filtros['total_desde'])) {
            $where[] = 'd.total >= :total_desde';
            $vars[':total_desde'] = $filtros['total_desde'];
        }
        if (!empty($filtros['total_hasta'])) {
            $where[] = 'd.total <= :total_hasta';
            $vars[':total_hasta'] = $filtros['total_hasta'];
        }
        if (isset($filtros['sucursal_sii']) and $filtros['sucursal_sii']!=-1) {
            if ($filtros['sucursal_sii']) {
                $where[] = 'd.sucursal_sii = :sucursal_sii';
                $vars[':sucursal_sii'] = $filtros['sucursal_sii'];
            } else {
                $where[] = 'd.sucursal_sii IS NULL';
            }
        }
        if (!empty($filtros['periodo'])) {
            $where[] = $this->db->date('Ym', 'd.fecha').' = :periodo';
            $vars[':periodo'] = $filtros['periodo'];
        }
        if (isset($filtros['receptor_evento'])) {
            if ($filtros['receptor_evento']) {
                $where[] = 'd.receptor_evento = :receptor_evento';
                $vars[':receptor_evento'] = $filtros['receptor_evento'];
            } else {
                $where[] = 'd.receptor_evento IS NULL';
            }
        }
        if (!empty($filtros['cedido'])) {
            $where[] = 'd.cesion_track_id IS NOT NULL';
        }
        // si se debe hacer búsqueda dentro de los XML
        if (!empty($filtros['xml'])) {
            $i = 1;
            foreach ($filtros['xml'] as $nodo => $valor) {
                $nodo = preg_replace('/[^A-Za-z\/]/', '', $nodo);
                $where[] = 'LOWER('.$this->db->xml('d.xml', '/EnvioDTE/SetDTE/DTE/*/'.$nodo, 'http://www.sii.cl/SiiDte').') LIKE :xml'.$i;
                $vars[':xml'.$i] = '%'.strtolower($valor).'%';
                $i++;
            }
        }
        // armar consulta interna (no obtiene razón social verdadera en DTE exportación por que requiere acceder al XML)
        $query = '
            SELECT
                d.emisor,
                d.dte,
                d.folio,
                d.certificacion,
                t.tipo,
                r.razon_social,
                i.glosa AS intercambio,
                u.usuario
            FROM
                dte_emitido AS d
                JOIN dte_tipo AS t ON d.dte = t.codigo
                JOIN contribuyente AS r ON d.receptor = r.rut
                JOIN usuario AS u ON d.usuario = u.id
                LEFT JOIN dte_intercambio_resultado_dte AS i ON i.emisor = d.emisor AND i.dte = d.dte AND i.folio = d.folio AND i.certificacion = d.certificacion
            WHERE '.implode(' AND ', $where).'
            ORDER BY d.fecha DESC, t.tipo, d.folio DESC
        ';
        // armar límite consulta
        if (isset($filtros['limit'])) {
            $query = $this->db->setLimit($query, $filtros['limit'], $filtros['offset']);
        }
        // entregar consulta verdadera (esta si obtiene razón social verdadera en DTE exportación, pero sólo para las filas del límite consultado)
        $razon_social_xpath = $this->db->xml('d.xml', '/EnvioDTE/SetDTE/DTE/Exportaciones/Encabezado/Receptor/RznSocRecep', 'http://www.sii.cl/SiiDte');
        return $this->db->getTable('
            SELECT
                e.dte,
                e.tipo,
                e.folio,
                d.receptor,
                CASE WHEN e.dte NOT IN (110, 111, 112) THEN e.razon_social ELSE '.$razon_social_xpath.' END AS razon_social,
                d.fecha,
                d.total,
                d.revision_estado AS estado,
                e.intercambio,
                d.sucursal_sii,
                e.usuario
            FROM
                dte_emitido AS d
                JOIN ('.$query.') AS e ON d.emisor = e.emisor AND e.dte = d.dte AND e.folio = d.folio AND e.certificacion = d.certificacion
            ORDER BY d.fecha DESC, e.tipo, e.folio DESC
        ', $vars);
    }

    /**
     * Método que entrega el total de documentos emitidos por el contribuyente
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2019-07-06
     */
    public function countDocumentosEmitidos($filtros = [])
    {
        $where = ['d.emisor = :rut', 'd.certificacion = :certificacion'];
        $vars = [':rut'=>$this->rut, ':certificacion'=>(int)$this->config_ambiente_en_certificacion];
        foreach (['folio', 'total', 'fecha', 'usuario'] as $c) {
            if (isset($filtros[$c])) {
                $where[] = 'd.'.$c.' = :'.$c;
                $vars[':'.$c] = $filtros[$c];
            }
        }
        // dte
        if (!empty($filtros['dte'])) {
            if (is_array($filtros['dte'])) {
                $i = 0;
                $where_dte = [];
                foreach ($filtros['dte'] as $filtro_dte) {
                    $where_dte[] = ':dte'.$i;
                    $vars[':dte'.$i] = $filtro_dte;
                    $i++;
                }
                $where[] = 'd.dte IN ('.implode(', ', $where_dte).')';
            }
            else if ($filtros['dte'][0]=='!') {
                $where[] = 'd.dte != :dte';
                $vars[':dte'] = substr($filtros['dte'],1);
            }
            else {
                $where[] = 'd.dte = :dte';
                $vars[':dte'] = $filtros['dte'];
            }
        }
        // receptor
        if (!empty($filtros['receptor'])) {
            if ($filtros['receptor'][0]=='!') {
                $where[] = 'd.receptor != :receptor';
                $vars[':receptor'] = substr($filtros['receptor'],1);
            }
            else {
                $where[] = 'd.receptor = :receptor';
                $vars[':receptor'] = $filtros['receptor'];
            }
        }
        // filtros fecha
        if (!empty($filtros['fecha_desde'])) {
            $where[] = 'd.fecha >= :fecha_desde';
            $vars[':fecha_desde'] = $filtros['fecha_desde'];
        }
        if (!empty($filtros['fecha_hasta'])) {
            $where[] = 'd.fecha <= :fecha_hasta';
            $vars[':fecha_hasta'] = $filtros['fecha_hasta'];
        }
        // documento cedido
        if (!empty($filtros['cedido'])) {
            $where[] = 'd.cesion_track_id IS NOT NULL';
        }
        // contar documentos emitidos
        return (integer)$this->db->getValue(
            'SELECT COUNT(*) FROM dte_emitido AS d WHERE '.implode(' AND ', $where),
            $vars
        );
    }

    /**
     * Método que crea el objeto email para enviar por SMTP y lo entrega
     * @param email Email que se quiere obteber: intercambio o sii
     * @return \sowerphp\core\Network_Email
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2019-06-07
     */
    public function getEmailSmtp($email = 'intercambio')
    {
        $user = $this->{'config_email_'.$email.'_user'};
        $pass = $this->{'config_email_'.$email.'_pass'};
        $host = $this->{'config_email_'.$email.'_smtp'};
        // validar campos mínimos
        if (empty($user)) {
            throw new \Exception('El usuario del correo "'.$email.'" no está definido. Por favor, verificar configuración de la empresa.');
        }
        if (empty($pass)) {
            throw new \Exception('La contraseña del correo "'.$email.'" no está definida. Por favor, verificar configuración de la empresa.');
        }
        if (empty($host)) {
            throw new \Exception('El servidor SMTP del correo "'.$email.'" no está definido. Por favor, verificar configuración de la empresa.');
        }
        // crear objeto con configuración del correo
        return new \sowerphp\core\Network_Email([
            'type' => 'smtp-phpmailer',
            'host' => $host,
            'user' => $user,
            'pass' => $pass,
            'from' => ['email'=>$user, 'name'=>str_replace(',', '', $this->getNombre())],
        ]);
    }

    /**
     * Método que crea el objeto Imap para recibir correo por IMAP
     * @param email Email que se quiere obteber: intercambio o sii
     * @return \sowerphp\core\Network_Email_Imap
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2019-06-07
     */
    public function getEmailImap($email = 'intercambio')
    {
        $user = $this->{'config_email_'.$email.'_user'};
        $pass = $this->{'config_email_'.$email.'_pass'};
        $host = $this->{'config_email_'.$email.'_imap'};
        // validar campos mínimos
        if (empty($user)) {
            throw new \Exception('El usuario del correo "'.$email.'" no está definido. Por favor, verificar configuración de la empresa.');
        }
        if (empty($pass)) {
            throw new \Exception('La contraseña del correo "'.$email.'" no está definida. Por favor, verificar configuración de la empresa.');
        }
        if (empty($host)) {
            throw new \Exception('El servidor IMAP del correo "'.$email.'" no está definido. Por favor, verificar configuración de la empresa.');
        }
        // crear objeto con configuración del correo
        $Imap = new \sowerphp\core\Network_Email_Imap([
            'mailbox' => $host,
            'user' => $user,
            'pass' => $pass,
        ]);
        return $Imap->isConnected() ? $Imap : false;
    }

    /**
     * Método que entrega el resumen de las boletas por períodos
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2018-11-07
     */
    public function getResumenBoletasPeriodos()
    {
        $periodo_col = $this->db->date('Ym', 'fecha');
        return $this->db->getTable('
            SELECT
                '.$periodo_col.' AS periodo,
                COUNT(folio) AS emitidas,
                MIN(fecha) AS desde,
                MAX(fecha) AS hasta,
                SUM(exento) AS exento,
                SUM(neto) AS neto,
                SUM(iva) AS iva,
                SUM(total) AS total
            FROM dte_emitido
            WHERE emisor = :rut AND certificacion = :certificacion AND dte IN (39, 41)
            GROUP BY '.$periodo_col.'
            ORDER BY '.$periodo_col.' DESC
        ', [':rut'=>$this->rut, ':certificacion'=>(int)$this->config_ambiente_en_certificacion]);
    }

    /**
     * Método que entrega las boletas de un período
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2018-11-07
     */
    public function getBoletas($periodo)
    {
        $periodo_col = $this->db->date('Ym', 'e.fecha');
        return $this->db->getTable('
            SELECT
                e.dte,
                e.folio,
                e.tasa,
                e.fecha,
                '.$this->db->concat('r.rut', '-', 'r.dv').' AS rut,
                e.exento,
                e.neto,
                e.iva,
                e.total,
                a.codigo AS anulada
            FROM
                dte_emitido AS e
                LEFT JOIN dte_referencia AS a ON
                    a.emisor = e.emisor
                    AND a.referencia_dte = e.dte
                    AND a.referencia_folio = e.folio
                    AND a.certificacion = e.certificacion
                    AND a.codigo = 1,
                contribuyente AS r
            WHERE
                e.receptor = r.rut
                AND e.emisor = :rut
                AND e.certificacion = :certificacion
                AND e.dte IN (39, 41)
                AND '.$periodo_col.' = :periodo
            ORDER BY e.fecha, e.dte, e.folio
        ', [
            ':rut' => $this->rut,
            ':certificacion' => (int)$this->config_ambiente_en_certificacion,
            ':periodo' => $periodo,
        ]);
    }

    /**
     * Método que entrega los documentos para el reporte de consumo de folios de
     * las boletas electrónicas
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2016-02-14
     */
    public function getDocumentosConsumoFolios($desde, $hasta = null)
    {
        if (!$hasta)
            $hasta = $desde;
        return $this->db->getTable('
            (
                SELECT
                    dte,
                    folio,
                    tasa,
                    fecha,
                    exento,
                    neto,
                    iva,
                    total
                FROM
                    dte_emitido AS e
                WHERE
                    fecha BETWEEN :desde AND :hasta
                    AND emisor = :rut
                    AND certificacion = :certificacion
                    AND dte IN (39, 41)
            ) UNION (
                SELECT
                    e.dte,
                    e.folio,
                    e.tasa,
                    e.fecha,
                    e.exento,
                    e.neto,
                    e.iva,
                    e.total
                FROM
                    dte_referencia AS r
                    JOIN dte_emitido AS e ON
                        r.emisor = e.emisor
                        AND r.dte = e.dte
                        AND r.folio = e.folio
                        AND r.certificacion = e.certificacion
                WHERE
                    r.emisor = :rut
                    AND r.dte = 61
                    AND r.certificacion = :certificacion
                    AND r.referencia_dte IN (39, 41)
                    AND e.fecha BETWEEN :desde AND :hasta
            )
            ORDER BY fecha, dte, folio
        ', [
            ':rut' => $this->rut,
            ':certificacion' => (int)$this->config_ambiente_en_certificacion,
            ':desde' => $desde,
            ':hasta' => $hasta,
        ]);
    }

    /**
     * Método que entrega el resumen de las ventas por períodos
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2016-10-12
     */
    public function getResumenVentasPeriodos()
    {
        $periodo_col = $this->db->date('Ym', 'e.fecha', 'INTEGER');
        return $this->db->getTable('
            (
                SELECT '.$periodo_col.' AS periodo, COUNT(*) AS emitidos, v.documentos AS enviados, v.track_id, v.revision_estado
                FROM dte_tipo AS t, dte_emitido AS e LEFT JOIN dte_venta AS v ON e.emisor = v.emisor AND e.certificacion = v.certificacion AND '.$periodo_col.' = v.periodo
                WHERE t.codigo = e.dte AND t.venta = true AND e.emisor = :rut AND e.certificacion = :certificacion AND e.dte != 46
                GROUP BY '.$periodo_col.', enviados, v.track_id, v.revision_estado
            ) UNION (
                SELECT periodo, documentos AS emitidos, documentos AS enviados, track_id, revision_estado
                FROM dte_venta
                WHERE emisor = :rut AND certificacion = :certificacion
            )
            ORDER BY periodo DESC
        ', [':rut'=>$this->rut, ':certificacion'=>(int)$this->config_ambiente_en_certificacion]);
    }

    /**
     * Método que entrega el total de ventas de un período
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2018-05-17
     */
    public function countVentas($periodo)
    {
        $periodo_col = $this->db->date('Ym', 'e.fecha');
        return (integer)$this->db->getValue('
            SELECT COUNT(*)
            FROM dte_emitido AS e JOIN dte_tipo AS t ON e.dte = t.codigo
            WHERE
                e.emisor = :rut AND e.certificacion = :certificacion AND '.$periodo_col.' = :periodo AND e.dte != 46 AND t.venta = true
                AND (e.emisor, e.dte, e.folio, e.certificacion) NOT IN (
                    SELECT e.emisor, e.dte, e.folio, e.certificacion
                    FROM
                        dte_emitido AS e
                        JOIN dte_referencia AS r ON r.emisor = e.emisor AND r.dte = e.dte AND r.folio = e.folio AND r.certificacion = e.certificacion
                        WHERE '.$periodo_col.' = :periodo AND r.referencia_dte = 46
                )
        ', [':rut'=>$this->rut, ':certificacion'=>(int)$this->config_ambiente_en_certificacion, ':periodo'=>$periodo]);
    }

    /**
     * Método que entrega las ventas de un período
     * @todo Corregir ID en Extranjero y asignar los NULL por los valores que corresponden (quizás haya que modificar tabla dte_emitido)
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2017-04-28
     */
    public function getVentas($periodo)
    {
        $periodo_col = $this->db->date('Ym', 'e.fecha');
        $razon_social_xpath = $this->db->xml('e.xml', '/EnvioDTE/SetDTE/DTE/Exportaciones/Encabezado/Receptor/RznSocRecep', 'http://www.sii.cl/SiiDte');
        $razon_social = 'CASE WHEN e.dte NOT IN (110, 111, 112) THEN r.razon_social ELSE '.$razon_social_xpath.' END AS razon_social';
        // si el contribuyente tiene impuestos adicionales se crean las query para esos campos
        if ($this->config_extra_impuestos_adicionales) {
            list($impuesto_codigo, $impuesto_tasa, $impuesto_monto) = $this->db->xml('e.xml', [
                '/EnvioDTE/SetDTE/DTE/Documento/Encabezado/Totales/ImptoReten/TipoImp',
                '/EnvioDTE/SetDTE/DTE/Documento/Encabezado/Totales/ImptoReten/TasaImp',
                '/EnvioDTE/SetDTE/DTE/Documento/Encabezado/Totales/ImptoReten/MontoImp',
            ], 'http://www.sii.cl/SiiDte');
        } else {
            $impuesto_codigo = $impuesto_tasa = $impuesto_monto = 'NULL';
        }
        if ($this->config_extra_constructora) {
            $credito_constructoras = $this->db->xml('e.xml', '/EnvioDTE/SetDTE/DTE/Documento/Encabezado/Totales/CredEC', 'http://www.sii.cl/SiiDte');
        } else {
            $credito_constructoras = 'NULL';
        }
        // campos para datos extranjeros
        list($extranjero_id, $extranjero_nacionalidad) = $this->db->xml('e.xml', [
            '/EnvioDTE/SetDTE/DTE/Exportaciones/Referencia/FolioRef', // FIXME
            '/EnvioDTE/SetDTE/DTE/Exportaciones/Encabezado/Receptor/Extranjero/Nacionalidad',
        ], 'http://www.sii.cl/SiiDte');
        $extranjero_id = 'NULL'; // TODO: fix xpath para seleccionar la referencia que tiene codigo 813 (u otro doc identidad que se defina)
        // realizar consulta
        return $this->db->getTable('
            SELECT
                e.dte,
                e.folio,
                '.$this->db->concat('r.rut', '-', 'r.dv').' AS rut,
                e.tasa,
                '.$razon_social.',
                e.fecha,
                CASE WHEN e.anulado THEN \'A\' ELSE NULL END AS anulado,
                e.exento,
                e.neto,
                e.iva,
                CASE WHEN e.iva_fuera_plazo THEN e.iva ELSE NULL END AS iva_fuera_plazo,
                '.$impuesto_codigo.' AS impuesto_codigo,
                '.$impuesto_tasa.' AS impuesto_tasa,
                '.$impuesto_monto.' AS impuesto_monto,
                NULL AS iva_propio,
                NULL AS iva_terceros,
                NULL AS iva_retencion_total,
                NULL AS iva_retencion_parcial,
                NULL AS iva_no_retenido,
                NULL AS ley_18211,
                '.$credito_constructoras.' AS credito_constructoras,
                NULL AS referencia_tipo,
                NULL AS referencia_folio,
                NULL AS deposito_envases,
                NULL AS monto_no_facturable,
                NULL AS monto_periodo,
                NULL AS pasaje_nacional,
                NULL AS pasaje_internacional,
                CASE WHEN e.dte IN (110, 111, 112) THEN '.$extranjero_id.' ELSE NULL END AS extranjero_id,
                CASE WHEN e.dte IN (110, 111, 112) THEN '.$extranjero_nacionalidad.' ELSE NULL END AS extranjero_nacionalidad,
                NULL AS indicador_servicio,
                NULL AS indicador_sin_costo,
                NULL AS liquidacion_rut,
                NULL AS liquidacion_comision_neto,
                NULL AS liquidacion_comision_exento,
                NULL AS liquidacion_comision_iva,
                e.sucursal_sii,
                NULL AS numero_interno,
                NULL AS emisor_nc_nd_fc,
                e.total
            FROM dte_tipo AS t, dte_emitido AS e, contribuyente AS r
            WHERE
                t.codigo = e.dte AND t.venta = true AND e.receptor = r.rut AND e.emisor = :rut AND e.certificacion = :certificacion AND '.$periodo_col.' = :periodo AND e.dte != 46
                AND (e.emisor, e.dte, e.folio, e.certificacion) NOT IN (
                    SELECT e.emisor, e.dte, e.folio, e.certificacion
                    FROM
                        dte_emitido AS e
                        JOIN dte_referencia AS r ON r.emisor = e.emisor AND r.dte = e.dte AND r.folio = e.folio AND r.certificacion = e.certificacion
                        WHERE '.$periodo_col.' = :periodo AND r.referencia_dte = 46
                )
            ORDER BY e.fecha, e.dte, e.folio
        ', [':rut'=>$this->rut, ':certificacion'=>(int)$this->config_ambiente_en_certificacion, ':periodo'=>$periodo]);
    }

    /**
     * Método que entrega el historial de ventas con el monto total por período para un determinado receptor
     * @param periodo Período para el cual se está construyendo el libro
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2018-04-14
     */
    public function getHistorialVentas($receptor, $fecha = null, $periodos = 12)
    {
        if (strpos($receptor, '-')) {
            $receptor = substr($receptor, 0, -2);
        }
        if (!$fecha) {
            $fecha = date('Y-m-d');
        }
        $periodo_col = $this->db->date('Ym', 'e.fecha');
        $desde = substr(str_replace('-', '', \sowerphp\general\Utility_Date::getPrevious($fecha, 'M', $periodos)),0,6);
        $hasta = \sowerphp\general\Utility_Date::previousPeriod(substr(str_replace('-', '', $fecha),0,6));
        // realizar consulta
        $montos = $this->db->getTable('
            SELECT
                '.$periodo_col.' AS periodo,
                t.operacion,
                SUM(e.total) AS total
            FROM dte_emitido AS e JOIN dte_tipo AS t ON t.codigo = e.dte
            WHERE
                t.venta = true
                AND e.emisor = :emisor
                AND e.certificacion = :certificacion
                AND e.dte != 46
                AND '.$periodo_col.' BETWEEN :desde AND :hasta
                AND e.receptor = :receptor
            GROUP BY periodo, t.operacion
            ORDER BY periodo
        ', [':emisor'=>$this->rut, ':certificacion'=>(int)$this->config_ambiente_en_certificacion, ':receptor'=>$receptor, ':desde'=>$desde, ':hasta'=>$hasta]);
        if (!$montos) {
            return [];
        }
        $historial = [];
        $periodo = $montos[0]['periodo'];
        while ($periodo <= $hasta) {
            $historial[(int)$periodo] = 0;
            $periodo = \sowerphp\general\Utility_Date::nextPeriod($periodo);
        }
        foreach ($montos as $monto) {
            if ($monto['operacion'] == 'S') {
                $historial[$monto['periodo']] += $monto['total'];
            } else {
                $historial[$monto['periodo']] -= $monto['total'];
            }
        }
        return $historial;
    }

    /**
     * Método que entrega el objeto del libro de ventas a partir de las ventas registradas en la aplicación
     * @param periodo Período para el cual se está construyendo el libro
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2016-12-21
     */
    public function getLibroVentas($periodo)
    {
        $Libro = new \sasco\LibreDTE\Sii\LibroCompraVenta();
        $ventas = $this->getVentas($periodo);
        foreach ($ventas as $venta) {
            // armar detalle para agregar al libro
            $d = [];
            foreach ($venta as $k => $v) {
                if (strpos($k, 'impuesto_')!==0 and strpos($k, 'extranjero_')!==0) {
                    if ($v!==null) {
                        $d[Model_DteVenta::$libro_cols[$k]] = $v;
                    }
                }
            }
            // agregar datos si es extranjero
            if (!empty($venta['extranjero_id']) or !empty($venta['extranjero_nacionalidad'])) {
                $d['Extranjero'] = [
                    'NumId' => !empty($venta['extranjero_id']) ? $venta['extranjero_id'] : false,
                    'Nacionalidad' => !empty($venta['extranjero_nacionalidad']) ? $venta['extranjero_nacionalidad'] : false,
                ];
            }
            // agregar otros impuestos
            if (!empty($venta['impuesto_codigo'])) {
                $d['OtrosImp'] = [
                    'CodImp' => $venta['impuesto_codigo'],
                    'TasaImp' => $venta['impuesto_tasa'],
                    'MntImp' => $venta['impuesto_monto'],
                ];
            }
            // agregar al libro
            $Libro->agregar($d);
        }
        return $Libro;
    }

    /**
     * Método que entrega el resumen de las ventas diarias de un período
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2017-09-11
     */
    public function getVentasDiarias($periodo)
    {
        $periodo_col = $this->db->date('Ym', 'e.fecha');
        $dia_col = $this->db->date('d', 'e.fecha');
        return $this->db->getTable('
            SELECT '.$dia_col.' AS dia, COUNT(*) AS documentos
            FROM dte_tipo AS t, dte_emitido AS e
            WHERE t.codigo = e.dte AND t.venta = true AND e.emisor = :rut AND e.certificacion = :certificacion AND '.$periodo_col.' = :periodo AND e.dte != 46
            GROUP BY e.fecha
            ORDER BY e.fecha
        ', [':rut'=>$this->rut, ':certificacion'=>(int)$this->config_ambiente_en_certificacion, ':periodo'=>$periodo]);
    }

    /**
     * Método que entrega el resumen de ventas por tipo de un período
     * @return Arreglo asociativo con las ventas
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2017-09-11
     */
    public function getVentasPorTipo($periodo)
    {
        $periodo_col = $this->db->date('Ym', 'e.fecha');
        return $this->db->getTable('
            SELECT t.tipo, COUNT(*) AS documentos
            FROM dte_tipo AS t, dte_emitido AS e
            WHERE t.codigo = e.dte AND t.venta = true AND e.emisor = :rut AND e.certificacion = :certificacion AND '.$periodo_col.' = :periodo AND e.dte != 46
            GROUP BY t.tipo
        ', [':rut'=>$this->rut, ':certificacion'=>(int)$this->config_ambiente_en_certificacion, ':periodo'=>$periodo]);
    }

    /**
     * Método que entrega el resumen de las guías por períodos
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2016-10-12
     */
    public function getResumenGuiasPeriodos()
    {
        $periodo_col = $this->db->date('Ym', 'e.fecha', 'INTEGER');
        return $this->db->getTable('
            (
                SELECT '.$periodo_col.' AS periodo, COUNT(*) AS emitidos, g.documentos AS enviados, g.track_id, g.revision_estado
                FROM dte_emitido AS e LEFT JOIN dte_guia AS g ON e.emisor = g.emisor AND e.certificacion = g.certificacion AND '.$periodo_col.' = g.periodo
                WHERE e.emisor = :rut AND e.certificacion = :certificacion AND e.dte = 52
                GROUP BY '.$periodo_col.', enviados, g.track_id, g.revision_estado
            ) UNION (
                SELECT periodo, documentos AS emitidos, documentos AS enviados, track_id, revision_estado
                FROM dte_guia
                WHERE emisor = :rut AND certificacion = :certificacion
            )
            ORDER BY periodo DESC
        ', [':rut'=>$this->rut, ':certificacion'=>(int)$this->config_ambiente_en_certificacion]);
    }

    /**
     * Método que entrega el resumen de las guías de un período
     * @todo Extraer IndTraslado en MariaDB
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2016-10-12
     */
    public function countGuias($periodo)
    {
        $periodo_col = $this->db->date('Ym', 'e.fecha');
        return (integer)$this->db->getValue('
            SELECT COUNT(*)
            FROM
                dte_emitido AS e
                LEFT JOIN dte_referencia AS ref ON e.emisor = ref.emisor AND e.dte = ref.referencia_dte AND e.folio = ref.referencia_folio AND e.certificacion = ref.certificacion
                LEFT JOIN dte_emitido AS re ON re.emisor = ref.emisor AND re.dte = ref.dte AND re.folio = ref.folio AND re.certificacion = ref.certificacion
            WHERE e.emisor = :rut AND e.certificacion = :certificacion AND '.$periodo_col.' = :periodo AND e.dte = 52
        ', [':rut'=>$this->rut, ':certificacion'=>(int)$this->config_ambiente_en_certificacion, ':periodo'=>$periodo]);
    }

    /**
     * Método que entrega el resumen de las guías de un período
     * @todo Extraer IndTraslado en MariaDB
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2016-10-12
     */
    public function getGuias($periodo)
    {
        $periodo_col = $this->db->date('Ym', 'e.fecha');
        $tipo_col= $this->db->xml('e.xml', '/EnvioDTE/SetDTE/DTE/Documento/Encabezado/IdDoc/IndTraslado', 'http://www.sii.cl/SiiDte');
        return $this->db->getTable('
            SELECT
                e.folio,
                CASE WHEN e.anulado THEN 2 ELSE NULL END AS anulado,
                1 AS operacion,
                '.$tipo_col.' AS tipo,
                e.fecha,
                '.$this->db->concat('r.rut', '-', 'r.dv').' AS rut,
                r.razon_social,
                e.neto,
                e.tasa,
                e.iva,
                e.total,
                NULL AS modificado,
                ref.dte AS ref_dte,
                ref.folio AS ref_folio,
                re.fecha AS ref_fecha
            FROM
                dte_emitido AS e
                LEFT JOIN dte_referencia AS ref ON e.emisor = ref.emisor AND e.dte = ref.referencia_dte AND e.folio = ref.referencia_folio AND e.certificacion = ref.certificacion
                LEFT JOIN dte_emitido AS re ON re.emisor = ref.emisor AND re.dte = ref.dte AND re.folio = ref.folio AND re.certificacion = ref.certificacion,
                contribuyente AS r
            WHERE e.receptor = r.rut AND e.emisor = :rut AND e.certificacion = :certificacion AND '.$periodo_col.' = :periodo AND e.dte = 52
            ORDER BY e.fecha, e.folio
        ', [':rut'=>$this->rut, ':certificacion'=>(int)$this->config_ambiente_en_certificacion, ':periodo'=>$periodo]);
    }

    /**
     * Método que entrega el resumen de las guías diarias de un período
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2018-05-17
     */
    public function getGuiasDiarias($periodo)
    {
        $periodo_col = $this->db->date('Ym', 'fecha');
        $dia_col = $this->db->date('d', 'fecha');
        return $this->db->getTable('
            SELECT '.$dia_col.' AS dia, COUNT(*) AS documentos
            FROM dte_emitido
            WHERE emisor = :rut AND certificacion = :certificacion AND '.$periodo_col.' = :periodo AND dte = 52
            GROUP BY fecha
            ORDER BY fecha
        ', [':rut'=>$this->rut, ':certificacion'=>(int)$this->config_ambiente_en_certificacion, ':periodo'=>$periodo]);
    }

    /**
     * Método que entrega la tabla con los casos de intercambio del contribuyente
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2018-05-19
     */
    public function getIntercambios(array $filter = [])
    {
        return (new Model_DteIntercambios())->setContribuyente($this)->buscar($filter);
    }

    /**
     * Método para actualizar la bandeja de intercambio
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2018-05-19
     */
    public function actualizarBandejaIntercambio($dias = 7)
    {
        return (new Model_DteIntercambios())->setContribuyente($this)->actualizar($dias);
    }

    /**
     * Método que entrega el listado de documentos recibidos por el contribuyente
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2019-07-04
     */
    public function getDocumentosRecibidos($filtros = [])
    {
        // armar filtros
        $where = ['d.receptor = :rut', 'd.certificacion = :certificacion'];
        $vars = [':rut'=>$this->rut, ':certificacion'=>(int)$this->config_ambiente_en_certificacion];
        foreach (['folio', 'fecha', 'total', 'intercambio', 'usuario'] as $c) {
            if (isset($filtros[$c])) {
                $where[] = 'd.'.$c.' = :'.$c;
                $vars[':'.$c] = $filtros[$c];
            }
        }
        // filtrar por DTE
        if (!empty($filtros['dte'])) {
            if (is_array($filtros['dte'])) {
                $i = 0;
                $where_dte = [];
                foreach ($filtros['dte'] as $filtro_dte) {
                    $where_dte[] = ':dte'.$i;
                    $vars[':dte'.$i] = $filtro_dte;
                    $i++;
                }
                $where[] = 'd.dte IN ('.implode(', ', $where_dte).')';
            } else {
                $where[] = 'd.dte = :dte';
                $vars[':dte'] = $filtros['dte'];
            }
        }
        // filtrar por emisor
        if (!empty($filtros['emisor'])) {
            if (strpos($filtros['emisor'], '-')) {
                $filtros['emisor'] = substr(str_replace('.', '', $filtros['emisor']), 0, -2);
            }
            $where[] = 'd.emisor = :emisor';
            $vars[':emisor'] = $filtros['emisor'];
        }
        if (!empty($filtros['razon_social'])) {
            $where[] = 'e.razon_social ILIKE :razon_social';
            $vars[':razon_social'] = '%'.$filtros['razon_social'].'%';
        }
        // filtrar por fechas
        if (!empty($filtros['periodo'])) {
            $where[] = $this->db->date('Ym', 'd.fecha').' = :periodo';
            $vars[':periodo'] = $filtros['periodo'];
        }
        if (!empty($filtros['fecha_desde'])) {
            $where[] = 'd.fecha >= :fecha_desde';
            $vars[':fecha_desde'] = $filtros['fecha_desde'];
        }
        if (!empty($filtros['fecha_hasta'])) {
            $where[] = 'd.fecha <= :fecha_hasta';
            $vars[':fecha_hasta'] = $filtros['fecha_hasta'];
        }
        // filtrar por montos
        if (!empty($filtros['total_desde'])) {
            $where[] = 'd.total >= :total_desde';
            $vars[':total_desde'] = $filtros['total_desde'];
        }
        if (!empty($filtros['total_hasta'])) {
            $where[] = 'd.total <= :total_hasta';
            $vars[':total_hasta'] = $filtros['total_hasta'];
        }
        // armar consulta
        $query = '
            SELECT d.dte, t.tipo, d.folio, d.emisor, e.razon_social, d.fecha, d.total, d.intercambio, u.usuario, d.emisor
            FROM dte_recibido AS d, dte_tipo AS t, contribuyente AS e, usuario AS u
            WHERE d.dte = t.codigo AND d.emisor = e.rut AND d.usuario = u.id AND '.implode(' AND ', $where).'
            ORDER BY d.fecha DESC, t.tipo, e.razon_social
        ';
        // armar límite consulta
        if (isset($filtros['limit'])) {
            $query = $this->db->setLimit($query, $filtros['limit'], $filtros['offset']);
        }
        // entregar consulta
        return $this->db->getTable($query, $vars);
    }

    /**
     * Método que entrega el total de documentos recibidos por el contribuyente
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2019-08-07
     */
    public function countDocumentosRecibidos($filtros = [])
    {
        $where = ['d.receptor = :rut', 'd.certificacion = :certificacion'];
        $vars = [':rut'=>$this->rut, ':certificacion'=>(int)$this->config_ambiente_en_certificacion];
        foreach (['dte', 'folio', 'emisor', 'fecha', 'total', 'usuario'] as $c) {
            if (isset($filtros[$c])) {
                $where[] = 'd.'.$c.' = :'.$c;
                $vars[':'.$c] = $filtros[$c];
            }
        }
        return (integer)$this->db->getValue(
            'SELECT COUNT(*) FROM dte_recibido AS d WHERE '.implode(' AND ', $where),
            $vars
        );
    }

    /**
     * Método que entrega el resumen de las compras por períodos
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2016-10-12
     */
    public function getResumenComprasPeriodos()
    {
        if ($this->db->config['type']!='PostgreSQL')
            return $this->getResumenComprasPeriodosMySQL();
        $periodo_col = $this->db->date('Ym', 'r.fecha', 'INTEGER');
        return $this->db->getTable('
            (
                SELECT
                    CASE WHEN r.periodo IS NOT NULL THEN
                        r.periodo
                    ELSE
                        CASE WHEN f.periodo IS NOT NULL THEN
                            f.periodo
                        ELSE
                            NULL
                        END
                    END AS periodo,
                    CASE WHEN r.recibidos IS NOT NULL AND f.facturas_compra IS NOT NULL THEN
                        r.recibidos + f.facturas_compra
                    ELSE
                        CASE WHEN r.recibidos IS NOT NULL THEN
                            r.recibidos
                        ELSE
                            f.facturas_compra
                        END
                    END AS recibidos,
                    c.documentos AS enviados,
                    c.track_id,
                    c.revision_estado
                FROM
                    (
                        SELECT periodo, COUNT(*) AS recibidos
                        FROM (
                            SELECT
                                CASE WHEN r.periodo IS NOT NULL THEN
                                    r.periodo
                                ELSE
                                    '.$periodo_col.'
                                END AS periodo
                            FROM dte_tipo AS t, dte_recibido AS r
                            WHERE t.codigo = r.dte AND t.compra = true AND r.receptor = :rut AND r.certificacion = :certificacion
                        ) AS t
                        GROUP BY periodo
                    ) AS r
                    FULL JOIN (
                        SELECT '.$periodo_col.' AS periodo, COUNT(*) AS facturas_compra
                        FROM dte_emitido AS r
                        WHERE r.emisor = :rut AND r.certificacion = :certificacion AND r.dte = 46
                        GROUP BY '.$periodo_col.'
                    ) AS f ON r.periodo = f.periodo
                    LEFT JOIN dte_compra AS c ON c.receptor = :rut AND c.certificacion = :certificacion AND c.periodo IN (r.periodo, f.periodo)
            ) UNION (
                SELECT periodo, documentos AS recibidos, documentos AS enviados, track_id, revision_estado
                FROM dte_compra
                WHERE receptor = :rut AND certificacion = :certificacion
            )
            ORDER BY periodo DESC
        ', [':rut'=>$this->rut, ':certificacion'=>(int)$this->config_ambiente_en_certificacion]);
    }

    /**
     * Método que entrega el resumen de las compras por períodos
     * @warning Versión del método para MySQL, no soporta facturas de compra (se hace en método aparte porque no hay FULL JOIN en MySQL)
     * @todo Emular FULL JOIN para obtener el soporte para facturas de compra
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2016-10-12
     */
    private function getResumenComprasPeriodosMySQL()
    {
        $periodo_col = $this->db->date('Ym', 'r.fecha');
        return $this->db->getTable('
            (
                SELECT '.$periodo_col.' AS periodo, COUNT(*) AS recibidos, c.documentos AS enviados, c.track_id, c.revision_estado
                FROM dte_tipo AS t, dte_recibido AS r LEFT JOIN dte_compra AS c ON r.receptor = c.receptor AND r.certificacion = c.certificacion AND '.$periodo_col.' = c.periodo
                WHERE t.codigo = r.dte AND t.compra = true AND r.receptor = :rut AND r.certificacion = :certificacion
                GROUP BY '.$periodo_col.', enviados, c.track_id, c.revision_estado
            ) UNION (
                SELECT periodo, documentos AS recibidos, documentos AS enviados, track_id, revision_estado
                FROM dte_compra
                WHERE receptor = :rut AND certificacion = :certificacion
            )
            ORDER BY periodo DESC
        ', [':rut'=>$this->rut, ':certificacion'=>(int)$this->config_ambiente_en_certificacion]);
    }

    /**
     * Método que entrega el total de las compras de un período
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2018-05-17
     */
    public function countCompras($periodo)
    {
        $periodo_col = $this->db->date('Ym', 'r.fecha', 'INTEGER');
        $compras = $this->db->getCol('
            (
                SELECT COUNT(*)
                FROM dte_tipo AS t JOIN dte_recibido AS r ON t.codigo = r.dte
                WHERE
                    t.compra = true
                    AND r.receptor = :rut
                    AND r.certificacion = :certificacion
                    AND ((r.periodo IS NULL AND '.$periodo_col.' = :periodo) OR (r.periodo IS NOT NULL AND r.periodo = :periodo))
            ) UNION (
                SELECT COUNT(*)
                FROM dte_tipo AS t JOIN dte_emitido AS r ON t.codigo = r.dte
                WHERE
                    r.emisor = :rut
                    AND r.certificacion = :certificacion
                    AND '.$periodo_col.' = :periodo
                    AND (
                        r.dte = 46
                        OR (r.emisor, r.dte, r.folio, r.certificacion) IN (
                            SELECT r.emisor, r.dte, r.folio, r.certificacion
                            FROM
                                dte_emitido AS r
                                JOIN dte_referencia AS re ON re.emisor = r.emisor AND re.dte = r.dte AND re.folio = r.folio AND re.certificacion = r.certificacion
                                WHERE '.$periodo_col.' = :periodo AND re.referencia_dte = 46
                        )
                    )
            )
        ', [':rut'=>$this->rut, ':certificacion'=>(int)$this->config_ambiente_en_certificacion, ':periodo'=>$periodo]);
        return array_sum($compras);
    }

    /**
     * Método que entrega el resumen de las compras de un período
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2017-09-03
     */
    public function getCompras($periodo, $tipo_dte = null)
    {
        $periodo_col = $this->db->date('Ym', 'r.fecha', 'INTEGER');
        list($impuesto_codigo, $impuesto_tasa, $impuesto_monto) = $this->db->xml('r.xml', [
            '/EnvioDTE/SetDTE/DTE/Documento/Encabezado/Totales/ImptoReten/TipoImp',
            '/EnvioDTE/SetDTE/DTE/Documento/Encabezado/Totales/ImptoReten/TasaImp',
            '/EnvioDTE/SetDTE/DTE/Documento/Encabezado/Totales/ImptoReten/MontoImp',
        ], 'http://www.sii.cl/SiiDte');
        $vars = [':rut'=>$this->rut, ':certificacion'=>(int)$this->config_ambiente_en_certificacion, ':periodo'=>$periodo];
        if ($tipo_dte !== null) {
            if (is_array($tipo_dte)) {
                $where_tipo_dte = 'AND t.codigo IN ('.implode(', ', array_map('intval', $tipo_dte)).')';
            } else {
                $where_tipo_dte = 'AND t.electronico = :electronico';
                $vars[':electronico'] = (int)$tipo_dte;
            }
        } else {
            $where_tipo_dte = '';
        }
        $compras = $this->db->getTable('
            (
                SELECT
                    r.dte,
                    r.folio,
                    '.$this->db->concat('e.rut', '-', 'e.dv').' AS rut,
                    r.tasa,
                    e.razon_social,
                    r.impuesto_tipo,
                    r.fecha,
                    r.anulado,
                    r.exento,
                    r.neto,
                    r.iva,
                    r.iva_no_recuperable,
                    NULL AS iva_no_recuperable_codigo,
                    NULL AS iva_no_recuperable_monto,
                    r.iva_uso_comun,
                    r.impuesto_adicional,
                    NULL AS impuesto_adicional_codigo,
                    NULL AS impuesto_adicional_tasa,
                    NULL AS impuesto_adicional_monto,
                    r.impuesto_sin_credito,
                    r.monto_activo_fijo,
                    r.monto_iva_activo_fijo,
                    r.iva_no_retenido,
                    r.impuesto_puros,
                    r.impuesto_cigarrillos,
                    r.impuesto_tabaco_elaborado,
                    r.impuesto_vehiculos,
                    r.sucursal_sii,
                    r.numero_interno,
                    r.emisor_nc_nd_fc,
                    r.total,
                    r.tipo_transaccion
                FROM dte_tipo AS t, dte_recibido AS r, contribuyente AS e
                WHERE
                    t.codigo = r.dte
                    '.$where_tipo_dte.'
                    AND t.compra = true
                    AND r.emisor = e.rut
                    AND r.receptor = :rut
                    AND r.certificacion = :certificacion
                    AND ((r.periodo IS NULL AND '.$periodo_col.' = :periodo) OR (r.periodo IS NOT NULL AND r.periodo = :periodo))
            ) UNION (
                SELECT
                    r.dte,
                    r.folio,
                    '.$this->db->concat('e.rut', '-', 'e.dv').' AS rut,
                    r.tasa,
                    e.razon_social,
                    NULL AS impuesto_tipo,
                    r.fecha,
                    NULL AS anulado,
                    r.exento,
                    r.neto,
                    r.iva,
                    NULL AS iva_no_recuperable,
                    NULL AS iva_no_recuperable_codigo,
                    NULL AS iva_no_recuperable_monto,
                    NULL AS iva_uso_comun,
                    NULL AS impuesto_adicional,
                    '.$impuesto_codigo.' AS impuesto_adicional_codigo,
                    '.$impuesto_tasa.' AS impuesto_adicional_tasa,
                    '.$impuesto_monto.' AS impuesto_adicional_monto,
                    NULL AS impuesto_sin_credito,
                    NULL AS monto_activo_fijo,
                    NULL AS monto_iva_activo_fijo,
                    NULL AS iva_no_retenido,
                    NULL AS impuesto_puros,
                    NULL AS impuesto_cigarrillos,
                    NULL AS impuesto_tabaco_elaborado,
                    NULL AS impuesto_vehiculos,
                    NULL AS sucursal_sii,
                    NULL AS numero_interno,
                    CASE WHEN r.dte IN (56, 61) THEN 1 ELSE NULL END AS emisor_nc_nd_fc,
                    r.total,
                    NULL AS tipo_transaccion
                FROM dte_tipo AS t, dte_emitido AS r, contribuyente AS e
                WHERE
                    t.codigo = r.dte
                    '.$where_tipo_dte.'
                    AND r.receptor = e.rut
                    AND r.emisor = :rut
                    AND r.certificacion = :certificacion
                    AND '.$periodo_col.' = :periodo
                    AND (
                        r.dte = 46
                        OR (r.emisor, r.dte, r.folio, r.certificacion) IN (
                            SELECT r.emisor, r.dte, r.folio, r.certificacion
                            FROM
                                dte_emitido AS r
                                JOIN dte_referencia AS re ON re.emisor = r.emisor AND re.dte = r.dte AND re.folio = r.folio AND re.certificacion = r.certificacion
                                WHERE '.$periodo_col.' = :periodo AND re.referencia_dte = 46
                        )
                    )
            )
            ORDER BY fecha, dte, folio
        ', $vars);
        // procesar cada compra
        foreach ($compras as &$c) {
            // asignar IVA no recuperable
            if ($c['iva_no_recuperable']) {
                $iva_no_recuperable = json_decode($c['iva_no_recuperable'], true);
                $iva_no_recuperable_codigo = [];
                $iva_no_recuperable_monto = [];
                foreach ($iva_no_recuperable as $inr) {
                    $iva_no_recuperable_codigo[] = $inr['codigo'];
                    $iva_no_recuperable_monto[] = $inr['monto'];
                    $c['iva'] -= $inr['monto'];
                }
                $c['iva_no_recuperable_codigo'] = implode(',', $iva_no_recuperable_codigo);
                $c['iva_no_recuperable_monto'] = implode(',', $iva_no_recuperable_monto);
            }
            unset($c['iva_no_recuperable']);
            // asignar monto de impuesto adicionl
            if ($c['impuesto_adicional']) {
                $impuesto_adicional = json_decode($c['impuesto_adicional'], true);
                $impuesto_adicional_codigo = [];
                $impuesto_adicional_tasa = [];
                $impuesto_adicional_monto = [];
                foreach ($impuesto_adicional as $ia) {
                    $impuesto_adicional_codigo[] = $ia['codigo'];
                    $impuesto_adicional_tasa[] = $ia['tasa'];
                    $impuesto_adicional_monto[] = $ia['monto'];
                }
                $c['impuesto_adicional_codigo'] = implode(',', $impuesto_adicional_codigo);
                $c['impuesto_adicional_tasa'] = implode(',', $impuesto_adicional_tasa);
                $c['impuesto_adicional_monto'] = implode(',', $impuesto_adicional_monto);
            }
            unset($c['impuesto_adicional']);
            // asignar factor de proporcionalidad
            $c['iva_uso_comun_factor'] = $c['iva_uso_comun'] ? round(($c['iva_uso_comun']/$c['iva'])*100) : null;
        }
        return $compras;
    }

    /**
     * Método que entrega el objeto del libro de compras a partir de las compras registradas en la aplicación
     * @param periodo Período para el cual se está construyendo el libro
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2017-09-03
     */
    public function getLibroCompras($periodo)
    {
        $Libro = new \sasco\LibreDTE\Sii\LibroCompraVenta();
        $compras = $this->getCompras($periodo);
        foreach ($compras as $compra) {
            // armar detalle para agregar al libro
            $d = [];
            foreach ($compra as $k => $v) {
                if (strpos($k, 'impuesto_adicional')!==0 and strpos($k, 'iva_no_recuperable')!==0) {
                    if ($v!==null and isset(Model_DteCompra::$libro_cols[$k])) {
                        $d[Model_DteCompra::$libro_cols[$k]] = $v;
                    }
                }
            }
            // agregar iva no recuperable
            if (!empty($compra['iva_no_recuperable_codigo'])) {
                $d['IVANoRec'] = [
                    'CodIVANoRec' => $compra['iva_no_recuperable_codigo'],
                    'MntIVANoRec' => $compra['iva_no_recuperable_monto'],
                ];
            }
            // agregar otros impuestos
            if (!empty($compra['impuesto_adicional_codigo'])) {
                $d['OtrosImp'] = [
                    'CodImp' => $compra['impuesto_adicional_codigo'],
                    'TasaImp' => $compra['impuesto_adicional_tasa'] ? $compra['impuesto_adicional_tasa'] : 0,
                    'MntImp' => $compra['impuesto_adicional_monto'],
                ];
            }
            // agregar detalle al libro
            $Libro->agregar($d);
        }
        return $Libro;
    }

    /**
     * Método que entrega el resumen de las compras diarias de un período
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2017-09-11
     */
    public function getComprasDiarias($periodo)
    {
        if ($this->db->config['type']!='PostgreSQL')
            return $this->getComprasDiariasMySQL($periodo);
        $periodo_col = $this->db->date('Ym', 'r.fecha');
        $dia_col = $this->db->date('d', 'r.fecha');
        return $this->db->getTable('
            SELECT
                CASE WHEN r.dia IS NOT NULL THEN
                    r.dia
                ELSE
                    CASE WHEN f.dia IS NOT NULL THEN
                        f.dia
                    ELSE
                        NULL
                    END
                END AS dia,
                CASE WHEN r.documentos IS NOT NULL AND f.documentos IS NOT NULL THEN
                    r.documentos + f.documentos
                ELSE
                    CASE WHEN r.documentos IS NOT NULL THEN
                        r.documentos
                    ELSE
                        f.documentos
                    END
                END AS documentos
            FROM
                (
                    SELECT '.$dia_col.' AS dia, COUNT(*) AS documentos
                    FROM dte_tipo AS t, dte_recibido AS r
                    WHERE t.codigo = r.dte AND t.compra = true AND r.receptor = :rut AND r.certificacion = :certificacion AND '.$periodo_col.' = :periodo
                    GROUP BY r.fecha
                ) AS r
                FULL JOIN
                (
                    SELECT '.$dia_col.' AS dia, COUNT(*) AS documentos
                    FROM dte_emitido AS r
                    WHERE r.emisor = :rut AND r.certificacion = :certificacion AND '.$periodo_col.' = :periodo AND r.dte = 46
                    GROUP BY r.fecha
                ) AS f ON r.dia = f.dia
            ORDER BY dia
        ', [':rut'=>$this->rut, ':certificacion'=>(int)$this->config_ambiente_en_certificacion, ':periodo'=>$periodo]);
    }

    /**
     * Método que entrega el resumen de las compras diarias de un período
     * @warning Versión del método para MySQL, no soporta facturas de compra (se hace en método aparte porque no hay FULL JOIN en MySQL)
     * @todo Emular FULL JOIN para obtener el soporte para facturas de compra
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2017-09-11
     */
    private function getComprasDiariasMySQL($periodo)
    {
        $periodo_col = $this->db->date('Ym', 'r.fecha');
        $dia_col = $this->db->date('d', 'r.fecha');
        return $this->db->getTable('
            SELECT '.$dia_col.' AS dia, COUNT(*) AS documentos
            FROM dte_tipo AS t, dte_recibido AS r
            WHERE t.codigo = r.dte AND t.compra = true AND r.receptor = :rut AND r.certificacion = :certificacion AND '.$periodo_col.' = :periodo
            GROUP BY r.fecha
            ORDER BY r.fecha
        ', [':rut'=>$this->rut, ':certificacion'=>(int)$this->config_ambiente_en_certificacion, ':periodo'=>$periodo]);
    }

    /**
     * Método que entrega el resumen de compras por tipo de un período
     * @return Arreglo asociativo con las compras
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2017-09-11
     */
    public function getComprasPorTipo($periodo)
    {
        $periodo_col = $this->db->date('Ym', 'r.fecha');
        return $this->db->getTable('
            (
                SELECT t.tipo, COUNT(*) AS documentos
                FROM dte_tipo AS t, dte_recibido AS r
                WHERE t.codigo = r.dte AND t.compra = true AND r.receptor = :rut AND r.certificacion = :certificacion AND '.$periodo_col.' = :periodo
                GROUP BY t.tipo
            ) UNION (
                SELECT t.tipo, COUNT(*) AS facturas_compra
                FROM dte_tipo AS t, dte_emitido AS r
                WHERE t.codigo = r.dte AND r.emisor = :rut AND r.certificacion = :certificacion AND r.dte = 46 AND '.$periodo_col.' = :periodo
                GROUP BY t.tipo
            )
        ', [':rut'=>$this->rut, ':certificacion'=>(int)$this->config_ambiente_en_certificacion, ':periodo'=>$periodo]);
    }

    /**
     * Método que entrega el listado de documentos electrónicos que han sido
     * generados pero no se han enviado al SII
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2016-09-22
     */
    public function getDteEmitidosSinEnviar($certificacion = null)
    {
        $certificacion = (int)($certificacion !== null ? $certificacion : $this->config_ambiente_en_certificacion);
        return $this->db->getTable('
            SELECT dte, folio
            FROM dte_emitido
            WHERE
                emisor = :rut
                AND certificacion = :certificacion
                AND dte NOT IN (39, 41)
                AND track_id IS NULL
        ', [':rut'=>$this->rut, ':certificacion'=>$certificacion]);
    }

    /**
     * Método que entrega el listado de documentos electrónicos que han sido
     * generados y enviados al SII pero aun no se ha actualizado su estado
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2019-10-04
     */
    public function getDteEmitidosSinEstado($certificacion = null)
    {
        $certificacion = (int)($certificacion !== null ? $certificacion : $this->config_ambiente_en_certificacion);
        return $this->db->getTable('
            SELECT dte, folio
            FROM dte_emitido
            WHERE
                emisor = :rut
                AND certificacion = :certificacion
                AND dte NOT IN (39, 41)
                AND track_id > 0
                AND (
                    revision_estado IS NULL
                    OR revision_estado LIKE \'-%\'
                    OR SUBSTRING(revision_estado FROM 1 FOR 3) IN (\''.implode('\', \'', Model_DteEmitidos::$revision_estados['no_final']).'\')
                )
        ', [':rut'=>$this->rut, ':certificacion'=>$certificacion]);
    }

    /**
     * Método que entrega el listado de sucursales del contribuyente con los
     * codigos de actividad económica asociados a cada una (uno por sucursal)
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2016-08-08
     */
    public function getSucursalesActividades()
    {
        $actividades = [0 => $this->actividad_economica];
        if ($this->config_extra_sucursales) {
            foreach ($this->config_extra_sucursales as $sucursal) {
                $actividades[$sucursal->codigo] = $sucursal->actividad_economica ? $sucursal->actividad_economica : $this->actividad_economica;
            }
        }
        return $actividades;
    }

    /**
     * Método que entrega el listado de sucursales del contribuyente (se incluye
     * la casa matriz)
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2016-07-13
     */
    public function getSucursales()
    {
        $sucursales = [0=>'Casa matriz ('.$this->direccion.', '.$this->getComuna()->comuna.')'];
        if ($this->config_extra_sucursales) {
            foreach ($this->config_extra_sucursales as $sucursal) {
                $comuna = (new \sowerphp\app\Sistema\General\DivisionGeopolitica\Model_Comunas())->get($sucursal->comuna)->comuna;
                $sucursales[$sucursal->codigo] = $sucursal->sucursal.' ('.$sucursal->direccion.', '.$comuna.')';
            }
        }
        return $sucursales;
    }

    /**
     * Método que entrega el objeto de la sucursal del contribuyente a partir
     * del código de la sucursal (por defecto casa matriz)
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2016-07-13
     */
    public function getSucursal($codigo = null)
    {
        // si se pasó código se busca sucursal
        if ($codigo and $this->config_extra_sucursales) {
            foreach ($this->config_extra_sucursales as $sucursal) {
                if ($sucursal->codigo == $codigo) {
                    return $sucursal;
                }
            }
        }
        // si no se pasó código o no se encontró se entrega sucursal matriz
        return (object)[
            'codigo' => 0,
            'sucursal' => 'Casa matriz',
            'direccion' => $this->direccion,
            'comuna' => $this->comuna,
        ];
    }

    /**
     * Método que entrega las coordenadas geográficas del emisor según su dirección
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2016-12-26
     */
    public function getCoordenadas($sucursal = null)
    {
        $Sucursal = $this->getSucursal($sucursal);
        $direccion = $Sucursal->direccion.', '.(new \sowerphp\app\Sistema\General\DivisionGeopolitica\Model_Comuna($Sucursal->comuna))->comuna;
        return (new \sowerphp\general\Utility_Mapas_Google())->getCoordenadas($direccion);
    }

    /**
     * Método que entrega el listado de clientes del contribuyente
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2019-01-08
     */
    public function getClientes(array $filtros = [])
    {
        // si no hay módulo CRM se sacan los clientes de los DTE emitidos
        if (!\sowerphp\core\Module::loaded('Crm')) {
            return $this->db->getTable('
                SELECT c.rut, c.dv, c.razon_social, c.telefono, c.email, c.direccion, co.comuna, NULL AS codigo_interno, c.giro
                FROM
                    contribuyente AS c
                    LEFT JOIN comuna AS co ON co.codigo = c.comuna
                WHERE
                    c.rut IN (
                        SELECT receptor
                        FROM dte_emitido
                        WHERE emisor = :emisor AND receptor NOT IN (55555555, 66666666)
                    )
                ORDER BY c.razon_social
            ', [':emisor'=>$this->rut]);
        }
        // si hay módulo CRM se sacan los clientes desde el módulo
        else {
            return (new \libredte\oficial\Crm\Model_Clientes())->setContribuyente($this)->getListado($filtros);
        }
    }

    /**
     * Método que entrega la cuota de documentos asignada al contribuyente
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2019-08-19
     */
    public function getCuota()
    {
        return (int)$this->config_libredte_cuota;
    }

    /**
     * Método que entrega los documentos usados por el contribuyente. Ya sea en
     * todos los períodos o en uno en específico.
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2020-01-01
     */
    public function getDocumentosUsados($periodo = null)
    {
        $vars = [':rut'=>$this->rut, ':certificacion'=>(int)$this->config_ambiente_en_certificacion];
        // columnas de periodos
        $periodo_col = $this->db->date('Ym', 'fecha_hora_creacion');
        $intercambio_periodo_col = $this->db->date('Ym', 'fecha_hora_email');
        // listado de periodos
        if ($periodo) {
            $periodos = [$periodo];
        } else {
            // WARNING al ser muchos períodos (casos raros donde un cliente emitió con período
            // del año 2130) sale: "ERROR:  stack depth limit exceeded" (error de SQL)
            // por eso se usa un período mínimo base que es enero del 2000 y un periodo máximo
            // que es el períodi siguiente al actual
            // el error ocurre por la gran cantidad de UNION que aparecen
            $periodo_actual = date('Ym');
            $periodos_min = array_filter($this->db->getCol('
                (
                    SELECT MIN('.$periodo_col.')
                    FROM dte_emitido
                    WHERE emisor = :rut AND certificacion = :certificacion AND dte NOT IN (39,41)
                ) UNION (
                    SELECT MIN('.$periodo_col.')
                    FROM dte_emitido
                    WHERE emisor = :rut AND certificacion = :certificacion AND dte IN (39,41)
                ) UNION (
                    SELECT MIN('.$periodo_col.')
                    FROM dte_recibido
                    WHERE receptor = :rut AND certificacion = :certificacion AND emisor = 1
                )
            ', $vars));
            $periodo_min = max($periodos_min ? min($periodos_min) : $periodo_actual, 200001);
            $periodos_max = array_filter($this->db->getCol('
                (
                    SELECT MAX('.$periodo_col.')
                    FROM dte_emitido
                    WHERE emisor = :rut AND certificacion = :certificacion AND dte NOT IN (39,41)
                ) UNION (
                    SELECT MAX('.$periodo_col.')
                    FROM dte_emitido
                    WHERE emisor = :rut AND certificacion = :certificacion AND dte IN (39,41)
                ) UNION (
                    SELECT MAX('.$periodo_col.')
                    FROM dte_recibido
                    WHERE receptor = :rut AND certificacion = :certificacion AND emisor = 1
                )
            ', $vars));
            $periodo_max = min($periodos_max ? max($periodos_max) : $periodo_actual, \sowerphp\general\Utility_Date::nextPeriod($periodo_actual));
            $periodos = [];
            $p_aux = $periodo_min;
            do {
                $periodos[] = $p_aux;
                $p_aux = \sowerphp\general\Utility_Date::nextPeriod($p_aux);
            } while($p_aux <= $periodo_max);
        }
        // consulta SQL
        if ($periodo) {
            $periodo_where = ' AND '.$periodo_col.' = :periodo';
            $intercambio_periodo_where = ' AND '.$intercambio_periodo_col.' = :periodo';
            $vars[':periodo'] = $periodo;
        } else {
            $periodo_where = $intercambio_periodo_where = '';
        }
        $periodos = array_map(function($p) { return '(SELECT '.$p.' AS periodo)'; }, $periodos);
        $datos = $this->db->getTable('
            SELECT
                p.periodo,
                e.total AS emitidos,
                b.total AS boletas,
                r.total AS recibidos,
                i.total AS intercambios
            FROM
                (
                    SELECT periodo::TEXT
                    FROM ('.implode(' UNION ', $periodos).') AS t
                ) AS p
                LEFT JOIN (
                    SELECT '.$periodo_col.' AS periodo, COUNT(*) AS total
                    FROM dte_emitido
                    WHERE emisor = :rut AND certificacion = :certificacion AND dte NOT IN (39,41) '.$periodo_where.'
                    GROUP BY '.$periodo_col.'
                ) AS e ON e.periodo = p.periodo
                LEFT JOIN (
                    SELECT '.$periodo_col.' AS periodo, COUNT(*) AS total
                    FROM dte_emitido
                    WHERE emisor = :rut AND certificacion = :certificacion AND dte IN (39,41) '.$periodo_where.'
                    GROUP BY '.$periodo_col.'
                ) AS b ON b.periodo = p.periodo
                LEFT JOIN (
                    SELECT '.$periodo_col.' AS periodo, COUNT(*) AS total
                    FROM dte_recibido
                    WHERE receptor = :rut AND certificacion = :certificacion '.$periodo_where.'
                    GROUP BY '.$periodo_col.'
                ) AS r ON r.periodo = p.periodo
                LEFT JOIN (
                    SELECT '.$intercambio_periodo_col.' AS periodo, COUNT(*) AS total
                    FROM dte_intercambio
                    WHERE receptor = :rut AND certificacion = :certificacion '.$intercambio_periodo_where.'
                    GROUP BY '.$intercambio_periodo_col.'
                ) AS i ON i.periodo = p.periodo
            ORDER BY periodo DESC
        ', $vars);
        foreach ($datos as &$d) {
            $d['total'] = $d['emitidos'] + $d['boletas'] + $d['recibidos'];
        }
        if ($periodo) {
            return !empty($datos) ? $datos[0] : [
                'periodo' => 0,
                'emitidos' => 0,
                'boletas' => 0,
                'recibidos' => 0,
                'intercambios' => 0,
                'total' => 0,
            ];
        }
        return $datos;
    }

    /**
     * Método que entrega el total de documentos usados por el contribuyente en
     * un periodo en particular
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2020-01-01
     */
    public function getTotalDocumentosUsadosPeriodo($periodo = null)
    {
        if (!$periodo) {
            $periodo = date('Ym');
        }
        return $this->getDocumentosUsados($periodo)['total'];
    }

    /**
     * Método que entrega el resumen de los estados de los DTE para un periodo de tiempo
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2016-09-23
     */
    public function getDocumentosEmitidosResumenEstados($desde, $hasta)
    {
        return $this->db->getTable('
            SELECT revision_estado AS estado, COUNT(*) AS total
            FROM dte_emitido
            WHERE emisor = :rut AND certificacion = :certificacion AND fecha BETWEEN :desde AND :hasta AND track_id > 0
            GROUP BY revision_estado
            ORDER BY total DESC
        ', [':rut'=>$this->rut, ':certificacion'=>(int)$this->config_ambiente_en_certificacion, ':desde'=>$desde, ':hasta'=>$hasta]);
    }

    /**
     * Método que entrega el detalle de los documentos emitidos con cierto
     * estado en un rango de tiempo
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2016-10-12
     */
    public function getDocumentosEmitidosEstado($desde, $hasta, $estado = null)
    {
        // filtros
        $vars = [':rut'=>$this->rut, ':certificacion'=>(int)$this->config_ambiente_en_certificacion, ':desde'=>$desde, ':hasta'=>$hasta];
        if ($estado) {
            $vars[':estado'] = $estado;
            $estado = 'd.revision_estado = :estado';
        } else {
            $estado = 'd.revision_estado IS NULL';
        }
        // forma de obtener razón social
        $razon_social_xpath = $this->db->xml('d.xml', '/EnvioDTE/SetDTE/DTE/Exportaciones/Encabezado/Receptor/RznSocRecep', 'http://www.sii.cl/SiiDte');
        $razon_social = 'CASE WHEN d.dte NOT IN (110, 111, 112) THEN r.razon_social ELSE '.$razon_social_xpath.' END AS razon_social';
        // realizar consulta
        return $this->db->getTable('
            SELECT
                d.dte,
                t.tipo,
                d.folio,
                '.$razon_social.',
                d.fecha,
                d.total,
                d.revision_detalle AS estado_detalle,
                i.glosa AS intercambio,
                d.sucursal_sii,
                u.usuario
            FROM
                dte_emitido AS d LEFT JOIN dte_intercambio_resultado_dte AS i
                    ON i.emisor = d.emisor AND i.dte = d.dte AND i.folio = d.folio AND i.certificacion = d.certificacion,
                dte_tipo AS t,
                contribuyente AS r,
                usuario AS u
            WHERE
                d.dte = t.codigo
                AND d.receptor = r.rut
                AND d.usuario = u.id
                AND d.emisor = :rut
                AND d.certificacion = :certificacion
                AND d.fecha BETWEEN :desde AND :hasta
                AND d.track_id > 0
                AND '.$estado.'
            ORDER BY d.fecha DESC, t.tipo, d.folio DESC

        ', $vars);
    }

    /**
     * Método que entrega el resumen de los eventos asignados por los receptores para un periodo de tiempo
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2018-04-25
     */
    public function getDocumentosEmitidosResumenEventos($desde, $hasta)
    {
        return $this->db->getTable('
            SELECT receptor_evento AS evento, COUNT(*) AS total
            FROM dte_emitido
            WHERE emisor = :rut AND certificacion = :certificacion AND fecha BETWEEN :desde AND :hasta AND dte IN (33, 34, 43)
            GROUP BY receptor_evento
            ORDER BY total DESC
        ', [':rut'=>$this->rut, ':certificacion'=>(int)$this->config_ambiente_en_certificacion, ':desde'=>$desde, ':hasta'=>$hasta]);
    }

    /**
     * Método que entrega el detalle de los documentos emitidos con cierto
     * evento en un rango de tiempo
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2018-04-25
     */
    public function getDocumentosEmitidosEvento($desde, $hasta, $evento = null)
    {
        // filtros
        $vars = [':rut'=>$this->rut, ':certificacion'=>(int)$this->config_ambiente_en_certificacion, ':desde'=>$desde, ':hasta'=>$hasta];
        if ($evento) {
            $vars[':evento'] = $evento;
            $evento = 'd.receptor_evento = :evento';
        } else {
            $evento = 'd.receptor_evento IS NULL';
        }
        // forma de obtener razón social
        $razon_social_xpath = $this->db->xml('d.xml', '/EnvioDTE/SetDTE/DTE/Exportaciones/Encabezado/Receptor/RznSocRecep', 'http://www.sii.cl/SiiDte');
        $razon_social = 'CASE WHEN d.dte NOT IN (110, 111, 112) THEN r.razon_social ELSE '.$razon_social_xpath.' END AS razon_social';
        // realizar consulta
        return $this->db->getTable('
            SELECT
                d.dte,
                t.tipo,
                d.folio,
                '.$razon_social.',
                d.fecha,
                d.total,
                d.revision_detalle AS estado_detalle,
                i.glosa AS intercambio,
                d.sucursal_sii,
                u.usuario
            FROM
                dte_emitido AS d LEFT JOIN dte_intercambio_resultado_dte AS i
                    ON i.emisor = d.emisor AND i.dte = d.dte AND i.folio = d.folio AND i.certificacion = d.certificacion,
                dte_tipo AS t,
                contribuyente AS r,
                usuario AS u
            WHERE
                d.dte = t.codigo
                AND d.receptor = r.rut
                AND d.usuario = u.id
                AND d.emisor = :rut
                AND d.certificacion = :certificacion
                AND d.fecha BETWEEN :desde AND :hasta
                AND d.dte IN (33, 34, 43)
                AND '.$evento.'
            ORDER BY d.fecha DESC, t.tipo, d.folio DESC

        ', $vars);
    }

    /**
     * Método que entrega el detalle de los documentos emitidos que aun no han
     * sido enviado al SII
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2016-10-12
     */
    public function getDocumentosEmitidosSinEnviar()
    {
        // forma de obtener razón social
        $razon_social_xpath = $this->db->xml('d.xml', '/EnvioDTE/SetDTE/DTE/Exportaciones/Encabezado/Receptor/RznSocRecep', 'http://www.sii.cl/SiiDte');
        $razon_social = 'CASE WHEN d.dte NOT IN (110, 111, 112) THEN r.razon_social ELSE '.$razon_social_xpath.' END AS razon_social';
        // realizar consulta
        return $this->db->getTable('
            SELECT
                d.dte,
                t.tipo,
                d.folio,
                '.$razon_social.',
                d.fecha,
                d.total,
                i.glosa AS intercambio,
                d.sucursal_sii,
                u.usuario
            FROM
                dte_emitido AS d LEFT JOIN dte_intercambio_resultado_dte AS i
                    ON i.emisor = d.emisor AND i.dte = d.dte AND i.folio = d.folio AND i.certificacion = d.certificacion,
                dte_tipo AS t,
                contribuyente AS r,
                usuario AS u
            WHERE
                d.dte = t.codigo
                AND d.receptor = r.rut
                AND d.usuario = u.id
                AND d.emisor = :rut
                AND d.certificacion = :certificacion
                AND d.dte NOT IN (39, 41)
                AND d.track_id IS NULL
            ORDER BY d.fecha DESC, t.tipo, d.folio DESC

        ', [':rut'=>$this->rut, ':certificacion'=>(int)$this->config_ambiente_en_certificacion]);
    }

    /**
     * Método que entrega el resumen de los estados de los DTE para un periodo de tiempo
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2016-09-23
     */
    public function getDocumentosEmitidosResumenEstadoIntercambio($desde, $hasta)
    {
        return $this->db->getTable('
            SELECT
                CASE WHEN recibo.responde IS NOT NULL THEN true ELSE false END AS recibo,
                recepcion.estado AS recepcion,
                resultado.estado  AS resultado,
                COUNT(*) AS total
            FROM
                dte_emitido AS e
                LEFT JOIN dte_intercambio_recibo_dte AS recibo ON recibo.emisor = e.emisor AND recibo.dte = e.dte AND recibo.folio = e.folio AND recibo.certificacion = e.certificacion
                LEFT JOIN dte_intercambio_recepcion_dte AS recepcion ON recepcion.emisor = e.emisor AND recepcion.dte = e.dte AND recepcion.folio = e.folio AND recepcion.certificacion = e.certificacion
                LEFT JOIN dte_intercambio_resultado_dte AS resultado ON resultado.emisor = e.emisor AND resultado.dte = e.dte AND resultado.folio = e.folio AND resultado.certificacion = e.certificacion
            WHERE
                e.emisor = :rut
                AND e.certificacion = :certificacion
                AND e.fecha BETWEEN :desde AND :hasta
                AND e.track_id > 0
                AND  e.revision_estado IS NOT NULL
            GROUP BY recibo, recepcion, resultado
            ORDER BY total DESC
        ', [':rut'=>$this->rut, ':certificacion'=>(int)$this->config_ambiente_en_certificacion, ':desde'=>$desde, ':hasta'=>$hasta]);
    }

    /**
     * Método que entrega los estados de los DTE para un periodo de tiempo
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2016-09-23
     */
    public function getDocumentosEmitidosEstadoIntercambio($desde, $hasta, $recibo, $recepcion, $resultado)
    {
        // filtros
        $vars = [':rut'=>$this->rut, ':certificacion'=>(int)$this->config_ambiente_en_certificacion, ':desde'=>$desde, ':hasta'=>$hasta];
        $where = [$recibo ? 'recibo.responde IS NOT NULL' : 'recibo.responde IS NULL'];
        if ($recepcion!==null and $recepcion!=-1) {
            $where[] = 'recepcion.estado = :recepcion';
            $vars[':recepcion'] = $recepcion;
        } else {
            $where[] = 'recepcion.estado IS NULL';
        }
        if ($resultado!==null and $resultado!=-1) {
            $where[] = 'resultado.estado = :resultado';
            $vars[':resultado'] = $resultado;
        } else {
            $where[] = 'resultado.estado IS NULL';
        }
        // forma de obtener razón social
        $razon_social_xpath = $this->db->xml('e.xml', '/EnvioDTE/SetDTE/DTE/Exportaciones/Encabezado/Receptor/RznSocRecep', 'http://www.sii.cl/SiiDte');
        $razon_social = 'CASE WHEN e.dte NOT IN (110, 111, 112) THEN r.razon_social ELSE '.$razon_social_xpath.' END AS razon_social';
        // realizar consulta
        return $this->db->getTable('
            SELECT
                e.dte,
                t.tipo,
                e.folio,
                '.$razon_social.',
                e.fecha,
                e.total,
                e.revision_estado,
                e.sucursal_sii,
                u.usuario
            FROM
                dte_emitido AS e
                LEFT JOIN dte_intercambio_recibo_dte AS recibo ON recibo.emisor = e.emisor AND recibo.dte = e.dte AND recibo.folio = e.folio AND recibo.certificacion = e.certificacion
                LEFT JOIN dte_intercambio_recepcion_dte AS recepcion ON recepcion.emisor = e.emisor AND recepcion.dte = e.dte AND recepcion.folio = e.folio AND recepcion.certificacion = e.certificacion
                LEFT JOIN dte_intercambio_resultado_dte AS resultado ON resultado.emisor = e.emisor AND resultado.dte = e.dte AND resultado.folio = e.folio AND resultado.certificacion = e.certificacion
                JOIN dte_tipo AS t ON t.codigo = e.dte
                JOIN contribuyente AS r ON r.rut = e.receptor
                JOIN usuario AS u ON u.id = e.usuario
            WHERE
                e.emisor = :rut
                AND e.certificacion = :certificacion
                AND e.fecha BETWEEN :desde AND :hasta
                AND e.track_id > 0
                AND  e.revision_estado IS NOT NULL
                AND '.implode(' AND ', $where).'
            ORDER BY e.fecha DESC, t.tipo, e.folio DESC
        ', $vars);
    }

    /**
     * Método que entrega la información del registro de compra y venta del SII
     * del contribuyente
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2019-08-09
     */
    public function getRCV(array $filtros = [])
    {
        if (!$this->config_sii_pass) {
            throw new \Exception('No está configurada la contraseña del SII');
        }
        // filtros por defecto
        $filtros = array_merge([
            'detalle' => true,
            'operacion' => 'COMPRA',
            'estado' => 'REGISTRO',
            'periodo' => date('Ym'),
            'dte' => null,
            'tipo' => 'rcv', // tipo de formato a usar cuando se pide el detalle de documentos (rcv o iecv)
        ], $filtros);
        // si se pide el detalle pero no se indicó el tipo de documento se buscan todos los posible
        if ($filtros['detalle']===true) {
            // si no se indicó dte se colocan todos los posibles
            if (!$filtros['dte']) {
                $dtes = [];
                $resumen = $this->getRCV(['operacion' => $filtros['operacion'], 'periodo' => $filtros['periodo'], 'estado' => $filtros['estado'], 'detalle'=>false]);
                foreach ($resumen as $r) {
                    if ($r['rsmnTotDoc']) {
                        $dtes[] = $r['rsmnTipoDocInteger'];
                    }
                }
                $filtros['dte'] = $dtes;
            }
            // si el dte es sólo uno se coloca como arreglo
            else if (!is_array($filtros['dte'])) {
                $filtros['dte'] = [$filtros['dte']];
            }
        }
        // errores
        $errores = [
            1 => 'Error de negocio',
            2 => 'Error de aplicación',
            3 => 'Sin datos',
            99 => 'Consulta no válida',
        ];
        // consumir servicio web de resumen
        if (!$filtros['detalle']) {
            $r = libredte_consume(
                sprintf(
                    '/sii/rcv_resumen/%d-%s/%s/%d/%s?formato=json&certificacion=%d',
                    $this->rut, $this->dv, $filtros['operacion'], $filtros['periodo'], $filtros['estado'], (int)$this->config_ambiente_en_certificacion
                ), ['auth'=>['rut' => $this->rut.'-'.$this->dv, 'clave' => $this->config_sii_pass]]
            );
            if ($r['status']['code']!=200) {
                throw new \Exception('Error al obtener el resumen del RCV: '.$r['body']);
            }
            if ($r['body']['respEstado']['codRespuesta']) {
                $error = isset($errores[$r['body']['respEstado']['codRespuesta']]) ? $errores[$r['body']['respEstado']['codRespuesta']] : ('Código '.$r['body']['respEstado']['codRespuesta']);
                if ($error == 'Sin datos') {
                    return [];
                }
                throw new \Exception('No fue posible obtener el resumen: '.$r['body']['respEstado']['msgeRespuesta'].' ('.$error.')');
            }
            return $r['body']['data'];
        }
        // consumir servicio web de detalle
        else {
            $detalle = [];
            foreach ($filtros['dte'] as $dte) {
                $r = libredte_consume(
                    sprintf(
                        '/sii/rcv_detalle/%d-%s/%s/%d/%d/%s?formato=json&certificacion=%d&tipo=%s',
                        $this->rut, $this->dv, $filtros['operacion'], $filtros['periodo'], $dte, $filtros['estado'], (int)$this->config_ambiente_en_certificacion, $filtros['tipo']
                    ), ['auth'=>['rut' => $this->rut.'-'.$this->dv, 'clave' => $this->config_sii_pass]]
                );
                if ($r['status']['code']!=200) {
                    throw new \Exception('Error al obtener el detalle del RCV: '.$r['body']);
                }
                if ($r['body']['respEstado']['codRespuesta']) {
                    $error = isset($errores[$r['body']['respEstado']['codRespuesta']]) ? $errores[$r['body']['respEstado']['codRespuesta']] : ('Código '.$r['body']['respEstado']['codRespuesta']);
                    throw new \Exception('No fue posible obtener el detalle: '.$r['body']['respEstado']['msgeRespuesta'].' ('.$error.')');
                }
                $detalle = array_merge($detalle, $r['body']['data']);
            }
            return $detalle;
        }
    }

    /**
     * Método que entrega la configuración de cierta API (servicio web) del contribuyente
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2017-10-06
     */
    public function getAPI($api)
    {
        return ($this->config_api_servicios and isset($this->config_api_servicios->$api)) ? $this->config_api_servicios->$api : false;
    }

    /**
     * Método que entrega el cliente para la API (servicio web) del contribuyente
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2017-10-06
     */
    public function getApiClient($api)
    {
        $Api = $this->getAPI($api);
        if (!$Api) {
            return false;
        }
        $rest = new \sowerphp\core\Network_Http_Rest();
        $rest->url = $Api->url;
        if (!empty($Api->credenciales)) {
            if ($Api->auth=='http_auth_basic') {
                $aux = explode(':', $Api->credenciales);
                if (isset($aux[1])) {
                    $rest->setAuth($aux[0], $aux[1]);
                } else {
                    $rest->setAuth($aux[0]);
                }
            }
        }
        return $rest;
    }

    /**
     * Método que entrega los enlaces normalizados para ser usados en el layout
     * de la aplicación
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2017-12-29
     */
    public function getLinks()
    {
        // entregar el menú de contribuyente por defecto (genérico de la aplicación)
        if (!$this->config_extra_links) {
            return (array)\sowerphp\core\Configure::read('nav.contribuyente');
        }
        // entregar menu personalizado de la empresa
        $links = [];
        foreach ($this->config_extra_links as $l) {
            if ($l->nombre == '-') {
                $links[] = '-';
            } else {
                if (!empty($l->icono)) {
                    $links[$l->enlace] = '<span class="'.$l->icono.'"></span> '.$l->nombre;
                } else {
                    $links[$l->enlace] = $l->nombre;
                }
            }
        }
        return $links;
    }

    /**
     * Método que entrega la sucursal del usuario indicado
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2018-04-27
     */
    public function getSucursalUsuario($Usuario)
    {
        return method_exists($Usuario, 'getSucursal') ? $Usuario->getSucursal($this) : null;
    }

    /**
     * Método que entrega la plantilla de un correo ya armada con los datos
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2019-06-17
     */
    public function getEmailFromTemplate($template, $params = null)
    {
        // buscar plantilla
        $file = DIR_PROJECT.'/data/static/contribuyentes/'.(int)$this->rut.'/email/'.$template.'.html';
        if (!is_readable($file)) {
            return false;
        }
        // buscar parámetros pasados
        $params = array_slice(func_get_args(), 1);
        // si no se pasó ningún parámetro sólo se quiere saber si la plantilla existe o no
        if (!$params) {
            return true;
        }
        // leer archivo
        $html = file_get_contents($file);
        // plantilla de envío de DTE
        if ($template == 'dte') {
            $Documento = $params[0];
            $msg_text = !empty($params[1]) ? $params[1] : null;
            $links = $Documento->getLinks();
            $class = get_class($Documento);
            $mostrar_pagado = false;
            $mostrar_pagar = false;
            if ($this->config_pagos_habilitado and $Documento->getTipo()->operacion=='S') {
                if ($class == 'website\Dte\Model_DteTmp') {
                    $mostrar_pagar = true;
                } else {
                    $Cobro = $Documento->getCobro(false);
                    if ($Cobro->total) {
                        if (!$Cobro->pagado) {
                            $mostrar_pagar = true;
                        } else {
                            $mostrar_pagado = true;
                        }
                    }
                }
            }
            if ($class == 'website\Dte\Model_DteTmp') {
                if (in_array($Documento->dte, [33, 34, 39, 41])) {
                    $dte_cotizacion = 'cotización';
                    $dte_tipo = 'cotización';
                } else {
                    $dte_cotizacion = 'documento';
                    $dte_tipo = 'borrador de '.$Documento->getTipo()->tipo;
                }
            } else {
                $dte_cotizacion = 'documento tributario electrónico';
                $dte_tipo = $Documento->getTipo()->tipo;
            }
            $fecha_pago = $mostrar_pagado ? \sowerphp\general\Utility_Date::format($Cobro->pagado) : '00/00/0000';
            $medio_pago = $mostrar_pagado ? $Cobro->getMedioPago()->getNombre() : '"sin pago"';
            return str_replace(
                [
                    '{dte_cotizacion}',
                    '{total}',
                    '{razon_social}',
                    '{documento}',
                    '{folio}',
                    '{fecha_emision}',
                    '{link_pagar}',
                    '{link_pdf}',
                    '{msg_text}',
                    '{mostrar_pagado}',
                    '{msg_pagado}',
                    '{fecha_pago}',
                    '{medio_pago}',
                    '{mostrar_pagar}',
                ],
                [
                    $dte_cotizacion,
                    num($Documento->total),
                    $Documento->getReceptor()->razon_social,
                    $dte_tipo,
                    $Documento->getFolio(),
                    \sowerphp\general\Utility_Date::format($Documento->fecha),
                    $mostrar_pagar ? $links['pagar'] : '',
                    $links['pdf'],
                    $msg_text ? str_replace("\n", '</p><p>', $msg_text) : null,
                    !$mostrar_pagado ? 'none' : '',
                    $mostrar_pagado ? __('El documento se encuentra pagado con fecha %s usando el medio de pago %s', $fecha_pago, $medio_pago) : '',
                    $fecha_pago,
                    $medio_pago,
                    !$mostrar_pagar ? 'none' : '',
                ],
                $html
            );
        }
        // no se encontró plantilla
        return false;
    }

    /**
     * Método que entrega la URL del sitio web
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2019-02-18
     */
    public function getURL()
    {
        if ($this->config_extra_web) {
            if (strpos($this->config_extra_web, 'http://')===0 or strpos($this->config_extra_web, 'https://')) {
                return $this->config_extra_web;
            } else {
                return 'http://'.$this->config_extra_web;
            }
        }
    }

    /**
     * Método que entrega la aplicación de tercero del contribuyente
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2019-06-14
     */
    public function getApp($app)
    {
        // obtener namespace y código
        if (strpos($app, '.')) {
            list($namespace, $codigo) = explode('.', $app);
        } else {
            $namespace = 'apps';
            $codigo = $app;
        }
        // cargar app si existe
        $apps_config = \sowerphp\core\Configure::read('apps_3rd_party.'.$namespace);
        $App = (new \sowerphp\app\Utility_Apps($apps_config))->getApp($codigo);
        if (!$App) {
            throw new \Exception('Aplicación solicitada "'.$app.'" no existe', 404);
        }
        // cargar configuración de la app
        $App->setConfig($this->{'config_'.$namespace.'_'.$codigo});
        $App->setVars([
            'Contribuyente' => $this,
        ]);
        // entrgar App con su configuración (si existe) y enlazada al contribuyente
        return $App;
    }

    /**
     * Método que entrega todas los aplicaciones disponibles para el contribuyente
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2019-06-15
     */
    public function getApps($filtros = [])
    {
        // ver si viene el namespace como filtro y extraer
        if (is_string($filtros)) {
            $filtros = ['namespace' => $filtros];
        }
        $default = [
            'namespace' => 'apps',
            'loadConfig' => true,
        ];
        $filtros = array_merge($default, $filtros);
        foreach ($default as $key => $value) {
            $$key = $filtros[$key];
            unset($filtros[$key]);
        }
        // obtener aplicaciones según namespace y filtros
        $apps_config = \sowerphp\core\Configure::read('apps_3rd_party.'.$namespace);
        $apps = (new \sowerphp\app\Utility_Apps($apps_config))->getApps($filtros);
        // cargar variables por defecto (asociar contribuyente)
        foreach ($apps as $App) {
            $App->setVars([
                'Contribuyente' => $this,
            ]);
        }
        if ($loadConfig) {
            // cargar configuración de la app de un objeto que no es el Contribuyente
            if (is_array($loadConfig)) {
                list($config_obj, $config_prefix) = $loadConfig;
            }
            // cargar configuración de la app desde el objeto contribuyente y prefijo estándar
            else {
                $config_obj = $this;
                $config_prefix = 'config_'.$namespace.'_';
            }
            // cargar la configuración de cada tienda
            foreach ($apps as $App) {
                $App->setConfig($config_obj->{$config_prefix.$App->getCodigo()});
                // si se solicitó sólo disponibles o sólo no disponibles verificar
                if (isset($filtros['disponible'])) {
                    if ($App->getConfig()->disponible != $filtros['disponible']) {
                        unset($apps[$App->getCodigo()]);
                    }
                }
            }
        }
        // entregar aplicaciones
        return $apps;
    }

    /**
     * Método que entrega el contador asociado al contribuyente
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2019-08-09
     */
    public function getContador()
    {
        if (!$this->config_contabilidad_contador_run) {
            return false;
        }
        return (new Model_Contribuyentes())->get($this->config_contabilidad_contador_run);
    }

    /**
     * Método que verifica si el contribuyente tiene la autorización necesaria
     * en LibreDTE para trabajar. Ya sea porque pertenece el usuario del
     * contribuyente a cierto grupo o porque el contador pertenece a un grupo
     * específico (de contadores)
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2019-08-09
     */
    public function getAuthLibreDTE($grupo_contribuyentes, $grupo_contadores = null)
    {
         if (!$this->usuario or !$this->getUsuario()->inGroup($grupo_contribuyentes)) {
            if (!$grupo_contadores) {
                return false;
            }
            $Contador = $this->getContador();
            if (!$Contador or !$Contador->getUsuario()->inGroup($grupo_contadores)) {
                return false;
            }
        }
        return true;
    }

}
