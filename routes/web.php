<?php

use App\Http\Controllers\Extranet\ExtranetPageController;
use App\Http\Controllers\Intranet\Admin\InicioPageCotroller;
use App\Http\Controllers\Intranet\Admin\IntranetPageCotroller;
use App\Http\Controllers\Intranet\Admin\MenuController;
use App\Http\Controllers\Intranet\Admin\MenuRolController;
use App\Http\Controllers\Intranet\Admin\PermisoController;
use App\Http\Controllers\Intranet\Admin\PermisoRolController;
use App\Http\Controllers\Intranet\Admin\RolController;
use App\Http\Controllers\Intranet\Admin\UsuarioController;
use App\Http\Controllers\Intranet\Empresas\ArchivoController;
use App\Http\Controllers\Intranet\Empresas\BoletinController;
use App\Http\Controllers\Intranet\Empresas\CapacitacionController;
use App\Http\Controllers\Intranet\Empresas\ClienteController;
use App\Http\Controllers\Intranet\Empresas\DiagnosticoController;
use App\Http\Controllers\Intranet\Empresas\DocRetiroController;
use App\Http\Controllers\Intranet\Empresas\DocumentosContractualesnController;
use App\Http\Controllers\Intranet\Empresas\DotacionesController;
use App\Http\Controllers\Intranet\Empresas\EmpresaController;
use App\Http\Controllers\Intranet\Empresas\EvaluacionDesempController;
use App\Http\Controllers\Intranet\Empresas\HistoriaClinicalController;
use App\Http\Controllers\Intranet\Empresas\HojaVidaController;
use App\Http\Controllers\Intranet\Empresas\ManualController;
use App\Http\Controllers\Intranet\Empresas\ParametrosHVController;
use App\Http\Controllers\Intranet\Empresas\PermisoEmpleadoController;
use App\Http\Controllers\Intranet\Empresas\PoliticaController;
use App\Http\Controllers\Intranet\Empresas\ProcesoDisciplinarioController;
use App\Http\Controllers\Intranet\Empresas\ProveedorController;
use App\Http\Controllers\Intranet\Empresas\Situ_Lab_generalController;
use App\Http\Controllers\Intranet\Empresas\SolicitudController;
use App\Http\Controllers\Intranet\Empresas\SoporteAfiliacionController;
use App\Http\Controllers\Intranet\Empresas\VacacionesController;
use App\Http\Controllers\Intranet\Juzgados\CircuitoController;
use App\Http\Controllers\Intranet\Juzgados\Distritos;
use App\Http\Controllers\Intranet\Juzgados\Jurisdiccion;
use App\Http\Controllers\Intranet\Juzgados\JuzgadoController;
use App\Http\Controllers\Intranet\Juzgados\JuzgDepartamento;
use App\Http\Controllers\Intranet\Juzgados\MunicipioController;
use App\Http\Controllers\Intranet\Procesos\EstadoProcesoController;
use App\Http\Controllers\Intranet\Procesos\EtapaProcesoController;
use App\Http\Controllers\Intranet\Procesos\NoticiaController;
use App\Http\Controllers\Intranet\Procesos\PapelClienteController;
use App\Http\Controllers\Intranet\Procesos\ProcesoController;
use App\Http\Controllers\Intranet\Procesos\RiesgoPerdidaProcesoController;
use App\Http\Controllers\Intranet\Procesos\SentidoFalloController;
use App\Http\Controllers\Intranet\Procesos\TerminacionAnormalController;
use App\Http\Controllers\Intranet\Procesos\TipoProcesoController;
use App\Http\Controllers\Intranet\Proyectos\ComponenteController;
use App\Http\Controllers\Intranet\Proyectos\HistorialController;
use App\Http\Controllers\Intranet\Proyectos\ProyectoController;
use App\Http\Controllers\Intranet\Proyectos\TareaController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/clear-cache', function () {
    echo Artisan::call('config:clear');
    echo Artisan::call('config:cache');
    echo Artisan::call('cache:clear');
    echo Artisan::call('route:clear');
});
Route::get('/', [ExtranetPageController::class, 'index'])->name('index');
Route::get('restablecer', [ExtranetPageController::class, 'restablecer'])->name('restablecer');

Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::get('index', [IntranetPageCotroller::class, 'index'])->name('admin-index');
        Route::put('usuario/{id}/restablecer_password', [UsuarioController::class, 'restablecer_password'])->name('admin-usuario-restablecer_password');

        // Rutas Administrador del Sistema
        // ------------------------------------------------------------------------------------
        Route::group(['middleware' => 'adminSistema'], function () {
            // Ruta Administrador del Sistema Menus
            // ------------------------------------------------------------------------------------
            Route::get('menu-index', [MenuController::class, 'index'])->name('admin-menu-index');
            Route::get('menu-crear', [MenuController::class, 'crear'])->name('admin-menu-crear');
            Route::get('menu/{id}/editar', [MenuController::class, 'editar'])->name('admin-menu-editar');
            Route::post('menu', [MenuController::class, 'guardar'])->name('admin-menu-guardar');
            Route::put('menu/{id}', [MenuController::class, 'actualizar'])->name('admin-menu-actualizar');
            Route::get('menu/{id}/eliminar', [MenuController::class, 'eliminar'])->name('admin-menu-eliminar');
            Route::get('menu-guardar-orden', [MenuController::class, 'guardarOrden'])->name('admin-menu-guardar-orden');
            // ------------------------------------------------------------------------------------
            // Ruta Administrador del Sistema Roles
            Route::get('rol-index', [RolController::class, 'index'])->name('admin-rol-index');
            Route::get('rol-crear', [RolController::class, 'crear'])->name('admin-rol-crear');
            Route::get('rol/{id}/editar', [RolController::class, 'editar'])->name('admin-rol-editar');
            Route::post('rol', [RolController::class, 'guardar'])->name('admin-rol-guardar');
            Route::put('rol/{id}', [RolController::class, 'actualizar'])->name('admin-rol-actualizar');
            Route::delete('rol/{id}/eliminar', [RolController::class, 'eliminar'])->name('admin-rol-eliminar');
            Route::get('roles/export/', [RolController::class, 'exportarExcel'])->name('roles-exportarExcel');
            // ------------------------------------------------------------------------------------
            /*RUTAS Administrador del Sistema MENU_ROL*/
            Route::get('_menus_rol', [MenuRolController::class, 'index'])->name('admin-menu_rol');
            Route::post('_menus_rol', [MenuRolController::class, 'guardar'])->name('admin-guardar_menu_rol');
            // ------------------------------------------------------------------------------------
            /*RUTAS DE PERMISO*/
            Route::get('permiso-index', [PermisoController::class, 'index'])->name('admin-permiso-index');
            Route::get('permiso-crear/{pagVolver?}', [PermisoController::class, 'crear'])->name('admin-crear_permiso');
            Route::post('permiso', [PermisoController::class, 'guardar'])->name('admin-guardar_permiso');
            Route::get('permiso/{id}/editar', [PermisoController::class, 'editar'])->name('admin-editar_permiso');
            Route::put('permiso/{id}', [PermisoController::class, 'actualizar'])->name('admin-actualizar_permiso');
            Route::delete('permiso/{id}', [PermisoController::class, 'eliminar'])->name('admin-eliminar_permiso');
            // ------------------------------------------------------------------------------------
            /*RUTAS PERMISO_ROL*/
            Route::get('_permiso-rol', [PermisoRolController::class, 'index'])->name('admin-permiso_rol');
            Route::post('_permiso-rol', [PermisoRolController::class, 'guardar'])->name('admin-guardar_permiso_rol');
            // ------------------------------------------------------------------------------------
            // Ruta Administrador del Sistema Usuarios
            Route::get('usuario-index', [UsuarioController::class, 'index'])->name('admin-usuario-index');
            Route::get('usuario-crear', [UsuarioController::class, 'crear'])->name('admin-usuario-crear');
            Route::post('usuario', [UsuarioController::class, 'guardar'])->name('admin-usuario-guardar');
            Route::get('usuario/{id}/editar', [UsuarioController::class, 'editar'])->name('admin-usuario-editar');
            Route::put('usuario/{id}', [UsuarioController::class, 'actualizar'])->name('admin-usuario-actualizar');
            Route::delete('usuario/{id}', [UsuarioController::class, 'eliminar'])->name('admin-usuario-eliminar');
            // ------------------------------------------------------------------------------------
            // Ruta Empresas
            Route::get('empresa-index', [EmpresaController::class, 'index'])->name('admin-empresa-index');
            Route::get('empresa-crear', [EmpresaController::class, 'crear'])->name('admin-empresa-crear');
            Route::post('empresa', [EmpresaController::class, 'guardar'])->name('admin-empresa-guardar');
            Route::get('empresa/{id}/editar', [EmpresaController::class, 'editar'])->name('admin-empresa-editar');
            Route::put('empresa/{id}', [EmpresaController::class, 'actualizar'])->name('admin-empresa-actualizar');
            Route::delete('empresa/{id}', [EmpresaController::class, 'eliminar'])->name('admin-empresa-eliminar');
            // ------------------------------------------------------------------------------------
            // ------------------------------------------------------------------------------------


        });
        // ------------------------------------------------------------------------------------
        Route::group(['middleware' => 'administrador'], function () {
            // Noticias
            Route::get('noticias-index', [NoticiaController::class, 'index'])->name('noticias-index');
            Route::get('noticias-crear', [NoticiaController::class, 'crear'])->name('noticias-crear');
            Route::post('noticias', [NoticiaController::class, 'guardar'])->name('noticias-guardar');
            Route::get('noticias/{id}/editar', [NoticiaController::class, 'editar'])->name('noticias-editar');
            Route::put('noticias/{id}', [NoticiaController::class, 'actualizar'])->name('noticias-actualizar');
            Route::get('noticias/{id}/eliminar', [NoticiaController::class, 'eliminar'])->name('noticias-eliminar');
            Route::get('noticias/{id}/desactivar', [NoticiaController::class, 'desactivar'])->name('noticias-desactivar');
        });
        // ------------------------------------------------------------------------------------
        // Rutas Jurisdicciones
        Route::get('jurisdiccion_juzgado-index', [Jurisdiccion::class, 'index'])->name('admin-jurisdiccion_juzgado-index');
        // Ruta Departementos
        Route::get('departamento_juzgado-index', [JuzgDepartamento::class, 'index'])->name('admin-departamento_juzgado-index');
        // Ruta Distrito Juzgados
        Route::get('distrito_juzgado-index', [Distritos::class, 'index'])->name('admin-distrito_juzgado-index');
        // Ruta Circuitos Juzgados
        Route::get('circuito_juzgado-index', [CircuitoController::class, 'index'])->name('admin-circuito_juzgado-index');
        // Ruta Municipios Juzgados
        Route::get('municipio_juzgado-index', [MunicipioController::class, 'index'])->name('admin-municipio_juzgado-index');
        // Ruta Juzgados
        Route::get('juzgado-index', [JuzgadoController::class, 'index'])->name('admin-juzgado-index');
        //------------------------------------------------------------------------------------------------------------------------------------------
        // Rutas Tipo Proceso
        Route::get('tipo_proceso-index', [TipoProcesoController::class, 'index'])->name('admin-tipo_proceso-index');
        // Rutas Papel Cliente
        Route::get('papel_cliente-index', [PapelClienteController::class, 'index'])->name('admin-papel_cliente-index');
        // Rutas Estados Proceso
        Route::get('estado_proceso-index', [EstadoProcesoController::class, 'index'])->name('admin-estado_proceso-index');
        // Rutas Etapas Proceso
        Route::get('etapa_proceso-index', [EtapaProcesoController::class, 'index'])->name('admin-etapa_proceso-index');
        // Rutas Riesgo Perdidas Proceso
        Route::get('riesgo_perdida_proceso-index', [RiesgoPerdidaProcesoController::class, 'index'])->name('admin-riesgo_perdida_proceso-index');
        // Rutas Sentidos Fallo Proceso
        Route::get('sentido_fallo_proceso-index', [SentidoFalloController::class, 'index'])->name('admin-sentido_fallo_proceso-index');
        // Rutas Terminacion Anormal Proceso
        Route::get('terminacion_anormal-index', [TerminacionAnormalController::class, 'index'])->name('admin-terminacion_anormal-index');
        //-------------------------------------------------------------------------------------------------------------------------------------------
        // Parametros Hojas de vida
        Route::get('param_hojas_de_vida-index', [ParametrosHVController::class, 'index'])->name('param_hojas_de_vida-index');
        Route::get('param_hojas_de_vida-crear-nivel/{id}', [ParametrosHVController::class, 'crear_nivel'])->name('admin-param_hojas_de_vida-crear_nivel');
        Route::get('param_hojas_de_vida-crear-area/{id}', [ParametrosHVController::class, 'crear_area'])->name('admin-param_hojas_de_vida-crear_area');
        Route::get('param_hojas_de_vida-crear-cargo/{id}', [ParametrosHVController::class, 'crear_cargo'])->name('admin-param_hojas_de_vida-crear_cargo');
        Route::post('param_hojas_de_vida-nivel/{id}', [ParametrosHVController::class, 'guardar_nivel'])->name('admin-param_hojas_de_vida-guardar_nivel');
        Route::post('param_hojas_de_vida-area/{id}', [ParametrosHVController::class, 'guardar_area'])->name('admin-param_hojas_de_vida-guardar_area');
        Route::post('param_hojas_de_vida-cargo/{id}', [ParametrosHVController::class, 'guardar_cargo'])->name('admin-param_hojas_de_vida-guardar_cargo');
        Route::get('cargar_areas', [ParametrosHVController::class, 'cargar_areas'])->name('cargar_areas');
        //-------------------------------------------------------------------------------------------------------------------------------------------
        // Parametros Procesos
        Route::get('procesos_listado', [ProcesoController::class, 'index'])->name('admin-procesos-index');
        Route::get('procesos_listado/{id}/detalle', [ProcesoController::class, 'detalle'])->name('admin-procesos-detalle');
        Route::get('procesos/{id}/exportar', [ProcesoController::class, 'exportar'])->name('admin-procesos-exportar');
        Route::get('procesos_listado/{id?}/editar', [ProcesoController::class, 'editar'])->name('admin-procesos-editar');
        Route::delete('eliminar_demandado_proceso/{id_demandado}/eliminar', [ProcesoController::class, 'eliminar_demandado_proceso'])->name('eliminar_demandado_proceso');
        Route::delete('eliminar_demandante_proceso/{id_demandante}/eliminar', [ProcesoController::class, 'eliminar_demandante_proceso'])->name('eliminar_demandante_proceso');
        Route::post('nuevo_demandado_proceso', [ProcesoController::class, 'nuevo_demandado_proceso'])->name('nuevo_demandado_proceso');
        Route::post('nuevo_demandante_proceso', [ProcesoController::class, 'nuevo_demandante_proceso'])->name('nuevo_demandante_proceso');
        Route::get('nuevo_apoderado_proceso', [ProcesoController::class, 'nuevo_apoderado_proceso'])->name('nuevo_apoderado_proceso');
        Route::get('nuevo_asistente_proceso', [ProcesoController::class, 'nuevo_asistente_proceso'])->name('nuevo_asistente_proceso');

        Route::delete('eliminar_apoderado_proceso/{id_apoderado}/{id_proceso}/eliminar', [ProcesoController::class, 'eliminar_apoderado_proceso'])->name('eliminar_apoderado_proceso');
        Route::delete('eliminar_asistente_proceso/{id_asistente}/{id_proceso}/eliminar', [ProcesoController::class, 'eliminar_asistente_proceso'])->name('eliminar_asistente_proceso');
        Route::delete('eliminar_demandado_proceso/{id_demandado}/eliminar', [ProcesoController::class, 'eliminar_demandado_proceso'])->name('eliminar_demandado_proceso');
        Route::delete('eliminar_demandante_proceso/{id_demandante}/eliminar', [ProcesoController::class, 'eliminar_demandante_proceso'])->name('eliminar_demandante_proceso');
        Route::delete('eliminar_cliente_proceso/{id_cliente}/{id_proceso}/eliminar', [ProcesoController::class, 'eliminar_cliente_proceso'])->name('eliminar_cliente_proceso');
        Route::get('nuevo_cliente_proceso', [ProcesoController::class, 'nuevo_cliente_proceso'])->name('nuevo_cliente_proceso');
        Route::get('cambiar_cliente_proceso', [ProcesoController::class, 'cambiar_cliente_proceso'])->name('cambiar_cliente_proceso');
        Route::get('cargar_departamentos', [ProcesoController::class, 'cargar_departamentos'])->name('cargar_departamentos');
        Route::get('cargar_distritos', [ProcesoController::class, 'cargar_distritos'])->name('cargar_distritos');
        Route::get('cargar_circuitos', [ProcesoController::class, 'cargar_circuitos'])->name('cargar_circuitos');
        Route::get('cargar_municipios', [ProcesoController::class, 'cargar_municipios'])->name('cargar_municipios');
        Route::get('cargar_juzgados', [ProcesoController::class, 'cargar_juzgados'])->name('cargar_juzgados');
        Route::post('guardar_proceso', [ProcesoController::class, 'guardar_proceso'])->name('guardar_proceso');




        // Cambios actuaciones
        Route::get('actuaciones_procesos_crear/{procesos_id}', [ProcesoController::class, 'actuaciones_procesos_crear'])->name('actuaciones_procesos_crear');
        Route::post('actuaciones_procesos_crear', [ProcesoController::class, 'actuaciones_procesos_crear_guardar'])->name('actuaciones_procesos_crear_guardar');
        Route::delete('eliminar_actuaciones_procesos_crear/{id}/eliminar', [ProcesoController::class, 'eliminar_actuaciones_procesos_crear'])->name('eliminar_actuaciones_procesos_crear');
        Route::get('actuaciones_procesos_crear/{id}/editar', [ProcesoController::class, 'actuaciones_procesos_crear_editar'])->name('actuaciones_procesos_crear_editar');
        Route::put('modificar_actuacion_proceso/{id}', [ProcesoController::class, 'modificar_actuacion_proceso'])->name('modificar_actuacion_proceso');
        Route::get('actuaciones_documentos_act_crear/{actuaciones_id}/editar', [ProcesoController::class, 'actuaciones_documentos_act_crear_editar'])->name('actuaciones_documentos_act_crear_editar');
        Route::post('actuaciones_documentos_act_crear', [ProcesoController::class, 'actuaciones_documentos_act_crear_guardar'])->name('actuaciones_documentos_act_crear_guardar');
        Route::delete('eliminar_actuaciones_documentos_act_crear/{id}/eliminar', [ProcesoController::class, 'eliminar_actuaciones_documentos_act_crear'])->name('eliminar_actuaciones_documentos_act_crear');
        //--------------------------------------------------------------------------------
        //--------------------------------------------------------------------------------
        // Cambios documentos proceso
        Route::get('documentos_procesos_crear/{procesos_id}', [ProcesoController::class, 'documentos_procesos_crear'])->name('documentos_procesos_crear');
        Route::post('documentos_procesos_crear', [ProcesoController::class, 'documentos_procesos_crear_guardar'])->name('documentos_procesos_crear_guardar');
        Route::delete('eliminar_documentos_proc_crear/{id}/eliminar', [ProcesoController::class, 'eliminar_documentos_proc_crear'])->name('eliminar_documentos_proc_crear');
        //--------------------------------------------------------------------------------
        // fallos proceos
        Route::get('falllos_procesos-index/{procesos_id}', [ProcesoController::class, 'falllos_procesos_index'])->name('falllos_procesos_index');
        Route::get('falllos_procesos/editar', [ProcesoController::class, 'falllos_procesos_editar'])->name('falllos_procesos_editar');
        //--------------------------------------------------------------------------------
        // anotaciones proceos
        Route::get('anotaciones_procesos-index/{procesos_id}', [ProcesoController::class, 'anotaciones_procesos_index'])->name('anotaciones_procesos_index');
        Route::get('nueva_anotacion_proceso', [ProcesoController::class, 'nueva_anotacion_proceso'])->name('nueva_anotacion_proceso');
        Route::delete('eliminar_anotacion/{id}/eliminar', [ProcesoController::class, 'eliminar_anotacion'])->name('eliminar_anotacion');
        //--------------------------------------------------------------------------------
        // Documentos anotaciones proceos
        Route::get('doc_anotaciones_procesos-index/{procesos_id}/{anotacion_id}', [ProcesoController::class, 'doc_anotaciones_procesos_index'])->name('doc_anotaciones_procesos_index');
        Route::get('doc_anotaciones_procesos-crear/{procesos_id}/{anotacion_id}', [ProcesoController::class, 'doc_anotaciones_procesos_crear'])->name('doc_anotaciones_procesos_crear');
        Route::post('doc_anotaciones_procesos_guardar', [ProcesoController::class, 'doc_anotaciones_procesos_guardar'])->name('doc_anotaciones_procesos_guardar');
        Route::delete('eliminar_doc_anotacion/{id}/eliminar', [ProcesoController::class, 'eliminar_doc_anotacion'])->name('eliminar_doc_anotacion');
        //--------------------------------------------------------------------------------
        // Cambios proceso editar
        Route::get('cambio_cod_unico_proceso_ini', [ProcesoController::class, 'cambio_cod_unico_proceso_ini'])->name('cambio_cod_unico_proceso_ini');
        Route::get('cambio_tipo_proceso', [ProcesoController::class, 'cambio_tipo_proceso'])->name('cambio_tipo_proceso');
        Route::get('cambiar_juzgado_proceso', [ProcesoController::class, 'cambiar_juzgado_proceso'])->name('cambiar_juzgado_proceso');
        Route::get('cambiar_estado_notificacion_proceso', [ProcesoController::class, 'cambiar_estado_notificacion_proceso'])->name('cambiar_estado_notificacion_proceso');
        Route::get('cambiar_estado_con_jur_proceso', [ProcesoController::class, 'cambiar_estado_con_jur_proceso'])->name('cambiar_estado_con_jur_proceso');
        Route::get('editar_datos_proceso', [ProcesoController::class, 'editar_datos_proceso'])->name('editar_datos_proceso');
        //--------------------------------------------------------------------------------

        //-------------------------------------------------------------------------------------------------------------------------------------------
        // Parametros Procesos
        Route::get('archivo-index', [ArchivoController::class, 'index'])->name('archivo-index');
        // Manuales de Procedimientos
        Route::get('archivo-manuales-index/{id}', [ManualController::class, 'index'])->name('manuales-index');
        Route::put('archivo-manuales/{id}/elim_manual', [ManualController::class, 'elim_manual'])->name('manuales-elim_manual');
        Route::get('archivo-manuales/{id}/nuev_manual', [ManualController::class, 'nuev_manual'])->name('manuales-nuev_manual');
        Route::post('archivo-manuales-guardar/{id}', [ManualController::class, 'guardar_nuev_manual'])->name('manuales-nuev_manual-guardar');

        // Soportes de afiliacion
        Route::get('archivo-soportes_afiliacion-index/{id}', [SoporteAfiliacionController::class, 'index'])->name('soportes_afiliacion-index');
        Route::get('archivo-soportes_afiliacion/{id}/editar', [SoporteAfiliacionController::class, 'editar'])->name('soportes_afiliacion-editar');
        Route::get('archivo-soportes_afiliacion-filtar', [SoporteAfiliacionController::class, 'filtar'])->name('soportes_afiliacion-filtar');
        Route::get('archivo-soportes_afiliacion/{id}/crear', [SoporteAfiliacionController::class, 'crear'])->name('soportes_afiliacion-crear');
        Route::post('archivo-soportes_afiliacion/{id}/guardar', [SoporteAfiliacionController::class, 'guardar'])->name('soportes_afiliacion-guardar');
        Route::delete('archivo-soportes_afiliacion/{id}/eliminar', [SoporteAfiliacionController::class, 'eliminar'])->name('soportes_afiliacion-eliminar');

        // Documentos Contractuales
        Route::get('archivo-documentoscontractuales-index/{id}', [DocumentosContractualesnController::class, 'index'])->name('documentoscontractuales-index');
        Route::get('archivo-documentoscontractuales/{id}/editar', [DocumentosContractualesnController::class, 'editar'])->name('documentoscontractuales-editar');
        Route::get('archivo-documentoscontractuales/{id}/crear', [DocumentosContractualesnController::class, 'crear'])->name('documentoscontractuales-crear');
        Route::post('archivo-documentoscontractuales/{id}/guardar', [DocumentosContractualesnController::class, 'guardar'])->name('documentoscontractuales-guardar');
        Route::delete('archivo-documentoscontractuales/{id}/eliminar', [DocumentosContractualesnController::class, 'eliminar'])->name('documentoscontractuales-eliminar');
        // Documentos Situacion Laboral
        Route::get('archivo-sit_lab_gen-index/{id}', [Situ_Lab_generalController::class, 'index'])->name('sit_lab_gen-index');
        Route::get('archivo-sit_lab_gen/{id}/editar', [Situ_Lab_generalController::class, 'editar'])->name('sit_lab_gen-editar');
        Route::get('archivo-sit_lab_gen/{id}/crear', [Situ_Lab_generalController::class, 'crear'])->name('sit_lab_gen-crear');
        Route::post('archivo-sit_lab_gen/{id}/guardar', [Situ_Lab_generalController::class, 'guardar'])->name('sit_lab_gen-guardar');
        Route::delete('archivo-sit_lab_gen/{id}/eliminar', [Situ_Lab_generalController::class, 'eliminar'])->name('sit_lab_gen-eliminar');
        // Historias clínicas ocupacionales
        Route::get('archivo-his_clin_ocup-index/{id}', [HistoriaClinicalController::class, 'index'])->name('his_clin_ocup-index');
        Route::get('archivo-his_clin_ocup/{id}/editar', [HistoriaClinicalController::class, 'editar'])->name('his_clin_ocup-editar');
        Route::get('archivo-his_clin_ocup/{id}/crear', [HistoriaClinicalController::class, 'crear'])->name('his_clin_ocup-crear');
        Route::post('archivo-his_clin_ocup/{id}/guardar', [HistoriaClinicalController::class, 'guardar'])->name('his_clin_ocup-guardar');
        Route::delete('archivo-his_clin_ocup/{id}/eliminar', [HistoriaClinicalController::class, 'eliminar'])->name('his_clin_ocup-eliminar');
        // Dotaciones
        Route::get('archivo-dotaciones-index/{id}', [DotacionesController::class, 'index'])->name('dotaciones-index');
        Route::get('archivo-dotaciones/{id}/editar', [DotacionesController::class, 'editar'])->name('dotaciones-editar');
        Route::get('archivo-dotaciones/{id}/crear', [DotacionesController::class, 'crear'])->name('dotaciones-crear');
        Route::post('archivo-dotaciones/{id}/guardar', [DotacionesController::class, 'guardar'])->name('dotaciones-guardar');
        Route::delete('archivo-dotaciones/{id}/eliminar', [DotacionesController::class, 'eliminar'])->name('dotaciones-eliminar');
        // Procesos Disciplinarios
        Route::get('archivo-proceso_discip-index/{id}', [ProcesoDisciplinarioController::class, 'index'])->name('proceso_discip-index');
        Route::get('archivo-proceso_discip/{id}/editar', [ProcesoDisciplinarioController::class, 'editar'])->name('proceso_discip-editar');
        Route::get('archivo-proceso_discip/{id}/crear', [ProcesoDisciplinarioController::class, 'crear'])->name('proceso_discip-crear');
        Route::get('archivo-proceso_discip/{id}/{id_p}/n_archivo', [ProcesoDisciplinarioController::class, 'n_archivo'])->name('proceso_discip-n_archivo');
        Route::get('archivo-proceso_discip/{id}/{id_p}/{doc}/e_archivo', [ProcesoDisciplinarioController::class, 'e_archivo'])->name('proceso_discip-e_archivo');
        Route::post('archivo-proceso_discip/{id}/guardar', [ProcesoDisciplinarioController::class, 'guardar'])->name('proceso_discip-guardar');
        Route::post('archivo-proceso_discip/{id}/{id_p}/guardar_e', [ProcesoDisciplinarioController::class, 'guardar_e'])->name('proceso_discip-guardar_e');
        Route::delete('archivo-proceso_discip/{id}/eliminar', [ProcesoDisciplinarioController::class, 'eliminar'])->name('proceso_discip-eliminar');
        Route::delete('archivo-proceso_discip/{id}/{doc}/eliminar_d', [ProcesoDisciplinarioController::class, 'eliminar_d'])->name('proceso_discip-eliminar_d');
        // Evaluaciones de desempeño
        Route::get('archivo-evaluacion_desemp-index/{id}', [EvaluacionDesempController::class, 'index'])->name('evaluacion_desemp-index');
        Route::get('archivo-evaluacion_desemp/{id}/editar', [EvaluacionDesempController::class, 'editar'])->name('evaluacion_desemp-editar');
        Route::get('archivo-evaluacion_desemp/{id}/crear', [EvaluacionDesempController::class, 'crear'])->name('evaluacion_desemp-crear');
        Route::post('archivo-evaluacion_desemp/{id}/guardar', [EvaluacionDesempController::class, 'guardar'])->name('evaluacion_desemp-guardar');
        Route::delete('archivo-evaluacion_desemp/{id}/eliminar', [EvaluacionDesempController::class, 'eliminar'])->name('evaluacion_desemp-eliminar');
        // Vacaciones y licencias
        Route::get('archivo-vacaciones-index/{id}', [VacacionesController::class, 'index'])->name('vacaciones-index');
        Route::get('archivo-vacaciones/{id}/editar', [VacacionesController::class, 'editar'])->name('vacaciones-editar');
        Route::get('archivo-vacaciones/{id}/crear', [VacacionesController::class, 'crear'])->name('vacaciones-crear');
        Route::post('archivo-vacaciones/{id}/guardar', [VacacionesController::class, 'guardar'])->name('vacaciones-guardar');
        Route::delete('archivo-vacaciones/{id}/eliminar', [VacacionesController::class, 'eliminar'])->name('vacaciones-eliminar');
        // Documentos de Retiro
        Route::get('archivo-doc_retiro-index/{id}', [DocRetiroController::class, 'index'])->name('doc_retiro-index');
        Route::get('archivo-doc_retiro/{id}/editar', [DocRetiroController::class, 'editar'])->name('doc_retiro-editar');
        Route::get('archivo-doc_retiro/{id}/crear', [DocRetiroController::class, 'crear'])->name('doc_retiro-crear');
        Route::post('archivo-doc_retiro/{id}/guardar', [DocRetiroController::class, 'guardar'])->name('doc_retiro-guardar');
        Route::delete('archivo-doc_retiro/{id}/eliminar', [DocRetiroController::class, 'eliminar'])->name('doc_retiro-eliminar');
        // Capacitaciones y certificaciones
        Route::get('archivo-capacitacion-index/{id}', [CapacitacionController::class, 'index'])->name('capacitacion-index');
        Route::get('archivo-capacitacion/{id}/editar', [CapacitacionController::class, 'editar'])->name('capacitacion-editar');
        Route::get('archivo-capacitacion/{id}/crear', [CapacitacionController::class, 'crear'])->name('capacitacion-crear');
        Route::post('archivo-capacitacion/{id}/guardar', [CapacitacionController::class, 'guardar'])->name('capacitacion-guardar');
        Route::delete('archivo-capacitacion/{id}/eliminar', [CapacitacionController::class, 'eliminar'])->name('capacitacion-eliminar');
        // Políticas, Reglamentos y otros
        Route::get('archivo-politica-index/{id}', [PoliticaController::class, 'index'])->name('politica-index');
        Route::get('archivo-politica/crear/{id}', [PoliticaController::class, 'crear'])->name('politica-crear');
        Route::post('archivo-politica/{id}/guardar', [PoliticaController::class, 'guardar'])->name('politica-guardar');
        Route::delete('archivo-politica/{id}/eliminar', [PoliticaController::class, 'eliminar'])->name('politica-eliminar');
        // Permisos usuarios
        Route::get('archivo-permisos-index/{id}', [PermisoEmpleadoController::class, 'index'])->name('permisos-index');
        Route::get('archivo-permisos/{id}/editar', [PermisoEmpleadoController::class, 'editar'])->name('permisos-editar');
        Route::get('archivo-permisos/{id}/cambiar', [PermisoEmpleadoController::class, 'cambiar'])->name('permisos-cambiar');
        Route::get('archivo-permisos/crear', [PermisoEmpleadoController::class, 'crear'])->name('permisos-crear');
        Route::post('archivo-permisos-guardar', [PermisoEmpleadoController::class, 'guardar'])->name('permisos-guardar');
        Route::delete('archivo-permisos/{id}/eliminar', [PermisoEmpleadoController::class, 'eliminar'])->name('permisos-eliminar');
        //hojas de vida
        Route::get('archivo-hojas_de_vida-index/{id}', [HojaVidaController::class, 'index'])->name('hojas_de_vida-index');
        Route::get('archivo-hojas_de_vida/export/{id}', [HojaVidaController::class, 'exportarExcel'])->name('archivo-hojas_de_vida-exportarExcel');
        Route::get('archivo-hojas_de_vida-crear/{id}', [HojaVidaController::class, 'crear'])->name('hojas_de_vida-crear');
        Route::post('archivo-hojas_de_vida-guardar/{id}', [HojaVidaController::class, 'guardar'])->name('hojas_de_vida-guardar');
        Route::get('cargar_cargos', [HojaVidaController::class, 'cargar_cargos'])->name('cargar_cargos');
        Route::get('archivo-hojas_de_vida/{id}/detalles', [HojaVidaController::class, 'detalles'])->name('hojas_de_vida-detalles');
        Route::get('archivo-hojas_de_vida/{id}/editar', [HojaVidaController::class, 'editar'])->name('hojas_de_vida-editar');
        Route::get('archivo-hojas_de_vida/{id}/documentacion', [HojaVidaController::class, 'documentacion'])->name('hojas_de_vida-documentacion');
        Route::put('archivo-hojas_de_vida/{id}/guardar-infemp', [HojaVidaController::class, 'guardar_info_empleado'])->name('hojas_de_vida-guardar-infemp');
        Route::get('hv_cargar_municipios', [HojaVidaController::class, 'hv_cargar_municipios'])->name('hv_cargar_municipios');
        Route::get('archivo-hojas_de_vida/{id}/calcularTiempoLaboral', [HojaVidaController::class, 'calcularTiempoLaboral'])->name('hojas_de_vida-calcularTiempoLaboral');
        //-----Doc Hojas de vida
        //.......................................................................................................................................
        Route::get('archivo-hojas_de_vida/{id}/edubasica', [HojaVidaController::class, 'edubasica'])->name('hojas_de_vida-edubasica');
        Route::post('archivo-hojas_de_vida/{id}/edubasica-guardar', [HojaVidaController::class, 'edubasica_guardar'])->name('hojas_de_vida-edubasica-guardar');
        Route::delete('archivo-hojas_de_vida/{id}/eliminaredubasica', [HojaVidaController::class, 'eliminarEduBas'])->name('hojas_de_vida-eliminaredubasica');
        //.......................................................................................................................................
        Route::get('archivo-hojas_de_vida/{id}/edusuperior', [HojaVidaController::class, 'edusuperior'])->name('hojas_de_vida-edusuperior');
        Route::post('archivo-hojas_de_vida/{id}/edusuperior-guardar', [HojaVidaController::class, 'edusuperior_guardar'])->name('hojas_de_vida-edusuperior-guardar');
        Route::delete('archivo-hojas_de_vida/{id}/eliminaredusuperior', [HojaVidaController::class, 'eliminarEduSup'])->name('hojas_de_vida-eliminaredusuperior');
        //.......................................................................................................................................
        Route::get('archivo-hojas_de_vida/{id}/eduotra', [HojaVidaController::class, 'eduotra'])->name('hojas_de_vida-eduotra');
        Route::post('archivo-hojas_de_vida/{id}/eduotra-guardar', [HojaVidaController::class, 'eduotra_guardar'])->name('hojas_de_vida-eduotra-guardar');
        Route::delete('archivo-hojas_de_vida/{id}/eliminareduotra', [HojaVidaController::class, 'eliminarEduOtra'])->name('hojas_de_vida-eliminareduotra');
        //.......................................................................................................................................
        Route::get('archivo-hojas_de_vida/{id}/publicaciones', [HojaVidaController::class, 'publicaciones'])->name('hojas_de_vida-publicaciones');
        Route::post('archivo-hojas_de_vida/{id}/publicaciones-guardar', [HojaVidaController::class, 'publicaciones_guardar'])->name('hojas_de_vida-publicaciones-guardar');
        Route::delete('archivo-hojas_de_vida/{id}/eliminarpublicaciones', [HojaVidaController::class, 'eliminarpublicaciones'])->name('hojas_de_vida-eliminarpublicaciones');
        //.......................................................................................................................................
        Route::get('archivo-hojas_de_vida/{id}/idiomas', [HojaVidaController::class, 'idiomas'])->name('hojas_de_vida-idiomas');
        Route::post('archivo-hojas_de_vida/{id}/idiomas-guardar', [HojaVidaController::class, 'idiomas_guardar'])->name('hojas_de_vida-idiomas-guardar');
        Route::delete('archivo-hojas_de_vida/{id}/eliminaridiomas', [HojaVidaController::class, 'eliminaridiomas'])->name('hojas_de_vida-eliminaridiomas');
        //.......................................................................................................................................
        Route::get('archivo-hojas_de_vida/{id}/laboralformal', [HojaVidaController::class, 'laboralformal'])->name('hojas_de_vida-laboralformal');
        Route::post('archivo-hojas_de_vida/{id}/laboralformal-guardar', [HojaVidaController::class, 'laboralformal_guardar'])->name('hojas_de_vida-laboralformal-guardar');
        Route::delete('archivo-hojas_de_vida/{id}/eliminarlaboralformal', [HojaVidaController::class, 'eliminarlaboralformal'])->name('hojas_de_vida-eliminarlaboralformal');
        //.......................................................................................................................................
        Route::get('archivo-hojas_de_vida/{id}/laboralinformal', [HojaVidaController::class, 'laboralinformal'])->name('hojas_de_vida-laboralinformal');
        Route::post('archivo-hojas_de_vida/{id}/laboralinformal-guardar', [HojaVidaController::class, 'laboralinformal_guardar'])->name('hojas_de_vida-laboralinformal-guardar');
        Route::delete('archivo-hojas_de_vida/{id}/eliminarlaboralinformal', [HojaVidaController::class, 'eliminarlaboralinformal'])->name('hojas_de_vida-eliminarlaboralinformal');
        //.......................................................................................................................................
        //diagnosticos
        Route::get('diagnosticos-index', [DiagnosticoController::class, 'index'])->name('diagnosticos-index');
        Route::get('diagnosticos-crear', [DiagnosticoController::class, 'crear'])->name('diagnosticos-crear');
        Route::post('diagnosticos-guardar', [DiagnosticoController::class, 'guardar'])->name('diagnosticos-guardar');
        // Clientes
        Route::get('proyectos_clientes-index/{id}', [ClienteController::class, 'index'])->name('proyecto_clientes-index');
        //--------------------------------------------------------------------------------
        // Proveedores
        Route::get('proyectos_proveedores-index/{id}', [ProveedorController::class, 'index'])->name('proyecto_proveedores-index');
        // Rutas Proyectos
        //--------------------------------------------------------------------------------
        // Proyectos interfaz
        Route::get('proyectos-index', [ProyectoController::class, 'interfaz'])->name('proyecto-interfaz');
        Route::get('proyectos-crear', [ProyectoController::class, 'crear'])->name('proyecto-crear');
        Route::post('proyectos', [ProyectoController::class, 'guardar'])->name('proyecto-guardar');
        Route::get('proyectos/{id}/gestion-inter', [ProyectoController::class, 'gestion_inter'])->name('proyecto-gestion-inter');
        Route::get('proyectos/{id}/gestion', [ProyectoController::class, 'gestion'])->name('proyecto-gestion');
        Route::get('proyectos/{id}/listado_proy', [ProyectoController::class, 'listado_proy'])->name('proyecto-listado_proy');
        Route::get('proyectos/{id}/listado_tareas', [ProyectoController::class, 'listado_tareas'])->name('proyecto-listado_tareas');
        // Componentes
        Route::get('proyectos-componente/{id}/crear', [ComponenteController::class, 'crear'])->name('proyecto-componente-crear');
        Route::post('proyectos-componente/{id}/guardar', [ComponenteController::class, 'guardar'])->name('proyecto-componente-guardar');
        Route::get('proyectos-componente/{id}/editar', [ComponenteController::class, 'editar'])->name('proyecto-componente-editar');
        Route::put('proyectos-componente/{id}/actualizar', [ComponenteController::class, 'actualizar'])->name('proyecto-componente-actualizar');
        // tareas
        Route::get('proyectos-tareas/{id}/index', [TareaController::class, 'index'])->name('proyecto-tareas-index');
        Route::get('proyectos-tareas/{id}/crear', [TareaController::class, 'crear'])->name('proyecto-tareas-crear');
        Route::post('proyectos-tareas/{id}/guardar', [TareaController::class, 'guardar'])->name('proyecto-tareas-guardar');
        // Historiales
        Route::get('proyectos-historiales/{id}/crear', [HistorialController::class, 'crear'])->name('proyecto-historiales-crear');
        Route::post('proyectos-historiales/{id}/guardar', [HistorialController::class, 'guardar'])->name('proyecto-historiales-guardar');
        Route::get('proyectos-historiales/{id}/crear_doc', [HistorialController::class, 'crear_doc'])->name('proyecto-historiales-crear_doc');
        Route::post('proyectos-historiales/{id}/guardar_doc', [HistorialController::class, 'guardar_doc'])->name('proyecto-historiales-guardar_doc');

        // Clientes y Proveedores
        Route::get('proyectos/{id}/gestion_cliente-nuevo', [ProyectoController::class, 'gestion_cliente_nuevo'])->name('proyecto-gestion_cliente-nuevo');
        Route::delete('proyectos/{id_cli}/{id_pro}/gestion_cliente-borrar', [ProyectoController::class, 'gestion_cliente_borrar'])->name('proyecto-gestion_cliente-borrar');
        Route::get('proyectos/{id}/gestion_proveedor-nuevo', [ProyectoController::class, 'gestion_proveedor_nuevo'])->name('proyecto-gestion_proveedor-nuevo');
        Route::delete('proyectos/{id_cli}/{id_pro}/gestion_proveedor-borrar', [ProyectoController::class, 'gestion_proveedor_borrar'])->name('proyecto-gestion_proveedor-borrar');
        //========================================================================================================================
        // Boletines
        Route::get('consultas_solicitudes-index', [SolicitudController::class, 'index'])->name('consultas_solicitudes-index');
        Route::get('consultas_solicitudes-crear', [SolicitudController::class, 'crear'])->name('consultas_solicitudes-crear');
        Route::post('consultas_solicitudes-guardar/{id}', [SolicitudController::class, 'guardar'])->name('consultas_solicitudes-guardar');
        Route::get('consultas_solicitudes/{id}/gestionar', [SolicitudController::class, 'gestionar'])->name('consultas_solicitudes-gestionar');
        Route::get('consultas_solicitudes-camb_estd_solulicitud', [SolicitudController::class, 'camb_estd_solulicitud'])->name('consultas_solicitudes-camb_estd_solulicitud');
        Route::get('consultas_solicitudes/cerrar_solicitud', [SolicitudController::class, 'cerrar_solicitud'])->name('consultas_solicitudes-cerrar_solicitud');
        Route::get('consultas_solicitudes-gestionar_responsable', [SolicitudController::class, 'gestionar_responsable'])->name('consultas_solicitudes-gestionar_responsable');
        Route::delete('consultas_solicitudes/{cli_solicitud_id}/{usuario_id}/gestionar_responsable-delete', [SolicitudController::class, 'gestionar_responsable_delete'])->name('consultas_solicitudes_gestionar_responsable-delete');
        Route::get('consultas_solicitudes/{id}/historial', [SolicitudController::class, 'historial'])->name('consultas_solicitudes-historial');
        Route::post('consultas_solicitudes/{id}/historial-guardar', [SolicitudController::class, 'historial_guardar'])->name('historial-guardar');
        Route::delete('consultas_solicitudes/{id}/historial-eliminar', [SolicitudController::class, 'historial_eliminar'])->name('historial-eliminar');
        Route::post('consultas_solicitudes/{id}/doc_historial-guardar', [SolicitudController::class, 'doc_historial_guardar'])->name('doc_historial-guardar');
        Route::delete('consultas_solicitudes/{id}/doc_historial-eliminar', [SolicitudController::class, 'doc_historial_eliminar'])->name('doc_historial-eliminar');
        Route::get('consultas_solicitudes/{id}/ver', [SolicitudController::class, 'ver'])->name('consultas_solicitudes-ver');

        //========================================================================================================================
        //========================================================================================================================
        // Boletines
        Route::get('boletines-index', [BoletinController::class, 'index'])->name('boletines-index');
        //========================================================================================================================


    });
});
