<?php

    define('LOGIN_USUARIO_OK', 'Usuario logueado correctamente.');
	define('REGISTRAR_USUARIO_OK', 'Usuario registrado correctamente.');
	define('RECUPERAR_CONTRASENA_EMAIL_OK', 'La contraseña ha sido cambiada, revise su correo.');
	define('TOKEN_NUMERO_INCORRECTO_SEGMENTOS', 'La sesión ha caducado');

    define('PETICION_INVALIDA', 'Petición invalida.');
	define('ACCION_NO_ENCONTRADA', 'Acción no encontrada.');
	define('PUNTO_ACCESO_NO_ENCONTRADO', 'Punto de acceso no encontrado.');
	define('ACCION_DENEGADA_TEST', 'Sólo el administrador tiene permitido ejecutar el test.');

	define('DNI_VACIO', 'El DNI es vacio.');
	define('DNI_MENOR_QUE_9', 'El DNI no puede tener menos de 9 caracteres.');
	define('DNI_MAYOR_QUE_9', 'El DNI no puede tener mayor de 9 caracteres.');
	define('DNI_FORMATO_INCORRECTO', 'El formato del DNI es incorrecto, deben ser 8 números y una letra.');
	define('DNI_LETRA_INCORRECTA', 'La letra introducida en el DNI no es la correcta.');

	define('USUARIO_NO_EXISTE', 'El usuario no existe en el sistema.');
	define('CONTRASENA_INCORRECTO', 'La contraseña no es correcta.');
	define('USUARIO_ELIMINADO', 'El usuario está eliminado.');
	define('USUARIO_YA_EXISTE', 'Ya existe el usuario en el sistema.');
	define('EMAIL_YA_EXISTE', 'Ya existe un usuario con ese email.');
	define('EMAIL_NO_EXISTE', 'No existe el email.');
	define('USUARIO_EMAIL_NO_COINCIDEN', 'El usuario y el email no coinciden.');
	define('ACCION_DENEGADA_INSERTAR_USUARIO', 'Sólo el administrador puede insertar usuarios.');
	define('ACCION_DENEGADA_EDITAR_USUARIO', 'Sólo el administrador puede editar los datos de un usuario y un usuario los suyos propios.');


	define('LOGIN_USUARIO_VACIO', 'El login de usuario es vacio.');
	define('LOGIN_USUARIO_MENOR_QUE_3', 'El tamaño del nombre de usuario no puede ser menor que 3.');
	define('LOGIN_USUARIO_MAYOR_QUE_15', 'El tamaño del nombre de usuario no puede ser mayor que 15.');
	define('LOGIN_USUARIO_ALFANUMERICO_INCORRECTO', 'El nombre de usuario no puede contener más que letras y números, no se aceptan caracteres en blanco, ñ, acentos o carcateres especiales.');

	//contrasena
	define('CONTRASEÑA_USUARIO_VACIA', 'La contraseña no puede ser vacia.');
	define('CONTRASEÑA_USUARIO_LONGITUD_INCORRECTA', 'Seguridad de la password comprometida. Longitud de password incorrecta.');
	define('CONTRASEÑA_USUARIO_ALFANUMERICO_INCORRECTO', 'La contraseña de usuario no puede contener más que letras y números, no se aceptan caracteres en blanco, ñ, acentos o carcateres especiales.'); 
	define('CONTRASENA_USUARIO_VACIA', 'La contraseña no puede ser vacia.');
	define('CONTRASENA_USUARIO_LONGITUD_INCORRECTA', 'Seguridad de la password comprometida. Longitud de password incorrecta.');
	define('CONTRASENA_USUARIO_ALFANUMERICO_INCORRECTO', 'La contraseña de usuario no puede contener más que letras y números, no se aceptan caracteres en blanco, ñ, acentos o carcateres especiales.'); 


	//nombre
	define('NOMBRE_VACIO', 'El nombre no puede ser vacio.');
	define('NOMBRE_FORMATO_INCORRECTO', 'El nombre del usuario no puede contener más que letras.');	
	define('NOMBRE_MENOR_QUE_3', 'El nombre del usuario no puede se menor que 3.');
	define('NOMBRE_MAYOR_QUE_45', 'El nombre del usuario no puede ser mayor que 45.');	

	//apellidos
	define('APELLIDOS_VACIO', 'Los apellidos no pueden ser vacios.');
	define('APELLIDOS_FORMATO_INCORRECTO', 'Los apellidos del usuario no pueden contener más que letras.');
	define('APELLIDOS_MENOR_QUE_3', 'Los apellidos del usuario no pueden se menores que 3.');	
	define('APELLIDOS_MAYOR_QUE_45', 'Los apellidos del usuario no pueden ser mayores que 45.');	

	//fechaNacimiento
	define('FECHA_NACIMIENTO_VACIA', 'La fecha no puede ser vacia.');
	define('FECHA_NACIMIENTO_FORMATO_INCORRECTO', 'El formato de la fecha no es correcto: aaaa-mm-dd.');
	define('FECHA_NACIMIENTO_SOLO_NUMEROS_Y_GUIONES', 'La fecha solo puede contener números y -.');
	define('FECHA_NACIMIENTO_MENOR_QUE_10', 'La fecha de nacimiento no puede ser menor que 10 dígitos.');
	define('FECHA_NACIMIENTO_MAYOR_QUE_10', 'La fecha de nacimiento no puede ser mayor que 10 dígitos.');
	define('FECHA_NACIMIENTO_IMPOSIBLE', 'La fecha de nacimiento no puede ser mayor a la fecha actual.');

	//direccion
	define('DIRECCION_VACIA', 'La longitud de la direccion no debe ser vacia.');
	define('DIRECCION_FORMATO_INCORRECTO', 'La direccion solo debe contener letras, números º y ª.');
	define('DIRECCION_MENOR_5', 'La longitud de la direccion no debe ser manor de 5 caracteres.');
	define('DIRECCION_MAYOR_200', 'La longitud de la direccion no debe ser mayor de 200 caracteres.');

	//telefono
	define('TELEFONO_VACIO', 'El número de teléfono no puede ser vacio.');
	define('TELEFONO_FORMATO_INCORRECTO', 'El formato del teléfono no es el correcto, deben ser 9 números.');
	define('TELEFONO_MENOR_QUE_9', 'El tamaño del número de teléfono no puede ser menor que 9.');
	define('TELEFONO_MAYOR_QUE_9', 'El tamaño del número de teléfono no puede ser mayor que 9.');
	
	//email
	define('EMAIL_VACIO', 'El email no puede ser vacío.');
	define('EMAIL_LONGITUD_MINIMA', 'El email debe tener por lo menos 6 caracteres.');
	define('EMAIL_LONGITUD_MAXIMA', 'El email debe tener menos de 40 caracteres.');
	define('EMAIL_FORMATO_INCORRECTO', 'El formato del email no es correcto.');
	define('EMAIL_ALFANUMERICO_INCORRECTO', 'El formato del teléfono no es el correcto, deben ser números o letras.');

	define('BORRADO_LOGICO_DIFERENTE_0_1', 'El formato del borrado lógico no es correcto');

	define('ID_ROL_VACIO', 'El id del rol está vacío');
	define('ID_ROL_ERROR_FORMATO', 'El formato del id del rol es incorrecto');

	define('ADMIN_NO_SE_PUEDE_BORRAR', 'No se puede borrar el administrador del sistema.');
	define('ACCION_DENEGADA_BORRAR_USUARIO', 'Sólo el administrador puede borrar un usuario.');


	
	define('ACCION_ES_VACIO', 'La acción no puede estar vacía.');
	define('FUNCIONALIDAD_ES_VACIO', 'La funcionalidad no puede estar vacía.');
	define('ROL_ES_VACIO', 'El rol no puede estar vacío.');
	define('ACCION_VACIO', 'La acción no puede estar vacía.');
	define('FUNCIONALIDAD_VACIO', 'La funcionalidad no puede estar vacía.');
	define('ID_ACCION_ERROR_FORMATO', 'El id de la acción no tiene el formato correcto.');
	define('ID_FUNCIONALIDAD_ERROR_FORMATO', 'El id de la funcionalidad no tiene el formato correcto.');
	

	//categoria
	define('ACCION_DENEGADA_BUSCAR_CATEGORIAS', 'Sólo el moderador puede buscar categorias');
	define('ACCION_DENEGADA_INSERTAR_CATEGORIA', 'Sólo el moderador puede añadir categorias');
	define('ACCION_DENEGADA_EDITAR_CATEGORIA', 'Sólo el moderador puede modificar categorias');
	define('ACCION_DENEGADA_BORRAR_CATEGORIA', 'Sólo el moderador puede borrar categorias');
	define('ACCION_DENEGADA_NO_MODIFICADOR', 'Sólo el propietario puede borrar categorias');
	define('DESCRIPCION_VACIA', 'La descripción no puede ser vacía.');
	define('DESCRIPCION_MENOR_QUE_3', 'La descripción no puede ser menor de 3.');
	define('DESCRIPCION_MAYOR_QUE_500', 'La descripción no puede ser mayor de 500.');
	define('DESCRIPCION_FORMATO_INCORRECTO', 'El formato de la descripción no es correcto.');

	define('CATEGORIA_NO_EXISTE', 'La categoría no existe en el sistema');
	define('CATEGORIA_RAIZ_NO_SE_PUEDE_BORRAR', 'La categoría raíz no se puede borrar');
	define('CATEGORIA_RAIZ_NO_SE_PUEDE_MODIFICAR', 'La categoría raíz no se puede modificar');
	define('CATEGORIA_TIENE_HIJOS', 'No se puede borrar una categoría con hijos');
	define('ID_CATEGORIA_ERROR_FORMATO', 'El formato del id de la categoría es incorrecto');
	define('CATEGORIA_DUPLICADA', 'No puede haber dos categorias con el mismo nombre');

	define('PROCESO_YA_EXISTE', 'Ya existe el proceso en el sistema');
	define('PROCESO_NO_ES_ULTIMA_VERSION', 'La versión del proceso no es la última');
	define('PROCESO_ESTA_EN_USO', 'El proceso está en uso por algún usuario y no se puede borrar');
	define('ACTIVO_VACIO', 'Activo no puede ser vacío');
	define('ACTIVO_ERROR_FORMATO', 'El formato del activo es incorrecto');
	define('ID_VACIO', 'El id está vacío');
	define('ID_NOTIFICACION_ERROR_FORMATO', 'El formato del id es incorrecto');
	define('TITULO_VACIO', 'El título no puede ser vacío');
	define('TITULO_MENOR_QUE_3', 'El título no puede ser menor de 3');
	define('TITULO_MAYOR_QUE_45', 'El título no puede ser mayor de 45');
	define('TITULO_FORMATO_INCORRECTO', 'El formato del título no es correcto');
	define('CUERPO_VACIA', 'El cuerpo del mensaje no puede setar vacío');
	define('CUERPO_MENOR_QUE_3', 'El cuerpo del mensaje no puede ser menor de 3');
	define('CUERPO_MAYOR_QUE_500', 'El cuerpo del mensaje no puede ser mayor de 500');
	define('CUERPO_FORMATO_INCORRECTO', 'El cuerpo del mensaje no tiene el formato correcto');
	define('FECHA_FORMATO_INCORRECTO', 'El formato de la fecha es incorrecto');
	define('FECHA_SOLO_NUMEROS_Y_GUIONES', 'La fecha sólo puede tener números y guines');
	define('FECHA_MENOR_QUE_10', 'La fecha no puede ser menor de 10');
	define('FECHA_MAYOR_QUE_10', 'La fecha no puede ser mayor de 10');
	define('FECHA_IMPOSIBLE', 'La fecha no puede ser futura');
	define('FECHA_VACIA', 'La fecha no puede ser vacía');
	define('NOTIFICACION_LEIDA_VACIO', 'Leído no puede ser vacía');
	define('NOTIFICACION_LEIDA_ERROR_FORMATO', 'El formato de leída no es correcto');
	define('USUARIO_NO_ES_DUEÑO_NOTIFICACION', 'La notificación no te pertenece');

	define('ACCION_DENEGADA_BUSCAR_PARAMETROS', 'Sólo el formulador puede buscar parámetros');
	define('ACCION_DENEGADA_INSERTAR_PARAMETRO', 'Sólo el formulador puede buscar parámetros');
	define('ACCION_DENEGADA_EDITAR_PARAMETRO', 'Sólo el formulador puede editar parámetros');
	define('ACCION_DENEGADA_ELIMINAR_PARAMETRO', 'Sólo el formulador puede eliminar parámetros');
	define('PARAMETRO_NO_EXISTE', 'El parámetro no existe');

	define('VALOR_VACIO', 'El valor está vacío');
	define('VALOR_MAYOR_QUE_9', 'El valor no puede ser mayor de 9');

	define('UNIDAD_MAYOR_QUE_45', 'La unidad debe ser mayor de 45');
	define('UNIDAD_FORMATO_INCORRECTO', 'El formato de la uidad es incorrecto');

	define('ID_PARAMETRO_VACIO', 'El id no puede ser vacío');
	define('ID_PARAMETRO_ERROR_FORMATO', 'El formato del id es incorrecto');
	define('PARAMETRO_ESTA_EN_USO', 'El parametro está en uso por algún usuario y no se puede borrar');
	define('UNIDAD_VACIO', 'La unidad no puede ser vacía');
	define('DESCRIPCION_PARAMETRO_FORMATO_INCORRECTO', 'La descriopción sólo puede contener letras');

	define('ID_PROCESO_VACIO', 'El id no puede ser vacío');
	define('ID_PROCESO_ERROR_FORMATO', 'El formato del id es incorrecto');
	define('VERSION_VACIO', 'La versión no puede ser vacía');
	define('VERSION_ERROR_FORMATO', 'El formato de la versión es incorrecto');
	define('PROCESO_USUARIO_EJECUCION_EN_USO', 'El proceso ya se ha calculado y no se puede borrar');
	define('VERSION_ANTERIOR_NO_CALCULADA', 'No se puede abrir el proceso. La versión anterior no se ha calculado');
	define('PROCESO_ID_CATEGORIA_VACIO', 'El id del proceso no puede ser vacío');
	define('FORMULA_VACIA', 'La fórmula no puede ser vacía');
	define('FORMULA_NO_VACIA', 'La fórmula debe ser vacía');
	define('FORMULA_MENOR_QUE_3', 'La fórmula no puede ser menor que 3');
	define('FORMULA_MAYOR_QUE_500', 'La fórmula no puede ser mayor que 500');
	
	define('FECHA_CREACION_VACIA', 'La fecha no puede ser vacía');
	define('FECHA_CREACION_FORMATO_INCORRECTO', 'La fecha tiene un formato incorrecto');
	define('FECHA_CREACION_SOLO_NUMEROS_Y_GUIONES', 'La fecha sólo puede tener números y guiones');
	define('FECHA_CREACION_MENOR_QUE_10', 'La fecha no puede ser menor que 10');
	define('FECHA_CREACION_MAYOR_QUE_10', 'La fecha no puede ser mayor que 10');
	define('FECHA_CREACION_IMPOSIBLE', 'La fecha no es real');

	define('FECHA_MODIFICACION_VACIA', 'La fecha no puede ser vacía');
	define('FECHA_MODIFICACION_FORMATO_INCORRECTO', 'La fecha tiene un formato incorrecto');
	define('FECHA_MODIFICACION_SOLO_NUMEROS_Y_GUIONES', 'La fecha sólo puede tener números y guiones');
	define('FECHA_MODIFICACION_MENOR_QUE_10', 'La fecha no puede ser menor que 10');
	define('FECHA_MODIFICACION_MAYOR_QUE_10', 'La fecha no puede ser mayor que 10');
	define('FECHA_MODIFICACION_IMPOSIBLE', 'La fecha no es real');

	define('ACCION_FUNCIONALIDAD_EXISTE', 'La acción-funcionalidad ya existe');
	define('ACCION_FUNCIONALIDAD_NO_EXISTE', 'La acción-funcionalidad no existe');
	define('ACCION_DENEGADA_BUSCAR_NOTIFICACIONES', 'No tienes permisos para buscar notificaciones');
	define('ACCION_DENEGADA_INSERTAR_NOTIFICACION', 'No tienes permisos para insertar notificaciones');
	define('ACCION_DENEGADA_EDITAR_NOTIFICACION', 'No tienes permisos para editar notificaciones');
	define('ACCION_DENEGADA_ELIMINAR_NOTIFICACION', 'No tienes permisos para eliminar notificaciones');
	define('NOTIFICACION_NO_EXISTE', 'La notificación no existe');
	define('ACCION_DENEGADA_INSERTAR_PROCESOS_USUARIO_PARAMETRO_EJECUCION', 'No tienes permiso para insertar procesos-usuario-ejecucion-parametro');
	define('ACCION_DENEGADA_INSERTAR_PROCESOS_USUARIO_EJECUCION', 'No tienes permiso para insertar procesos-usuario-ejecucion');
	define('PROCESO_USUARIO_EJECUCION_PARAMETRO_NO_EXISTE', 'El proceso-usuario-ejecucion no existe');
	define('ACCION_DENEGADA_BORRAR_PROCESO_USUARIO_EJECUCION_PARAMETRO', 'No tienes permiso para borar el proceso-usuario-ejecucion-parametro');
	define('ACCION_DENEGADA_BORRAR_PROCESO_USUARIO_EJECUCION', 'No tienes permiso para borar el proceso-usuario-ejecucion');
	define('ACCION_DENEGADA_BUSCAR_PROCESOS_USUARIO_PARAMETRO_EJECUCION', 'No tienes permisos para buscar procesos-usuario-ejecucion-parametro');
	define('ACCION_DENEGADA_BUSCAR_PROCESOS_USUARIO_EJECUCION', 'No tienes permisos para buscar procesos-usuario-ejecucion');
	define('PROCESO_USUARIO_EJECUCION_PARAMETRO_YA_EXISTE', 'Proceso-usuario-ejecucion-parametro ya existe');
	define('PROCESO_USUARIO_EJECUCION_YA_EXISTE', 'Proceso-usuario-ejecucion ya existe');
	define('PROCESO_USUARIO_EJECUCION_NO_EXISTE', 'El proceso-usuario-ejecución no existe');
	define('ACCION_DENEGADA_BUSCAR_PROCESO', 'No tienes permisos para buscar procesos');
	define('PROCESO_NO_EXISTE', 'El proceso no existe');
	define('ACCION_DENEGADA_EDITAR_PROCESO', 'No tienes permisos para editar procesos');
	define('ACCION_DENEGADA_ELIMINAR_PROCESO', 'No tienes permisos para eliminar procesos');
	define('ROL_ACCION_FUNCIONALIDAD_EXISTE', 'El rol-accion-funcionalidad ya existe');
	define('ROL_ACCION_FUNCIONALIDAD_NO_EXISTE', 'El rol-accion-funcionalidad no existe');
?>